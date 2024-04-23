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
        Schema::create('master_vendor', function (Blueprint $table) {
            $table->string('vendor_id',200);
            $table->string('fullname');
            $table->bigInteger('phone');
            $table->text('address');
            $table->text('avatar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_vendor');
    }
};
