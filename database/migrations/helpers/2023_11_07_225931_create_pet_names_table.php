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
        Schema::create('pet_names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('race')->nullable();
            $table->string('subrace')->nullable();
            $table->string('gender')->nullable();
            $table->string('colors')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_names');
    }
};
