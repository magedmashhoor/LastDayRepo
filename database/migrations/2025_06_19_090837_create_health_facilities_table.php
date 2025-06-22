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
        Schema::create('health_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('facility_name');
            $table->string('facility_type');
            $table->text('address');
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('district_id');
            $table->string('phone_number_1')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->unsignedBigInteger('responsible_user_id')->nullable();
            $table->timestamps();

            $table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('responsible_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_facilities');
    }
};
