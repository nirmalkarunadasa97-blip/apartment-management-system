<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run the UserRoleSeeder which creates roles AND users
        $this->call(UserRoleSeeder::class);

        // Remove or comment out the User::factory() calls since
        // UserRoleSeeder already creates the users we need

        // If you want additional users beyond what UserRoleSeeder creates,
        // use different email addresses:

        // \App\Models\User::factory()->create([
        //     'name' => 'Additional Admin',
        //     'email' => 'admin2@gmail.com',
        //     'password' => Hash::make('admin@123#'),
        //     'is_active' => 1,
        //     'user_role_id' => 1, // Admin role
        // ]);
    }
}
