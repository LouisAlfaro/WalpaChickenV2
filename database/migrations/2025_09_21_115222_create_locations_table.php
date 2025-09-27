<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Nombre del local
            $table->text('address')->nullable(); // Dirección completa
            $table->string('phone')->nullable(); // Teléfono
            $table->string('whatsapp_url')->nullable(); // URL de WhatsApp
            $table->string('maps_url')->nullable(); // URL de Google Maps
            $table->string('image')->nullable(); // Imagen del local
            $table->integer('order')->default(0)->nullable(); // Orden en el carrousel
            $table->boolean('active')->default(true)->nullable(); // Estado activo/inactivo
            $table->text('description')->nullable(); // Descripción adicional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
