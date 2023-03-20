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

            $table->tinyText('name')->nullable();
            $table->string('location')->nullable();
            $table->tinyText('wilaya_name')->nullable();
            $table->tinyInteger('wilaya_number')->nullable();

            $table->string('race_name');
            $table->string('sub_race')->nullable();
            $table->tinyInteger('gender_id')->nullable();   //make it integer 3 options
            $table->tinyText('gender_name')->nullable();   //make it integer 3 options

            $table->tinyInteger('offer_type_id')->nullable();   //make it integer 3 options
            $table->tinyText('offer_type_name')->nullable();   //make it integer 3 options
            $table->double('price')->nullable();

            $table->date('birthday')->nullable();

            $table->string('color')->nullable();
            $table->string('weight')->nullable();
            $table->string('description')->nullable();
            $table->tinyText('phone_number_this_pet')->nullable();

            $table->tinyInteger('is_active')->default(1);
            $table->date('last_date_activated');

            $table->longText('keywords')->nullable();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('race_id')->constrained('races');

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
