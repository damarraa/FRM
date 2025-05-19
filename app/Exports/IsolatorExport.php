<?php

namespace App\Exports;

use App\Models\Isolator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class IsolatorExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $ids;
    protected $worksheetName;

    public function __construct(array $ids = null, $worksheetName = 'Isolator')
    {
        $this->ids = $ids;
        $this->worksheetName = $worksheetName;
    }

    public function collection()
    {
        if ($this->ids) {
            return Isolator::whereIn('id', $this->ids)->get();
        }

        return Isolator::all();
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
            'Tgl. Inspeksi',
            'Kode UP3',
            'UP3',
            'Kode ULP',
            'ULP',
            'Gudang Retur',
            'Lokasi Akhir Terpasang',
            'Tahun Produksi',
            'Masa Pakai',
            'Tipe Isolator',
            'No. Serial',
            'Nama Pabrikan',
            'Pemeriksaan Kondisi Visual/Sifat Tampak',
            'Ket. Pemeriksaan Kondisi',
            'Perubahan Warna',
            'Ket. Perubahan Warna',
            'Tidak Pecah',
            'Ket. Tidak Pecah',
            'Gores Permukaan',
            'Ket. Gores Permukaan',
            'Korosi',
            'Ket. Korosi',
            'Pengujian Tahanan Isolasi',
            'Ket. Pengujian Tahanan Isolasi',
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
            $row->tipe_isolator,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->kondisi_visual,
            $row->keteranganVisualTampak,
            $row->kondisi_warna,
            $row->keteranganKondisiWarna,
            $row->kondisi_pecah,
            $row->keteranganKondisiPecah,
            $row->kondisi_permukaan,
            $row->keteranganKondisiPermukaan,
            $row->kondisi_korosi,
            $row->keteranganKondisiKorosi,
            $row->pengujian_isolasi,
            $row->keteranganTahananIsolasi,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
