<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur PHBTR</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-phbtr.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Bagian Unit, Gudang, dan Tanggal -->
                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="11">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select name="up3_id" class="form-control" id="up3_id" required>
                                        <option value="">-- Pilih UP3 --</option>
                                        @foreach ($up3s as $up3)
                                            <option value="{{ $up3->id }}">{{ $up3->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gudang_id">Gudang Retur</label>
                                    <select name="gudang_id" class="form-control" id="gudang_id" required>
                                        <option value="">-- Pilih Gudang Retur --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_inspeksi">Tanggal Inspeksi</label>
                                    <input type="date" class="form-control" id="tgl_inspeksi" name="tgl_inspeksi"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian A: Data Material -->
                        <h6 class="mb-3 font-weight-bold">A. Data Material</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi_akhir_terpasang">Lokasi Akhir Terpasang</label>
                                    <input name="lokasi_akhir_terpasang" type="text" class="form-control"
                                        id="lokasi_akhir_terpasang" placeholder="Masukkan Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select name="ulp_id" class="form-control" id="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-4 form-group">
                                    <div class="w-50">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            id="tahun_produksi" name="tahun_produksi" required>
                                            <option value="">-- Pilih Tahun --</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai" placeholder="Masa Pakai" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_phbtr">Tipe PHBTR</label>
                                    <select name="tipe_phbtr" class="form-control select2" id="tipe_phbtr" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="PL-250-2-LBS">PL-250-2-LBS</option>
                                        <option value="PL-250-2-MCCB">PL-250-2-MCCB</option>
                                        <option value="PL-250-2-FS">PL-250-2-FS</option>
                                        <option value="PL-400-2-LBS">PL-400-2-LBS</option>
                                        <option value="PL-400-2-MCCB">PL-400-2-MCCB</option>
                                        <option value="PL-400-2-FS">PL-400-2-FS</option>
                                        <option value="PL-400-4-LBS">PL-400-4-LBS</option>
                                        <option value="PL-400-4-MCCB">PL-400-4-MCCB</option>
                                        <option value="PL-400-4-FS">PL-400-4-FS</option>
                                        <option value="PL-4-LBS">PL-630-4-LBS</option>
                                        <option value="PL-4-MCCB">PL-630-4-MCCB</option>
                                        <option value="PL-4-FS">PL-630-4-FS</option>
                                        <option value="PL-100-6-LBS">PL-100-6-LBS</option>
                                        <option value="PL-100-6-MCCB">PL-100-6-MCCB</option>
                                        <option value="PL-100-8-LBS">PL-100-8-LBS</option>
                                        <option value="PL-100-8-MCCB">PL-100-8-MCCB</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input name="no_serial" type="number" class="form-control" id="no_serial"
                                        placeholder="Masukkan No Serial">
                                </div>
                                <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <select name="pabrikan_id" class="form-control" id="pabrikan_id" required>
                                        <option value="">-- Pilih Pabrikan --</option>
                                        @foreach ($pabrikans as $pabrikan)
                                            <option value="{{ $pabrikan->id }}">{{ $pabrikan->nama_pabrikan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian B: Pemeriksaan Visual -->
                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Visual</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nameplate">1. Nameplate</label>
                                    <div class="input-group">
                                        <select name="nameplate" id="nameplate" class="form-control poin1" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNameplate')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNameplate" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganNameplate">Keterangan Nameplate:</label>
                                        <textarea class="form-control" id="keteranganNameplate" name="keteranganNameplate" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganNameplate', 'charCountKeteranganNameplate')"></textarea>
                                        <small id="charCountKeteranganNameplate" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="busbar_penyangga">2. Busbar dan penyangga busbar</label>
                                    <div class="input-group">
                                        <select id="busbar_penyangga" name="busbar_penyangga"
                                            class="form-control poin2" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganBusbar')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganBusbar" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganBusbar">Keterangan Busbar dan Penyangga:</label>
                                        <textarea class="form-control" id="keteranganBusbar" name="keteranganBusbar" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganBusbar', 'charCountKeteranganBusbar')"></textarea>
                                        <small id="charCountKeteranganBusbar" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="saklar_utama">3. Saklar utama</label>
                                    <div class="input-group">
                                        <select id="saklar_utama" name="saklar_utama" class="form-control poin3"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganSaklarUtama')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganSaklarUtama" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganSaklarUtama">Keterangan Saklar Utama:</label>
                                        <textarea class="form-control" id="keteranganSaklarUtama" name="keteranganSaklarUtama" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganSaklarUtama', 'charCountKeteranganSaklarUtama')"></textarea>
                                        <small id="charCountKeteranganSaklarUtama" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nh_fuse">4. NH Fuse</label>
                                    <div class="input-group">
                                        <select id="nh_fuse" name="nh_fuse" class="form-control poin4" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNHFuse')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNHFuse" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganNHFuse">Keterangan NH Fuse:</label>
                                        <textarea class="form-control" id="keteranganNHFuse" name="keteranganNHFuse" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganNHFuse', 'charCountKeteranganNHFuse')"></textarea>
                                        <small id="charCountKeteranganNHFuse" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fuse_rail">5. Fuse Rail</label>
                                    <div class="input-group">
                                        <select id="fuse_rail" name="fuse_rail" class="form-control poin5" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganFuseRail')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganFuseRail" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganFuseRail">Keterangan Fuse Rail:</label>
                                        <textarea class="form-control" id="keteranganFuseRail" name="keteranganFuseRail" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganFuseRail', 'charCountKeteranganFuseRail')"></textarea>
                                        <small id="charCountKeteranganFuseRail" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="selungkup_phbtr">6. Kondisi selungkup untuk PHBTR pasangan luar
                                        (ada retak/longgar dari selungkup) </label>
                                    <div class="input-group">
                                        <select id="selungkup_phbtr" name="selungkup_phbtr"
                                            class="form-control poin5" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganSelungkup')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganSelungkup" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganSelungkup">Keterangan Kondisi Selungkup:</label>
                                        <textarea class="form-control" id="keteranganSelungkup" name="keteranganSelungkup" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganSelungkup', 'charCountKeteranganSelungkup')"></textarea>
                                        <small id="charCountKeteranganSelungkup" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">
                                Keterangan:
                                <br>a. Poin 1 dan 4 bila terdapat cacat dapat diperbaiki atau dilengkapi.
                                <br>b. Jika poin B (2,3,5,6) ada yang tidak sesuai maka pengujian poin C tidak perlu
                                dilakukan.
                            </p>
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian C: Pengujian Elektrik -->
                        <h6 class="mb-3 font-weight-bold">C. Pengujian Elektrik</h6>
                        <h6 class="mb-3">1. Pengujian Tahanan Isolasi (Persyaratan >1 MΩ)</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l1_phbtr">a) L1-(L2+L3+N+body)</label>
                                    <div class="input-group">
                                        <input id="l1_phbtr" name="l1_phbtr" type="number" class="form-control"
                                            min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL1PHBTR')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL1PHBTR" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL1PHBTR">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganL1PHBTR" name="keteranganL1PHBTR" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL1PHBTR', 'charCountKeteranganL1PHBTR')"></textarea>
                                        <small id="charCountKeteranganL1PHBTR" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="l2_phbtr">b) L2-(L1+L3+N+body)</label>
                                    <div class="input-group">
                                        <input id="l2_phbtr" name="l2_phbtr" type="number" class="form-control"
                                            min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL2PHBTR')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL2PHBTR" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL2PHBTR">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganL2PHBTR" name="keteranganL2PHBTR" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL2PHBTR', 'charCountKeteranganL2PHBTR')"></textarea>
                                        <small id="charCountKeteranganL2PHBTR" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l3_phbtr">c) L3-(L1+L2+N+body)</label>
                                    <div class="input-group">
                                        <input id="l3_phbtr" name="l3_phbtr" type="number" class="form-control"
                                            min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL3PHBTR')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL3PHBTR" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL3PHBTR">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganL3PHBTR" name="keteranganL3PHBTR" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL3PHBTR', 'charCountKeteranganL3PHBTR')"></textarea>
                                        <small id="charCountKeteranganL3PHBTR" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nphbtr">d) N-(L1+L2+L3+body)</label>
                                    <div class="input-group">
                                        <input name="nphbtr" type="number" class="form-control" id="nphbtr"
                                            min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNPHBTR')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNPHBTR" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganNPHBTR">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganNPHBTR" name="keteranganNPHBTR" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganNPHBTR', 'charCountKeteranganNPHBTR')"></textarea>
                                        <small id="charCountKeteranganNPHBTR" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin C adalah
                                mandatory.</p>
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian D: Pengujian Mekanik -->
                        <h6 class="mb-3 font-weight-bold">D. Pengujian Mekanik</h6>
                        <label>1. Pengujian Mekanik:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_mekanik1">a) Buka Tutup Saklar Utama 5x</label>
                                    <div class="input-group">
                                        <select id="pengujian_mekanik1" name="pengujian_mekanik1"
                                            class="form-control" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Tidak baik">Tidak baik</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganMekanik1')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganMekanik1" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganMekanik1">Keterangan Pengujian 1:</label>
                                        <textarea class="form-control" id="keteranganMekanik1" name="keteranganMekanik1" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganMekanik1', 'charCountKeteranganMekanik1')"></textarea>
                                        <small id="charCountKeteranganMekanik1" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_mekanik2">b) Buka Tutup Pintu PHBTR Untuk Pasangan
                                        Luar 5x</label>
                                    <div class="input-group">
                                        <select id="pengujian_mekanik2" name="pengujian_mekanik2"
                                            class="form-control" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Tidak baik">Tidak baik</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganMekanik2')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganMekanik2" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganMekanik2">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganMekanik2" name="keteranganMekanik2" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganMekanik2', 'charCountKeteranganMekanik2')"></textarea>
                                        <small id="charCountKeteranganMekanik2" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin D adalah mandatory.
                        </p>
                        <hr class="mb-3">

                        <!-- Bagian E: Kesimpulan -->
                        <h6 class="mb-3"><strong>E. Kesimpulan</strong></h6>
                        <div class="row">
                            @if (auth()->user()->hasRole('Petugas'))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kesimpulan">Kesimpulan</label>
                                        <select class="form-control" id="kesimpulan" name="kesimpulan" required
                                            readonly>
                                            <option value="">-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)">Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)">Bekas bisa diperbaiki (K7)
                                            </option>
                                            <option value="Bekas tidak layak pakai (K8)">Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kesimpulan">Kesimpulan</label>
                                        <select class="form-control" id="kesimpulan" name="kesimpulan" required
                                            @if (auth()->user()->hasRole('Petugas')) disabled style="pointer-events: none; background-color: #e9ecef;" @endif>
                                            <option value="">-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)">Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)">Bekas bisa diperbaiki (K7)
                                            </option>
                                            <option value="Bekas tidak layak pakai (K8)">Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian F: Gambar Evidence -->
                        <h6 class="mb-3 font-weight-bold">F. Gambar Evidence</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar1" style="display: block">Gambar 1</label>
                                    <div id="preview1" class="mt-2"></div>
                                    <input type="file" name="gambar[0]" id="gambar1" accept="image/*"
                                        onchange="previewImage(this, 'preview1')">
                                </div>

                                <div class="form-group">
                                    <label for="gambar2" style="display: block">Gambar 2</label>
                                    <div id="preview2" class="mt-2"></div>
                                    <input type="file" name="gambar[1]" id="gambar2" accept="image/*"
                                        onchange="previewImage(this, 'preview2')">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar3" style="display: block">Gambar 3</label>
                                    <div id="preview3" class="mt-2"></div>
                                    <input type="file" name="gambar[2]" id="gambar3" accept="image/*"
                                        onchange="previewImage(this, 'preview3')">
                                </div>

                                <div class="form-group">
                                    <label for="gambar4" style="display: block">Gambar 4</label>
                                    <div id="preview4" class="mt-2"></div>
                                    <input type="file" name="gambar[3]" id="gambar4" accept="image/*"
                                        onchange="previewImage(this, 'preview4')">
                                </div>
                            </div>
                        </div>

                        <!-- Modal Bootstrap untuk menampilkan gambar lebih besar -->
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img src="" id="modalImage" class="img-fluid" alt="Gambar Preview">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('forms') }}" class="btn btn-secondary">Kembali</a>
                        <button type="button" id="clearFormButton" class="btn btn-danger">Reset</button>
                        @if (auth()->user()->hasRole('Petugas'))
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>

