<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TiangListrik extends Model
{
    protected $table = 'tiang_listriks';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'lokasi_akhir_terpasang',
        'tahun_produksi',
        'tipe_tiang_listrik',
        'jenis_tiang',
        'no_serial',
        'masa_pakai',
        'pengujian_visual',
        'persyaratan_pengujian_visual',
        'kesesuaian_pengujian_visual',
        'pengujian_panjang',
        'persyaratan_pengujian_panjang',
        'kesesuaian_pengujian_panjang',
        'kelurusan_tiang',
        'persyaratan_kelurusan_tiang',
        'kesesuaian_kelurusan_tiang',
        'keterangan_kelurusan_tiang',
        'kualitas_penyambungan',
        'persyaratan_kualitas_penyambungan',
        'kesesuaian_kualitas_penyambungan',
        'kesimpulan',
        'gambar',
        'status',
        'jenis_form_id',
        'gudang_id',
        'pabrikan_id',
        'uid_id',
        'up3_id',
        'ulp_id',
        'user_id',
        'approved_by'
    ];

    protected $cast = [
        'gambar' => 'array'
    ];

    // Relasi user yang submit form
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi user yang approve form
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function jenisForm()
    {
        return $this->belongsTo(JenisForm::class, 'jenis_form_id');
    }

    public function nomorSurat()
    {
        return $this->hasOne(NomorSurat::class, 'jenis_form_id', 'jenis_form_id')
            ->where('kode_gudang', $this->gudang_id)
            ->whereYear('created_at', date('Y', strtotime($this->tgl_inspeksi)));
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function pabrikan(): BelongsTo
    {
        return $this->belongsTo(Pabrikan::class, 'pabrikan_id');
    }

    public function uid(): BelongsTo
    {
        return $this->belongsTo(UID::class);
    }

    public function up3s(): BelongsTo
    {
        return $this->belongsTo(UP3::class, 'up3_id');
    }

    public function ulp(): BelongsTo
    {
        return $this->belongsTo(ULP::class, 'ulp_id', 'id');
    }
}
