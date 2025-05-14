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
        Schema::create('kotak_a_p_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('lokasi_akhir_terpasang');
            $table->string('pabrikan');
            $table->string('tahun_produksi');
            $table->string('masa_pakai');
            $table->enum('tipe_kotak', ['Pemasangan di Dinding', 'Pemasangan di Tiang']);
            $table->string('no_serial');

            $table->string('nameplate');
            $table->string('keteranganNameplate')->nullable();
            $table->string('kondisi_selungkup');
            $table->string('keteranganSelungkup')->nullable();
            $table->string('kunci_pengaman');
            $table->string('keteranganKunciPengaman')->nullable();
            $table->string('ventilasi');
            $table->string('keteranganVentilasi')->nullable();
            $table->string('jendela_kaca');
            $table->string('keteranganJendelaKaca')->nullable();
            $table->string('kuping_pemasang');
            $table->string('keteranganKupingPemasang')->nullable();
            $table->string('seal');
            $table->string('keteranganSeal')->nullable();
            $table->string('logo_peringatan');
            $table->string('keteranganLogoPeringatan')->nullable();
            $table->string('kotak_kontak');
            $table->string('keteranganKotakKontak')->nullable();
            $table->string('papan_montase');
            $table->string('keteranganPapanMontase')->nullable();
            $table->string('rangka_jendela');
            $table->string('keteranganRangkaJendela')->nullable();
            $table->string('rel_mcb');
            $table->string('keteranganRelMCB')->nullable();
            $table->string('lubang_kabel');
            $table->string('keteranganLubangKabel')->nullable();
            $table->string('busbar_fasa');
            $table->string('keteranganBusbarFasa')->nullable();
            $table->string('busbar_netral');
            $table->string('keteranganBusbarNetral')->nullable();
            $table->string('insulator_busbar');
            $table->string('keteranganInsulatorBusbar')->nullable();
            $table->string('indikator_shunt');
            $table->string('keteranganIndikatorShunt')->nullable();
            $table->string('saku_modem');
            $table->string('keteranganSakuModem')->nullable();

            $table->string('l1_app');
            $table->string('keteranganL1APP')->nullable();
            $table->string('l2_app');
            $table->string('keteranganL2APP')->nullable();
            $table->string('l3_app');
            $table->string('keteranganL3APP')->nullable();
            $table->string('n_app');
            $table->string('keteranganNAPP')->nullable();

            $table->string('pengujian_mekanik');
            $table->string('keteranganMekanik')->nullable();

            $table->enum('kesimpulan', ['Bekas layak pakai (K6)', 'Bekas bisa diperbaiki (K7)', 'Bekas tidak layak pakai (K8)']);
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
        Schema::dropIfExists('kotak_a_p_p_s');
    }
};
