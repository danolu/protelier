<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        // UserSeeder::class,
        PermissionSeeder::class,
        HotelSeeder::class,
        RoomTypeSeeder::class,
        EmployeeSeeder::class,
        RoomSeeder::class,
        ServiceSeeder::class,
        GuestSeeder::class,
        PaymentSeeder::class,
    ]);
    }
}
