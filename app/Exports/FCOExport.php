<?php

namespace App\Exports;

use App\Models\FuseCutOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class FCOExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $ids;
    protected $worksheetName;

    public function __construct(array $ids = null, $worksheetName = 'FCO')
    {
        $this->ids = $ids;
        $this->worksheetName = $worksheetName;
    }

    public function collection()
    {
        if ($this->ids) {
            return FuseCutOut::whereIn('id', $this->ids)->get();
        }

        return FuseCutOut::all();
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
            'Tipe Fuse Cut Out',
            'No. Serial',
            'Nama Pabrikan',
            'Penandaan Pada Fuse Base',
            'Ket. Penandaan Pada Fuse Base',
            'Penandaan Pada Fuse Carrier',
            'Ket. Penandaan Pada Fuse Carrier',
            'Fuse Base',
            'Ket. Fuse Base',
            'Fuse Carrier',
            'Ket. Fuse Carrier',
            'Bracket',
            'Ket. Bracket',
            'Mekanisme Kontak (Posisi kontak antara Fuse Carrier dengan Fuse Base)',
            'Ket. Mekanisme Kontak',
            'Kondisi Fuse Base',
            'Ket. Kondisi Fuse Base',
            'Kondisi Insulator (Bebas retak dan rongga (void))',
            'Ket. Kondisi Insulator',
            'Bracket',
            'Ket. Bracket',
            'Kondisi Fuse Carrier (Terdiri dari tabung pelebur, konektor tabung pelebur, kepala tabung, trunnion)',
            'Ket. Fuse Carrier',
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
            $row->tipe_fco,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->penandaan_fuse,
            $row->keteranganPenandaanFuse,
            $row->penandaan_carrier,
            $row->keteranganPenandaanCarrier,
            $row->fuse_base,
            $row->keteranganFuseBase,
            $row->fuse_carrier,
            $row->keteranganFuseCarrier,
            $row->bracket,
            $row->keterangan_bracket,
            $row->mekanisme_kontak,
            $row->keteranganMekanismeKontak,
            $row->kondisi_fuse_base,
            $row->keteranganKondisiFuseBase,
            $row->kondisi_insulator,
            $row->keteranganKondisiInsulator,
            $row->kondisi_bracket,
            $row->keteranganKondisiBracket,
            $row->kondisi_fuse_carrier,
            $row->keteranganKondisiFuseCarrier,
            $row->uji_tahanan_isolasi,
            $row->keterangan_uji_tahanan,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
