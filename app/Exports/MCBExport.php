<?php

namespace App\Exports;

use App\Models\MCB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MCBExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MCB::all();
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
          'ID Pelanggan',
          'No. Serial',
          'Tipe MCB',
          'Nilai Ampere',
          'Nama Pabrikan',
          'Masa Pakai',
          'Pengujian Ketidakhapusan Penandaan',
          'Ket. Pengujian Ketidakhapusan Penandaan',
          'Pengujian Toggle Switch',
          'Ket. Pengujian Toggle Switch',
          'Pengujian Keandalan Sekrup, Bagian Yang Menghantar Arus dan Sambungan',
          'Ket. Pengujian Keandalan Sekrup',
          'Pengujian Keandalan Terminal Untuk Penghantar Luar (Dilakukan Bersamaan Dengan Memutar Sekrup)',
          'Ket. Pengujian Keandalan Terminal',
          'Pengujian Pemutusan Arus',
          'Ket. Pengujian Pemutusan Arus',
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
            $row->id_pelanggan,
            $row->no_serial,
            $row->tipe_mcb,
            $row->nilai_ampere,
            $row->pabrikan->nama_pabrikan,
            $row->masa_pakai,
            $row->pengujian_ketidakhapusan_penandaan,
            $row->keterangan_ketidakhapusan_penandaan,
            $row->pengujian_toggle_switch,
            $row->keterangan_toggle_switch,
            $row->pengujian_keandalan_sekrup,
            $row->pengujian_keandalan_terminal,
            $row->pengujian_pemutusan_arus,
            $row->keterangan_pemutusan_arus,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
