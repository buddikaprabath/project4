<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('sold_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_no')->unique();
            $table->string('vehicle_name');
            $table->string('model');
            $table->string('type');
            $table->string('chassis_no');
            $table->string('engine_no');
            $table->date('yom');
            $table->string('v_status');
            $table->decimal('buying', 10, 2);
            $table->decimal('selling', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sold_vehicles');
    }
}