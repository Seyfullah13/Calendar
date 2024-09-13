<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function contacts()
    {
        return $this
            ->belongsToMany(Contact::class, 'contact_conversation', 'conversation_id', 'contact_id')
            ->withPivot('read_at');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function message(int $message_id)
    {
        return $this
            ->orderedMessagesQuery()
            ->firstWhere('id', $message_id);
    }
    
    public function orderedMessages() 
    {
        return $this->orderedMessagesQuery('asc')->get();
    }

    public function orderedMessagesLimit(int $limit) 
    {
        return $this
            ->orderedMessagesQuery()
            ->limit($limit)
            ->get();
    }

    public function orderedMessagesBefore($sent_at) 
    {
        return $this
            ->orderedMessagesQuery()
            ->where('sent_at', '<' , $sent_at)
            ->limit(10)
            ->get();
    }

    public function lastMessage() 
    {
        return $this
            ->orderedMessagesQuery()
            ->first();
    }

    public function countMessages()
    {
        return $this->messages()->count();
    }

    public function readBy() 
    {
        $readers = $this
                    ->contacts()
                    ->select('contacts.first_name')
                    ->where('contacts.id', '!=', Auth::user()->contact->id)
                    ->wherePivot('read_at', '>', $this->updated_at)
                    ->pluck('contacts.first_name')
                    ->toArray();

        return $readers;
    }

    public function orderedMessagesQuery(String $order_by = 'desc') 
    {
        return $this
            ->messages()
            ->withTrashed()
            ->orderBy('sent_at', $order_by)
            ->with([
                'sender:id,first_name,picture_url',
                'replyTo:id,message_text',
                'attachments',
            ]);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('c');
    }
}
