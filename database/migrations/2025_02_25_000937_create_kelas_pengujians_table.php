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
        Schema::create('kelas_pengujians', function (Blueprint $table) {
            $table->id();
            $table->enum('kelas_pengujian', ['0.5', '1', '2']);
            $table->decimal('batas_kesalahan', 3, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_pengujians');
    }
};