<!-- CSS untuk membatasi tinggi textarea -->
<style>
    textarea.form-control {
        resize: none;
        /* Nonaktifkan resize */
        overflow: hidden;
        /* Sembunyikan scrollbar */
        height: auto;
        /* Sesuaikan tinggi secara otomatis */
        min-height: 60px;
        /* Tinggi minimal untuk 2 baris */
    }

    select[readonly] {
        pointer-events: none;
        touch-action: none;
        background-color: #e9ecef;
        opacity: 1;
    }
</style>

<script>
    function previewImage(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = ""; // Kosongkan preview sebelumnya

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement("img");
                imgElement.src = e.target.result;
                imgElement.classList.add("h-40", "w-40", "object-cover", "rounded-lg", "border", "border-gray-300");
                imgElement.style.cursor = "pointer";

                // Tambahkan event onclick untuk membuka modal
                imgElement.onclick = () => openImageModal(e.target.result);

                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function openImageModal(imageSrc) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
</script>

<script>
    // Fungsi untuk toggle keterangan
    function toggleKeterangan(id) {
        var element = document.getElementById(id);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }

    // Fungsi untuk menghitung sisa karakter
    function updateCharCount(textareaId, charCountId) {
        const textarea = document.getElementById(textareaId);
        const charCount = document.getElementById(charCountId);
        const maxLength = textarea.getAttribute('maxlength');
        const remainingChars = maxLength - textarea.value.length;

        // Update teks sisa karakter
        charCount.textContent = `${remainingChars} karakter tersisa.`;

        // Jika karakter habis, ubah warna teks menjadi merah
        if (remainingChars <= 0) {
            charCount.style.color = 'red';
        } else {
            charCount.style.color = 'gray';
        }
    }
</script>

<!-- Tambahkan di bagian head atau sebelum penutup body -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "3000"
    };

    // Fungsi utama setelah DOM loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Inisialisasi form
        const formInspeksi = document.getElementById("formInspeksi");

        // [Bagian yang dimodifikasi] - Event submit form
        formInspeksi.addEventListener('submit', function(e) {
            // e.preventDefault(); // 1. Hentikan submit default

            // Simpan data ke localStorage
            localStorage.removeItem("formInspeksiData");

            // Tampilkan toast
            toastr.success('Data berhasil disimpan!');

            // Submit form setelah toast muncul
            setTimeout(() => {
                formInspeksi.submit();
            }, 1000);
        });
    });

    // Fungsi untuk mengecek apakah form memiliki perubahan
    function hasFormChanges() {
        const savedData = localStorage.getItem("formInspeksiData");
        return savedData !== null;
    }

    // Fungsi untuk mereset form secara menyeluruh
    function resetFormCompletely() {
        const formInspeksi = document.getElementById("formInspeksi");
        if (formInspeksi) {
            // Simpan nilai tgl_inspeksi sebelum form di-reset
            const tglInspeksi = document.getElementById("tgl_inspeksi");
            const tglInspeksiValue = tglInspeksi ? tglInspeksi.value : '';

            // Reset form ke keadaan default
            formInspeksi.reset();

            // Kembalikan nilai tgl_inspeksi setelah form di-reset
            if (tglInspeksi) {
                tglInspeksi.value = tglInspeksiValue;
            }

            // Reset semua textarea
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.value = '';
            });

            // Reset preview gambar
            const previews = ['preview1', 'preview2', 'preview3', 'preview4'];
            previews.forEach(previewId => {
                const preview = document.getElementById(previewId);
                if (preview) preview.innerHTML = '';
            });

            // Reset file inputs
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.value = '';
            });

            // Hapus data dari localStorage
            localStorage.removeItem("formInspeksiData");

            // Jalankan fungsi lain yang diperlukan (opsional)
            if (typeof updateKesimpulan === 'function') {
                updateKesimpulan();
            }

            // Tampilkan toast sukses
            toastr.success('Form telah berhasil dikosongkan.');
        }
    }

    // SweetAlert untuk Clear Form
    document.getElementById('clearFormButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Semua data yang telah diisi akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                resetFormCompletely();
            }
        });
    });

    // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
    document.getElementById('backButton').addEventListener('click', function(e) {
        if (hasFormChanges()) {
            e.preventDefault();
            Swal.fire({
                title: 'Ada perubahan yang belum disimpan',
                text: "Anda yakin ingin meninggalkan halaman ini? Perubahan yang belum disimpan akan hilang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tinggalkan halaman',
                cancelButtonText: 'Tetap di halaman'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.getAttribute('href');
                }
            });
        }
    });

    // Tangkap pesan sukses dari Laravel (jika ada)
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif

    // Tangkap pesan error dari Laravel (jika ada)
    @if (Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ Session::get('error') }}"
        });
    @endif
