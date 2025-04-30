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
        Schema::table('kwh_meters', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan'); // Indeks untuk kesimpulan
        });
        Schema::table('mcbs', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan'); // Indeks untuk kesimpulan
        });
        Schema::table('trafos', function (Blueprint $table) {
            $table->index('created_at'); // Indeks untuk created_at
            $table->index('status');    // Indeks untuk status
            $table->index('kesimpulan'); // Indeks untuk kesimpulan
        });
        Schema::table('users', function (Blueprint $table) {
            $table->index('is_active'); // Indeks untuk is_active
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kwh_meters', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
        Schema::table('mcbs', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
        Schema::table('trafos', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['kesimpulan']);
        });
    
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });
    }
};
