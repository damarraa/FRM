<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur Trafo Tegangan (PT)</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 0px; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW {{ $trafo_tegangan->uid->wilayah }}</span> <br> UNIT
                {{ $trafo_tegangan->up3s->unit }}</div>
            <div style="float: right">Formulir 01-M</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR TRAFO TEGANGAN (PT)</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: {{ $trafo_tegangan->no_surat }}</p>
        </div>

        <div style="font-size: 11px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur Trafo Tegangan (PT) dengan data sebagai berikut:
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p style="text-align: left; font-size: 14px; font-weight: bold; margin-top: 10px; margin-bottom: -10px;">A.
                DATA MATERIAL</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">Lokasi Akhir Terpasang:
                                {{ $trafo_tegangan->lokasi_akhir_terpasang }}</li>
                            <li style="padding: 0px 0;">Unit Layanan Pelanggan: {{ $trafo_tegangan->ulp->daerah }}</li>
                            <li style="padding: 0px 0;">Tahun Produksi: {{ $trafo_tegangan->tahun_produksi }}</li>
                            <li style="padding: 0px 0;">Tipe Trafo Arus:
                                @if ($trafo_tegangan->tipe_trafo_tegangan == 'Indoor')
                                    Indoor/<del>Outdoor</del>
                                @elseif ($trafo_tegangan->tipe_trafo_tegangan == 'Outdoor')
                                    <del>Indoor</del>/Outdoor
                                @endif
                            </li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">No Serial: {{ $trafo_tegangan->no_serial }}</li>
                            <li style="padding: 0px 0;">Nama Pabrikan: {{ $trafo_tegangan->pabrikan->nama_pabrikan }}
                            </li>
                            <li style="padding: 0px 0;">Rasio Tegangan: {{ $trafo_tegangan->rasio }}</li>
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
                            Retak Pada Resin</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->retak_pada_resin == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->retak_pada_resin == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Tidak ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->retak_pada_resin == 'Tidak ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;"
                            rowspan="8">
                            Periksa secara <br>
                            visual ada atau <br>
                            tidak item yang <br>
                            diperiksa</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Nameplate</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->nameplate == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->nameplate == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->nameplate == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">3</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Penandaan Terminal Primer dan Sekunder</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->penandaan_terminal == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->penandaan_terminal == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->penandaan_terminal == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">4</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Terminal Primer</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->terminal_primer == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->terminal_primer == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->terminal_primer == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">5</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Terminal Sekunder</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->terminal_sekunder == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->terminal_sekunder == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->terminal_sekunder == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">6</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Kelengkapan Baut Terminal Primer</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->kelengkapan_baut_primer == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->kelengkapan_baut_primer == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->kelengkapan_baut_primer == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">7</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Kelengkapan Baut Terminal Sekunder</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->kelengkapan_baut_sekunder == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->kelengkapan_baut_sekunder == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->kelengkapan_baut_sekunder == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">8</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Cover Terminal Sekunder</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->cover_terminal == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $trafo_tegangan->cover_terminal == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($trafo_tegangan->cover_terminal == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan:</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 10px;">a. Jika item mandatory poin B (1,2,3,6)
                ada
                yang tidak sesuai maka pengujian poin C tidak perlu dilakukan</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 10px;">b. Poin 4 dan 5 dapat diperbaiki
                menggunakan baut baru yang sesuai ukuran</p>
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
                            rowspan="3">
                            1</td>
                        <td style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;"
                            colspan="6">
                            Pengujian Tahanan Isolasi:</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            a) Primer - (Sekunder + Ground)
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $trafo_tegangan->nilai_pengujian_primer }}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            MΩ</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            > 20 MΩ</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($trafo_tegangan->nilai_pengujian_primer > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $trafo_tegangan->keterangan_nilai_pengujian_primer }}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            b) Sekunder - (Primer + Ground) Antar Seksi Belitan Pada Belitan Primer
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $trafo_tegangan->nilai_pengujian_sekunder }}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            MΩ</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            > 20 MΩ</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($trafo_tegangan->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $trafo_tegangan->keterangan_nilai_pengujian_sekunder }}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Pengujian Akurasi Rasio Tegangan</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $trafo_tegangan->akurasi_rasio_tegangan }}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            %</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Sesuai Kelas</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($trafo_tegangan->kesesuaian_akurasi_rasio_tegangan == 'yes')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $trafo_tegangan->keterangan_akurasi_rasio_tegangan }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan: Kesesuaian seluruh mata uji poin C adalah mandatory.</p>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                D. KESIMPULAN</p>
            @if ($trafo_tegangan->kesimpulan == 'Bekas layak pakai (K6)')
                <p style="font-size: 11px; margin-left: 20px;"> *) bekas layak pakai (K6) / <del>masih garansi
                        (K7)</del> / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($trafo_tegangan->kesimpulan == 'Masih garansi (K7)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / masih garansi
                    (K7) / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($trafo_tegangan->kesimpulan == 'Bekas tidak layak pakai (K8)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / <del>masih
                        garansi
                        (K7)</del> / bekas
                    tidak layak pakai (K8)</p>
            @endif

            {{-- @if ($trafo_tegangan->approved_by && $trafo_tegangan->wasChanged())
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $trafo_tegangan->approvedBy->name }} pada
                    {{ $trafo_tegangan->updated_at->format('d/m/Y') }}
                </p>
            @endif --}}

            {{-- @if ($trafo_tegangan->approved_by && $trafo_tegangan->updated_at != $trafo_tegangan->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $trafo_tegangan->approvedBy->name }} pada
                    {{ $trafo_tegangan->updated_at->format('d/m/Y') }}
                </p>
            @endif --}}

            @if ($trafo_tegangan->is_edited)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $trafo_tegangan->approvedBy->name }} pada
                    {{ $trafo_tegangan->updated_at->format('d/m/Y') }}
                </p>
            @endif

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($trafo_tegangan->created_at)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($trafo_tegangan->updated_at)->format('d/m/Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $trafo_tegangan->user->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $trafo_tegangan->user->name ?? '............................................' }} </p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $trafo_tegangan->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $trafo_tegangan->approvedBy->name ?? '............................................' }}
                        </p>
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
                E. GAMBAR EVIDENCE
            </p>
            @if ($trafo_tegangan->gambar)
                @php
                    $gambarArray = json_decode($trafo_tegangan->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_trafo_tegangan/' . basename($gambar));
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
