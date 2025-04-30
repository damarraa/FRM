<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur Tiang Listrik</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 40px auto; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW {{ $tiang_listrik->uid->wilayah }}</span> <br> UNIT
                {{ $tiang_listrik->up3s->unit }}</div>
            <div style="float: right">Formulir 01-O</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR TIANG LISTRIK</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: {{ $tiang_listrik->no_surat }}</p>
        </div>

        <div style="font-size: 11px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur Tiang Listrik dengan data sebagai berikut:
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
                                {{ $tiang_listrik->lokasi_akhir_terpasang }}</li>
                            <li style="padding: 0px 0;">Unit Layanan Pelanggan: {{ $tiang_listrik->ulp->daerah }}</li>
                            <li style="padding: 0px 0;">Tahun Produksi: {{ $tiang_listrik->tahun_produksi }}</li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: 10px">
                            <li style="padding: 0px 0;">Tipe Tiang Listrik:
                                @if ($tiang_listrik->tipe_tiang_listrik == 'Baja')
                                    Baja / <del>Beton</del> / {{ $tiang_listrik->jenis_tiang }}
                                @elseif ($tiang_listrik->tipe_tiang_listrik == 'Beton')
                                    <del>Baja</del> / Beton / {{ $tiang_listrik->jenis_tiang }}
                                @endif
                            </li>
                            <li style="padding: 0px 0;">No Serial: {{ $tiang_listrik->no_serial }}</li>
                            <li style="padding: 0px 0;">Nama Pabrikan: {{ $tiang_listrik->pabrikan->nama_pabrikan }}
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
                            BAIK</th>
                        <th
                            style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;">
                            RUSAK</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Pengujian Visual / Sifat Tampak</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $tiang_listrik->pengujian_visual == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $tiang_listrik->pengujian_visual == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($tiang_listrik->pengujian_visual == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Jika tiang baja terdapat <br>
                            karatan ringan tanpa keropos, <br>
                            maka dapat diperbaiki (cat <br>
                            ulang)</td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -10px; margin-bottom: -10px;">
                B. PENGUJIAN DIMENSI</p>
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
                            METER</th>
                        <th
                            style="border: 1px solid black; padding: 1px; margin: 0px; text-align: center; font-size: 11px;">
                            daN</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Panjang</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{ $tiang_listrik->pengujian_panjang }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {{ explode('/', $tiang_listrik->jenis_tiang)[1] ?? '' }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Sesuai Standar</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($tiang_listrik->pengujian_panjang == 'yes')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Beban kerja (daN) diisi jika <br>
                            masih ada di penandaan tiang <br>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -10px; margin-bottom: -10px;">
                D. PENGUJIAN KONSTRUKSI</p>
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
                            RUSAK</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Kelurusan Tiang</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $tiang_listrik->kelurusan_tiang == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $tiang_listrik->kelurusan_tiang == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($tiang_listrik->kelurusan_tiang == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            {{ $tiang_listrik->keterangan_kelurusan_tiang }}
                        </td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 11px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 11px; height: 0px;">
                            Kualitas Penyambungan</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $tiang_listrik->kualitas_penyambungan == 'Baik' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            {!! $tiang_listrik->kualitas_penyambungan == 'Rusak' ? '✔' : '' !!}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Baik</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($tiang_listrik->kualitas_penyambungan == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 11px; height: 0px;">
                            Untuk tiang listrik baja
                        </td>
                    </tr>
                </table>
            </div>
            <p style="margin-left: 20px; margin-top: -10px; font-size: 10px;">Keterangan: Seluruh mata uji poin D
                adalah mandatory.</p>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                D. KESIMPULAN</p>
            @if ($tiang_listrik->kesimpulan == 'Bekas layak pakai (K6)')
                <p style="font-size: 11px; margin-left: 20px;"> *) bekas layak pakai (K6) / <del>masih garansi
                        (K7)</del> / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($tiang_listrik->kesimpulan == 'Masih garansi (K7)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / masih garansi
                    (K7) / <del>bekas
                        tidak layak pakai (K8)</del></p>
            @elseif ($tiang_listrik->kesimpulan == 'Bekas tidak layak pakai (K8)')
                <p style="font-size: 11px; margin-left: 20px;"> *) <del>bekas layak pakai (K6)</del> / <del>masih
                        garansi
                        (K7)</del> / bekas
                    tidak layak pakai (K8)</p>
            @endif

            @if ($tiang_listrik->approved_by && $tiang_listrik->updated_at != $tiang_listrik->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: -10px;">
                    *edited by: {{ $tiang_listrik->approvedBy->name }} pada
                    {{ $tiang_listrik->updated_at->format('d/m/Y') }}
                </p>
            @endif

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($tiang_listrik->created_at)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($tiang_listrik->updated_at)->format('d/m/Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $tiang_listrik->user->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $tiang_listrik->user->name ?? '............................................' }} </p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $tiang_listrik->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $tiang_listrik->approvedBy->name ?? '............................................' }}
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
            @if ($tiang_listrik->gambar)
                @php
                    $gambarArray = json_decode($tiang_listrik->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_tiang_listrik/' . basename($gambar));
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
