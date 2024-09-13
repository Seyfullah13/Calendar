<?php

namespace Database\Seeders;

use App\Models\MyUserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyUserRolesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // $data = [
    //     [
    //         'user_id' => 1,
    //         'property_id' => 14,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 24,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 34,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 44,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 54,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 64,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 74,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 8,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 9,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 10,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 11,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 12,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 13,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 14,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 15,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 16,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 17,
    //         'my_role_id' => 3,
    //     ],
    //     [
    //         'user_id' => 1,
    //         'property_id' => 18,
    //         'my_role_id' => 3,
    //     ],
    // ];

    // foreach ($data as $row) {
    //   MyUserRole::create($row);
    // }

    // Step 1: Retrieve all unique property IDs that have bookings
    $propertyIds = DB::table('bookings')->distinct()->pluck('property_id');

    // Step 2: Create an array of data to insert into the MyUserRole table
    $data = [];
    foreach ($propertyIds as $propertyId) {
      $data[] = [
        'user_id' => 1,
        'property_id' => $propertyId,
        'my_role_id' => 3,
      ];
    }

    // Step 3: Insert the data into the MyUserRole table
    foreach ($data as $row) {
      MyUserRole::create($row);
    }
  }
}