</script>

<script>
    // TEST SEDERHANA - HARUS DILAKUKAN PERTAMA
    document.addEventListener("DOMContentLoaded", function() {
        // Tes 1: Coba ubah nilai kesimpulan secara manual
        const testSelect = document.getElementById('kesimpulan');
        testSelect.value = "Bekas layak pakai (K6)";
        console.log("Tes manual:", testSelect.value);

        // Tes 2: Cek apakah elemen input terdeteksi
        console.log("Elemen kesimpulan ditemukan?", !!testSelect);
    });

    // Debugging - tampilkan semua library yang terload
    console.log('JQuery version:', $.fn.jquery);
    console.log('Select2 version:', $.fn.select2 ? $.fn.select2.version : 'Not loaded');
    console.log('Element checks:', {
        nameplate: $('#nameplate').length,
        saklar_utama: $('#saklar_utama').length,
        kesimpulan: $('#kesimpulan').length
    });
</script>

<script>
    // Script yang diperbaiki untuk auto-generate kesimpulan form PHBTR
    document.addEventListener("DOMContentLoaded", function() {
        // Tunggu sebentar untuk memastikan semua elemen dan library telah dimuat sempurna
        setTimeout(function() {
            // Inisialisasi
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById('tahun_produksi');
            const inputMasaPakai = document.getElementById('masa_pakai');
            const kesimpulanSelect = document.getElementById('kesimpulan');

            console.log("Inisialisasi script kesimpulan PHBTR");

            // 1. Fungsi Hitung Masa Pakai
            function hitungMasaPakai() {
                const tahunProduksi = parseInt(selectTahun.value);
                if (!isNaN(tahunProduksi)) {
                    const masaPakai = tahunSekarang - tahunProduksi;
                    inputMasaPakai.value = masaPakai + " tahun";
                    return masaPakai;
                }
                inputMasaPakai.value = "";
                return 0;
            }

            // Isi dropdown tahun produksi secara dinamis
            if (selectTahun) {
                // Kosongkan opsi yang sudah ada kecuali default
                while (selectTahun.options.length > 1) {
                    selectTahun.remove(1);
                }

                // Tambahkan opsi tahun
                for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
                    const option = new Option(tahun, tahun);
                    selectTahun.add(option);
                }

                // Event listener untuk tahun produksi
                selectTahun.addEventListener('change', function() {
                    hitungMasaPakai();
                    setTimeout(updateKesimpulan, 100); // Delay kecil untuk Select2
                });
            } else {
                console.error("Elemen tahun_produksi tidak ditemukan!");
            }

            // 2. Fungsi Utama Update Kesimpulan
            function updateKesimpulan() {
                const masaPakai = hitungMasaPakai();

                // Fungsi untuk mendapatkan nilai input yang lebih reliable
                const getValue = (id) => {
                    const el = document.getElementById(id);
                    if (el) {
                        // Jika select2, kita ambil nilai dari select2
                        if ($(el).hasClass('select2-hidden-accessible')) {
                            return $(el).val();
                        }
                        return el.value;
                    }
                    return null;
                };

                // Dapatkan nilai-nilai pemeriksaan visual
                const nameplate = getValue('nameplate');
                const busbar = getValue('busbar_penyangga');
                const saklarUtama = getValue('saklar_utama');
                const nhFuse = getValue('nh_fuse');
                const fuseRail = getValue('fuse_rail');
                const selungkup = getValue('selungkup_phbtr');

                // Dapatkan nilai pengujian mekanik
                const mekanik1 = getValue('pengujian_mekanik1');
                const mekanik2 = getValue('pengujian_mekanik2');

                // Log nilai yang didapat
                console.log("Nilai form untuk kesimpulan:", {
                    masaPakai,
                    nameplate,
                    busbar,
                    saklarUtama,
                    nhFuse,
                    fuseRail,
                    selungkup,
                    mekanik1,
                    mekanik2
                });

                // Logika kesimpulan
                let kesimpulan = "Bekas tidak layak pakai (K8)"; // Default

                // Kriteria untuk Bekas layak pakai (K6)
                const kondisiK6 = (
                    nameplate === "Ada" &&
                    busbar === "Ada" &&
                    saklarUtama === "Ada" &&
                    nhFuse === "Ada" &&
                    fuseRail === "Ada" &&
                    selungkup === "Tidak ada" &&
                    masaPakai <= 25 &&
                    mekanik1 === "Baik" &&
                    mekanik2 === "Baik"
                );

                // Kriteria untuk Bekas bisa diperbaiki (K7)
                // Material utama (busbar dan saklar) masih baik, tapi ada komponen lain yang perlu diperbaiki
                const kondisiK7 = (
                    busbar === "Ada" &&
                    saklarUtama === "Ada"
                );

                if (kondisiK6) {
                    kesimpulan = "Bekas layak pakai (K6)";
                } else if (kondisiK7) {
                    kesimpulan = "Bekas bisa diperbaiki (K7)";
                }

                // Terapkan kesimpulan ke elemen select
                if (kesimpulanSelect) {
                    // Untuk select2, kita perlu metode khusus
                    if ($(kesimpulanSelect).hasClass('select2-hidden-accessible')) {
                        $(kesimpulanSelect).val(kesimpulan).trigger('change');
                    } else {
                        kesimpulanSelect.value = kesimpulan;
                    }
                    console.log("Kesimpulan diperbarui:", kesimpulan);
                } else {
                    console.error("Elemen kesimpulan tidak ditemukan!");
                }
            }

            // 3. Pasang event listeners ke semua input yang relevan
            const inputIds = [
                'nameplate', 'busbar_penyangga', 'saklar_utama',
                'nh_fuse', 'fuse_rail', 'selungkup_phbtr',
                'pengujian_mekanik1', 'pengujian_mekanik2'
            ];

            // Pasang event listener pada setiap elemen input
            inputIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    // Untuk Select2, kita perlu event handler khusus
                    if ($(el).hasClass('select2-hidden-accessible')) {
                        $(el).on('select2:select', function() {
                            setTimeout(updateKesimpulan, 100);
                        });
                    }

                    // Tambahkan event listener standar
                    el.addEventListener('change', function() {
                        setTimeout(updateKesimpulan, 100);
                    });
                } else {
                    console.warn(`Elemen ${id} tidak ditemukan`);
                }
            });

            // 4. Inisialisasi awal
            hitungMasaPakai();
            setTimeout(updateKesimpulan, 500); // Memberikan waktu untuk memastikan semua nilai terisi

            // 5. Reset form handler
            const resetBtn = document.getElementById('clearFormButton');
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    // Reset semua input
                    const form = document.getElementById('formInspeksi');
                    if (form) {
                        form.reset();

                        // Reset Select2 jika ada
                        inputIds.forEach(id => {
                            const el = document.getElementById(id);
                            if (el && $(el).hasClass('select2-hidden-accessible')) {
                                $(el).val('').trigger('change');
                            }
                        });

                        // Reset kesimpulan
                        setTimeout(updateKesimpulan, 500);
                    }
                });
            }

            console.log("Script kesimpulan PHBTR berhasil dimuat");
        }, 500); // Delay untuk memastikan semua elemen DOM tersedia
    });
</script>

<x-layouts.footer />
