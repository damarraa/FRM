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
        Schema::create('tiang_listriks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->enum('tipe_tiang_listrik', ['Baja', 'Beton']);
            $table->string('jenis_tiang');
            $table->string('no_serial');

            $table->string('masa_pakai');

            $table->string('pengujian_visual');
            $table->string('persyaratan_pengujian_visual');
            $table->string('kesesuaian_pengujian_visual');

            $table->string('pengujian_panjang');
            $table->string('persyaratan_pengujian_panjang');
            $table->string('kesesuaian_pengujian_panjang');

            $table->string('kelurusan_tiang');
            $table->string('persyaratan_kelurusan_tiang');
            $table->string('kesesuaian_kelurusan_tiang');
            $table->string('keterangan_kelurusan_tiang');

            $table->string('kualitas_penyambungan')->nullable();
            $table->string('persyaratan_kualitas_penyambungan');
            $table->string('kesesuaian_kualitas_penyambungan');

            $table->enum('kesimpulan', ['Bekas layak pakai (K6)', 'Bekas bisa diperbaiki (K7)', 'Bekas tidak layak pakai (K8)']);
            $table->json('gambar')->nullable();
            $table->enum('status', ['Unapproved', 'Approved']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('gudang_id');
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade');
            $table->unsignedBigInteger('pabrikan_id');
            $table->foreign('pabrikan_id')->references('id')->on('pabrikans')->onDelete('cascade');
            $table->unsignedBigInteger('uid_id');
            $table->foreign('uid_id')->references('id')->on('uids')->onDelete('cascade');
            $table->unsignedBigInteger('up3_id');
            $table->foreign('up3_id')->references('id')->on('up3s')->onDelete('cascade');
            $table->unsignedBigInteger('ulp_id');
            $table->foreign('ulp_id')->references('id')->on('ulps')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiang_listriks');
    }
};
