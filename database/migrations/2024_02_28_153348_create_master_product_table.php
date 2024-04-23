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
        Schema::create('master_product', function (Blueprint $table) {
            $table->id();
            $table->string('code_product');
            $table->integer('vendor_id');
            $table->string('product', 100);
            $table->string('price');
            $table->longText('picture');
            $table->text('remark');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_product');
    }
};
