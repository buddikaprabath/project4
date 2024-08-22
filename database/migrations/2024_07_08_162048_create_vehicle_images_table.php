<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleImagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_images', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_no');
            $table->string('image_path');
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('vehicle_no')->references('vehicle_no')->on('vehicles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_images');
    }
}