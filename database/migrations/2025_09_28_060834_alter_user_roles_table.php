<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            $table->renameColumn('id', 'user_role_id');
            $table->string('user_role')->nullable();
        });

        DB::statement('UPDATE user_roles SET user_role = name');

        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropColumn(['name', 'display_name', 'description']);
            $table->string('user_role')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            $table->string('name');
            $table->string('display_name');
            $table->text('description')->nullable();
        });

        DB::statement('UPDATE user_roles SET name = user_role, display_name = user_role, description = NULL');

        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropColumn('user_role');
            $table->renameColumn('user_role_id', 'id');
        });
    }
};
