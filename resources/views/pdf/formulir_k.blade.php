<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur PHBTR</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 40px auto; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW {{ $phbtr->uid->wilayah }}</span> <br> UNIT
                {{ $phbtr->up3s->unit }}</div>
            <div style="float: right">Formulir 01-K</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR PHBTR</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: {{ $phbtr->no_surat }}</p>
        </div>

        <div style="font-size: 11px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span>
            bulan <span style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua
                Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur Papan Hubung Bagi Tegangan Rendah (PHBTR) dengan data sebagai
            berikut:
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p style="text-align: left; font-size: 14px; font-weight: bold; margin-top: 10px; margin-bottom: -10px;">A.
                DATA MATERIAL</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">Lokasi Akhir Terpasang: {{ $phbtr->lokasi_akhir_terpasang }}
                            </li>
                            <li style="padding: 0px 0;">Unit Layanan Pelanggan: {{ $phbtr->ulp->daerah }}</li>
                            <li style="padding: 0px 0;">Tahun Produksi: {{ $phbtr->tahun_produksi }}</li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">Tipe PHBR: {{ $phbtr->tipe_phbtr }}</li>
                            <li style="padding: 0px 0;">No Serial: {{ $phbtr->no_serial }}</li>
                            <li style="padding: 0px 0;">Nama Pabrikan: {{ $phbtr->pabrikan->nama_pabrikan }}</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -10px; margin-bottom: -10px;">
                B. PEMERIKSAAN VISUAL</p>
            <div style="width: 100%; padding: 10px 20px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">NO</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">MATA UJI</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            colspan="2">HASIL PEMERIKSAAN</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">PERSYARATAN</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">KESESUAIAN</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">KETERANGAN</th>
                    </tr>
                    <tr>
                        <th
                            style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;">
                            ADA</th>
                        <th
                            style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;">
                            TIDAK ADA</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Nameplate</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->nameplate == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->nameplate == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($phbtr->nameplate == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganNameplate }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Busbar dan penyangga busbar</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->busbar_penyangga == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->busbar_penyangga == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($phbtr->busbar_penyangga == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganBusbar }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">3</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Saklar utama</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->saklar_utama == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->saklar_utama == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($phbtr->saklar_utama == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganSaklarUtama }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">4</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            NH Fuse</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->nh_fuse == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->nh_fuse == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($phbtr->nh_fuse == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganNHFuse }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">5</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Fuse Rail</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->fuse_rail == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->fuse_rail == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Tidak ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($phbtr->fuse_rail == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganFuseRail }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">6</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Kondisi Selungkup Untuk PHBTR Pasangan Luar
                            (Ada retak/longgar dari selungkup)</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->selungkup_phbtr == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $phbtr->selungkup_phbtr == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Tidak ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($phbtr->selungkup_phbtr == 'Tidak ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganSelungkup }}
                        </td>
                    </tr>
                </table>
            </div>
            <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan:</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 10px;">a. Poin 1 dan 4 bila terdapat cacat dapat
                diperbaiki atau dilengkapi.</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 10px;">b. Jika poin B (2,3,5,6) ada yang tidak
                sesuai maka pengujian poin C tidak perlu dilakukan.</p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                C. PENGUJIAN ELEKTRIK</p>
            <div style="width: 100%; padding: 10px 20px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            NO</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            MATA UJI</th>
                        <th colspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            HASIL PENGUJIAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            PERSYARATAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            KESESUAIAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            KETERANGAN</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px;">
                            NILAI</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px;">
                            SATUAN</th>
                    </tr>
                    <tr style="height: 0px">
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;"
                            rowspan="5">
                            1</td>
                        <td style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;"
                            colspan="6">
                            Pengujian Tahanan Isolasi</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            a) L1 - (L2 + L3 + N + Body)
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->l1_phbtr }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            M Ohm
                        </td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;"
                            rowspan="4">
                            > 1 MΩ</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($phbtr->l1_phbtr > 1)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganL1PHBTR }}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            b) L2 - (L1 + L3 + N + Body)
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->l2_phbtr }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            M Ohm
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($phbtr->l2_phbtr > 1)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganL2PHBTR }}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            c) L3 - (L1 + L2 + N + Body)
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->l3_phbtr }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            M Ohm
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($phbtr->l3_phbtr > 1)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganL3PHBTR }}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            d) N - (L1 + L2 + L3 + Body)
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->nphbtr }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            M Ohm
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($phbtr->nphbtr > 1)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganNPHBTR }}</td>
                    </tr>
                </table>
            </div>
            <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan: Kesesuaian seluruh mata uji
                poin C adalah mandatory.</p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -10px; margin-bottom: -10px;">
                D. PENGUJIAN MEKANIK</p>
            <div style="width: 100%; padding: 10px 20px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">NO</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">MATA UJI</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            colspan="2">HASIL PENGUJIAN</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">PERSYARATAN</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">KESESUAIAN</th>
                        <th style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;"
                            rowspan="2">KETERANGAN</th>
                    </tr>
                    <tr>
                        <th
                            style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;">
                            BAIK</th>
                        <th
                            style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;">
                            TIDAK BAIK</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;"
                            colspan="3">1</td>
                        <td style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;"
                            rowspan="6">
                            Pengujian Mekanik</td>
                    </tr>
                    <tr style="">
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            a) Buka Tutup Saklar Utama 5x
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {!! $phbtr->pengujian_mekanik1 == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {!! $phbtr->pengujian_mekanik1 == 'Tidak baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            Saklar tetap <br>
                            beroperasi <br>
                            dengan baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($phbtr->pengujian_mekanik1 == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganMekanik1 }}</td>
                    </tr>
                    <tr style="">
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            b) Buka Tutup Pintu PHBTR Untuk Pasangan Luar 5x
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {!! $phbtr->pengujian_mekanik2 == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {!! $phbtr->pengujian_mekanik2 == 'Tidak baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($phbtr->pengujian_mekanik2 == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $phbtr->keteranganMekanik2 }}</td>
                    </tr>
                </table>
            </div>
            <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan: Kesesuaian seluruh mata uji
                poin D adalah mandatory.</p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                E. KESIMPULAN</p>
            @if ($phbtr->kesimpulan == 'Bekas layak pakai (K6)')
                <p style="font-size: 11px; margin-left: 20px;"> *) bekas layak pakai (K6) / <del>bekas bisa diperbaiki
                        (K7)</del> / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($phbtr->kesimpulan == 'Bekas bisa diperbaiki (K7)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / bekas bisa
                    diperbaiki (K7) / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($phbtr->kesimpulan == 'Bekas tidak layak pakai (K8)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / <del>bekas bisa
                        diperbaiki (K7)</del> / bekas
                    tidak layak pakai (K8)</p>
            @endif

            {{-- @if ($phbtr->approved_by && $phbtr->updated_at != $phbtr->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $phbtr->approvedBy->name }} pada
                    {{ $phbtr->updated_at->format('d/m/Y') }}
                </p>
            @endif --}}

            @if ($phbtr->is_edited)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $phbtr->approvedBy->name }} pada
                    {{ $phbtr->updated_at->format('d/m/Y') }}
                </p>
            @endif

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($phbtr->created_at)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($phbtr->updated_at)->format('d/m/Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $phbtr->user->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $phbtr->user->name ?? '............................................' }} </p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $phbtr->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $phbtr->approvedBy->name ?? '............................................' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div style="font-size: 11px; margin-top: 10px;">
            <p style="text-align: left; font-size: 12px; margin: 0px; margin-top: -5px;">
                Keterangan:</p>
            <p style="text-align: left; font-size: 11px; margin: 0px; display: block;"><span
                    style="font-family: 'DejaVu Sans', sans-serif;">☑</span> sesuai</p>
            <p style="text-align: left; font-size: 11px; margin: 0px; display: block;"><span
                    style="font-family: 'DejaVu Sans', sans-serif;">☒</span> tidak sesuai</p>
            <p style="text-align: left; font-size: 11px; margin: 0px; display: block;">*) coret yang tidak diperlukan
            </p>
        </div>

        <div style="page-break-before: always; margin-top: 20px;">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: 10px;">
                F. GAMBAR EVIDENCE
            </p>
            @if ($phbtr->gambar)
                @php
                    $gambarArray = json_decode($phbtr->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_phbtr/' . basename($gambar));
                                    $imageData = base64_encode(file_get_contents($path));
                                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                                @endphp
                                <td style="text-align: center; padding: 10px; border: 1px solid #ddd;">
                                    <img src="{{ $imageSrc }}" alt="Gambar Inspeksi"
                                        style="width: 250px; height: auto; display: block; margin: auto;">
                                </td>
                            @endforeach
                            {{-- Jika jumlah gambar ganjil, tambahkan sel kosong agar tabel tetap rapi --}}
                            @if (count($row) < 2)
                                <td style="border: 1px solid #ddd;"></td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
</body>

</html>
