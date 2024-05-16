<?php

use App\Enums\OrderStatus;
use App\Models\Address;
use App\Models\DeliveryMethod;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained();
            $table->foreignIdFor(DeliveryMethod::class, 'delivery_method_id')->nullable();
            $table->foreignIdFor(Address::class ,'address_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->default(OrderStatus::PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
