<?php
// database/migrations/xxxx_create_social_widgets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('social_widgets', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('position')->default('right'); // left, right
            $table->json('social_links'); // URLs de redes sociales
            $table->string('background_color')->default('#FEC601');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_widgets');
    }
};