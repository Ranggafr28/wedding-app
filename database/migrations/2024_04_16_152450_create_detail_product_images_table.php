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
        Schema::create('detail_product_images', function (Blueprint $table) {
            $table->id();
            $table->String('code_product', 100);
            $table->longText('images');
            $table->String('status', 20);
            $table->String('created_by', 50);
            $table->String('updated_by', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_product_images');
    }
};
