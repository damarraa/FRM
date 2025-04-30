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
        Schema::create('fuse_cut_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->string('masa_pakai');
            $table->enum('tipe_fco', ['Polymer', 'Keramik']);
            $table->string('no_serial');

            $table->string('penandaan_fuse');
            $table->string('keteranganPenandaanFuse')->nullable();
            $table->string('penandaan_carrier');
            $table->string('keteranganPenandaanCarrier')->nullable();
            $table->string('fuse_base');
            $table->string('keteranganFuseBase')->nullable();
            $table->string('fuse_carrier');
            $table->string('keteranganFuseCarrier')->nullable();
            $table->string('bracket');
            $table->string('keterangan_bracket')->nullable();

            $table->string('mekanisme_kontak');
            $table->string('keteranganMekanismeKontak')->nullable();
            $table->string('kondisi_fuse_base');
            $table->string('keteranganKondisiFuseBase')->nullable();
            $table->string('kondisi_insulator');
            $table->string('keteranganKondisiInsulator')->nullable();
            $table->string('kondisi_bracket');
            $table->string('keteranganKondisiBracket')->nullable();
            $table->string('kondisi_fuse_carrier');
            $table->string('keteranganKondisiFuseCarrier')->nullable();

            $table->string('uji_tahanan_isolasi')->nullable();
            $table->string('keterangan_uji_tahanan')->nullable();

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
        Schema::dropIfExists('fuse_cut_outs');
    }
};
