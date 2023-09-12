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
        Schema::create('pet_lost_metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_lost_id')->constrained('pet_losts')->onDelete('cascade');
            $table->integer('views')->default(0); // Number of times the post has been viewed
            $table->integer('likes')->default(0); // Number of likes for the post
            $table->integer('shares')->default(0); // Number of times the post has been shared
            $table->integer('favorites')->default(0); // Number of times the post has been favorited
            $table->json('custom_data')->nullable(); // Any additional custom data in JSON format
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_lost_metadata');
    }
};
