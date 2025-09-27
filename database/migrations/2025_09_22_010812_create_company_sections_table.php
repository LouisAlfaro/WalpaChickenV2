<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_sections', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'mission', 'values', 'history', 'team', etc.
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->json('list_items')->nullable(); // Para valores, objetivos, etc.
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_sections');
    }
};