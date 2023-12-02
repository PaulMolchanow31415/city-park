<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->boolean('isOnlineSaleAvailable');
            $table->string('name');
            $table->string('src');
            $table->string('description', 2048);
            $table->integer('price');
            $table->integer('weight');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('menu_items');
    }
};
