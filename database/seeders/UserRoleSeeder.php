<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create user roles
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full system access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'staff',
                'display_name' => 'Staff',
                'description' => 'Staff member',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'tenant',
                'display_name' => 'Tenant',
                'description' => 'Property renter',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('user_roles')->insert($roles);

        // Get role IDs for user creation
        $adminRoleId = DB::table('user_roles')->where('name', 'admin')->first()->id;
        $staffRoleId = DB::table('user_roles')->where('name', 'staff')->first()->id;
        $tenantRoleId = DB::table('user_roles')->where('name', 'tenant')->first()->id;

        // Create default admin user
        DB::table('users')->insert([
            'name' => 'System Administrator',
            'email' => 'admin@apartment.com',
            'password' => Hash::make('password'),
            'is_active' => 1,
            'user_role_id' => $adminRoleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test staff user
        DB::table('users')->insert([
            'name' => 'John Staff',
            'email' => 'staff@test.com',
            'password' => Hash::make('password'),
            'is_active' => 1,
            'user_role_id' => $staffRoleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test tenant user
        DB::table('users')->insert([
            'name' => 'Jane Tenant',
            'email' => 'tenant@test.com',
            'password' => Hash::make('password'),
            'is_active' => 1,
            'user_role_id' => $tenantRoleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
