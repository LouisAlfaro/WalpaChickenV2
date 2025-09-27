<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            
            // Contenido del post
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            
            // Media (imagen o video)
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->enum('media_type', ['image', 'video'])->default('image');
            
            // Texto superpuesto en la imagen/video
            $table->string('overlay_text')->nullable();
            $table->enum('overlay_position', ['top', 'center', 'bottom'])->default('bottom');
            
            // Red social y botón
            $table->enum('social_platform', ['facebook', 'instagram', 'tiktok', 'youtube', 'twitter'])->default('facebook');
            $table->string('social_url')->nullable();
            $table->string('button_text')->default('Seguir');
            $table->string('button_color')->default('#1877F2');
            
            // Control
            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_posts');
    }
};