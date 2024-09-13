<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use DateTimeInterface;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reply_to_id',
        'conversation_id',
        'contact_id',
        'order',
        'message_text',
        'sent_at'
    ];

    protected $dates = ['sent_at'];

    public function getSentAtAttribute($value)
    {
        return Carbon::parse($value)->toIso8601String();
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function replyTo()
    {
        return $this->belongsTo(Message::class, 'reply_to_id');
    }

    public function sender()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('c');
    }
}
