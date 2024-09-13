<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IcalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Données iCal
        $icals = [
            //Gueliz Airbnb
            [
                'ical_url' => 'https://www.airbnb.fr/calendar/ical/914396303106441469.ics?s=0c51d187ff133c6b3d52331f7f2207b7',
                'property_id' => 1, 
                'partenaire_id' => 1, 
                'calendar_name' => 'Calendar 1',
            ],
            //Ain Itti Airbnb
            [
                'ical_url' => 'https://www.airbnb.fr/calendar/ical/36180168.ics?s=5abad9269e83984d0fd9965f4783a907',
                'property_id' => 2, 
                'partenaire_id' => 1,
                'calendar_name' => 'Calendar 1',
            ],
            //Neuilly Airbnb
            [
                'ical_url' => 'https://www.airbnb.com/calendar/ical/1147132949077311136.ics?s=0e9b4d61e888ca4a1fd56870511864f9&locale=fr',
                'property_id' => 3, 
                'partenaire_id' => 1, 
                'calendar_name' => 'Calendar 1',
            ],

             //Gueliz Hos
             [
                'ical_url' => 'https://api.hospitable.com/v1/properties/reservations.ics?key=1415446&token=7495f979-4f4a-4b8a-8f15-6c6c7404e3de&noCache',
                'property_id' => 1, 
                'partenaire_id' => 2, 
                'calendar_name' => 'Calendar 1',
            ],
            //Ain Itti Hos
            [
                'ical_url' => 'https://api.hospitable.com/v1/properties/reservations.ics?key=1415444&token=bf5e0612-d0c6-47f0-9ac9-1edeb50b25f8&noCache',
                'property_id' => 2, 
                'partenaire_id' => 2, 
                'calendar_name' => 'Calendar 1',
            ],

            //Gueliz Travel
            [
                'ical_url' => 'https://api.travelnest.com/ical?id=7108128',
                'property_id' => 1, 
                'partenaire_id' => 3, 
                'calendar_name' => 'Calendar 1',
            ],
            //Ain Itti Travel
            [
                'ical_url' => 'https://api.travelnest.com/ical?id=5073159',
                'property_id' => 2, 
                'partenaire_id' => 3, 
                'calendar_name' => 'Calendar 1',
            ],
        ];

        // Insérer les données dans la table
        foreach ($icals as $ical) {
            DB::table('icals')->insert([
                'ical_url' => $ical['ical_url'],
                'property_id' => $ical['property_id'],
                'partenaire_id' => $ical['partenaire_id'],
                'calendar_name' => $ical['calendar_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
