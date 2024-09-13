<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Photo::create(
      [
        'url' => 'https://picsum.photos/1000/600',
      ]
    );
  }
}
