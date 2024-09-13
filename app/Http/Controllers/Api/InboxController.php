<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Events\NewMessageEvent;
use App\Events\NewReactionEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use App\Events\DeletedMessageEvent;
use App\Events\RemoveReactionEvent;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\ReadConversationEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class InboxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $response_array = $request->user()->contact->conversationsApi();

        return response()
            ->json([
                'conversations'                => $response_array[0],
                'unread_conversations_number'  => $response_array[1]
            ]);
    }

    public function show(Request $request, Conversation $conversation) {
        $this->authorize('view', $conversation);

        $messages = null;

        if ($request->get('before')) {
            $messages = $conversation->orderedMessagesBefore($request->get('before'));
        } else {
            $messages = $conversation->orderedMessagesLimit(10);
        }

        $messages = $this->getReactions($messages);

        $read_conversation = Auth::user()->contact->conversation($conversation->id)->pivot;
        $read_conversation->read_at = Carbon::now();
        $read_conversation->save();

        return response()
            ->json([
                'messages'        => array_reverse($messages),
                'messages_count'  => $conversation->countMessages()
            ]);
    }

    public function store(Request $request, Conversation $conversation)
    {
        $this->authorize('update', $conversation);

        $this->validator($request->all())->validate();

        $messages = [];

        $message_id = DB::table('messages')->insertGetId([
            'reply_to_id'       => $request->reply_to_id,
            'conversation_id'   => $conversation->id,
            'contact_id'        => Auth::user()->contact->id,
            'order'             => 0,
            'message_text'      => $this->displayMessage($request->message_text),
            'sent_at'           => Carbon::now()
        ]);

        $u_files_by_types = $this->groupFilesByType($request->attachments);

        if($u_files_by_types) 
        {
            $initial_message_already_has_attachment = false;

            foreach($u_files_by_types as $type => $u_files_by_type)
            {
                
                if(($type === 'image') || ($type === 'application'))
                {
                    if ($initial_message_already_has_attachment) {
                        $message_id = $this->createEmptyMessage($conversation->id);
                    }

                    foreach ($u_files_by_type as $file) {
                        DB::table('attachments')->insert([
                            'message_id'     => $message_id,
                            'original_name'  => $file['name'],
                            'stored_name'    => $file['url'],
                            'mime_type'      => $file['type'],
                            'extension'      => $file['extension'],
                            'size'           => $file['size']
                        ]);
                    }
                    
                    $messages[] = $this->addMessage($conversation, $message_id);
                    $initial_message_already_has_attachment = true;
                }
                else 
                {
                    foreach ($u_files_by_type as $file) {
                        if ($initial_message_already_has_attachment) {
                            $message_id = $this->createEmptyMessage($conversation->id);
                        }
                        
                        DB::table('attachments')->insert([
                            'message_id'     => $message_id,
                            'original_name'  => $file['name'],
                            'stored_name'    => $file['url'],
                            'mime_type'      => $file['type'],
                            'extension'      => $file['extension'],
                            'size'           => $file['size']
                        ]);

                        $messages[] = $this->addMessage($conversation, $message_id);
                        $initial_message_already_has_attachment = true;
                    }
                }
            }
        }
        else 
        {
            $messages[] = $this->addMessage($conversation, $message_id);
        }

        NewMessageEvent::dispatch($conversation, $this->getReactions($messages));

        // notify users...

        // return response()->json(['messages' => $messages]);
        return response()->json(['success' => 'Message sent successfully']);
    }

    public function read(Conversation $conversation) {
        $this->authorize('update', $conversation);

        $read_date = Carbon::now();

        $read_conversation = Auth::user()->contact->conversation($conversation->id)->pivot;
        $read_conversation->read_at = $read_date;
        $read_conversation->save();

        ReadConversationEvent::dispatch($conversation);

        return response()
            ->json([
                'read_at' => $read_date
            ]);
    }

    public function uploadFile(Request $request, Conversation $conversation) {
        
        $this->authorize('update', $conversation);

        if (isset($request->delete) && (Storage::exists('public/' . $request->file['url']))) 
        {
            $deleted = Storage::delete(['public/' . $request->file['url']]);

            return response()->json([
                'success' => $deleted
            ]);
        }
        else 
        {
            // $request->validate([
            //     'file' => 'max:20971520|mimes:png,jpeg,svg,gif,mp4,avi,pdf'
            // ]);
    
            $file = $request->file('file');
    
            $filename = $file->store('inboxes/' . $conversation->id, 'public');
    
            return response()->json([
                'name'      => $file->getClientOriginalName(),
                'type'      => $file->getMimeType(),
                'extension' => $file->guessExtension(),
                'url'       => $filename,
                'size'      => $file->getSize()
            ]);
        }
    }

    public function deleteMessage(Request $request, Conversation $conversation) {
        $this->authorize('update', $conversation);

        $message_id = $request->message_id;
        $message_attachments_query = DB::table('attachments')->where('message_id', $message_id);
        $message_attachments = $message_attachments_query->get();
        $deleted_at = Carbon::now();

        foreach ($message_attachments as $key => $attachment) {
            if(Storage::exists('public/' . $attachment->stored_name)) 
            {
                Storage::delete('public/' . $attachment->stored_name);
            }
        }

        $message_attachments_query->delete();

        $message = Message::find($message_id);
        $message->delete();

        DeletedMessageEvent::dispatch($conversation, $message);

        return response()->json([
            'success' => $deleted_at
        ]);
    }

    protected function getUsersReactionsForAMessage($id){

        $usersForAReaction = DB::table("contacts")
            ->join("contact_message","contacts.id", "=", "contact_message.contact_id")
            ->where("contact_message.message_id", $id)
            ->select("contacts.full_name", "contact_message.*")
            ->get()->toArray();
        
        return $usersForAReaction;
    }
    
    protected function getReactions($messages){
        $reactions = [];

        foreach($messages as $m){
            
            $usersReactions = $this->getUsersReactionsForAMessage($m->id);

            $message = DB::table("contact_message")
                ->selectRaw("reaction_unicode, message_id, count(*) AS `times`")
                ->where("message_id", $m->id)
                ->groupBy("reaction_unicode", "message_id")
                ->get()
                ->toArray();
           
            $message = array_map(function ($mes) use ($usersReactions){
                $decoded_reactions = json_decode(json_encode($mes), true);
                $reactions = array_filter($usersReactions, function($user) use ($mes){
                    return $user->reaction_unicode === $mes->reaction_unicode;
                });
                $decoded_reactions["persons"] = array_values($reactions);
                return $decoded_reactions;
            }, $message);

            $reactions[] = $message;                       
        }

        if(!is_array($messages)){
            $messages = $messages->toArray();
        }

        $messages = array_map(function (array | Message $message) use($reactions){
            static $i = 0;
            if(!is_array($message)){
                $message = $message->toArray();
            }
            $message["reactions"] = $reactions[$i];
            $i++;
            return $message;
        },$messages);

        return $messages;
    }

    public function add_reaction(Request $request, Conversation $conversation){
        $this->authorize('update', $conversation);

        $hasReacted = DB::table("contact_message")
            ->where("contact_id", Auth::user()->contact->id)
            ->where("message_id", $request->message_id)
            ->where("reaction_unicode", $request->ascii_code)
            ->get()
            ->toArray();

        if(empty($hasReacted)){

            DB::table("contact_message")->insert([
                "contact_id" => Auth::user()->contact->id,
                "message_id" => $request->message_id,
                "reaction_unicode" => $request->ascii_code,
            ]);

            $message = [$conversation->message($request->message_id)];    
            
            $reactions = $this->getReactions($message)[0];

            NewReactionEvent::dispatch($conversation, $reactions);

            return response()->json([
                'success' => "You've reacted"
            ]);
        }
        else{
            return response()->json([
                'success' => "You've already reacted"
            ]);
        }
    }

    public function remove_reaction(Request $request, Conversation $conversation){
        $this->authorize('update', $conversation);
        
        $hasReacted = DB::table("contact_message")
            ->where("contact_id", Auth::user()->contact->id)
            ->where("message_id", $request->message_id)
            ->where("reaction_unicode", $request->ascii_code)
            ->get()
            ->toArray();

        if(!empty($hasReacted)){
            DB::table("contact_message")
                ->where("contact_id", Auth::user()->contact->id)
                ->where("message_id", $request->message_id)
                ->where("reaction_unicode", $request->ascii_code)
                ->delete();
    
            $message = [$conversation->message($request->message_id)];    
            
            $reactions = $this->getReactions($message)[0];
    
            RemoveReactionEvent::dispatch($conversation, $reactions);
    
            return response()->json([
                'success' => "You've removed your reaction"
            ]);
        }
        else{
            return response()->json([
                'success' => "No reaction to remove"
            ]); 
        }
    }

    public function talkInPrivate(int $id) {
        $auth_contact = Auth::user()->contact;
        $talked_contact = Contact::find($id);
        
        $conversation = Conversation::whereHas('contacts', function(Builder $query) use ($auth_contact, $talked_contact)
            {
                $query->whereIn('full_name', [$auth_contact->full_name, $talked_contact->full_name]);
            }, '=', 2)
            ->whereNull('booking_id')
            ->first();

        $conversation_id = null;

        if(!$conversation)
        {
            $conversation_id = DB::table('conversations')->insertGetId([
                'booking_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('contact_conversation')->insert([
                ['contact_id' => $auth_contact->id, 'conversation_id' => $conversation_id, 'read_at' => Carbon::now()],
                ['contact_id' => $talked_contact->id, 'conversation_id' => $conversation_id, 'read_at' => Carbon::now()]
            ]);

            DB::table('messages')->insert([
                'conversation_id' => $conversation_id,
                'contact_id' => $auth_contact->id,
                'order' => 0,
                'message_type' => 'notification',
                'message_text' => $auth_contact->first_name . ' created the conversation',
                'sent_at' => Carbon::now()
            ]);
        }
        else 
        {
            $conversation_id = $conversation->id;
        }

        return $conversation_id;
    }

    private function createEmptyMessage($conversation_id)
    {
        return DB::table('messages')->insertGetId([
            'reply_to_id'       => null,
            'conversation_id'   => $conversation_id,
            'contact_id'        => Auth::user()->contact->id,
            'order'             => 0,
            'message_text'      => '',
            'sent_at'           => Carbon::now()
        ]);
    }

    private function addMessage(Conversation $conversation, int $message_id)
    {
        $conversation->updated_at = Carbon::now();
        $conversation->save();
        
        return $conversation->message($message_id);
    }

    private function groupFilesByType($u_files) 
    {
        $u_files_by_types = [];

        foreach ($u_files as $u_file) {
            $type = explode('/', $u_file['type'])[0];
            
            if (!array_key_exists($type, $u_files_by_types)) {
                $u_files_by_types[$type] = array();
            }
            
            $u_files_by_types[$type][] = $u_file;
        }

        return $u_files_by_types;
    }

    private function trimHtmlTags(string $str) {
        return preg_replace('/<\/?[^>]+>/', '', $str);
    }

    private function parseDatas(string $str) {
        $http_url_regex = "/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()!@:%_\+.~#?&\/\/=]*)/";
        // $tel_regex = "/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/";
        // $email_regex = "/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/";

        preg_match_all($http_url_regex, $str, $urls);
        foreach ($urls[0] as $url) {
            $str = str_replace($url, "<a href='$url' class='font-semibold underline' target='_blank'>$url</a>", $str);
        }
        
        // preg_match_all($tel_regex, $str, $tels);
        // foreach ($tels[0] as $tel) {
        //     $str = str_replace($tel, "<a href='tel:$tel' class='font-semibold underline' target='_blank'>$tel</a>", $str);
        // }
        
        // preg_match_all($email_regex, $str, $emails);
        // foreach ($emails[0] as $email) {
        //     $str = str_replace($email, "<a href='mailto:$email' class='font-semibold underline'>$email</a>", $str);
        // }

        return $str;
    }
    
    // Fonction pour afficher le message en conservant les sauts de ligne et en nettoyant le HTML
    private function displayMessage($message)
    {
        // Nettoyage du HTML avec Purifier
        $cleanMessage = new HtmlString(Purifier::clean($message));
    
        // Transformation des liens en HTML fonctionnel
        $messageWithLinks = $this->parseDatas($cleanMessage);
    
        // Conservation des sauts de ligne
        $messageWithLineBreaks = nl2br($messageWithLinks);
    
        return $messageWithLineBreaks;
    }

    private function validator(array $data) 
    {
        return Validator::make($data, [
            'message_text' => 'required_without:attachments'
        ]);
    }
}
