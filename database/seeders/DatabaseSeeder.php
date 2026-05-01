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
        $this->call(RolePermissionSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(BangladeshLocationSeeder::class);
        $this->call(ServiceSeeder::class);

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $hospitalOwnerRole = Role::firstOrCreate(['name' => 'hospital_owner', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'patient', 'guard_name' => 'web']);

        $patientUser = User::updateOrCreate(
            ['email' => 'patient@gmail.com'],
            [
                'first_name' => 'Patient',
                'last_name' => 'Demo',
                'phone' => '01710000000',
                'address' => 'Dhaka, Bangladesh',
                'password' => Hash::make('12345678'),
                'plan_password' => '12345678',
                'email_verified_at' => now(),
            ]
        );
        $patientUser->syncRoles([$userRole]);

        $adminUsers = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '01710000001',
            ],
            [
                'first_name' => 'Main',
                'last_name' => 'Admin',
                'email' => 'superadmin1@gmail.com',
                'phone' => '01710000002',
            ],
            [
                'first_name' => 'Support',
                'last_name' => 'Admin',
                'email' => 'superadmin2@gmail.com',
                'phone' => '01710000003',
            ],
        ];

        foreach ($adminUsers as $adminData) {
            $adminUser = User::updateOrCreate(
                ['email' => $adminData['email']],
                [
                    ...$adminData,
                    'address' => 'Dhaka, Bangladesh',
                    'password' => Hash::make('12345678'),
                    'plan_password' => '12345678',
                    'email_verified_at' => now(),
                ]
            );

            $adminUser->syncRoles([$adminRole]);
        }

        $hospitalUsers = [
            [
                'first_name' => 'City',
                'last_name' => 'Hospital',
                'email' => 'hospital1@gmail.com',
                'phone' => '01710000011',
                'hospital_name' => 'City Care Hospital',
                'hospital_location' => 'Dhanmondi, Dhaka',
                'district' => 'Dhaka',
                'thana' => 'Dhanmondi',
                'area' => 'Dhanmondi',
            ],
            [
                'first_name' => 'Green',
                'last_name' => 'Life',
                'email' => 'hospital2@gmail.com',
                'phone' => '01710000012',
                'hospital_name' => 'Green Life Medical',
                'hospital_location' => 'Uttara, Dhaka',
                'district' => 'Dhaka',
                'thana' => 'Uttara',
                'area' => 'Uttara East',
            ],
            [
                'first_name' => 'Popular',
                'last_name' => 'Diagnostic',
                'email' => 'hospital3@gmail.com',
                'phone' => '01710000013',
                'hospital_name' => 'Popular Diagnostic Center',
                'hospital_location' => 'Mirpur, Dhaka',
                'district' => 'Dhaka',
                'thana' => 'Mirpur',
                'area' => 'Mirpur',
            ],
        ];

        foreach ($hospitalUsers as $hospitalData) {
            $hospitalUser = User::updateOrCreate(
                ['email' => $hospitalData['email']],
                [
                    ...$hospitalData,
                    'address' => 'Dhaka, Bangladesh',
                    'password' => Hash::make('12345678'),
                    'plan_password' => '12345678',
                    'approval_status' => 'approved',
                    'approved_at' => now(),
                    'email_verified_at' => now(),
                ]
            );

            $hospitalUser->syncRoles([$hospitalOwnerRole]);
        }

        $this->call(HospitalDemoContentSeeder::class);
    }
}
