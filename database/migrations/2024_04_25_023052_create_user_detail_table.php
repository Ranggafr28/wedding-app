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
        Schema::create('user_detail', function (Blueprint $table) {
            $table->string('user_id', 200);
            $table->string('fullname', 100);
            $table->bigInteger('phone');
            $table->string('email', 50);
            $table->string('city', 50);
            $table->string('country', 50);
            $table->text('address');
            $table->text('avatar');
            $table->string('created_by', 50);
            $table->string('updated_by', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_detail');
    }
};
