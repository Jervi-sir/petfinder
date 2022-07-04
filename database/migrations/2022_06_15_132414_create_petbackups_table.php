<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetbackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petbackups', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name')->nullable();

            $table->string('location');

            $table->string('race');
            $table->string('gender');
            $table->string('color')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('size')->nullable();

            $table->longText('pics')->nullable();
            $table->longText('description')->nullable();

            $table->string('phone_number')->nullable();

            $table->integer('is_active')->default(1);
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petbackups');
    }
}
