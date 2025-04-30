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
        Schema::table('cable_powers', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan_k6'); // Indeks untuk kesimpulan_k6
            $table->index('kesimpulan_k8'); // Indeks untuk kesimpulan_k8
        });
        Schema::table('conductors', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan_k6'); // Indeks untuk kesimpulan_k6
            $table->index('kesimpulan_k8'); // Indeks untuk kesimpulan_k8
        });
        Schema::table('trafo_aruses', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan'); // Indeks untuk kesimpulan
        });
        Schema::table('trafo_tegangans', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan'); // Indeks untuk kesimpulan
        });
        Schema::table('tiang_listriks', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan'); // Indeks untuk kesimpulan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cable_powers', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
        Schema::table('conductors', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
        Schema::table('trafo_aruses', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
        Schema::table('trafo_tegangans', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
        Schema::table('tiang_listriks', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
    }
};
