<?php

namespace App\Exports;

use App\Models\LBS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LBSExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LBS::all();
    }

    public function headings(): array
    {
        return [
            'No. Surat',
            'Tgl. Inspeksi',
            'Tgl. Inspeksi',
            'Kode UP3',
            'UP3',
            'Kode ULP',
            'ULP',
            'Gudang Retur',
            'Lokasi Akhir Terpasang',
            'Tahun Produksi',
            'Masa Pakai',
            'Tipe LBS',
            'No. Serial',
            'Nama Pabrikan',
            'Papan Nama',
            'Penandaan Terminal',
            'Counter Mekanis LBS',
            'Kondisi Fisik Bushing HV (Ada retak/longgar dari tangki/seal bushing rembes)',
            'Indikator Posisi LBS',
            'Fisik RTU',
            'Indikator Kegagalan Interuptor Pada Vacuum atau Indikator Low Pressure Pada Gas SF6',
            'Buka Tutup Switch Secara Manual 5x',
            'Ket. Buka Tutup Switch Manual',
            'Buka Tutup Switch Dengan Panel Kontrol 5x',
            'Ket. Buka Tutup Switch Panel Kontrol',
            'Pengujian Tahanan Kontak R',
            'Pengujian Tahanan Kontak S',
            'Pengujian Tahanan Kontak T',
            'Kesimpulan',
            'Gambar',
            'Petugas',
            'Approval PIC'
        ];
    }

    public function map($row): array
    {
        return [
            $row->no_surat,
            $row->tgl_inspeksi,
            $row->up3s->kode_unit,
            $row->up3s->unit ?? '-',
            $row->ulp->kode_ulp,
            $row->ulp->daerah ?? '-',
            $row->gudang->nama_gudang ?? '-',
            $row->lokasi_akhir_terpasang,
            $row->tahun_produksi,
            $row->masa_pakai,
            $row->tipe_lbs,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->nameplate,
            $row->penandaan_terminal,
            $row->counter_lbs,
            $row->bushing_lbs,
            $row->indikator_lbs,
            $row->rtu_lbs,
            $row->interuptor_lbs,
            $row->mekanik1_lbs,
            $row->keteranganMekanikManual,
            $row->mekanik2_lbs,
            $row->keteranganPanelKontrol,
            $row->elektrik_r,
            $row->elektrik_s,
            $row->elektrik_t,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
