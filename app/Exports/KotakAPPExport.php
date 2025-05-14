<?php

namespace App\Exports;

use App\Models\KotakAPP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use function PHPSTORM_META\map;

class KotakAPPExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KotakAPP::all();
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
            'Tipe Kotak APP',
            'No. Serial',
            'Nama Pabrikan',
            'Nameplate',
            'Ket. Nameplate',
            'Kondisi Selungkup dan Pintu Kotak APP',
            'Ket. Kondisi Selungkup dan Pintu Kotak APP',
            'Kunci Pengaman',
            'Ket. Kunci Pengaman',
            'Ventilasi',
            'Ket. Ventilasi',
            'Jendela Kaca',
            'Ket. Jendela Kaca',
            'Kuping Pemasang',
            'Ket. Kuping Pemasang',
            'Seal',
            'Ket. Seal',
            'Logo PLN dan Tanda Peringatan Bahaya',
            'Ket. Logo PLN dan Tanda Peringatan Bahaya',
            'Kotak Kontak',
            'Ket. Kotak Kontak',
            'Papan Montase',
            'Ket. Papan Montase',
            'Rangka dan Jendela MCB/MCCB (APP-PL-CB dan APP-PTL)',
            'Rangka dan Jendela MCB/MCCB',
            'Rel MCB Tipe DIN Rail (APP-PL-CB dan APP-PTL)',
            'Ket. Rel MCB Tipe DIN Rail',
            'Lubang Kabel Dilengkapi Cable Grand',
            'Ket. Lubang Kabel Dilengkapi Cable Grand',
            'Busbar Fasa R S T (APP-PTL)',
            'Ket. Busbar Fasa R S T (APP-PTL)',
            'Busbar Netral (APP-PTL-CB dan APP-PTL)',
            'Ket. Busbar Netral',
            'Insulator Busbar (APP-PL-CB dan APP-PTL)',
            'Ket. Insulator Busbar',
            'Indikator Shunt Trip (APP-PTL)',
            'Ket. Indikator Shunt Trip',
            'Saku Modem, Lubang Modem, dan Topi Pelindung Antena',
            'Ket. Saku Modem, Lubang Modem, dan Topi Pelindung Antena',
            'Pengujian L1-(L2+L3+N+Body)',
            'Ket. Pengujian L1-(L2+L3+N+Body)',
            'Pengujian L2-(L1+L3+N+Body)',
            'Ket. Pengujian L2-(L1+L3+N+Body)',
            'Pengujian L3-(L1+L2+N+Body)',
            'Ket. Pengujian L3-(L1+L2+N+Body)',
            'Pengujian N-(L1+L2+L3+Body)',
            'Ket. Pengujian N-(L1+L2+L3+Body)',
            'Uji Mekanik Buka Tutup Pintu Kotak APP 5x',
            'Ket. Uji Mekanik Buka Tutup Pintu Kotak APP 5x',
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
            $row->tipe_kotak,
            $row->no_serial,
            $row->pabrikan->nama_pabrikan,
            $row->nameplate,
            $row->keteranganNameplate,
            $row->kondisi_selungkup,
            $row->keteranganSelungkup,
            $row->kunci_pengaman,
            $row->keteranganKunciPengaman,
            $row->ventilasi,
            $row->keteranganVentilasi,
            $row->jendela_kaca,
            $row->keteranganJendelaKaca,
            $row->kuping_pemasang,
            $row->keteranganKupingPemasang,
            $row->seal,
            $row->keteranganSeal,
            $row->logo_peringatan,
            $row->keteranganLogoPeringatan,
            $row->kotak_kontak,
            $row->keteranganKotakKontak,
            $row->papan_montase,
            $row->keteranganPapanMontase,
            $row->rangka_jendela,
            $row->keteranganRangkaJendela,
            $row->rel_mcb,
            $row->keteranganRelMCB,
            $row->lubang_kabel,
            $row->keteranganLubangKabel,
            $row->busbar_fasa,
            $row->keteranganBusbarFasa,
            $row->busbar_netral,
            $row->keteranganBusbarNetral,
            $row->insulator_busbar,
            $row->keteranganInsulatorBusbar,
            $row->indikator_shunt,
            $row->keteranganIndikatorShunt,
            $row->saku_modem,
            $row->keteranganSakuModem,
            $row->l1_app,
            $row->keteranganL1APP,
            $row->l2_app,
            $row->keteranganL2APP,
            $row->l3_app,
            $row->keteranganL3APP,
            $row->n_app,
            $row->keteranganNAPP,
            $row->pengujian_mekanik,
            $row->keteranganMekanik,
            $row->kesimpulan,
            $row->gambar,
            $row->user->name ?? '-',
            $row->approvedBy->name ?? '-'
        ];
    }
}
