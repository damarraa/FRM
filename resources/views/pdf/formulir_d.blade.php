<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Inspeksi Material Retur Cable Power</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 900px; background: white; padding: 30px; margin: 40px auto; border-radius: 5px;">
        <div style="font-weight: normal; padding-bottom: 20px; font-size: 12px;">
            <div style="float: left"><span style="font-weight: bold">PT PLN (PERSERO)</span> <br> <span
                    style="font-weight: bold">UID/UIW {{ $cable_powers->uid->wilayah }}</span> <br> UNIT
                {{ $cable_powers->up3s->unit }}</div>
            <div style="float: right">Formulir 01-D</div>
        </div>

        <div style="clear: both"></div>

        <div style="text-align: center; padding-bottom: 10px;">
            <h2
                style="font-size: 16px; text-transform: uppercase; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">
                FORMULIR INSPEKSI MATERIAL RETUR CABLE POWER</h2>
            <p style="font-size: 14px; font-weight: bold; margin-top: 0;">NO: {{ $cable_powers->no_surat }}</p>
        </div>

        <div style="font-size: 12px; text-align: justify; margin-top: -10px;">
            Pada hari ini <span style="font-weight: bold">{{ $hari }}</span> tanggal <span
                style="font-weight: bold">{{ $tanggal }}</span> bulan <span
                style="font-weight: bold">{{ $bulan }}</span> tahun <span style="font-weight: bold">Dua Ribu
                {{ $tahunTeks }}</span>
            telah diadakan inspeksi material retur Cable Power dengan data sebagai berikut:
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p style="text-align: left; font-size: 14px; font-weight: bold; margin-top: 10px; margin-bottom: -10px;">A.
                DATA MATERIAL</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="list-style: none; padding: 10px 10px; margin: 0; font-size: 12px; margin-left: 10px">
                            <li style="padding: 1px 0;">Lokasi Akhir Terpasang:
                                {{ $cable_powers->lokasi_akhir_terpasang }}</li>
                            <li style="padding: 1px 0;">Unit Layanan Pelanggan: {{ $cable_powers->ulp->daerah }}
                            </li>
                            <li style="padding: 1px 0;">Tahun Pemasangan:
                                {{ $cable_powers->tahun_pemasangan }}</li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul
                            style="list-style: none; padding: 10px 10px; margin: 0; font-size: 11px; margin-left: -15px">
                            <li style="padding: 1px 0;">Jenis Cable Power:
                                @if ($cable_powers->jenis_cable_power === 'LVTIC')
                                    LVTIC/<del>NYY</del>/<del>XLPE</del>/<del>MVTIC</del>/
                                    {{ $cable_powers->ukuran_cable_power }} mm2 *)
                                @elseif ($cable_powers->jenis_cable_power === 'NYY')
                                    <del>LVTIC</del>/NYY/<del>XLPE</del>/<del>MVTIC</del>/
                                    {{ $cable_powers->ukuran_cable_power }} mm2 *)
                                @elseif ($cable_powers->jenis_cable_power === 'XLPE')
                                    <del>LVTIC</del>/<del>NYY</del>/XLPE/<del>MVTIC</del>/
                                    {{ $cable_powers->ukuran_cable_power }} mm2 *)
                                @elseif ($cable_powers->jenis_cable_power === 'MVTIC')
                                    <del>LVTIC</del>/<del>NYY</del>/<del>XLPE</del>/MVTIC/
                                    {{ $cable_powers->ukuran_cable_power }} mm2 *)
                                @else
                                    <del>LVTIC</del>/<del>NYY</del>/<del>XLPE</del>/<del>MVTIC</del>/
                                    {{ $cable_powers->jenis_cable_power }}/{{ $cable_powers->ukuran_cable_power }} mm2
                                    *)
                                @endif
                            </li>
                            <li style="padding: 1px 0;">Luas Penampang: {{ $cable_powers->luas_penampang }}</li>
                            <li style="padding: 1px 0;">Panjang: {{ $cable_powers->panjang_cable_power }}</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                B. PENGUJIAN NON ELEKTRIK</p>
            <div style="width: 100%; padding: 10px 20px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px;"
                            rowspan="2">NO</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">METODA UJI/PERSYARATAN</th>
                        <th style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px;"
                            colspan="2">HASIL</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">NILAI ACUAN/PERSYARATAN</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">KESESUAIAN</th>
                        <th style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px;"
                            rowspan="2">KETERANGAN</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px;">
                            NILAI</th>
                        <th style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px;">
                            SATUAN</th>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">1</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 12px; height: 0px;">
                            Pemeriksaan kondisi visual dan penandaan</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $cable_powers->nilai_pemeriksaan_kondisi_visual }}</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            -</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            Baik (Tidak Rantas, Tidak Mekar & Isolasi Tidak Rusak)</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($cable_powers->nilai_pemeriksaan_kondisi_visual == 'Baik')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $cable_powers->keterangan_pemeriksaan }}</td>
                    </tr>
                    <tr style="">
                        <td style="border: 1px solid black; text-align: center; font-size: 12px; height: 0px;">2</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: left; padding-left: 10px; font-size: 12px; height: 0px;">
                            Pengujian dimensi (diameter konduktor)</td>
                        <td
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $cable_powers->nilai_pengujian_dimensi }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            mm
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            +/- 1%</td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            @if ($cable_powers->kesesuaian_pengujian_dimensi == 'yes')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $cable_powers->keterangan_pengujian_dimensi }}</td>
                    </tr>
                </table>
            </div>

            <p style="margin-left: 20px; margin-top: -10px; font-size: 12px;">Keterangan: Kesesuaian Poin B nomor 1
                adalah mandatory.
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
                            METODA UJI/PERSYARATAN</th>
                        <th colspan="2"
                            style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px; height: 0px;">
                            HASIL</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            NILAI ACUAN/PERSYARATAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            KESESUAIAN</th>
                        <th rowspan="2"
                            style="border: 1px solid black; padding: 1px; text-align: center; font-size: 12px; height: 0px;">
                            KETERANGAN</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px;">
                            NILAI</th>
                        <th style="border: 1px solid black; padding: 2px; text-align: center; font-size: 12px;">
                            SATUAN</th>
                    </tr>
                    <tr style="height: 0px">
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            1</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: left; padding-left: 20px; font-size: 12px; height: 0px;">
                            Uji Tahanan Isolasi</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $cable_powers->nilai_uji_tahanan_isolasi ?? '.....' }}
                        </td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px; font-family: 'DejaVu Sans', sans-serif;">
                            MΩ</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            Tidak Tembus atau bernilai > 0 ohm</td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; font-family: 'DejaVu Sans', sans-serif; height: 0px;">
                            @if ($cable_powers->kesesuaian_uji_tahanan_isolasi == 'yes')
                                <span style="width: 100px; height: auto; align-items: center">&#x2611;</span>
                            @else
                                <span style="width: 100px; height: auto; align-items: center">&#9746;</span>
                            @endif
                        </td>
                        <td
                            style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px; height: 0px;">
                            {{ $cable_powers->keterangan_uji_tahanan_isolasi }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="">
            <p
                style="text-align: left; font-size: 14px; font-weight: bold; margin: 0px; margin-top: -5px; margin-bottom: -10px;">
                D. KESIMPULAN</p>
            <p style="font-size: 12px; margin: 0px; margin-left: 20px; margin-top: 10px;"> bekas layak pakai (K6) <span
                    style="text-align: center; margin: 0px;">{{ $cable_powers->kesimpulan_k6 }}</span> meter</p>
            <p style="font-size: 12px; margin: 0px; margin-left: 20px; margin-top: 0px;"> bekas tidak layak pakai (K8)
                <span style="text-align: center; margin: 0px;">{{ $cable_powers->kesimpulan_k8 }}</span> meter
            </p>

            {{-- @if ($cable_powers->approved_by && $cable_powers->updated_at != $cable_powers->created_at)
                <p style="font-size: 10px; margin-left: 20px; margin-top: 5px;">
                    *edited by: {{ $cable_powers->approvedBy->name }} pada
                    {{ $cable_powers->updated_at->format('d/m/Y') }}
                </p>
            @endif --}}

            @if ($cable_powers->is_edited)
                <p style="font-size: 10px; margin-left: 20px; margin-top: 5px;">
                    *edited by: {{ $cable_powers->approvedBy->name }} pada
                    {{ $cable_powers->updated_at->format('d/m/Y') }}
                </p>
            @endif

            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">Yang Menyerahkan
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($cable_powers->created_at)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">DISETUJUI OLEH
                        <br>
                        PIC Gudang
                        <p style="margin: 0px; font-weight: normal;">Ditandatangani tanggal
                            {{ \Carbon\Carbon::parse($cable_powers->updated_at)->format('d/m/Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $cable_powers->user->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto;" />
                        <p style="margin: 0px;">
                            {{ $cable_powers->user->name ?? '............................................' }} </p>
                    </td>
                    <td style="text-align: center; border: none; font-size: 14px; font-weight: bold;">
                        <img src="{{ $cable_powers->approvedBy->signature }}" width="50px" height="50px"
                            style="display: block; margin: 5px auto 10px auto" />
                        <p style="margin: 0px">
                            {{ $cable_powers->approvedBy->name ?? '............................................' }}</p>
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
            @if ($cable_powers->gambar)
                @php
                    $gambarArray = json_decode($cable_powers->gambar, true);
                    $chunkedImages = array_chunk($gambarArray, 2); // Membagi array menjadi kelompok 2 gambar per baris
                @endphp

                <table style="width: 100%; border-collapse: collapse;">
                    @foreach ($chunkedImages as $row)
                        <tr>
                            @foreach ($row as $gambar)
                                @php
                                    $path = public_path('gambar_cable_power/' . basename($gambar));
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
