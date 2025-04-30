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
        Schema::create('l_b_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('tahun_produksi');
            $table->string('masa_pakai');
            $table->enum('tipe_lbs', ['Vacuum', 'SF6']);
            $table->string('no_serial');

            $table->string('nameplate');
            $table->string('persyaratan_nameplate');
            $table->enum('kesesuaian_nameplate', ['yes', 'no']);
            // $table->string('keterangan_nameplate')->nullable();

            $table->string('penandaan_terminal');
            $table->string('persyaratan_penandaan_terminal');
            $table->enum('kesesuaian_penandaan_temrinal', ['yes', 'no']);
            // $table->string('keterangan_penandaan_terminal')->nullable();

            $table->string('counter_lbs');
            $table->string('persyaratan_counter_lbs');
            $table->enum('kesesuaian_counter_lbs', ['yes', 'no']);
            // $table->string('keterangan_counter_lbs')->nullable();

            $table->string('bushing_lbs');
            $table->string('persyaratan_bushing_lbs');
            $table->enum('kesesuaian_bushing_lbs', ['yes', 'no']);
            // $table->string('keterangan_bushing_lbs')->nullable();

            $table->string('indikator_lbs');
            $table->string('persyaratan_indikator_lbs');
            $table->enum('kesesuaian_indikator_lbs', ['yes', 'no']);
            // $table->string('keterangan_indikator_lbs')->nullable();

            $table->string('rtu_lbs');
            $table->string('persyaratan_rtu_lbs');
            $table->enum('kesesuaian_rtu_lbs', ['yes', 'no']);
            // $table->string('keterangan_rtu_lbs')->nullable();

            $table->string('interuptor_lbs');
            $table->string('persyaratan_interuptor_lbs');
            $table->enum('kesesuaian_interuptor_lbs', ['yes', 'no']);
            // $table->string('keterangan_interuptor_lbs')->nullable();

            $table->string('mekanik1_lbs')->nullable();
            $table->string('persyaratan_mekanik1_lbs');
            $table->enum('kesesuaian_mekanik1_lbs', ['yes', 'no']);
            $table->string('keteranganMekanikManual')->nullable();

            $table->string('mekanik2_lbs')->nullable();
            $table->string('persyaratan_mekanik2_lbs');
            $table->enum('kesesuaian_mekanik2_lbs', ['yes', 'no']);
            $table->string('keteranganPanelKontrol')->nullable();

            $table->string('elektrik_r');
            $table->string('elektrik_s');
            $table->string('elektrik_t');

            $table->boolean('kesesuaian_elektrik')->default(false)->comment('Status kesesuaian overall');
            $table->json('data_elektrik')->nullable()->comment('Detail perhitungan dalam format JSON');

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
        Schema::dropIfExists('l_b_s');
    }
};
