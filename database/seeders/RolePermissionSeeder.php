<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined permissions
        $permissionNames = [
            'create user',
            'edit user',
            'update user',
            'show user',
            'delete user',
        ];

        $permissions = [];
        foreach ($permissionNames as $perm) {
            $permissions[] = Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'web',
            ]);
        }

        // Predefined roles
        $roleNames = ['doctor', 'present', 'admin', 'user'];

        foreach ($roleNames as $roleName) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            // Attach all permissions to role
            $role->syncPermissions($permissions);
        }

        $this->command->info('Roles and Permissions created successfully!');

    }
}
