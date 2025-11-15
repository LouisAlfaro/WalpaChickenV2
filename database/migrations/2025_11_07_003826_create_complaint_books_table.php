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
        Schema::create('complaint_books', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_number')->unique(); // Número de reclamo autogenerado
            $table->enum('type', ['reclamo', 'queja']); // Tipo de solicitud
            
            // Datos del consumidor
            $table->string('full_name');
            $table->string('document_type'); // DNI, CE, Pasaporte, RUC
            $table->string('document_number');
            $table->string('phone');
            $table->string('email');
            $table->string('department')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->text('address')->nullable();
            
            // Identificación del bien contratado
            $table->enum('product_type', ['producto', 'servicio']);
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('description');
            
            // Detalle de la reclamación
            $table->text('complaint_detail');
            $table->text('request'); // Pedido del consumidor
            
            // Estado y observaciones
            $table->enum('status', ['pendiente', 'en_proceso', 'resuelto', 'rechazado'])->default('pendiente');
            $table->text('admin_notes')->nullable();
            $table->timestamp('resolved_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_books');
    }
};
