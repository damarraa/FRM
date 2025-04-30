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
        Schema::create('cable_powers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_pemasangan');
            $table->string('jenis_cable_power');
            $table->string('ukuran_cable_power'); // satuan ukuran ???
            $table->float('luas_penampang'); // satuan ukuran ???
            $table->float('panjang_cable_power'); // satuan ukuran ???

            $table->string('nilai_pemeriksaan_kondisi_visual');
            $table->string('satuan_pemeriksaan_kondisi_visual');
            $table->string('persyaratan_pemeriksaan_kondisi_visual');
            $table->enum('kesesuaian_pemeriksaan_kondisi_visual', ['yes', 'no']);
            $table->string('keterangan_pemeriksaan')->nullable();

            $table->string('nilai_pengujian_dimensi');
            $table->string('satuan_pengujian_dimensi');
            $table->string('persyaratan_pengujian_dimensi');
            $table->enum('kesesuaian_pengujian_dimensi', ['yes', 'no']);
            $table->string('keterangan_pengujian_dimensi')->nullable();

            $table->string('nilai_uji_tahanan_isolasi');
            $table->string('satuan_uji_tahanan_isolasi');
            $table->string('persyaratan_uji_tahanan_isolasi');
            $table->enum('kesesuaian_uji_tahanan_isolasi', ['yes', 'no']);
            $table->string('keterangan_uji_tahanan_isolasi')->nullable();

            $table->float('kesimpulan_k6');
            $table->float('kesimpulan_k8');

            $table->json('gambar')->nullable();
            $table->enum('status', ['Unapproved', 'Approved']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('gudang_id');
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade');
            // $table->unsignedBigInteger('pabrikan_id');
            // $table->foreign('pabrikan_id')->references('id')->on('pabrikans')->onDelete('cascade');
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
        Schema::dropIfExists('cable_powers');
    }
};
