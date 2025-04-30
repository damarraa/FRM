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
        Schema::table('trafos', function (Blueprint $table) {
            $table->string('persyaratan_rasio_belitan')->after('persyaratan_pengujian_tahanan_isolasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trafos', function (Blueprint $table) {
            Schema::dropColumns('persyaratan_rasio_belitan');
        });
    }
};
