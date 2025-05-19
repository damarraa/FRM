<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur LBS</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 40px auto; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW {{ $lbs->uid->wilayah }}</span> <br> UNIT
                {{ $lbs->up3s->unit }}</div>
            <div style="float: right">Formulir 01-N</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR LBS</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: {{ $lbs->no_surat }}</p>
        </div>

        <div style="font-size: 11px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur LBS dengan data sebagai berikut:
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
                                {{ $lbs->lokasi_akhir_terpasang }}</li>
                            <li style="padding: 0px 0;">Unit Layanan Pelanggan: {{ $lbs->ulp->daerah }}</li>
                            <li style="padding: 0px 0;">Tahun Produksi: {{ $lbs->tahun_produksi }}</li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">Tipe LBS:
                                @if ($lbs->tipe_lbs == 'Vacuum')
                                    Vacuum/<del>SF6</del> *)
                                @elseif ($lbs->tipe_lbs == 'SF6')
                                    <del>Vacuum</del>/SF6 *)
                                @endif
                            </li>
                            <li style="padding: 0px 0;">No Serial: {{ $lbs->no_serial }}</li>
                            <li style="padding: 0px 0;">Nama Pabrikan: {{ $lbs->pabrikan->nama_pabrikan }}
                            </li>
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
                            Papan Nama</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->nameplate == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->nameplate == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->nameplate == 'Ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;"
                            rowspan="7">
                            Periksa secara <br>
                            visual ada atau <br>
                            tidak item yang <br>
                            diperiksa</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Penandaan Terminal</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->penandaan_terminal == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->penandaan_terminal == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->penandaan_terminal == 'Ada')
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
                            Counter Mekanis LBS</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->counter_lbs == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->counter_lbs == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->counter_lbs == 'Ada')
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
                            Kondisi Fisik Bushing HV (Ada retak/longgar dari tangki/seal bushing rembes)</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->bushing_lbs == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->bushing_lbs == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Tidak ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->bushing_lbs == 'Tidak ada')
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
                            Indikator Posisi LBS</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->indikator_lbs == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->indikator_lbs == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->indikator_lbs == 'Ada')
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
                            Fisik RTU</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->rtu_lbs == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->rtu_lbs == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->rtu_lbs == 'Ada')
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
                            Indikator Kegagalan Interuptor Pada Vacuum atau Indikator Low Pressure Pada Gas SF6</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->interuptor_lbs == 'Ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->interuptor_lbs == 'Tidak ada' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Tidak ada</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->interuptor_lbs == 'Tidak ada')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <p style="margin-left: 20px; margin-top: -10px; font-size: 9px;">Keterangan:</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 9px;">a. Jika item mandatory poin B (4, 5, 6,
                7)
                ada
                yang tidak sesuai maka pengujian poin C tidak perlu dilakukan</p>
            <p style="margin-left: 22px; margin-top: -10px; font-size: 9px;">b. Poin 1, 2, 3 dapat diperbaiki/diganti
            </p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                C. PENGUJIAN MEKANIK</p>
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
                            BERHASIL</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px;">
                            GAGAL</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Buka Tutup Switch Secara Manual 5x</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->mekanik1_lbs == 'Berhasil' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->mekanik1_lbs == 'Gagal' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Berhasil</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->mekanik1_lbs == 'Berhasil')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $lbs->keteranganMekanikManual }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Buka Tutup Switch Dengan Panel Kontrol 5x</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->mekanik2_lbs == 'Berhasil' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $lbs->mekanik2_lbs == 'Gagal' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Berhasil</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($lbs->mekanik2_lbs == 'Berhasil')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $lbs->keteranganPanelKontrol }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                C. PENGUJIAN MEKANIK</p>
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
                            rowspan="4">
                            1</td>
                        <td style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;"
                            colspan="6">
                            Pengujian Tahanan Kontak:</td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            a) R
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $lbs->elektrik_r }}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            µOhm</td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;"
                            rowspan="3">
                            Perbedaan nilai <br>
                            tahanan antar fasa <br>
                            tidak lebih dari 20%
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($kesesuaianElektrik['RS']['sesuai'] && $kesesuaianElektrik['RT']['sesuai'])
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;"
                            rowspan="3">
                            Menggunakan <br>
                            miro-ohmeter
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            b) S
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $lbs->elektrik_s }}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            µOhm</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($kesesuaianElektrik['RS']['sesuai'] && $kesesuaianElektrik['ST']['sesuai'])
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            c) T
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $lbs->elektrik_t }}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            µOhm</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($kesesuaianElektrik['RT']['sesuai'] && $kesesuaianElektrik['ST']['sesuai'])
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                E. KESIMPULAN</p>
            @if ($lbs->kesimpulan == 'Bekas layak pakai (K6)')
                <p style="font-size: 11px; margin-left: 20px;"> *) bekas layak pakai (K6) / <del>bekas bisa diperbaiki (K7)</del> / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($lbs->kesimpulan == 'Bekas bisa diperbaiki (K7)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / bekas bisa diperbaiki (K7) / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($lbs->kesimpulan == 'Bekas tidak layak pakai (K8)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / <del>bekas bisa diperbaiki (K7)</del> / bekas
                    tidak layak pakai (K8)</p>
            @endif

            {{-- @if ($lbs->approved_by && $lbs->updated_at != $lbs->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $lbs->approvedBy->name }} pada
                    {{ $lbs->updated_at->format('d/m/Y') }}
                </p>
            @endif --}}

            @if ($lbs->is_edited)
                <p style="font-size: 9px; margin-left: 20px; margin-top: 5px;">
                    *edited by: {{ $lbs->approvedBy->name }} pada
                    {{ $lbs->updated_at->format('d/m/Y') }}
                </p>
            @endif

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($lbs->created_at)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($lbs->updated_at)->format('d/m/Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $lbs->user->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $lbs->user->name ?? '............................................' }} </p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $lbs->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $lbs->approvedBy->name ?? '............................................' }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div style="font-size: 9px; margin-top: 10px;">
            <p style="text-align: left; font-size: 12px; margin: 0px; margin-top: -5px;">
                Keterangan:</p>
            <p style="text-align: left; font-size: 9px; margin: 0px; display: block;"><span
                    style="font-family: 'DejaVu Sans', sans-serif;">☑</span> sesuai</p>
            <p style="text-align: left; font-size: 9px; margin: 0px; display: block;"><span
                    style="font-family: 'DejaVu Sans', sans-serif;">☒</span> tidak sesuai</p>
            <p style="text-align: left; font-size: 9px; margin: 0px; display: block;">*) coret yang tidak diperlukan
            </p>
        </div>

        <div style="page-break-before: always; margin-top: 20px;">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: 10px;">
                E. GAMBAR EVIDENCE
            </p>
            @if ($lbs->gambar)
                @php
                    $gambarArray = json_decode($lbs->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_lbs/' . basename($gambar));
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
