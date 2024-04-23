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
        Schema::create('transaction_payment', function (Blueprint $table) {
            $table->id();
            $table->String('no_trans');
            $table->String('customer_id');
            $table->bigInteger('price')->nullable();
            $table->string('payment_method', 30)->nullable();
            $table->string('status', 10)->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_payment');
    }
};
