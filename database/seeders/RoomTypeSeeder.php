<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->insert([
            'name' => 'Standard',
            'rate' => 6000,
            'caution' => 2000,
            'number_of_beds' => 1,
            'bed_type' => 'King-sized',
            'adult_capacity' => 2,
            'children_capacity' => 1,
        ]);
        DB::table('room_types')->insert([
            'name' => 'Deluxe',
            'rate' => 7000,
            'caution' => 2000,
            'number_of_beds' => 1,
            'bed_type' => 'King-sized',
            'adult_capacity' => 2,
            'children_capacity' => 1,
        ]);
        DB::table('room_types')->insert([
            'name' => 'Executive Double',
            'rate' => 8000,
            'caution' => 2000,
            'number_of_beds' => 1,
            'bed_type' => 'King-sized',
            'adult_capacity' => 2,
            'children_capacity' => 1,
        ]);
    }
}
