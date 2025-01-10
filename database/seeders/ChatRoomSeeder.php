<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatRoom;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default chat room
        ChatRoom::create([
            'room_name' => 'General Chat', // Name of the default chat room
        ]);
    }
}
