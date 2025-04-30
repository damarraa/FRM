<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur KWH Meter</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 40px auto; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW {{ $kWh_Meter->uid->wilayah }}</span> <br> UNIT
                {{ $kWh_Meter->up3s->unit }}</div>
            <div style="float: right">Formulir 01-A</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR KWH METER</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: {{ $kWh_Meter->no_surat }}</p>
        </div>

        <div style="font-size: 12px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur kWh Meter dengan data sebagai berikut:
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p style="text-align: left; font-size: 14px; font-weight: bold; margin-top: 10px; margin-bottom: -10px;">A.
                DATA MATERIAL</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 12px; margin-left: 10px">
                            <li style="padding: 1px 0;">ID Pelanggan:
                                {{ $kWh_Meter->id_pelanggan }}</li>
                            <li style="padding: 1px 0;">Unit Layanan Pelanggan: {{ $kWh_Meter->ulp->daerah }}
                            </li>
                            <li style="padding: 1px 0;">Tahun Produksi:
                                {{ $kWh_Meter->tahun_produksi }}</li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 12px; margin-left: 30px">
                            <li style="padding: 1px 0;">Tipe KWH Meter: {{ $kWh_Meter->tipe_kwh_meter }}</li>
                            <li style="padding: 1px 0;">No Serial:
                                {{ $kWh_Meter->no_serial }}</li>
                            <li style="padding: 1px 0;">Nama Pabrikan: {{ $kWh_Meter->pabrikan->nama_pabrikan }}</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                B. PEMERIKSAAN VISUAL DAN KONSTRUKSI</p>
            <div style="width: 100%; padding: 10px 20px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px;"
                            rowspan="2">NO</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">MATA UJI</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            colspan="2">HASIL PEMERIKSAAN</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">PERSYARATAN</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">KESESUAIAN</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">KETERANGAN</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;">
                            BAIK</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;">
                            RUSAK</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Masa
                            pakai</td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;"
                            colspan="2">{{ $kWh_Meter->masa_pakai }} tahun</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            &lt; 5
                            tahun</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($kWh_Meter->masa_pakai <= 5)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $kWh_Meter->keterangan_masa_pakai }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Kondisi
                            body kWh Meter</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_body_kwh_meter == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_body_kwh_meter == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($kWh_Meter->kondisi_body_kwh_meter == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">{{ $kWh_Meter->keterangan_body_kwh_meter }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">3</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Kondisi
                            segel meterologi</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_segel_meterologi == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_segel_meterologi == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($kWh_Meter->kondisi_segel_meterologi == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">{{ $kWh_Meter->keterangan_segel_meterologi }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">4</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Kondisi
                            terminal</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_terminal == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_terminal == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($kWh_Meter->kondisi_terminal == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">{{ $kWh_Meter->keterangan_terminal }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">5</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Kondisi
                            stand kWh Meter</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_stand_kwh_meter == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_stand_kwh_meter == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($kWh_Meter->kondisi_stand_kwh_meter == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">{{ $kWh_Meter->keterangan_stand_kwh_meter }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">6</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Kondisi
                            cover terminal kWh Meter</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_cover_terminal_kwh_meter == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_cover_terminal_kwh_meter == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($kWh_Meter->kondisi_cover_terminal_kwh_meter == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">{{ $kWh_Meter->keterangan_cover_terminal_kwh_meter }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">7</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Kondisi
                            nameplate</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_nameplate == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $kWh_Meter->kondisi_nameplate == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            Baik
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($kWh_Meter->kondisi_nameplate == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">{{ $kWh_Meter->keterangan_nameplate }}</td>
                    </tr>
                </table>
            </div>

            <p style="margin-left: 20px; margin-top: -10px; font-size: 12px;">Keterangan: Kesesuaian seluruh mata uji
                poin
                B
                adalah mandatory. Jika seluruh poin B
                sesuai, maka dapat dilanjutkan ke pengujian poin C. Jika tidak, maka poin selanjutnya tidak perlu diuji.
            </p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                C. PENGUJIAN KARAKTERISTIK</p>
            <div style="width: 100%; padding: 10px 20px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            NO</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            MATA UJI</th>
                        <th colspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            HASIL PENGUJIAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            PERSYARATAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            KESESUAIAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            KETERANGAN</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;">
                            NILAI</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;">
                            SATUAN</th>
                    </tr>
                    <tr style="height: 0px">
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            1</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Uji
                            kesalahan (%)</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $kWh_Meter->nilai_uji_kesalahan ?? '.....' }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            %</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            sesuai
                            kelas</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($kWh_Meter->kesesuaian_uji_kesalahan == 'yes')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">Kelas pengujian: {{ $kWh_Meter->KelasPengujian->kelas_pengujian ?? '-'}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                D. KESIMPULAN</p>
            @if ($kWh_Meter->kesimpulan == 'Bekas layak pakai (K6)')
                <p style="font-size: 12px; margin-left: 20px;"> *) bekas layak pakai (K6) / <del>masih garansi
                        (K7)</del> / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($kWh_Meter->kesimpulan == 'Masih garansi (K7)')
                <p style="font-size: 12px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / masih garansi
                    (K7) / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($kWh_Meter->kesimpulan == 'Bekas tidak layak pakai (K8)')
                <p style="font-size: 12px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / <del>masih
                        garansi
                        (K7)</del> / bekas
                    tidak layak pakai (K8)</p>
            @endif

            @if ($kWh_Meter->approved_by && $kWh_Meter->updated_at != $kWh_Meter->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -5px;">
                    *edited by: {{ $kWh_Meter->approvedBy->name }} pada
                    {{ $kWh_Meter->updated_at->format('d/m/Y') }}
                </p>
            @endif

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($kWh_Meter->created_at)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($kWh_Meter->updated_at)->format('d/m/Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $kWh_Meter->user->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $kWh_Meter->user->name ?? '............................................' }} </p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $kWh_Meter->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $kWh_Meter->approvedBy->name ?? '............................................' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div style="font-size: 12px; margin-top: 10px;">
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
            @if ($kWh_Meter->gambar)
                @php
                    $gambarArray = json_decode($kWh_Meter->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_kwh/' . basename($gambar));
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
