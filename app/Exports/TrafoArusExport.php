<?php

namespace App\Exports;

use App\Models\TrafoArus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class TrafoArusExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $ids;
    protected $worksheetName;

    public function __construct(array $ids = null, $worksheetName = 'CT')
    {
        $this->ids = $ids;
        $this->worksheetName = $worksheetName;
    }

    public function collection()
    {
        if ($this->ids) {
            return TrafoArus::whereIn('id', $this->ids)->get();
        }
        
        return TrafoArus::all();
    }

    public function title(): string
    {
        return $this->worksheetName;
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
            'Tipe Trafo Arus',
            'No. Serial',
            'Nama Pabrikan',
            'Rasio',
            'Kelas Pengukuran',
            'kelas Proteksi',
            'Retak Pada Resin',
            'Nameplate',
            'Penandaan Terminal Primer dan Sekunder',
            'Kelengkapan Baut Terminal Primer',
            'Kelengkapan Baut Terminal Sekunder',
            'Cover Terminal Sekunder',
            'Pengujian Tahanan Isolasi Primer',
            'Ket. Pengujian Tahanan Isolasi Primer',
            'Pengujian Tahanan Isolasi Sekunder',
            'Ket. Pengujian Tahanan Isolasi Sekunder',
            'Batas Kesalahan Akurasi Trafo Arus',
            'Ket. Batas Kesalahan Akurasi Trafo Arus',
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
            $row->tipe_trafo_arus,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->rasio,
            $row->kelas_pengukuran,
            $row->kelas_proteksi,
            $row->retak_pada_resin,
            $row->nameplate,
            $row->penandaan_terminal,
            $row->kelengkapan_baut_primer,
            $row->kelengkapan_baut_sekunder,
            $row->cover_terminal,
            $row->nilai_pengujian_primer,
            $row->keterangan_nilai_pengujian_primer,
            $row->nilai_pengujian_sekunder,
            $row->keterangan_nilai_pengujian_sekunder,
            $row->batas_kesalahan,
            $row->keterangan_batas_kesalahan,
            $row->kelas_akurasi,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
