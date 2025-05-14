<?php

namespace App\Exports;

use App\Models\TiangListrik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TiangListrikSingleExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return TiangListrik::where('id', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'No. Surat',
            'Tgl. Inspeksi',
            'Kode UP3',
            'UP3',
            'Kode ULP',
            'ULP',
            'Gudang Retur',
            'Lokasi Akhir Terpasang',
            'Tahun Produksi',
            'Masa Pakai',
            'Tipe Tiang Listrik',
            'Jenis Tiang',
            'No. Serial',
            'Nama Pabrikan',
            'Pengujian Visual/Sifat Tampak (Jika tiang baja terdapat karatan ringan tanpa keropos, maka dapat diperbaiki (cat ulang))',
            'Panjang (Beban kerja (daN) diisi jika masih ada di penandaan tiang)',
            'Kelurusan Tiang',
            'Ket. Kelurusan Tiang',
            'Kualitas Penyambung (Untuk tiang listrik baja)',
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
            $row->tipe_tiang_listrik,
            $row->jenis_tiang,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->pengujian_visual,
            $row->pengujian_panjang,
            $row->kelurusan_tiang,
            $row->keterangan_kelurusan_tiang,
            $row->kualitas_penyambungan,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
