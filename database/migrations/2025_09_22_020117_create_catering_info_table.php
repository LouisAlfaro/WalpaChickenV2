<?php
// Migration 1: create_catering_info_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catering_info', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('main_image')->nullable();
            $table->json('images')->nullable(); // Para múltiples imágenes
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catering_info');
    }
};