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
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reviewer_id')->constrained('users'); // the user who wrote the review
            $table->foreignId('reviewee_id')->constrained('users'); // the user who is being reviewed
            $table->text('review');  // the review text
            $table->tinyInteger('rating')->nullable();  // rating out of 5 or 10, as you prefer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reviews');
    }
};
