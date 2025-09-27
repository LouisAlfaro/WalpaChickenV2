<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('CONTACTO'); // Por si quieres editar el título
            $table->string('schedule')->nullable();       // Atención: 12:00 pm a 11:00 pm
            $table->string('phone')->nullable();          // Teléfono
            $table->string('email')->nullable();          // Correo
            $table->string('address')->nullable();        // Dirección u oficina
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
