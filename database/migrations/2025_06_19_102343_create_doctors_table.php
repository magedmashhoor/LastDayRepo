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
        Schema::create('doctors', function (Blueprint $table) {
        $table->id();
        $table->string('doctor_name');
        $table->string('gender');
        $table->unsignedBigInteger('specialty_id');
        $table->unsignedBigInteger('subspecialty_id')->nullable();
        $table->string('qualification_degree')->nullable();
        $table->text('bio')->nullable();
        $table->decimal('average_rating', 3, 2)->default(0);
        $table->integer('total_reviews')->default(0);
        $table->timestamps();

        $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
        $table->foreign('subspecialty_id')->references('id')->on('subspecialties')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
