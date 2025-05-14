<?php

namespace App\Exports;

use App\Models\TrafoTegangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TrafoTeganganSingleExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return TrafoTegangan::where('id', $this->id)->get();
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
            'Tipe Trafo Tegangan',
            'No. Serial',
            'Nama Pabrikan',
            'Rasio',
            'Retak Pada Resin',
            'Nameplate',
            'Penandaan Terminal Primer dan Sekunder',
            'Terminal Primer',
            'Terminal Sekunder',
            'Kelengkapan Baut Terminal Primer',
            'Kelengkapan Baut Terminal Sekunder',
            'Cover Terminal Sekunder',
            'Pengujian Tahanan Isolasi Primer',
            'Ket. Pengujian Tahanan Isolasi Primer',
            'Pengujian Tahanan Isolasi Sekunder',
            'Ket. Pengujian Tahanan Isolasi Sekunder',
            'Akurasi Rasio Tegangan',
            'Ket. Akurasi Rasio Tegangan',
            'Kelas Akurasi',
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
            $row->tipe_trafo_tegangan,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->rasio,
            $row->retak_pada_resin,
            $row->nameplate,
            $row->penandaan_terminal,
            $row->terminal_primer,
            $row->terminal_sekunder,
            $row->kelengkapan_baut_primer,
            $row->kelengkapan_baut_sekunder,
            $row->cover_terminal,
            $row->nilai_pengujian_primer,
            $row->keterangan_nilai_pengujian_primer,
            $row->nilai_pengujian_sekunder,
            $row->keterangan_nilai_pengujian_sekunder,
            $row->akurasi_rasio_tegangan,
            $row->keterangan_akurasi_rasio_tegangan,
            $row->kelas_akurasi,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
