<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('contacts')->delete();
        
        for ($i=1; $i <= 10; $i++) { 
            $user = \DB::table('users')->find($i);
    
            \DB::table('contacts')->insert([
                'type' => 'contact',
                'user_id' => $user->id,
                'first_name' => explode(' ', $user->name)[0],
                'full_name' => $user->name,
                'email' => $user->email,
                'phone' => null,
                'local' => null,
                'picture_url' => $user->avatar,
                'thumbnail_url' => null,
                'location' => null,
            ]);
        }
    }
}
