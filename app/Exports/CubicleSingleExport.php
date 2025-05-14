<?php

namespace App\Exports;

use App\Models\Cubicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CubicleSingleExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Cubicle::where('id', $this->id)->get();
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
            'Tipe PHBTM/Cubicle',
            'No. Serial',
            'Nama Pabrikan',
            'Nameplate',
            'Ket. Nameplate',
            'Kelengkapan Peralatan/Komponen',
            'Ket. Kelengkapan Peralatan/Komponen',
            'Busbar dan Penyangga Busbar',
            'Ket. Busbar dan Penyangga Busbar',
            'Kondisi Pembumian dan Kelengkapan',
            'Ket. Kondisi Pembumian dan Kelengkapan',
            'Kondisi Selungkup Untuk PHBTM (Ada retak/longgar dari selungkup)',
            'Ket. Kondisi Selungkup Untuk PHBTM',
            'Pengujian L1-(L2+L3+N+Body)',
            'Ket. Pengujian L1-(L2+L3+N+Body)',
            'Pengujian L2-(L1+L3+N+Body)',
            'Ket. Pengujian L2-(L1+L3+N+Body)',
            'Pengujian L3-(L1+L2+N+Body)',
            'Ket. Pengujian L3-(L1+L2+N+Body)',
            'Pengujian N-(L1+L2+L3+Body)',
            'Ket. Pengujian N-(L1+L2+L3+Body)',
            'Pengujian Operasi LBS & Es (Torsi/Manual)',
            'Ket. Pengujian Operasi LBS & Es (Torsi/Manual)',
            'Pengujian Interlock Mekanik',
            'Ket. Pengujian Interlock Mekanik',
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
            $row->tipe_cubicle,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->nameplate,
            $row->keteranganNameplate,
            $row->kelengkapan_peralatan,
            $row->keteranganKelengkapan,
            $row->busbar_penyangga,
            $row->keteranganBusbar,
            $row->kondisi_pembumian,
            $row->keteranganPembumian,
            $row->kondisiSelungkup,
            $row->l1_cubicle,
            $row->keteranganL1Cubicle,
            $row->l2_cubicle,
            $row->keteranganL2Cubicle,
            $row->l3_cubicle,
            $row->keteranganL3Cubicle,
            $row->n_cubicle,
            $row->keteranganNCubicle,
            $row->pengujian_mekanik1,
            $row->keteranganPengujianMekanik1,
            $row->pengujian_mekanik2,
            $row->keteranganPengujianMekanik2,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
