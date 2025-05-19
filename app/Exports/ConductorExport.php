<?php

namespace App\Exports;

use App\Models\Conductor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ConductorExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $ids;
    protected $worksheetName;

    public function __construct(array $ids = null, $worksheetName = 'Conductor')
    {
        $this->ids = $ids;
        $this->worksheetName = $worksheetName;
    }

    public function collection()
    {
        if ($this->ids) {
            return Conductor::whereIn('id', $this->ids)->get();
        }

        return Conductor::all();
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
            'Tahun Pemasangan',
            'Jenis Conductor',
            'Ukuran Conductor',
            'Luas Penampang',
            'Panjang',
            'Pemeriksaan Kondisi Visual dan Penandaan (Tidak rantas, tidak mekar & isolasi tidak rusak)',
            'Pengujian Dimensi (+/- 1% dari standar conductor)',
            'Uji Tahanan Isolasi (Tidak rantas, tidak mekar & isolasi tidak rusak)',
            'Bekas Layak Pakai (K6)',
            'Bekas Tidak Layak Pakai (K8)',
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
            $row->tahun_pemasangan,
            $row->jenis_conductor,
            $row->ukuran_conductor,
            $row->luas_penampang,
            $row->panjang_conductor,
            $row->nilai_pemeriksaan_kondisi_visual,
            $row->nilai_pengujian_dimensi,
            $row->nilai_uji_tahanan_isolasi,
            $row->kesimpulan_k6,
            $row->kesimpulan_k8,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
