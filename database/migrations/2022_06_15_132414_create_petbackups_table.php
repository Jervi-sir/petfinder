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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('race_id')->constrained('races');
            $table->foreignId('sub_race_id')->constrained('sub_races');
            $table->foreignId('status_id')->constrained('statuses');
            $table->foreignId('wilaya_id')->constrained('wilayas');

            $table->string('raceName');
            $table->string('sub_raceName');
            $table->string('wilayaName');

            $table->string('gender');
            $table->string('color')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('size')->nullable();
            $table->longText('pics')->nullable();
            $table->longText('description')->nullable();

            $table->longText('tags')->nullable();

            $table->string('phone_number')->nullable();

            $table->integer('is_active')->default(1);
            $table->string('announcement_status')->default('active');
            $table->date('last_date_activated');

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
