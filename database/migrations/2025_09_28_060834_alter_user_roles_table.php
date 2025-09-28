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
            $table->string('title');
            $table->dropColumn(['name', 'display_name', 'description']);
        });

        DB::statement('UPDATE user_roles SET title = name');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            $table->renameColumn('user_role_id', 'id');
            $table->string('name');
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->dropColumn('title');
        });

        DB::statement('UPDATE user_roles SET name = title, display_name = title, description = NULL');
    }
};
