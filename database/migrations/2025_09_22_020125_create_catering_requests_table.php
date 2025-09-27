<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catering_requests', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'catering' o 'reservation'
            
            // Datos personales
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            
            // Datos del evento/reserva
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->string('contact_type')->nullable(); // teléfono, email, etc.
            $table->string('contact_value')->nullable();
            $table->string('reason')->nullable(); // motivo del evento
            $table->text('message')->nullable();
            
            // Datos específicos de catering
            $table->foreignId('catering_package_id')->nullable()->constrained()->onDelete('set null');
            $table->string('event_type')->nullable();
            $table->text('special_requirements')->nullable();
            
            // Estado
            $table->enum('status', ['pending', 'contacted', 'confirmed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catering_requests');
    }
};