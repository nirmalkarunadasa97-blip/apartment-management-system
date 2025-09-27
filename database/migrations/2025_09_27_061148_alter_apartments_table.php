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
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn(['name', 'address', 'city', 'state', 'zip_code']);
            $table->renameColumn('rent_amount', 'monthly_rent');
            $table->string('contact_no')->nullable();
            $table->integer('no_of_bedroom')->nullable();
            $table->integer('no_of_bathroom')->nullable();
            $table->string('apartment_no')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn(['contact_no', 'no_of_bedroom', 'no_of_bathroom', 'apartment_no', 'status']);
            $table->renameColumn('monthly_rent', 'rent_amount');
            $table->string('name');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
        });
    }
};
