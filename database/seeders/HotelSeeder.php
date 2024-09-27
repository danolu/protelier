<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotel')->insert([
            'name' => 'Hotel Name',
            'phone' => '123456789',
            'alt_phone' => '123456789',
            'email' => 'info@hotelname.com',
            'alt_email' => 'hotelname@mail.com',
            'address' => '5, Privet Drive CA.',
            'website' => 'hotelname.com',
            'tagline' => 'hospitality at its best',
        ]);
    }
}
