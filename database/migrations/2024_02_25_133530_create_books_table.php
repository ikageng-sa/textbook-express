<?php

use App\Enums\AccountStatus;
use App\Enums\Conditions;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->text('description')->nullable();
            $table->string('isbn')->unique();
            $table->string('publisher')->nullable();
            $table->string('publication_date')->nullable();
            $table->string('edition');
            $table->string('category')->nullable();
            $table->string('language');
            $table->json('tags')->nullable();
            $table->foreignId('added_by')->contrained('users', 'id');
            $table->foreignId('reviewed_by')->nullable()->constrained('users', 'id');
            $table->string('cover')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
