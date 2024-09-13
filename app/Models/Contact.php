<?php

namespace App\Models;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'first_name',
        'full_name',
        'email',
        'phone',
        'local',
        'picture_url',
        'thumbnail_url',
        'location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'contact_id');

    }

    public function reactedMessages()
    {
        return $this
            ->belongsToMany(Message::class, 'contact_message', 'contact_id', 'message_id')
            ->withPivot('reaction_unicode');
    }

    public function conversations()
    {
        return $this
            ->belongsToMany(Conversation::class, 'contact_conversation', 'contact_id', 'conversation_id')
            ->withPivot('read_at');
    }

    public function conversation(int $conversation_id)
    {
        return $this
            ->conversations()
            ->where('conversation_id', '=', $conversation_id)
            ->first();
    }

    public function contacts() {
        return $this->contactsQuery()->get();
    }

    public function contactsQuery() 
    {
        $contact_conversation_ids = $this->conversations()->select('conversations.id')->pluck('conversations.id');
        
        $result = Contact::whereHas('conversations', function ($query) use ($contact_conversation_ids) {
            $query->whereIn('conversations.id', $contact_conversation_ids);
        })
        ->where('contacts.id', '!=', $this->id);

        return $result;
    }

    public function orderedConversations() 
    {
        return $this->conversations()->orderBy('updated_at', 'desc')->get();
    }

    public function conversationsApi() {
        $conversations_collection = $this
                                        ->conversations()
                                        ->select('conversations.id', 'conversations.updated_at', 'booking_id')
                                        ->orderBy('conversations.updated_at', 'desc')
                                        ->with([
                                            'contacts' => function ($query) {
                                                $query->select('contacts.id', 'first_name', 'full_name', 'email', 'picture_url');
                                            },
                                            'booking' => function ($query) {
                                                $query->select('bookings.id', 'check_in', 'check_out', 'token', 'partenaire_id','property_id', 'booking_guest_id', 'booking_status_id');
                                                $query->with('guest:id,first_name,last_name,picture');
                                                $query->with('property:id,property_attribute_id');
                                                $query->with('status:id,name');
                                                $query->with('partenaire:id,name,icon');
                                            },
                                            'booking.property.attribute' => function ($query) {
                                                $query->select('id', 'name');
                                            },
                                        ])
                                        ->get();

        $conversation_array = [];
        $unread_conversations_number = 0;

        foreach($conversations_collection as $conversation) 
        {
            $conversation->is_read = $conversation->updated_at < $conversation->pivot->read_at;
            $conversation->read_by = $conversation->readBy();
            $conversation->total_members_number = $conversation->contacts()->count();

            unset($conversation->pivot);

            if (is_null($conversation->booking_id) && $conversation->contacts->count() == 2) {
                $interlocutor = $conversation->contacts->firstWhere('id', '!=', Auth::user()->contact->id);
                
                $conversation->interlocutor = $interlocutor;
            }

            if ($conversation->is_read === false) {
                $unread_conversations_number++;
            }

            $last_message = $conversation->lastMessage();

            if($last_message !== null) 
            {
                $last_message = [
                    $last_message->contact_id, 
                    $last_message->message_text, 
                    $last_message->message_type,
                    count($last_message->attachments->toArray())
                ];
                $last_message[1] = preg_replace('/<\/?[^>]+>/', '', $last_message[1]);
            }
            else 
            {
                $last_message = [0, 'Aucun message', null, 0];
            }

            $conversation->last_message = $last_message;

            $conversation_array[$conversation->id] = $conversation;
        }

        return [$conversation_array, $unread_conversations_number];
    }
}
