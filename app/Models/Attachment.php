<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'original_name',
        'stored_name',
        'mime_type',
        'extension',
        'size',
        'created_at'
    ];

    public function message() 
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
}
