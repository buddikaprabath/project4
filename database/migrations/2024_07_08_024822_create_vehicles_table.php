<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('vehicle_no')->primary();
            $table->string('vehicle_name');
            $table->string('model');
            $table->string('type');
            $table->string('chassis_no');
            $table->string('engine_no');
            $table->date('yom');
            $table->string('v_status');
            $table->string('order_status')->default('available');
            $table->decimal('advancepayment', 10, 2)->nullable();
            $table->decimal('buying', 10, 2);
            $table->decimal('selling', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
}