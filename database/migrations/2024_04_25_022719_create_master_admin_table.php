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
        Schema::create('master_admin', function (Blueprint $table) {
            $table->string('admin_id', 200);
            $table->string('fullname', 100);
            $table->bigInteger('phone');
            $table->string('email', 50);
            $table->string('city', 50);
            $table->string('country', 50);
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
        Schema::dropIfExists('master_admin');
    }
};
