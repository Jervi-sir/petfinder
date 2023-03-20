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
            $table->tinyText('name');
            $table->tinyText('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->tinyText('phone_number')->nullable();
            $table->string('pic')->nullable();

            $table->string('location')->nullable();
            $table->foreignId('wilaya_number')->nullable();
            $table->tinyText('wilaya_name')->nullable();

            $table->string('social_list')->nullable();

            $table->foreignId('role_id')->constrained('roles');

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
