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
        Schema::create('p_h_b_t_r_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->string('masa_pakai');
            $table->enum('tipe_phbtr', ['PL-250-2-LBS', 'PL-250-2-MCCB', 'PL-250-2-FS', 'PL-400-2-LBS', 'PL-400-2-MCCB', 'PL-400-2-FS', 'PL-400-4-LBS', 'PL-400-4-MCCB', 'PL-400-4-FS', 'PL-4-LBS', 'PL-4-MCCB', 'PL-4-FS', 'PL-100-6-LBS', 'PL-100-6-MCCB', 'PL-100-8-LBS', 'PL-100-8-MCCB']);
            $table->string('no_serial');

            $table->string('nameplate');
            $table->string('persyaratan_nameplate');
            $table->string('keteranganNameplate')->nullable();

            $table->string('busbar_penyangga');
            $table->string('persyaratan_busbar_penyangga');
            $table->string('keteranganBusbar')->nullable();

            $table->string('saklar_utama');
            $table->string('persyaratan_saklar_utama');
            $table->string('keteranganSaklarUtama')->nullable();

            $table->string('nh_fuse');
            $table->string('persyaratan_nh_fuse');
            $table->string('keteranganNHFuse')->nullable();

            $table->string('fuse_rail');
            $table->string('persyaratan_fuse_rail');
            $table->string('keteranganFuseRail')->nullable();

            $table->string('selungkup_phbtr');
            $table->string('persyaratan_selungkup_phbtr');
            $table->string('keteranganSelungkup')->nullable();

            $table->string('l1_phbtr')->nullable();
            $table->string('keteranganL1PHBTR')->nullable();
            $table->string('l2_phbtr')->nullable();
            $table->string('keteranganL2PHBTR')->nullable();
            $table->string('l3_phbtr')->nullable();
            $table->string('keteranganL3PHBTR')->nullable();
            $table->string('nphbtr')->nullable();
            $table->string('keteranganNPHBTR')->nullable();

            $table->string('pengujian_mekanik1');
            $table->string('persyaratan_pengujian_mekanik1');
            $table->string('keteranganMekanik1')->nullable();

            $table->string('pengujian_mekanik2');
            $table->string('persyaratan_pengujian_mekanik2');
            $table->string('keteranganMekanik2')->nullable();

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
        Schema::dropIfExists('p_h_b_t_r_s');
    }
};
