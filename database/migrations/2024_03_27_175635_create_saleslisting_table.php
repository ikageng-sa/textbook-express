<?php

use App\Enums\SalesListingStatus;
use App\Models\User;
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
        Schema::create('sales_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->decimal('price');
            $table->string('condition');
            $table->foreignId('seller')->constrained('users')->noActionOnDelete()->restrictOnUpdate();
            $table->string('status')->default(SalesListingStatus::AVAILABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saleslisting');
    }
};
