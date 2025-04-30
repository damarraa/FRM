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
        Schema::create('isolators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->string('masa_pakai');
            $table->enum('tipe_isolator', ['Pin', 'Pin Post', 'Line Post', 'Suspension']);
            $table->string('no_serial');

            $table->string('kondisi_visual');
            $table->string('persyaratan_kondisi_visual');
            $table->enum('kesesuaian_kondisi_visual', ['yes', 'no']);
            $table->string('keteranganVisualTampak')->nullable();

            $table->string('kondisi_warna');
            $table->string('persyaratan_kondisi_warna');
            $table->enum('kesesuaian_kondisi_warna', ['yes', 'no']);
            $table->string('keteranganKondisiWarna')->nullable();

            $table->string('kondisi_pecah');
            $table->string('persyaratan_kondisi_pecah');
            $table->enum('kesesuaian_kondisi_pecah', ['yes', 'no']);
            $table->string('keteranganKondisiPecah')->nullable();

            $table->string('kondisi_permukaan');
            $table->string('persyaratan_kondisi_permukaan');
            $table->enum('kesesuaian_kondisi_permukaan', ['yes', 'no']);
            $table->string('keteranganKondisiPermukaan')->nullable();

            $table->string('kondisi_korosi');
            $table->string('persyaratan_kondisi_korosi');
            $table->enum('kesesuaian_kondisi_korosi', ['yes', 'no']);
            $table->string('keteranganKondisiKorosi')->nullable();

            $table->string('pengujian_isolasi')->nullable();
            $table->string('persyaratan_pengujian_isolasi');
            $table->enum('kesesuaian_pengujian_isolasi', ['yes', 'no']);
            $table->string('keteranganTahananIsolasi')->nullable();

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
        Schema::dropIfExists('isolators');
    }
};
