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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('user_id')->index();
            $table->foreignId('race_id')->index();

            $table->string('sub_race')->nullable();
            $table->tinyInteger('gender_id')->nullable();   //make it integer 3 options
            $table->tinyInteger('offer_type_id')->nullable();   //make it integer 3 options
            $table->double('price')->nullable();

            $table->tinyText('name')->nullable();
            $table->string('location')->nullable();
            $table->tinyInteger('wilaya_id')->nullable();
            $table->string('wilaya_name')->nullable();
            $table->json('images')->nullable();

            $table->date('birthday')->nullable();
            $table->string('color')->nullable();
            $table->string('weight')->nullable();
            $table->longText('description')->nullable();
            $table->tinyText('phone_number')->nullable();

            $table->tinyInteger('is_vaccinated')->default(1);
            $table->string('special_needs')->nullable();

            $table->string('keywords')->nullable();

            $table->tinyInteger('adoption_status')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->date('last_date_activated');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
