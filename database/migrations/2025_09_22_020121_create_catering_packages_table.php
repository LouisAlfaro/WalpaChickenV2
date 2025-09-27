<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catering_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "10 a 20 personas", "20 a 30 personas", etc.
            $table->text('description');
            $table->integer('min_people');
            $table->integer('max_people');
            $table->decimal('price_per_person', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->json('features')->nullable(); // Características del paquete
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catering_packages');
    }
};