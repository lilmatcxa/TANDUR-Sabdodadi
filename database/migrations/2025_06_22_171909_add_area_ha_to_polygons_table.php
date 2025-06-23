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
        Schema::table('polygons', function (Blueprint $table) {
            $table->double('area_ha')->nullable(); // atau float
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('polygons', function (Blueprint $table) {
            $table->dropColumn('area_ha');
        });
    }
};
