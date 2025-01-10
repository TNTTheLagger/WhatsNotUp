<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
    ];

    // Relationship: A chat room has many messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
