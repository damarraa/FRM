<?php

namespace App\Exports;

use App\Models\KWHMeter;

class KWHMeterExport extends BaseReturExport
{
    public function modelType(): string
    {
        return 'KWH Meter';
    }

    public function customHeadings(): array
    {
        return [
            'No. Surat',
            'Tgl. Inspeksi',
            'UP3',
            'Gudang Retur',
            'ID Pelanggan',
            'No. Serial',
            'Tipe KWH',
            'Tahun Produksi',
            'Masa Pakai',
            'Ket. Masa Pakai',
            'Kondisi Body',
            'Ket. Kondisi Body',
            'Kondisi Segel',
            'Ket. Kondisi Segel',
            'Kondisi Terminal',
            'Ket. Terminal',
            'Kondisi Stand',
            'Ket. Kondisi Stand',
            'Kondisi Cover',
            'Ket. Kondisi Cover',
            'Kondisi Nameplate',
            'Ket. Kondisi Nameplate',
            'Nilai Uji Kesalahan',
            'Kelas Pengujian',
            'Ket. Uji Kesalahan',
            'Kesimpulan',
            'Gambar',
            'Petugas',
            'Approval PIC'
        ];
    }

    public function customMap($item): array
    {
        $item->load(['up3', 'gudang', 'kelasPengujian', 'user', 'approvedBy']);

        return [
            $item->no_surat,
            $item->tgl_inspeksi,
            $item->up3->unit ?? '-',
            $item->gudang->nama_gudang ?? '-',
            $item->id_pelanggan,
            $item->no_serial,
            $item->tipe_kwh_meter,
            $item->tahun_produksi,
            $item->masa_pakai,
            $item->keterangan_masa_pakai,
            $item->kondisi_body_kwh_meter,
            $item->keterangan_body_kwh_meter,
            $item->kondisi_segel_meterologi,
            $item->keterangan_segel_meterologi,
            $item->kondisi_terminal,
            $item->keterangan_terminal,
            $item->kondisi_stand_kwh_meter,
            $item->keterangan_stand_kwh_meter,
            $item->kondisi_cover_terminal_kwh_meter,
            $item->keterangan_cover_terminal_kwh_meter,
            $item->kondisi_nameplate,
            $item->keterangan_nameplate,
            $item->nilai_uji_kesalahan,
            $item->kelasPengujian->kelas_pengujian ?? '-',
            $item->keterangan_uji_kesalahan,
            $item->kesimpulan,
            $item->gambar,
            $item->user->name ?? '-',
            $item->approvedBy->name ?? '-'
        ];
    }
}
