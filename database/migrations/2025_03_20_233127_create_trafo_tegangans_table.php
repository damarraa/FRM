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
        Schema::create('trafo_tegangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->enum('tipe_trafo_tegangan', ['Indoor', 'Outdoor']);
            $table->string('no_serial');
            $table->string('rasio');

            $table->string('masa_pakai');
            $table->string('retak_pada_resin');
            $table->string('persyaratan_retak');
            $table->string('kesesuaian_retak');

            $table->string('nameplate');
            $table->string('persyaratan_nameplate');
            $table->string('kesesuaian_nameplate');

            $table->string('penandaan_terminal');
            $table->string('persyaratan_penandaan_terminal');
            $table->string('kesesuaian_penandaan_terminal');

            $table->string('terminal_primer');
            $table->string('persyaratan_terminal_primer');
            $table->string('kesesuaian_terminal_primer');

            $table->string('terminal_sekunder');
            $table->string('persyaratan_terminal_sekunder');
            $table->string('kesesuaian_terminal_sekunder');

            $table->string('kelengkapan_baut_primer');
            $table->string('persyaratan_baut_primer');
            $table->string('kesesuaian_baut_primer');

            $table->string('kelengkapan_baut_sekunder');
            $table->string('persyaratan_baut_sekunder');
            $table->string('kesesuaian_baut_sekunder');

            $table->string('cover_terminal');
            $table->string('persyaratan_cover_terminal');
            $table->string('kesesuaian_cover_terminal');

            $table->string('nilai_pengujian_primer')->nullable();
            $table->string('satuan_nilai_pengujian_primer');
            $table->string('persyaratan_nilai_pengujian_primer');
            $table->string('kesesuaian_nilai_pengujian_primer');
            $table->string('keterangan_nilai_pengujian_primer')->nullable();

            $table->string('nilai_pengujian_sekunder')->nullable();
            $table->string('satuan_nilai_pengujian_sekunder');
            $table->string('persyaratan_nilai_pengujian_sekunder');
            $table->string('kesesuaian_nilai_pengujian_sekunder');
            $table->string('keterangan_nilai_pengujian_sekunder')->nullable();

            $table->string('akurasi_rasio_tegangan')->nullable();
            $table->string('satuan_akurasi_rasio_tegangan');
            $table->string('persyaratan_akurasi_rasio_tegangan');
            $table->string('kesesuaian_akurasi_rasio_tegangan');
            $table->string('keterangan_akurasi_rasio_tegangan')->nullable();
            $table->string('kelas_akurasi')->nullable();

            $table->enum('kesimpulan', ['Bekas layak pakai (K6)', 'Masih garansi (K7)', 'Bekas tidak layak pakai (K8)']);
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
        Schema::dropIfExists('trafo_tegangans');
    }
};
