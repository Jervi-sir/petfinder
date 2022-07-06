<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->integer('score');
            $table->string('english_word');
            $table->longText('translation');
            $table->string('nb_words')->nullable(); //incase to use it
            $table->string('how_many_searched')->nullable(); //incase to use it
            $table->timestamps();
        });
    }
    /*
    |--------------------------------------------------------------------------
    | Score
    |--------------------------------------------------------------------------
    | 1: race
    | 2 - 4: breed
    | 5: color
    | 10: location
    | 15: size
    | 20: rent, sell, adopte
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
};
