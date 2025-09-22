<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update landlord role to staff
        DB::table('user_roles')
            ->where('name', 'landlord')
            ->update([
                'name' => 'staff',
                'display_name' => 'Staff',
                'description' => 'Staff member',
            ]);

        // Update the test user email
        DB::table('users')
            ->where('email', 'landlord@test.com')
            ->update(['email' => 'staff@test.com']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert staff back to landlord
        DB::table('user_roles')
            ->where('name', 'staff')
            ->update([
                'name' => 'landlord',
                'display_name' => 'Landlord',
                'description' => 'Property owner/manager',
            ]);

        // Revert the test user email
        DB::table('users')
            ->where('email', 'staff@test.com')
            ->update(['email' => 'landlord@test.com']);
    }
};
