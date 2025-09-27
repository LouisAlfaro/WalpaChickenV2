<?php
// database/migrations/xxxx_create_delivery_platforms_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('link');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_platforms');
    }
};