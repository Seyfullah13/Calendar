<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactConversationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $conversations = \DB::table('conversations')->select('id')->take(5)->get();

        \DB::table('contact_conversation')->insert([
            'contact_id' => 1,
            'conversation_id' => $conversations[0]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 2,
            'conversation_id' => $conversations[0]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 3,
            'conversation_id' => $conversations[0]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 4,
            'conversation_id' => $conversations[0]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 2,
            'conversation_id' => $conversations[1]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 3,
            'conversation_id' => $conversations[1]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 4,
            'conversation_id' => $conversations[1]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 5,
            'conversation_id' => $conversations[2]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 6,
            'conversation_id' => $conversations[2]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 6,
            'conversation_id' => $conversations[3]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 4,
            'conversation_id' => $conversations[3]->id
        ]);

        \DB::table('contact_conversation')->insert([
            'contact_id' => 1,
            'conversation_id' => $conversations[4]->id
        ]);
    }
}
