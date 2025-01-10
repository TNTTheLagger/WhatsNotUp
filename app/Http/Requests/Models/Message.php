<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'room_id', 'content', 'parent_id',
    ];

    // Relationship: A message belongs to one user (sender)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A message belongs to one chat room
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'room_id');
    }

    // Relationship: A message can have one parent message (if it's a reply)
    public function parentMessage()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    // Relationship: A message can have many replies (messages that reply to it)
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }
}
