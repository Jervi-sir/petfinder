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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable()->unique();
            $table->tinyText('name');
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('phone_number')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained('genders');
            $table->string('pic')->nullable();

            $table->string('location')->nullable();
            $table->foreignId('wilaya_id')->index()->nullable();
            $table->tinyText('wilaya_name')->nullable();

            $table->string('social_list')->nullable();
            $table->boolean('is_verified')->default(0);

            //$table->foreignId('role_id')->constrained('roles');
            $table->foreignId('role_id')->index();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
