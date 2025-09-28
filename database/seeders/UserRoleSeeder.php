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
                'title' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'tenant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('user_roles')->insert($roles);

        // Get role IDs for user creation
        $adminRoleId = DB::table('user_roles')->where('title', 'admin')->first()->user_role_id;
        $staffRoleId = DB::table('user_roles')->where('title', 'staff')->first()->user_role_id;
        $tenantRoleId = DB::table('user_roles')->where('title', 'tenant')->first()->user_role_id;

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
