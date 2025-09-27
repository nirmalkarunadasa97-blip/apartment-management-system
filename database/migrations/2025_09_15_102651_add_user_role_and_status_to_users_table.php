<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(1)->after('password');
            }
            if (!Schema::hasColumn('users', 'user_role_id')) {
                $table->unsignedBigInteger('user_role_id')->nullable()->after('is_active');
            }

            // You might want to add a foreign key constraint if you have a roles table
            // $table->foreign('user_role_id')->references('id')->on('user_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'user_role_id']);
        });
    }
};
