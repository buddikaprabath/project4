<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id('bill_id');
            $table->decimal('total_amount', 10, 2);
            $table->unsignedBigInteger('pay_id');
            $table->timestamps();

            $table->foreign('pay_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
}