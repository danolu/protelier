<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guests')->insert([
            'first_name' => 'Harry',
            'last_name' => 'Potter',
            'phone' => '123456789',
        ]);
    }
}
