<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur Fuse Cut Out</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 40px auto; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW ...</span> <br> UNIT
                ...</div>
            <div style="float: right">Formulir 01-H</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR FUSE CUT OUT</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: ...</p>
        </div>

        <div style="font-size: 11px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">...</span> tanggal <span style="font-weight: bold">...</span>
            bulan <span style="font-weight: bold">...</span> tahun <span style="font-weight: bold">Dua Ribu
                ...</span>
            telah diadakan inspeksi material retur Fuse Cut Out dengan data sebagai berikut:
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p style="text-align: left; font-size: 14px; font-weight: bold; margin-top: 10px; margin-bottom: -10px;">A.
                DATA MATERIAL</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">Lokasi Akhir Terpasang: ...</li>
                            <li style="padding: 0px 0;">Unit Layanan Pelanggan: ...</li>
                            <li style="padding: 0px 0;">Tahun Produksi: ...</li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">Tipe Fuse Cut Out: ...
                                {{-- @if ($trafo_arus->tipe_trafo_arus == 'Indoor')
                                    Indoor/<del>Outdoor</del>
                                @elseif ($trafo_arus->tipe_trafo_arus == 'Outdoor')
                                    <del>Indoor</del>/Outdoor
                                @endif --}}
                            </li>
                            <li style="padding: 0px 0;">No Serial: ...</li>
                            <li style="padding: 0px 0;">Nama Pabrikan: ...</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -10px; margin-bottom: -10px;">
                B. PEMERIKSAAN PENANDAAN</p>
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
                            Penandaan Pada Fuse Base</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->retak_pada_resin == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->retak_pada_resin == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- @if ($trafo_arus->retak_pada_resin == 'Tidak ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Penandaan Pada Fuse Carrier</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- @if ($trafo_arus->nameplate == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                C. PEMERIKSAAN KONSTRUKSI DAN KELENGKAPAN KOMPONEN</p>
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
                            HASIL PEMERIKSAAN</th>
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
                            BAIK</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px;">
                            RUSAK</th>
                    </tr>
                    <tr style="height: 0px">
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;"
                            rowspan="5">
                            1</td>
                        <td style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;"
                            colspan="6">
                            Bagian Utama Fuse Cut Out</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;"
                            colspan="6">
                            a) Fuse Holder, Terdiri Dari:
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            - Fuse Base
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_primer > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{-- {{ $trafo_arus->keterangan_nilai_pengujian_primer }} --}}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            - Fuse Carrier
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_primer > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{-- {{ $trafo_arus->keterangan_nilai_pengujian_primer }} --}}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            b) Bracket
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{-- {{ $trafo_arus->keterangan_nilai_pengujian_sekunder }} --}}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Mekanisme Kontak</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Posisi kontak antara fuse carrier dengan fuse base</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Mekanisme Kontak</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Posisi kontak antara fuse<br>
                            carrier dengan fuse base</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            3</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Fuse Base</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{-- {{ $trafo_arus->keterangan_nilai_pengujian_sekunder }} --}}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            4</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Kondisi Insulator</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Bebas retak dan rongga<br>
                            (void)</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            5</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Bracket</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{-- {{ $trafo_arus->keterangan_nilai_pengujian_sekunder }} --}}</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            6</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Fuse Carrier</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- {!! $trafo_arus->nameplate == 'Tidak ada' ? '✔' : '' !!} --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            {{-- @if ($trafo_arus->nilai_pengujian_sekunder > 20)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Terdiri dari tabung pelebur,<br>
                            konektor tabung pelebur,<br>
                            kepala tabung, dan trunnion</td>
                    </tr>
                </table>
            </div>
            <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan:</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 10px;">a. Jika item mandatory poin B (1 s.d 5)
                ada
                yang tidak sesuai maka pengujian poin D tidak perlu dilakukan</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 10px;">b. Poin 6 dapat diperbaiki/diganti</p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -10px; margin-bottom: -10px;">
                D. PENGUJIAN ELEKTRIK</p>
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
                            NILAI</th>
                        <th
                            style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;">
                            SATUAN</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Pengujian Tahanan Isolasi</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            ...
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            M Ohm
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            > 20 MΩ</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{-- @if ($trafo_arus->retak_pada_resin == 'Tidak ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif --}}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                        </td>
                    </tr>
                </table>
            </div>
            <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan: Kesesuaian seluruh mata uji poin D adalah mandatory.</p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                E. KESIMPULAN</p>
            {{-- @if ($trafo_arus->kesimpulan == 'Bekas layak pakai (K6)')
                <p style="font-size: 11px; margin-left: 20px;"> *) bekas layak pakai (K6) / <del>masih garansi
                        (K7)</del> / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($trafo_arus->kesimpulan == 'Masih garansi (K7)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / masih garansi
                    (K7) / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($trafo_arus->kesimpulan == 'Bekas tidak layak pakai (K8)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / <del>masih
                        garansi
                        (K7)</del> / bekas
                    tidak layak pakai (K8)</p>
            @endif

            @if ($trafo_arus->approved_by && $trafo_arus->updated_at != $trafo_arus->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $trafo_arus->approvedBy->name }} pada
                    {{ $trafo_arus->updated_at->format('d/m/Y') }}
                </p>
            @endif --}}

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        {{-- <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($trafo_arus->created_at)->format('d/m/Y') }}</p> --}}
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        {{-- <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($trafo_arus->updated_at)->format('d/m/Y') }}</p> --}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        {{-- <img src="{{ $trafo_arus->user->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $trafo_arus->user->name ?? '............................................' }} </p> --}}
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        {{-- <img src="{{ $trafo_arus->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $trafo_arus->approvedBy->name ?? '............................................' }}</p> --}}
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
            {{-- @if ($trafo_arus->gambar)
                @php
                    $gambarArray = json_decode($trafo_arus->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_trafo_arus/' . basename($gambar));
                                    $imageData = base64_encode(file_get_contents($path));
                                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                                @endphp
                                <td style="text-align: center; padding: 10px; border: 1px solid #ddd;">
                                    <img src="{{ $imageSrc }}" alt="Gambar Inspeksi"
                                        style="width: 250px; height: auto; display: block; margin: auto;">
                                </td>
                            @endforeach --}}
            {{-- Jika jumlah gambar ganjil, tambahkan sel kosong agar tabel tetap rapi --}}
            {{-- @if (count($row) < 2)
                                <td style="border: 1px solid #ddd;"></td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            @endif --}}
        </div>
    </div>
</body>

</html>
