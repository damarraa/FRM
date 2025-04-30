<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulir Inspeksi Material Retur Trafo Distribusi</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        h1,
        h2,
        h6 {
            text-align: center;
            margin: 0;
            padding: 5px 0;
        }

        table {
            width: 100%;
            /* Lebar tabel 100% */
            border-collapse: collapse;
            table-layout: auto;
            /* Pastikan lebar kolom mengikuti CSS */
        }

        th,
        td {
            border: 1px solid black;
            padding: 2px;
            text-align: center;
            vertical-align: top;
            word-wrap: break-word;
            /* Memastikan teks tidak meluber */
        }

        th.mata-uji,
        td.mata-uji {
            width: 35% !important;
            /* Sesuaikan dengan kebutuhan */
            word-wrap: break-word;
            white-space: normal;
        }


        .signature {
            margin: 0px;
            display: table;
            width: 100%;
        }

        .signature div {
            display: table-cell;
            width: 30%;
            text-align: center;
        }

        .notes {
            margin: 0px;
        }

        .grid-container {
            margin: 0px;
            display: table;
            width: 100%;
        }

        .grid-item {
            display: table-cell;
            width: 50%;
            padding: 0px;
        }

        .kodeform {
            text-align: right;
            margin-right: 20px;
        }

        .rowspan {
            vertical-align: middle;
            text-align: center;
            height: 100px;
        }

        .page-break {
            page-break-before: always;
            margin-top: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: table; width: 100%;">
            <p style="display: table-cell; width: 50%;"><span style="font-weight: bold">PT PLN (PERSERO)<br>UID/UW
                    {{ $trafo->uid->wilayah }}</span><br>UNIT
                {{ $trafo->up3s->unit }}</p>
            <p style="display: table-cell; width: 50%; text-align: right;">Formulir 01-F</p>
        </div>

        <h2><u>FORMULIR INSPEKSI MATERIAL RETUR TRAFO DISTRIBUSI</u></h2>
        <center>
            <p style="font-weight: bold; margin-top: 0px;">NO: {{ $trafo->no_surat }}</p>

        </center>
        <p>Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur Trafo Distribusi dengan data sebagai berikut:</p>

        <h3 style="margin-bottom: -5px;">A DATA MATERIAL</h3>
        <div class="grid-container" style="margin-bottom: -10px;">
            <div class="grid-item">
                <p>Lokasi akhir terpasang: {{ $trafo->lokasi_akhir_terpasang }}<br>
                    Unit Layanan Pelanggan: {{ $trafo->ulp->daerah }}<br>
                    Tahun Produksi: {{ $trafo->tahun_produksi }}</p>
            </div>
            <div class="grid-item">
                <p>Tipe Trafo Distribusi: {{ $trafo->tipe_trafo }}<br>
                    No Serial: {{ $trafo->no_serial }}<br>
                    Nama Pabrikan: {{ $trafo->pabrikan->nama_pabrikan }}</p>
            </div>
        </div>

        <h3 style="margin-top: 5px;">B PEMERIKSAAN VISUAL</h3>

        <table style="margin-top: -10px">
            <colgroup>
                <col style="width: 5%;"> <!-- No -->
                <col style="width: 35%;"> <!-- Mata Uji -->
                <col style="width: 15%;"> <!-- Hasil Pemeriksaan -->
                <col style="width: 15%;"> <!-- Persyaratan -->
                <col style="width: 10%;"> <!-- Kesesuaian -->
                <col style="width: 20%;"> <!-- Keterangan -->
            </colgroup>
            <tr>
                <th rowspan="2" class="no">NO</th>
                <th rowspan="2" style="width: 30px;" class="matauji">MATA UJI</th>
                <th colspan="2">HASIL PEMERIKSAAN</th>
                <th rowspan="2">PERSYARATAN</th>
                <th rowspan="2" class="checkbox-cell">KESESUAIAN</th>
                <th rowspan="2" class="keterangan">KETERANGAN</th>
            </tr>
            <tr>
                <th>Ada</th>
                <th>Tidak ada</th>
            </tr>
            <tr>
                <td>1</td>
                <td style="width: 300px; text-align: left;">Nameplate</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->nameplate == 'Ada' ? '✔' : '' !!}</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->nameplate == 'Tidak ada' ? '✔' : '' !!}</td>
                <td>Ada</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->nameplate == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nameplate }}</td>
            </tr>

            <tr>
                <td>2</td>
                <td style="text-align: left;">Penandaaan Terminal Primer dan Sekunder</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->penandaan_terminal == 'Ada' ? '✔' : '' !!}</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->penandaan_terminal == 'Tidak ada' ? '✔' : '' !!}</td>
                <td>Ada</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->penandaan_terminal == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_penandaan_terminal }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td style="text-align: left;">Pengaman tekanan lebih</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->pengaman_tekanan == 'Ada' ? '✔' : '' !!}</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->pengaman_tekanan == 'Tidak ada' ? '✔' : '' !!}</td>
                <td>Ada</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->pengaman_tekanan == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_pengaman_tekanan }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td style="text-align: left;">Kondisi tangki (ada kebocoran/bengkak/cacat radiator(sirip)/seal top cover
                    rembes)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->kondisi_tangki == 'Ada' ? '✔' : '' !!}</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->kondisi_tangki == 'Tidak ada' ? '✔' : '' !!}</td>
                <td>Tidak ada</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kondisi_tangki == 'Tidak ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_kondisi_tangki }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td style="text-align: left;">Kondisi fisik bushing HV dan LV (ada retak/longgar dari tangki/seal
                    bushing rembes)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->kondisi_fisik_bushing == 'Ada' ? '✔' : '' !!}</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $trafo->kondisi_fisik_bushing == 'Tidak ada' ? '✔' : '' !!}</td>
                <td>Tidak ada</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kondisi_fisik_bushing == 'Tidak ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>
                    *) Rusak pada fasa
                    @php
                        $fasaOptions = ['R', 'S', 'T', 'N']; // Semua opsi fasa
                        $kerusakanFasa = $trafo->kerusakan_fasa;

                        // Jika kerusakan_fasa adalah string JSON, decode menjadi array
                        if (is_string($kerusakanFasa)) {
                            $kerusakanFasa = json_decode($kerusakanFasa, true) ?? [];
                        }

                        // Pastikan kerusakanFasa adalah array
                        if (!is_array($kerusakanFasa)) {
                            $kerusakanFasa = [];
                        }
                    @endphp

                    @foreach ($fasaOptions as $fasa)
                        @if (!in_array($fasa, $kerusakanFasa))
                            <!-- Coret fasa yang tidak rusak -->
                            <del>{{ $fasa }}</del>
                        @else
                            <!-- Tampilkan fasa tanpa coretan jika rusak -->
                            {{ $fasa }}
                        @endif

                        @if (!$loop->last)
                            / <!-- Tambahkan pemisah antara fasa -->
                        @endif
                    @endforeach
                </td>
            </tr>

        </table>
        <p style="margin: 0px;">Keterangan: <br> a. Poin 1 dan 2 bila terdapat cacat dapat diperbaiki dengan dibuat
            penanda baru.
            <br> b. Kesesuaian poin B (3,4,5) adalah mandatory, jika ada yang tidak sesuai maka pengujian poin C tidak
            perlu dilakukan
        </p>

        <h3 style="margin-top: 5px;">C. UJI ELEKTRIK</h3>
        <table style="margin-top: -10px;">

            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2" class="matauji">MATA UJI</th>
                <th colspan="2">HASIL PENGUJIAN</th>
                <th rowspan="2">PERSYARATAN</th>
                <th rowspan="2">KESESUAIAN</th>
                <th rowspan="2" class="keterangan">KETERANGAN</th>
            </tr>
            <tr>
                <th>Nilai</th>
                <th>Satuan</th>
            </tr>
            <tr>
            <tr>
                <td style="background-color: rgb(202, 202, 202);">1</td>
                <td colspan="6" style="text-align: left; background-color: rgb(202, 202, 202);">Pengujian tahanan
                    isolasi:</td>

            </tr>
            <td></td>
            <td style="text-align: left;">a) HV - LV</td>

            <td>{{ $trafo->nilai_hv_lv }}</td>
            <td style="font-weight: bold;">M Ohm</td>
            <td rowspan="3" style="vertical-align: center; font-size: 12px; font-weight: bold;">1Mohm/kV atau PI > 2
            </td>
            <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                @if ($trafo->kesesuaian_nilai_hv_lv === 'yes')
                    <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                @else
                    <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                @endif
            </td>
            <td>{{ $trafo->keterangan_nilai_hv_lv }}</td>
            </tr>
            <tr>
                <td></td>

                <td style="text-align: left;">b) HV - Ground</td>

                <td>{{ $trafo->nilai_hv_ground }}</td>
                <td style="font-weight: bold;">M Ohm</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_hv_ground === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_hv_ground }}</td>
            </tr>
            <tr>
                <td></td>

                <td style="text-align: left;">c) LV - Ground</td>

                <td>{{ $trafo->nilai_lv_ground }}</td>
                <td style="font-weight: bold;">M Ohm</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_lv_ground === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_lv_ground }}</td>
            </tr>
            <tr>
            <tr>
                <td style="background-color: rgb(202, 202, 202);">2</td>
                <td colspan="6" style="text-align: left; background-color: rgb(202, 202, 202);">Rasio Belitan</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">Tap 1</td>
                <td rowspan="12"
                    style="vertical-align: center; font-size: 12px; text-align: center; font-weight: bold;">
                    rasio:<br>
                    Yzn5<br>
                    Dyn5<br>
                    YNyn0<br>
                    toleransi<br>
                    perbedaan rasio<br>
                    ±0,5%
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1U-1V</td>
                <td>{{ $trafo->nilai_tap1_1u_1v }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap1_1u_1v === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>

                <td>{{ $trafo->keterangan_nilai_tap1_1u_1v }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1V-1W</td>
                <td>{{ $trafo->nilai_tap1_1v_1w }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap1_1v_1w === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap1_1v_1w }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1W-1U</td>
                <td>{{ $trafo->nilai_tap1_1w_1u }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap1_1w_1u === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap1_1w_1u }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">Tap 3</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1U-1V</td>
                <td>{{ $trafo->nilai_tap3_1u_1v }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap3_1u_1v === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap3_1u_1v }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1V-1W</td>
                <td>{{ $trafo->nilai_tap3_1v_1w }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap3_1v_1w === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap3_1v_1w }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1W-1U</td>
                <td>{{ $trafo->nilai_tap3_1w_1u }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap3_1w_1u === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap3_1w_1u }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">Tap 7</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1U-1V</td>
                <td>{{ $trafo->nilai_tap7_1u_1v }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap7_1u_1v === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap7_1u_1v }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1V-1W</td>
                <td>{{ $trafo->nilai_tap7_1v_1w }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap7_1v_1w === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap7_1v_1w }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">1W-1U</td>
                <td>{{ $trafo->nilai_tap7_1w_1u }}</td>
                <td style="font-weight: bold;">%</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($trafo->kesesuaian_nilai_tap7_1w_1u === 'yes')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $trafo->keterangan_nilai_tap7_1w_1u }}</td>
            </tr>
        </table>

        <p style="margin: 0px;">Keterangan: Kesesuaian seluruh mata uji poin C adalah mandatory</p>

        <h3 style="margin-top: 5px;">D KESIMPULAN</h3>
        @if ($trafo->kesimpulan == 'Bekas layak pakai (K6)')
            <p style="margin: 0px; margin-top: -5px;"> *) bekas layak pakai (K6) / <del>masih garansi
                    (K7)</del> / <del>bekas
                    tidak layak pakai (K8)</del></p>
        @elseif ($trafo->kesimpulan == 'Masih garansi (K7)')
            <p style="margin: 0px; margin-top: -5px;"> *) <del>bekas layak pakai (K6)</del> / masih garansi
                (K7) / <del>bekas
                    tidak layak pakai (K8)</del></p>
        @elseif ($trafo->kesimpulan == 'Bekas tidak layak pakai (K8)')
            <p style="margin: 0px; margin-top: -5px;"> *) <del>bekas layak pakai (K6)</del> / <del>masih
                    garansi
                    (K7)</del> / bekas
                tidak layak pakai (K8)</p>
        @endif

        @php
            $isEdited = $trafo->updated_at != $trafo->created_at; // Cek apakah ada perubahan
            $isStatusOnly = true; // Asumsikan hanya status yang diubah

            // Jika ada perubahan pada kolom selain status, set $isStatusOnly ke false
            foreach ($trafo->getChanges() as $key => $value) {
                if ($key !== 'status') {
                    $isStatusOnly = false;
                    break;
                }
            }
        @endphp

        @if ($trafo->approved_by && $isEdited && !$isStatusOnly)
            <p style="font-size: 9px; margin-left: 20px; margin-top: 0px;">
                *edited by: {{ $trafo->approvedBy->name }} pada
                {{ $trafo->updated_at->format('d/m/Y') }}
            </p>
        @endif

        <table style="width: 100%; border-collapse: collapse; margin-top: -5px;">
            <tr>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">Yang Menyerahkan
                    <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                        {{ \Carbon\Carbon::parse($trafo->created_at)->format('d/m/Y') }}</p>
                </td>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">DISETUJUI OLEH
                    <br>
                    PIC Gudang
                    <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                        {{ \Carbon\Carbon::parse($trafo->updated_at)->format('d/m/Y') }}</p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">
                    <img src="{{ $trafo->user->signature }}" alt="Signature" width="50px" height="50px"
                        style="display: block; margin: 5px auto 10px auto;" />
                    <p style="margin: 0px;">
                        {{ $trafo->user->name ?? '............................................' }} </p>
                </td>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">
                    <img src="{{ $trafo->approvedBy->signature }}" width="50px" height="50px"
                        style="display: block; margin: 5px auto 10px auto" />
                    <p style="margin: 0px">
                        {{ $trafo->approvedBy->name ?? '............................................' }}</p>
                </td>
            </tr>
        </table>
        <div style="font-size: 10px; margin-top: 10px;">
            <p style="text-align: left; font-size: 10px; margin: 0px; margin-top: -5px;">
                Keterangan:</p>
            <p style="text-align: left; font-size: 9px; margin: 0px; display: block;"><span
                    style="font-family: 'DejaVu Sans', sans-serif;">☑</span> sesuai</p>
            <p style="text-align: left; font-size: 9px; margin: 0px; display: block;"><span
                    style="font-family: 'DejaVu Sans', sans-serif;">☒</span> tidak sesuai</p>
            <p style="text-align: left; font-size: 9px; margin: 0px; display: block;">*) coret yang tidak diperlukan
            </p>
        </div>

    </div>
    <div style="page-break-before: always; margin-top: 20px;">
        <p
            style="text-align: left; font-size: 11px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: 10px;">
            E. GAMBAR EVIDENCE
        </p>
        @if ($trafo->gambar)
            @php
                $gambarArray = json_decode($trafo->gambar, true);
                $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
            @endphp

            <table style="width: 100%; border-collapse: collapse;">
                @foreach ($chunkedImages as $row)
                    <tr>
                        @foreach ($row as $gambar)
                            @php
                                $path = public_path('gambar_trafo/' . basename($gambar));
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
</body>

</html>
