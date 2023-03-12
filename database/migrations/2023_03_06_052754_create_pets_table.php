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
            $table->string('name')->nullable();

            $table->string('location')->nullable();
            $table->string('wilaya_name')->nullable();
            $table->string('price')->nullable();
            $table->string('weight')->nullable();

            $table->string('race_name');
            $table->string('sub_race')->nullable();
            $table->tinyInteger('gender')->nullable();   //make it integer 3 options
            $table->string('color')->nullable();
            $table->date('birthday')->nullable();

            $table->longText('description')->nullable();

            $table->string('phone_number')->nullable();

            $table->tinyInteger('is_active')->default(1);
            $table->string('status')->default('active');    //active, deleted, backedup
            $table->date('last_date_activated');

            $table->longText('keywords')->nullable();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('race_id')->constrained('races');
            $table->foreignId('offer_type_id')->constrained('offer_types');
            $table->foreignId('wilaya_id')->constrained('wilayas');

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
