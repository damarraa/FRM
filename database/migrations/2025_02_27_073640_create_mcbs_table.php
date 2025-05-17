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
        Schema::create('mcbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_form_id')->constrained('jenis_forms')->onDelete('cascade');
            $table->date('tgl_inspeksi');
            $table->string('no_surat')->unique();
            $table->string('id_pelanggan');
            $table->enum('tipe_mcb', ['1 fasa', '3 fasa']);
            $table->string('nilai_ampere');
            $table->string('no_serial')->nullable();
            $table->enum('masa_pakai', ['<=10', '>10']);
            $table->string('pengujian_ketidakhapusan_penandaan');
            $table->string('persyaratan_ketidakhapusan_penandaan');
            $table->enum('kesesuaian_pengujian_ketidakhapusan_penandaan', ['yes', 'no']);
            $table->string('keterangan_ketidakhapusan_penandaan')->nullable();
            
            $table->string('pengujian_toggle_switch');
            $table->string('persyaratan_toggle_switch');
            $table->enum('kesesuaian_pengujian_toggle_switch', ['yes', 'no']);
            $table->string('keterangan_toggle_switch')->nullable();

            $table->string('pengujian_keandalan_sekrup');
            $table->string('persyaratan_keandalan_sekrup');
            $table->enum('kesesuaian_keandalan_sekrup', ['yes', 'no']);

            $table->string('pengujian_keandalan_terminal');
            $table->string('persyaratan_keandalan_terminal');
            $table->enum('kesesuaian_keandalan_terminal', ['yes', 'no']);
            $table->string('keterangan_pengujian_keandalan')->nullable();

            $table->string('pengujian_pemutusan_arus')->nullable();
            $table->string('persyaratan_pemutusan_arus');
            $table->enum('kesesuaian_pemutusan_arus', ['yes', 'no']);
            $table->string('keterangan_pemutusan_arus')->nullable();
            
            $table->enum('kesimpulan', ['Bekas layak pakai (K6)', 'Masih garansi (K7)', 'Bekas tidak layak pakai (K8)']);
            $table->json('gambar')->nullable();
            $table->enum('status', ['Unapproved', 'Approved']);
            $table->boolean('is_edited')->default(false);
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
        Schema::dropIfExists('mcbs');
    }
};
