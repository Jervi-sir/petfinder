<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesToDeletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_to_deletes', function (Blueprint $table) {
            $table->id();
            $table->string('source');       //from strainght delete, or from backup function
            $table->string('type');         //client profile or pet
            $table->string('name');         //name of the file
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
        Schema::dropIfExists('images_to_deletes');
    }
}
