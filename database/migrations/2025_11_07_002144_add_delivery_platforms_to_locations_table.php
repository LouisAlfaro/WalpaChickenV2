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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('pedidosya_url')->nullable()->after('promotions_pdf');
            $table->string('didifood_url')->nullable()->after('pedidosya_url');
            $table->string('rappi_url')->nullable()->after('didifood_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['pedidosya_url', 'didifood_url', 'rappi_url']);
        });
    }
};
