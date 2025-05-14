<?php

namespace App\Exports;

use App\Models\Trafo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TrafoSingleExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Trafo::where('id', $this->id)->get();
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
            'No. Serial',
            'Nama Pabrikan',
            'Nameplate',
            'Ket. Nameplate',
            'Penandaan Terminal Primer dan Sekunder',
            'Ket. Penandaan Terminal Primer dan Sekunder',
            'Pengaman Tekanan Lebih',
            'Ket. Pengaman Tekanan Lebih',
            'Kondisi Tangki (Ada kebocoran/bengkak/cacat radiator(sirip)/seal top cover rembes)',
            'Ket. Kondisi Tangki',
            'Kondisi Fisik Bushing HV dan LV (Ada retak/longgar dari tangki/seal bushing rembes)',
            'Ket. Kondisi Fisik Bushing HV dan LV',
            'Kerusakan Fasa',
            'Pengujian HV - LV (MΩ)',
            'Kesesuaian HV - LV (MΩ)',
            'Keterangan HV - LV (MΩ)',
            'Pengujian HV - Ground (MΩ)',
            'Kesesuaian HV - Ground (MΩ)',
            'Keterangan HV- Ground (MΩ)',
            'Pengujian LV - Ground (MΩ)',
            'Kesesuaian LV - Ground (MΩ)',
            'Keterangan LV - Ground (MΩ)',
            'Tap 1 - 1U-1V(%)',
            'Kesesuaian Tap 1 - 1U-1V(%)',
            'Keterangan Tap 1 - 1U-1V(%)',
            'Tap 1 - 1V-1W(%)',
            'Kesesuaian Tap 1 - 1V-1W(%)',
            'Keterangan Tap 1 - 1V-1W(%)',
            'Tap 1 - 1W-1U(%)',
            'Kesesuaian Tap 1 - 1W-1U(%)',
            'Keterangan Tap 1 - 1W-1U(%)',
            'Tap 3 - 1U-1V(%)',
            'Kesesuaian Tap 3 - 1U-1V(%)',
            'Keterangan Tap 3 - 1U-1V(%)',
            'Tap 3 - 1V-1W(%)',
            'Kesesuaian Tap 3 - 1V-1W(%)',
            'Keterangan Tap 3 - 1V-1W(%)',
            'Tap 3 - 1W-1U(%)',
            'Kesesuaian Tap 3 - 1W-1U(%)',
            'Keterangan Tap 3 - 1W-1U(%)',
            'Tap 7 - 1U-1V(%)',
            'Kesesuaian Tap 7 - 1U-1V(%)',
            'Keterangan Tap 7 - 1U-1V(%)',
            'Tap 7 - 1V-1W(%)',
            'Kesesuaian Tap 7 - 1V-1W(%)',
            'Keterangan Tap 7 - 1V-1W(%)',
            'Tap 7 - 1W-1U(%)',
            'Kesesuaian Tap 7 - 1W-1U(%)',
            'Keterangan Tap 7 - 1W-1U(%)',
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
            $row->lokasi_akhir_terpasang,
            $row->tahun_produksi,
            $row->masa_pakai,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan ?? '-',
            $row->nameplate,
            $row->keterangan_nameplate ?? '-',
            $row->penandaan_terminal,
            $row->keterangan_penandaan_terminal ?? '-',
            $row->pengaman_tekanan,
            $row->keterangan_pengaman_tekanan ?? '-',
            $row->kondisi_tangki,
            $row->keterangan_kondisi_tangki ?? '-',
            $row->kondisi_fisik_bushing,
            $row->keterangan_kondisi_fisik_bushing ?? '-',
            $row->kerusakan_fasa ?? '-',
            $row->nilai_hv_lv,
            $row->kesesuaian_nilai_hv_lv,
            $row->keterangan_nilai_hv_lv,
            $row->nilai_hv_ground,
            $row->kesesuaian_nilai_hv_ground,
            $row->keterangan_nilai_hv_ground,
            $row->nilai_lv_ground,
            $row->kesesuaian_nilai_lv_ground,
            $row->keterangan_nilai_lv_ground,
            $row->nilai_tap1_1u_1v,
            $row->kesesuaian_nilai_tap1_1u_1v,
            $row->keterangan_nilai_tap1_1u_1v,
            $row->nilai_tap1_1v_1w,
            $row->kesesuaian_nilai_tap1_1v_1w,
            $row->keterangan_nilai_tap1_1v_1w,
            $row->nilai_tap1_1w_1u,
            $row->kesesuaian_nilai_tap1_1w_1u,
            $row->keterangan_nilai_tap1_1w_1u,
            $row->nilai_tap3_1u_1v,
            $row->kesesuaian_nilai_tap3_1u_1v,
            $row->keterangan_nilai_tap3_1u_1v,
            $row->nilai_tap3_1v_1w,
            $row->kesesuaian_nilai_tap3_1v_1w,
            $row->keterangan_nilai_tap3_1v_1w,
            $row->nilai_tap3_1w_1u,
            $row->kesesuaian_nilai_tap3_1w_1u,
            $row->keterangan_nilai_tap3_1w_1u,
            $row->nilai_tap7_1u_1v,
            $row->kesesuaian_nilai_tap7_1u_1v,
            $row->keterangan_nilai_tap7_1u_1v,
            $row->nilai_tap7_1v_1w,
            $row->kesesuaian_nilai_tap7_1v_1w,
            $row->keterangan_nilai_tap7_1v_1w,
            $row->nilai_tap7_1w_1u,
            $row->kesesuaian_nilai_tap7_1w_1u,
            $row->keterangan_nilai_tap7_1w_1u,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
