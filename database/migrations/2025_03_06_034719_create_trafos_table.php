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
        Schema::create('trafos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->enum('tipe_trafo', ['Trafo Kering (Dry Type Transformer)', 'Trafo Berisi Minyak (Oil-Immersed Transformer)']);
            $table->string('no_serial');
            $table->string('masa_pakai');

            $table->string('nameplate');
            $table->string('persyaratan_nameplate');
            $table->enum('kesesuaian_nameplate', ['yes', 'no']);
            $table->string('keterangan_nameplate')->nullable();

            $table->string('penandaan_terminal');
            $table->string('persyaratan_penandaan_terminal');
            $table->enum('kesesuaian_penandaan_terminal', ['yes', 'no']);
            $table->string('keterangan_penandaan_terminal')->nullable();

            $table->string('pengaman_tekanan');
            $table->string('persyaratan_pengaman_tekanan');
            $table->enum('kesesuaian_pengaman_tekanan', ['yes', 'no']);
            $table->string('keterangan_pengaman_tekanan')->nullable();

            $table->string('kondisi_tangki');
            $table->string('persyaratan_kondisi_tangki');
            $table->enum('kesesuaian_kondisi_tangki', ['yes', 'no']);
            $table->string('keterangan_kondisi_tangki')->nullable();

            $table->string('kondisi_fisik_bushing');
            $table->string('persyaratan_kondisi_fisik_bushing');
            $table->enum('kesesuaian_kondisi_fisik_bushing', ['yes', 'no']);
            $table->string('keterangan_kondisi_fisik_busing')->nullable();

            $table->json('kerusakan_fasa')->nullable();

            $table->string('nilai_hv_lv')->nullable();
            $table->string('satuan_nilai_hv_lv');
            $table->enum('kesesuaian_nilai_hv_lv', ['yes', 'no']);
            $table->string('keterangan_nilai_hv_lv')->nullable();

            $table->string('nilai_hv_ground')->nullable();
            $table->string('satuan_nilai_hv_ground');
            $table->enum('kesesuaian_nilai_hv_ground', ['yes', 'no']);
            $table->string('keterangan_nilai_hv_ground')->nullable();

            $table->string('nilai_lv_ground')->nullable();
            $table->string('satuan_nilai_lv_ground');
            $table->enum('kesesuaian_nilai_lv_ground', ['yes', 'no']);
            $table->string('keterangan_nilai_lv_ground')->nullable();

            $table->string('persyaratan_pengujian_tahanan_isolasi');

            $table->string('nilai_tap1_1u_1v')->nullable();
            $table->string('satuan_nilai_tap1_1u_1v');
            $table->enum('kesesuaian_nilai_tap1_1u_1v', ['yes', 'no']);
            $table->string('keterangan_nilai_tap1_1u_1v')->nullable();
            
            $table->string('nilai_tap1_1v_1w')->nullable();
            $table->string('satuan_nilai_tap1_1v_1w');
            $table->enum('kesesuaian_nilai_tap1_1v_1w', ['yes', 'no']);
            $table->string('keterangan_nilai_tap1_1v_1w')->nullable();
            
            $table->string('nilai_tap1_1w_1u')->nullable();
            $table->string('satuan_nilai_tap1_1w_1u');
            $table->enum('kesesuaian_nilai_tap1_1w_1u', ['yes', 'no']);
            $table->string('keterangan_nilai_tap1_1w_1u')->nullable();

            $table->string('nilai_tap3_1u_1v')->nullable();
            $table->string('satuan_nilai_tap3_1u_1v');
            $table->enum('kesesuaian_nilai_tap3_1u_1v', ['yes', 'no']);
            $table->string('keterangan_nilai_tap3_1u_1v')->nullable();

            $table->string('nilai_tap3_1v_1w')->nullable();
            $table->string('satuan_nilai_tap3_1v_1w');
            $table->enum('kesesuaian_nilai_tap3_1v_1w', ['yes', 'no']);
            $table->string('keterangan_nilai_tap3_1v_1w')->nullable();

            $table->string('nilai_tap3_1w_1u')->nullable();
            $table->string('satuan_nilai_tap3_1w_1u');
            $table->enum('kesesuaian_nilai_tap3_1w_1u', ['yes', 'no']);
            $table->string('keterangan_nilai_tap3_1w_1u')->nullable();

            $table->string('nilai_tap7_1u_1v')->nullable();
            $table->string('satuan_nilai_tap7_1u_1v');
            $table->enum('kesesuaian_nilai_tap7_1u_1v', ['yes', 'no']);
            $table->string('keterangan_nilai_tap7_1u_1v')->nullable();

            $table->string('nilai_tap7_1v_1w')->nullable();
            $table->string('satuan_nilai_tap7_1v_1w');
            $table->enum('kesesuaian_nilai_tap7_1v_1w', ['yes', 'no']);
            $table->string('keterangan_nilai_tap7_1v_1w')->nullable();

            $table->string('nilai_tap7_1w_1u')->nullable();
            $table->string('satuan_nilai_tap7_1w_1u');
            $table->enum('kesesuaian_nilai_tap7_1w_1u', ['yes', 'no']);
            $table->string('keterangan_nilai_tap7_1w_1u')->nullable();

            $table->enum('kesimpulan', ['Bekas layak pakai (K6)', 'Masih garansi (K7)', 'Bekas tidak layak pakai (K8)']);
            $table->json('gambar')->nullable();
            $table->enum('status', ['Unapproved', 'Approved']);
            $table->unsignedBigInteger('user_id')->nullable(); // Pastikan NULL agar tidak langsung error
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('trafos');
    }
};
