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
        Schema::create('up3s', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->unique();
            $table->unsignedBigInteger('uid_id');
            $table->string('kode_unit');
            $table->foreign('uid_id')->references('id')->on('uids')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('up3s');
    }
};
