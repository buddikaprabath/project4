<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Add order_id column
            $table->string('national_id'); // National ID
            $table->string('vehicle_no'); // Vehicle number
            $table->string('payment_method'); // Payment method
            $table->string('bankslip_path'); // Path to the bank slip image
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('national_id')->references('national_id')->on('users')->onDelete('cascade');
            $table->foreign('vehicle_no')->references('vehicle_no')->on('vehicles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}