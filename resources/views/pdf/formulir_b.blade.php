<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur MCB</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 40px auto; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW {{ $mcb->uid->wilayah }}</span> <br> UNIT
                {{ $mcb->up3s->unit }}</div>
            <div style="float: right">Formulir 01-B</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR MCB</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: {{ $mcb->no_surat }}</p>
        </div>

        <div style="font-size: 12px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur MCB dengan data sebagai berikut:
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
                                {{ $mcb->id_pelanggan }}</li>
                            <li style="padding: 1px 0;">Unit Layanan Pelanggan: {{ $mcb->ulp->daerah }}
                            </li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 12px; margin-left: 30px">
                            @if ($mcb->tipe_mcb == '1 fasa')
                                <li style="padding: 1px 0;"> Tipe MCB: 1 fasa / <del>3 fasa*</del> :
                                    {{ $mcb->nilai_ampere }} A</li>
                            @else
                                <li style="padding: 1px 0;"> Tipe MCB: <del>1 fasa</del> / 3 fasa* :
                                    {{ $mcb->nilai_ampere }} A</li>
                            @endif
                            <li style="padding: 1px 0;">No Serial:
                                {{ $mcb->no_serial }}</li>
                            <li style="padding: 1px 0;">Nama Pabrikan: {{ $mcb->pabrikan->nama_pabrikan }}</li>
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
                            Pengujian ketidakhapusan penandaan
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_ketidakhapusan_penandaan == 'Baik' ? '✔' : '' !!}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_ketidakhapusan_penandaan == 'Rusak' ? '✔' : '' !!}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($mcb->pengujian_ketidakhapusan_penandaan == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">{{ $mcb->keterangan_ketidakhapusan_penandaan }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Pengujian toggle switch</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_toggle_switch == 'Baik' ? '✔' : '' !!}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_toggle_switch == 'Rusak' ? '✔' : '' !!}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($mcb->pengujian_toggle_switch == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">{{ $mcb->keterangan_toggle_switch }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">3</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Pengujian keandalan sekrup, bagian yang
                            menghantar arus dan sambungan
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_keandalan_sekrup == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_keandalan_sekrup == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($mcb->pengujian_keandalan_sekrup == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;"
                            rowspan="2">{{ $mcb->keterangan_pengujian_keandalan }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">4</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Pengujian keandalan terminal untuk penghantar
                            luar
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_keandalan_terminal == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $mcb->pengujian_keandalan_terminal == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($mcb->pengujian_keandalan_terminal == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <p style="margin-left: 20px; margin-top: -10px; font-size: 12px;">Keterangan: Kesesuaian seluruh mata uji
                poin
                B
                adalah mandatory. Jika seluruh poin B
                sesuai, maka dapat dilanjutkan ke pengujian poin C. Jika tidak, maka poin selanjutnya tidak perlu diisi.
            </p>
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
                            Pengujian Pemutusan Arus (Inominal x 1,2)</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $mcb->pengujian_pemutusan_arus ?? '.....' }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            Detik</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            ≤ 5 detik</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($mcb->pengujian_pemutusan_arus <= 5)
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">{{ $mcb->keterangan_pemutusan_arus }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                D. KESIMPULAN</p>
            @if ($mcb->kesimpulan == 'Bekas layak pakai (K6)')
                <p style="font-size: 12px; margin-left: 20px;"> *) bekas layak pakai (K6) / <del>masih garansi
                        (K7)</del> / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($mcb->kesimpulan == 'Masih garansi (K7)')
                <p style="font-size: 12px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / masih garansi
                    (K7) / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($mcb->kesimpulan == 'Bekas tidak layak pakai (K8)')
                <p style="font-size: 12px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / <del>masih
                        garansi
                        (K7)</del> / bekas
                    tidak layak pakai (K8)</p>
            @endif

            {{-- @if ($mcb->approved_by && $mcb->updated_at != $mcb->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -5px;">
                    *edited by: {{ $mcb->approvedBy->name }} pada
                    {{ $mcb->updated_at->format('d/m/Y') }}
                </p>
            @endif --}}

            @if ($mcb->is_edited)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -5px;">
                    *edited by: {{ $mcb->approvedBy->name }} pada
                    {{ $mcb->updated_at->format('d/m/Y') }}
                </p>
            @endif

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($mcb->created_at)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($mcb->updated_at)->format('d/m/Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $mcb->user->signature }}" alt="Signature" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $mcb->user->name ?? '............................................' }} </p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $mcb->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $mcb->approvedBy->name ?? '............................................' }}</p>
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
            @if ($mcb->gambar)
                @php
                    $gambarArray = json_decode($mcb->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2);
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_mcb/' . basename($gambar));
                                    $imageData = base64_encode(file_get_contents($path));
                                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                                @endphp
                                <td style="text-align: center; padding: 10px; border: 1px solid #ddd;">
                                    <img src="{{ $imageSrc }}" alt="Gambar Inspeksi"
                                        style="width: 250px; height: auto; display: block; margin: auto;">
                                </td>
                            @endforeach
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
