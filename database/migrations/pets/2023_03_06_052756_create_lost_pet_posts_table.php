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
        Schema::create('lost_pet_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
            $table->tinyInteger('is_active')->default(1);
            $table->dateTime('last_date_activated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_pet_posts');
    }
};
