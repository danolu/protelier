<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'employees']);
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'payroll']);
        Permission::create(['name' => 'payment methods']);
        Permission::create(['name' => 'statistics']);
        Permission::create(['name' => 'edit services']);
        Permission::create(['name' => 'edit rooms']);
        Permission::create(['name' => 'edit roomtypes']);
        Permission::create(['name' => 'settings']);
        Permission::create(['name' => 'book']);
        Permission::create(['name' => 'delete booking']);
        Permission::create(['name' => 'delete guest']);
        Permission::create(['name' => 'payment']);
        Permission::create(['name' => 'loyalty']);



        // create roles and assign existing permissions
        $manager = Role::create(['name' => 'manager']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $receptionist = Role::create(['name' => 'receptionist']);

        $receptionist->givePermissionTo('book');
        $manager->syncPermissions('employees', 'loyalty', 'statistics','delete guest','delete booking', 'payment methods', 'payment', 'edit services', 'edit rooms', 'edit roomtypes', 'settings', 'book');
        $supervisor->syncPermissions('edit rooms', 'settings');
        
        $admin = Role::create(['name' => 'admin']);

        $admin_user = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'employee_id' => 1,
        ]);

        $admin_user->assignRole($admin);
    }
}
