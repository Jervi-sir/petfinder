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
        Schema::create('adoption_sale_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
            $table->tinyInteger('offer_type_id')->nullable();
            $table->float('price')->nullable();
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
        Schema::dropIfExists('adoption_sale_posts');
    }
};
