<?php
// database/migrations/xxxx_create_page_views_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page')->nullable();
            $table->string('section')->nullable();
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->timestamp('viewed_at');
            $table->timestamps();
            
            $table->index(['page', 'viewed_at']);
            $table->index(['section', 'viewed_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_views');
    }
};