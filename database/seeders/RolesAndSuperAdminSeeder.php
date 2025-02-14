<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndSuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $adminRole = Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);

        // Create permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            // Role Management
            'manage roles',
            // Analytics
            'view analytics',
            // Content Management
            'create content',
            'edit content',
            'delete content',
            // Student Management
            'view student progress',
            'manage student progress',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdminRole->givePermissionTo(Permission::all()); // Superadmin gets all permissions

        $adminRole->givePermissionTo([
            'view users',
            'create users',
            'edit users',
            'view analytics',
            'create content',
            'edit content',
            'delete content',
            'view student progress',
            'manage student progress',
        ]);

        $teacherRole->givePermissionTo([
            'view student progress',
            'manage student progress',
            'create content',
            'edit content',
        ]);

        $studentRole->givePermissionTo([
            'view student progress',
        ]);

        // Create superadmin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'superadmin',
        ]);

        // Assign role to superadmin
        $superAdmin->assignRole('superadmin');
    }
} 