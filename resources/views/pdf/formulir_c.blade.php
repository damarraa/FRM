<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulir Inspeksi Material Retur Kotak APP </title>
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
                    {{ $kotak->uid->wilayah }}</span><br>UNIT
                {{ $kotak->up3s->unit }}
            </p>
            <p style="display: table-cell; width: 50%; text-align: right;">Formulir 01-C</p>
        </div>

        <h2><u>FORMULIR INSPEKSI MATERIAL RETUR KOTAK APP</u></h2>
        <center>
            <p style="font-weight: bold; margin-top: 0px;">NO: {{ $kotak->no_surat }}</p>

        </center>
        <p>Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur Kotak APP Distribusi dengan data sebagai berikut:</p>

        <h3 style="margin-bottom: -5px;">A DATA MATERIAL</h3>
        <div class="grid-container" style="margin-bottom: -10px;">
            <div class="grid-item">
                <p>Lokasi Akhir Terpasang: {{ $kotak->lokasi_akhir_terpasang }}<br>
                    Unit Layanan Pelanggan: {{ $kotak->ulp->daerah }}<br>
                    Tahun Produksi: {{ $kotak->tahun_produksi }}</p>
            </div>
            <div class="grid-item">
                <p>Tipe Kotak APP: {{ $kotak->tipe_kotak }}<br>
                    No Serial: {{ $kotak->no_serial }}<br>
                    Nama Pabrikan: {{ $kotak->pabrikan }}</p>
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
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $kotak->nameplate == 'Ada' ? '✔' : '' !!}</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $kotak->nameplate == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan data lengkap <br>
                    (Nama pabrikan, merek, <br>
                    SN, tipe, IPXX, tegangan <br>
                    dan arus pengenal, tahun <br>
                    pembuatan, dan standar)</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->nameplate == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $kotak->keteranganNameplate }}</td>
            </tr>

            <tr>
                <td>2</td>
                <td style="text-align: left;"> Kondisi selungkup dan pintu kotak APP <br> (+tutup gembok untuk tipe
                    APP-PTL)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->kondisi_selungkup == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->kondisi_selungkup == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Tidak ada <br>
                    retak/longgar/karat/cacat <br>
                    lain</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->kondisi_selungkup == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $kotak->keteranganSelungkup }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td style="text-align: left;"> Kunci pengaman</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $kotak->kunci_pengaman == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->kunci_pengaman == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->kunci_pengaman == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $kotak->keteranganKunciPengaman }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td style="text-align: left;">Ventilasi</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">{!! $kotak->ventilasi == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->ventilasi == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->ventilasi == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $kotak->keteranganVentilasi }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td style="text-align: left;">Jendela kaca</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->jendela_kaca == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->jendela_kaca == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->jendela_kaca == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganJendelaKaca }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td style="text-align: left;">Kuping pemasang</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->kuping_pemasang == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->kuping_pemasang == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->kuping_pemasang == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganKupingPemasang }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td style="text-align: left;">Seal</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->seal == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->seal == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->seal == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganSeal }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td style="text-align: left;">Logo PLN dan tanda peringatan bahaya</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->logo_peringatan == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->logo_peringatan == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->logo_peringatan == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganLogoPeringatan }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td style="text-align: left;">Kotak kontak</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->kotak_kontak == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->kotak_kontak == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->kotak_kontak == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganKotakKontak }}</td>
            </tr>
            <tr>
                <td>10</td>
                <td style="text-align: left;">Papan montase</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->papan_montase == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->papan_montase == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->papan_montase == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganPapanMontase }}</td>
            </tr>
            <tr>
                <td>11</td>
                <td style="text-align: left;">Rangka dan jendela MCB/MCCB <br>
                    (APP-PL-CB dan APP-PTL)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->rangka_jendela == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->rangka_jendela == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->rangka_jendela == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganRangkaJendela }}</td>
            </tr>
            <tr>
                <td>12</td>
                <td style="text-align: left;">Rel MCB tipe DIN rail (APP-PL-CB dan APP-PTL)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->rel_mcb == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->rel_mcb == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->rel_mcb == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganRelMCB }}</td>
            </tr>
            <tr>
                <td>13</td>
                <td style="text-align: left;">Lubang kabel dilengkapi cable gland</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->lubang_kabel == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->lubang_kabel == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->lubang_kabel == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganLubangKabel }}</td>
            </tr>
            <tr>
                <td>14</td>
                <td style="text-align: left;"> Busbar fasa R S T (APP-PTL)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->busbar_fasa == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->busbar_fasa == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->busbar_fasa == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganBusbarFasa }}</td>
            </tr>
            <tr>
                <td>15</td>
                <td style="text-align: left;"> Busbar netral (APP-PL-CB dan APP-PTL)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->busbar_netral == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->busbar_netral == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->busbar_netral == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganBusbarNetral }}</td>
            </tr>
            <tr>
                <td>16</td>
                <td style="text-align: left;"> Insulator busbar (APP-PL-CB dan APP-PTL)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->insulator_busbar == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->insulator_busbar == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->insulator_busbar == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganInsulatorBusbar }}</td>
            </tr>
            <tr>
                <td>17</td>
                <td style="text-align: left;">Indikator shunt trip (APP-PTL)</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->indikator_shunt == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->indikator_shunt == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->indikator_shunt == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganIndikatorShunt }}</td>
            </tr>
            <tr>
                <td>18</td>
                <td style="text-align: left;">Saku modem, lubang modem dan topi <br>
                    pelindung antena</td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->saku_modem == 'Ada' ? '✔' : '' !!}
                </td>
                <td style="font-family: 'DejaVu Sans', sans-serif;">
                    {!! $kotak->saku_modem == 'Tidak ada' ? '✔' : '' !!}
                </td>
                <td>Ada dan baik</td>
                <td class="checkbox-cell" style="font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->saku_modem == 'Ada')
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                <td>{{ $kotak->keteranganSakuModem }}</td>
            </tr>

        </table>
        <p style="margin: 0px;">Keterangan: <br> a. Poin 1 dan 2 bila terdapat cacat dapat diperbaiki atau dilengkapi,
            poin yang lainnya adalah mandatory (tidak boleh diperbaiki)
            <br> b. Fungsi MCB/MCCB dan meter pada kotak APP diperiksa berdasarkan FORMULIR INSPEKSI Material MDU MCB
            dan Meter
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
                <th>Baik</th>
                <th>Tidak Baik</th>
            </tr>
            <tr>
            <tr>
                <td style="background-color: rgb(202, 202, 202);">1</td>
                <td colspan="6" style="text-align: left; background-color: rgb(202, 202, 202);">Pengujian tahanan
                    isolasi:</td>

            </tr>
            <td></td>
            <td style="text-align: left;">a) L1 - (L2+L3+N+body)</td>

            <td>{{ $kotak->l1_app }}</td>
            <td style="font-weight: bold;">M Ohm</td>
            <td rowspan="3" style="vertical-align: center; font-size: 12px; font-weight: bold;">>1 M Ohm</td>
            <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                @if ($kotak->l1_app > 1)
                    <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                @else
                    <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                @endif
            </td>
            <td>{{ $kotak->keteranganL1APP }}</td>
            </tr>
            <tr>
                <td></td>

                <td style="text-align: left;">b) L2 - (L1+L3+N+body)</td>

                <td>{{ $kotak->l2_app }}</td>
                <td style="font-weight: bold;">M Ohm</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->l2_app > 1)
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $kotak->keteranganL2APP }}</td>
            </tr>
            <tr>
                <td></td>

                <td style="text-align: left;">c) L3 - (L1+L2+N+body)</td>

                <td>{{ $kotak->l3_app }}</td>
                <td style="font-weight: bold;">M Ohm</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->l3_app > 1)
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $kotak->keteranganL3APP }}</td>
            </tr>
            <tr>
                <td></td>

                <td style="text-align: left;">d) N - (L1+L2+L3+body)</td>

                <td>{{ $kotak->n_app }}</td>
                <td style="font-weight: bold;">M Ohm</td>
                <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                    @if ($kotak->n_app > 1)
                        <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                    @else
                        <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                    @endif
                </td>
                <td>{{ $kotak->keteranganNAPP }}</td>
            </tr>

        </table>
        <h3 style="margin-top: 5px;">D. UJI MEKANIK</h3>
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
                <th>Baik</th>
                <th>Tidak Baik</th>
            </tr>
            <tr>
            <tr>
                <td style="background-color: rgb(202, 202, 202);">1</td>
                <td colspan="6" style="text-align: left; background-color: rgb(202, 202, 202);">Pengujian mekanik:
                </td>

            </tr>
            <td></td>
            <td style="text-align: left;">Buka tutup pintu kotak APP 5x</td>

            <td>{{ $kotak->pengujian_mekanik }}</td>
            <td>{{ $kotak->pengujian_mekanik }}</td>
            <td rowspan="3" style="vertical-align: center; font-size: 12px; font-weight: bold;">Pintu tetap
                beroperasi dengan baik</td>
            <td style="height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                @if ($kotak->pengujian_mekanik == 'Baik')
                    <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                @else
                    <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                @endif
            </td>
            <td>{{ $kotak->keteranganMekanik }}</td>
            </tr>
        </table>

        <h3 style="margin-top: 5px;">E KESIMPULAN</h3>
        @if ($kotak->kesimpulan == 'Bekas layak pakai (K6)')
            <p style="margin: 0px; margin-top: -5px;"> *) bekas layak pakai (K6) / <del>bekas bisa diperbaiki
                    (K7)</del> / <del>bekas
                    tidak layak pakai (K8)</del></p>
        @elseif ($kotak->kesimpulan == 'Bekas bisa diperbaiki (K7)')
            <p style="margin: 0px; margin-top: -5px;"> *) <del>bekas layak pakai (K6)</del> / bekas bisa diperbaiki
                (K7) / <del>bekas
                    tidak layak pakai (K8)</del></p>
        @elseif ($kotak->kesimpulan == 'Bekas tidak layak pakai (K8)')
            <p style="margin: 0px; margin-top: -5px;"> *) <del>bekas layak pakai (K6)</del> / <del>bekas bisa
                    diperbaiki (K7)</del> / bekas
                tidak layak pakai (K8)</p>
        @endif

        @php
            $isEdited = $kotak->updated_at != $kotak->created_at; // Cek apakah ada perubahan
            $isStatusOnly = true; // Asumsikan hanya status yang diubah

            // Jika ada perubahan pada kolom selain status, set $isStatusOnly ke false
            foreach ($kotak->getChanges() as $key => $value) {
                if ($key !== 'status') {
                    $isStatusOnly = false;
                    break;
                }
            }
        @endphp

        {{-- @if ($kotak->approved_by && $isEdited && !$isStatusOnly)
            <p style="font-size: 9px; margin-left: 20px; margin-top: 0px;">
                *edited by: {{ $kotak->approvedBy->name }} pada
                {{ $kotak->updated_at->format('d/m/Y') }}
            </p>
        @endif --}}

        @if ($kotak->is_edited)
            <p style="font-size: 9px; margin-left: 20px; margin-top: 0px;">
                *edited by: {{ $kotak->approvedBy->name }} pada
                {{ $kotak->updated_at->format('d/m/Y') }}
            </p>
        @endif

        <table style="width: 100%; border-collapse: collapse; margin-top: -5px;">
            <tr>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">Yang Menyerahkan
                    <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                        {{ \Carbon\Carbon::parse($kotak->created_at)->format('d/m/Y') }}
                    </p>
                </td>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">DISETUJUI OLEH
                    <br>
                    PIC Gudang
                    <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                        {{ \Carbon\Carbon::parse($kotak->updated_at)->format('d/m/Y') }}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">
                    <img src="{{ $kotak->user->signature }}" alt="Signature" width="50px" height="50px"
                        style="display: block; margin: 5px auto 10px auto;" />
                    <p style="margin: 0px;">
                        {{ $kotak->user->name ?? '............................................' }}
                    </p>
                </td>
                <td style="text-align: center; border: none; font-size: 12px; font-weight: bold;">
                    <img src="{{ $kotak->approvedBy->signature }}" width="50px" height="50px"
                        style="display: block; margin: 5px auto 10px auto" />
                    <p style="margin: 0px">
                        {{ $kotak->approvedBy->name ?? '............................................' }}
                    </p>
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
        @if ($kotak->gambar)
            @php
                $gambarArray = json_decode($kotak->gambar, true);
                $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
            @endphp

            <table style="width: 100%; border-collapse: collapse;">
                @foreach ($chunkedImages as $row)
                    <tr>
                        @foreach ($row as $gambar)
                            @php
                                $path = public_path('gambar_kotakApp/' . basename($gambar));
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
