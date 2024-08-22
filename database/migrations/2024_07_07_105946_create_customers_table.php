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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('national_id',20)->primary(); 
            $table->string('Customer_Name');
            $table->text('Customer_Address');
            $table->string('Customer_phone');
            $table->enum('type', ['buyer', 'seller'])->default('buyer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
       
    }
};