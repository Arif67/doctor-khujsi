<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RolePermissionSeeder::class);
        $this->call(PagesSeeder::class);


       $testUser = User::factory()->create([
            'first_name' => 'Patient',
            'email' => 'patient@gmail.com',
            'password' => Hash::make('12345678'),
            'plan_password' => '12345678'
        ]);

        $adminUser = User::factory()->create([
            'first_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'plan_password' => '12345678'
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'patient', 'guard_name' => 'web']);
        $adminUser->assignRole($adminRole);
        $testUser->assignRole($userRole);
    }
}
