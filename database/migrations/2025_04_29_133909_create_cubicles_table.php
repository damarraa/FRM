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
        Schema::create('cubicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->string('masa_pakai');
            $table->enum('tipe_cubicle', ['LBS-Motorized', 'TP', 'VT', 'LBS-Manual', 'CB']);
            $table->string('no_serial');

            $table->string('nameplate');
            $table->string('persyaratan_nameplate');
            $table->string('keteranganNameplate')->nullable();

            $table->string('kelengkapan_peralatan');
            $table->string('persyaratan_kelengkapan_peralatan');
            $table->string('keteranganKelengkapan')->nullable();

            $table->string('busbar_penyangga');
            $table->string('persyaratan_busbar_penyangga');
            $table->string('keteranganBusbar')->nullable();

            $table->string('kondisi_pembumian');
            $table->string('persyaratan_kondisi_pembumian');
            $table->string('keteranganPembumian')->nullable();

            $table->string('kondisi_selungkup');
            $table->string('persyaratan_kondisi_selungkup');
            $table->string('keteranganSelungkup')->nullable();

            $table->string('l1_cubicle')->nullable();
            $table->string('keteranganL1Cubicle')->nullable();

            $table->string('l2_cubicle')->nullable();
            $table->string('keteranganL2Cubicle')->nullable();

            $table->string('l3_cubicle')->nullable();
            $table->string('keteranganL3Cubicle')->nullable();

            $table->string('n_cubicle')->nullable();
            $table->string('keteranganNCubicle')->nullable();

            $table->string('pengujian_mekanik1');
            $table->string('persyaratan_pengujian_mekanik1');
            $table->string('keteranganPengujianMekanik1')->nullable();

            $table->string('pengujian_mekanik2');
            $table->string('persyaratan_pengujian_mekanik2');
            $table->string('keteranganPengujianMekanik2')->nullable();

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
        Schema::dropIfExists('cubicles');
    }
};
