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
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('pet_id')->constrained('pets');
            $table->double('amount');
            $table->string('status'); // could be 'Pending', 'Completed', 'Canceled'
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};
