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
        Schema::create('image_to_deletes', function (Blueprint $table) {
            $table->id();
            $table->string('source');       //from strainght delete, or from backup function
            $table->string('type');         //client profile or pet
            $table->string('name');         //name of the file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_to_deletes');
    }
};
