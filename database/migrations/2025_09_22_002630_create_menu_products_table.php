<?php
// database/migrations/xxxx_create_menu_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // "El Práctico"
            $table->text('description')->nullable(); // "Jugo de Papaya"
            $table->decimal('price', 8, 2)->nullable(); // 1.00
            $table->string('image')->nullable(); // Imagen del producto
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('order')->default(0)->nullable();
            $table->boolean('active')->default(true)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_products');
    }
};