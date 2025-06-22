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
        Schema::create('subspecialties', function (Blueprint $table) {
        $table->id();
        $table->string('subspecialty_name');
        $table->unsignedBigInteger('specialty_id');
        $table->timestamps();

        // Foreign Key Constraints
        $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subspecialties');
    }
};
