<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Hall Rental',
            'price' => 10000,
        ]);
    }
}
