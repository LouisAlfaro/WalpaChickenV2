<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunity_applications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['comercial', 'proveedores', 'trabajo']);
            
            // Campos comunes
            $table->string('company_name')->nullable(); // Para comercial y proveedores
            $table->string('business_area')->nullable(); // Rubro para comercial, especialidad para trabajo
            $table->string('phone');
            $table->string('email');
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->text('comment')->nullable();
            $table->string('attachment')->nullable(); // Para CVs o documentos
            
            // Campo específico para trabajo
            $table->string('full_name')->nullable(); // Solo para trabajo
            
            $table->enum('status', ['pending', 'reviewed', 'contacted', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunity_applications');
    }
};
