<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('social_posts', function (Blueprint $table) {
            $table->string('video_file')->nullable()->after('video_url');
        });
    }

    public function down()
    {
        Schema::table('social_posts', function (Blueprint $table) {
            $table->dropColumn('video_file');
        });
    }
};