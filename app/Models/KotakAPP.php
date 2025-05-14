<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function PHPSTORM_META\map;

class KotakAPP extends Model
{
    protected $table = 'kotak_a_p_p_s';

    protected $fillable = [
        'tgl_inspeksi',
        'no_surat',
        'tahun_produksi',
        'masa_pakai',
        'lokasi_akhir_terpasang',
        'pabrikan',
        'tipe_kotak',
        'no_serial',
        'nameplate',
        'keteranganNameplate',
        'kondisi_selungkup',
        'keteranganSelungkup',
        'kunci_pengaman',
        'keteranganKunciPengaman',
        'ventilasi',
        'keteranganVentilasi',
        'jendela_kaca',
        'keteranganJendelaKaca',
        'kuping_pemasang',
        'keteranganKupingPemasang',
        'seal',
        'keteranganSeal',
        'logo_peringatan',
        'keteranganLogoPeringatan',
        'kotak_kontak',
        'keteranganKotakKontak',
        'papan_montase',
        'keteranganPapanMontase',
        'rangka_jendela',
        'keteranganRangkaJendela',
        'rel_mcb',
        'keteranganRelMCB',
        'lubang_kabel',
        'keteranganLubangKabel',
        'busbar_fasa',
        'keteranganBusbarFasa',
        'busbar_netral',
        'keteranganBusbarNetral',
        'insulator_busbar',
        'keteranganInsulatorBusbar',
        'indikator_shunt',
        'keteranganIndikatorShunt',
        'saku_modem',
        'keteranganSakuModem',
        'l1_app',
        'keteranganL1APP',
        'l2_app',
        'keteranganL2APP',
        'l3_app',
        'keteranganL3APP',
        'n_app',
        'keteranganNAPP',
        'pengujian_mekanik',
        'keteranganMekanik',
        'gambar',
        'gambar.*',
        'kesimpulan',
        'gudang_id',
        'jenis_form_id',
        // 'pabrikan_id',
        'uid_id',
        'up3_id',
        'ulp_id',
        'user_id',
        'approved_by'
    ];

    protected $casts = [
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
