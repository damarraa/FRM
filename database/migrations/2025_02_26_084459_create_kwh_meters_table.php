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
        Schema::create('kwh_meters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('id_pelanggan');
            $table->string('tahun_produksi');
            $table->enum('tipe_kwh_meter', ['Prabayar', 'Pascabayar']);
            $table->string('no_serial');

            $table->string('masa_pakai');
            $table->string('persyaratan_masa_pakai');
            $table->enum('kesesuaian_masa_pakai', ['yes', 'no'])->default('no');
            $table->string('keterangan_masa_pakai')->nullable();

            $table->string('kondisi_body_kwh_meter');
            $table->string('persyaratan_body_kwh_meter');
            $table->enum('kesesuaian_body_kwh_meter', ['yes', 'no'])->default('no');
            $table->string('keterangan_body_kwh_meter')->nullable();

            $table->string('kondisi_segel_meterologi');
            $table->string('persyaratan_segel_meterologi');
            $table->enum('kesesuaian_segel_meterologi', ['yes', 'no'])->default('no');
            $table->string('keterangan_segel_meterologi')->nullable();

            $table->string('kondisi_terminal');
            $table->string('persyaratan_terminal');
            $table->enum('kesesuaian_terminal', ['yes', 'no'])->default('no');
            $table->string('keterangan_terminal')->nullable();

            $table->string('kondisi_stand_kwh_meter');
            $table->string('persyaratan_stand_kwh_meter');
            $table->enum('kesesuaian_stand_kwh_meter', ['yes', 'no'])->default('no');
            $table->string('keterangan_stand_kwh_meter')->nullable();

            $table->string('kondisi_cover_terminal_kwh_meter');
            $table->string('persyaratan_cover_terminal_kwh_meter');
            $table->enum('kesesuaian_cover_terminal_kwh_meter', ['yes', 'no'])->default('no');
            $table->string('keterangan_cover_terminal_kwh_meter')->nullable();

            $table->string('kondisi_nameplate');
            $table->string('persyaratan_nameplate');
            $table->enum('kesesuaian_nameplate', ['yes', 'no'])->default('no');
            $table->string('keterangan_nameplate')->nullable();

            $table->float('nilai_uji_kesalahan')->nullable();
            $table->string('satuan_uji_kesalahan')->nullable();
            $table->string('persyaratan_uji_kesalahan')->nullable();
            $table->enum('kesesuaian_uji_kesalahan', ['yes', 'no'])->default('no')->nullable();
            $table->string('keterangan_uji_kesalahan')->nullable();
            
            $table->enum('kesimpulan', ['Bekas layak pakai (K6)', 'Masih garansi (K7)', 'Bekas tidak layak pakai (K8)']);
            $table->json('gambar')->nullable();
            $table->enum('status', ['Unapproved', 'Approved']);
            $table->unsignedBigInteger('user_id')->nullable(); // Pastikan NULL agar tidak langsung error
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('gudang_id');
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade');
            $table->unsignedBigInteger('kelas_pengujian_id')->nullable();
            $table->foreign('kelas_pengujian_id')->references('id')->on('kelas_pengujians')->onDelete('cascade');
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
        Schema::dropIfExists('kwh_meters');
    }
};
