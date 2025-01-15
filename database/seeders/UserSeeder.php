<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permissions
        Permission::firstOrCreate(['name' => 'user-list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user-edit', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'customer-list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'customer-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'customer-edit', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'category-list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'category-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'category-edit', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'brand-list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'brand-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'brand-edit', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'product-list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'product-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'product-edit', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'sale-list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'sale-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'sale-edit', 'guard_name' => 'web']);

        // Create Roles and Assign Permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'user-list',
            'user-create',
            'user-edit',
            'customer-list',
            'customer-create',
            'customer-edit',
            'category-list',
            'category-create',
            'category-edit',
            'brand-list',
            'brand-create',
            'brand-edit',
            'product-list',
            'product-create',
            'product-edit',
            'sale-list',
            'sale-create',
            'sale-edit',
        ]);

        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo([
            'user-list',
            'customer-list',
            'category-list',
            'brand-list',
            'product-list',
            'sale-list',
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'user-list',
            'customer-list',
            'category-list',
            'brand-list',
            'product-list',
            'sale-list',
        ]);

        // Create and assign roles to users
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $superAdminUser->assignRole($superAdminRole);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $adminUser->assignRole($adminRole);

        $staffUser = User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('12345678'),
            ]
        );
        $staffUser->assignRole($staffRole);
    }
}
