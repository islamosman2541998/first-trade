<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // Dashboard
            'view dashboard',

            // Categories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Products
            'view products',
            'create products',
            'edit products',
            'delete products',

            // Product Images
            'manage product images',

            // Quote Requests
            'view quote requests',
            'edit quote requests',
            'delete quote requests',

            // Contact Messages
            'view contact messages',
            'edit contact messages',
            'delete contact messages',

            // Pages
            'view pages',
            'create pages',
            'edit pages',
            'delete pages',

            // Settings
            'view settings',
            'edit settings',

            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Activity Logs
            'view activity logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $editor = Role::firstOrCreate([
            'name' => 'Editor',
            'guard_name' => 'web',
        ]);

        $viewer = Role::firstOrCreate([
            'name' => 'Viewer',
            'guard_name' => 'web',
        ]);

        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'view dashboard',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view products',
            'create products',
            'edit products',
            'delete products',
            'manage product images',

            'view quote requests',
            'edit quote requests',
            'delete quote requests',

            'view contact messages',
            'edit contact messages',
            'delete contact messages',

            'view pages',
            'create pages',
            'edit pages',
            'delete pages',

            'view settings',
            'edit settings',

            'view activity logs',
        ]);

        $editor->syncPermissions([
            'view dashboard',

            'view categories',
            'create categories',
            'edit categories',

            'view products',
            'create products',
            'edit products',
            'manage product images',

            'view quote requests',
            'edit quote requests',

            'view contact messages',
            'edit contact messages',

            'view pages',
            'create pages',
            'edit pages',
        ]);

        $viewer->syncPermissions([
            'view dashboard',
            'view categories',
            'view products',
            'view quote requests',
            'view contact messages',
            'view pages',
        ]);

        $user = User::firstOrCreate(
            ['email' => 'admin@first-trade.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole($superAdmin);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}