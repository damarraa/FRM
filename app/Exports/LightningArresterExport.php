<?php

namespace App\Exports;

use App\Models\LightningArrester;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class LightningArresterExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $ids;
    protected $worksheetName;

    public function __construct(array $ids = null, $worksheetName = 'Lightning Arrester')
    {
        $this->ids = $ids;
        $this->worksheetName = $worksheetName;
    }

    public function collection()
    {
        if ($this->ids) {
            return LightningArrester::whereIn('id', $this->ids)->get();
        }

        return LightningArrester::all();
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
            'Tipe Lightning Arrester',
            'No. Serial',
            'Nama Pabrikan',
            'Pemeriksaan Kondisi Visual/Sifat Tampak',
            'Ket. Pemeriksaan Kondisi',
            'Uji Tahanan Isolasi',
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
            $row->tipe_la,
            $row->no_serial,
            $row->kondisi_visual,
            $row->keterangan_kondisi_visual,
            $row->uji_tahanan,
            $row->keterangan_uji_tahanan,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
