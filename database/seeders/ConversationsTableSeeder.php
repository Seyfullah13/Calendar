<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConversationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i=0; $i < 7; $i++) { 
            Conversation::create([
                'booking_id' => ($i + 1),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
