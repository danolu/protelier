<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'description' => 'Bar Rental X2',
            'customer' => 'Toke Makinwa',
            'method' => 'POS',
            'amount' => 230000,
            'unit_price' => 23000,
        ]);
    }
}
