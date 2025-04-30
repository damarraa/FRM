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
        Schema::create('pabrikan_kategoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pabrikan_id');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('pabrikan_id')->references('id')->on('pabrikans')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori_pabrikans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pabrikan_kategoris');
    }
};
