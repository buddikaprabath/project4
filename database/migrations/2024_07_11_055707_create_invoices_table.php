<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('national_id'); // Ensure this matches the data type in the users table
            $table->string('vehicle_no'); // Ensure this matches the data type in the vehicles table
            $table->decimal('total_amount', 10, 2);
            $table->decimal('total_bill_amount', 10, 2);
            $table->timestamps();

            $table->foreign('national_id')->references('national_id')->on('users')->onDelete('cascade');
            $table->foreign('vehicle_no')->references('vehicle_no')->on('vehicles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}