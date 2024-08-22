<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('national_id'); // This is the national_id from the users table
            $table->string('vehicle_no'); // This is the vehicle_no from the vehicles table
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('national_id')->references('national_id')->on('users')->onDelete('cascade'); // Reference to users table's national_id
            $table->foreign('vehicle_no')->references('vehicle_no')->on('vehicles')->onDelete('cascade');
            $table->unique(['national_id', 'vehicle_no']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}