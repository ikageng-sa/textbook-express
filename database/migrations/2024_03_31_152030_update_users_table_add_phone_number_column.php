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
            $table->addColumn('text', 'phone_number')->unique()->nullable()->after('email_verified_at');
            $table->addColumn('boolean', 'phone_number_verified_at')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('phone_number');
            $table->removeColumn('phone_number_verified_at');
        });
    }
};
