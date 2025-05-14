<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur PHBTM / Cubicle</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-cubicle.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Bagian Unit, Gudang, dan Tanggal -->
                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="10">
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
                                <div class="flex gap-4">
                                    <div class="w-1/2">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            name="tahun_produksi" id="tahun_produksi" required>
                                            <option value="">-- Pilih Tahun --</option>
                                        </select>
                                    </div>
                                    <div class="w-1/2">
                                        <label class="block mb-1" for="masa_pakai">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun Sekarang - Tahun Produksi" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_cubicle">Tipe PHBTM / Cubicle</label>
                                    <select name="tipe_cubicle" class="form-control" id="tipe_cubicle" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="LBS-Motorized">LBS-Motorized</option>
                                        <option value="TP">TP</option>
                                        <option value="VT">VT</option>
                                        <option value="LBS-Manual">LBS-Manual</option>
                                        <option value="CB">CB</option>
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
                                        <select id="nameplate" name="nameplate" class="form-control poinB1" required>
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
                                    <label for="kelengkapan_peralatan">2. Kelengkapan Peralatan/Komponen</label>
                                    <div class="input-group">
                                        <select id="kelengkapan_peralatan" name="kelengkapan_peralatan"
                                            class="form-control poinB2" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKelengkapan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKelengkapan" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganKelengkapan">Keterangan Kelengkapan:</label>
                                        <textarea class="form-control" id="keteranganKelengkapan" name="keteranganKelengkapan" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKelengkapan', 'charCountKeteranganKelengkapan')"></textarea>
                                        <small id="charCountKeteranganKelengkapan" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="busbar_penyangga">3. Busbar dan Penyangga Busbar</label>
                                    <div class="input-group">
                                        <select id="busbar_penyangga" name="busbar_penyangga"
                                            class="form-control poinB3" required>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kondisi_pembumian">4. Kondisi Pembumian dan Kelengkapan</label>
                                    <div class="input-group">
                                        <select id="kondisi_pembumian" name="kondisi_pembumian"
                                            class="form-control poinB4" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPembumian')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPembumian" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganPembumian">Keterangan Pembumian:</label>
                                        <textarea class="form-control" id="keteranganPembumian" name="keteranganPembumian" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganPembumian', 'charCountKeteranganPembumian')"></textarea>
                                        <small id="charCountKeteranganPembumian" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_selungkup">5. Kondisi Selungkup untuk PHBTM (Ada Retak/Longgar
                                        Dari Selungkup)</label>
                                    <div class="input-group">
                                        <select id="kondisi_selungkup" name="kondisi_selungkup"
                                            class="form-control poinB5" required>
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
                                        <label for="keteranganSelungkup">Keterangan Selungkup:</label>
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
                                <br>a. Poin 1 dan 2 bila terdapat cacat dapat diperbaiki atau dilengkapi.
                                <br>b. Jika poin B (3,4,5) ada yang tidak sesuai maka pengujian poin C tidak perlu
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
                                    <label for="l1_cubicle">a) L1-(L2+L3+N+body)</label>
                                    <div class="input-group">
                                        <input name="l1_cubicle" type="number" class="form-control poinC1"
                                            id="l1_cubicle" min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL1Cubicle')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL1Cubicle" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL1Cubicle">Keterangan L1:</label>
                                        <textarea class="form-control" id="keteranganL1Cubicle" name="keteranganL1Cubicle" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganL1Cubicle', 'charCountKeteranganL1Cubicle')"></textarea>
                                        <small id="charCountKeteranganL1Cubicle" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="l2_cubicle">b) L2-(L1+L3+N+body)</label>
                                    <div class="input-group">
                                        <input name="l2_cubicle" type="number" class="form-control poinC2"
                                            id="l2_cubicle" min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL2Cubicle')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL2Cubicle" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL2Cubicle">Keterangan L2:</label>
                                        <textarea class="form-control" id="keteranganL2Cubicle" name="keteranganL2Cubicle" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganL2Cubicle', 'charCountKeteranganL2Cubicle')"></textarea>
                                        <small id="charCountKeteranganL2Cubicle" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l3_cubicle">c) L3-(L1+L2+N+body)</label>
                                    <div class="input-group">
                                        <input name="l3_cubicle" type="number" class="form-control poinC3"
                                            id="l3_cubicle" min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL3Cubicle')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL3Cubicle" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL3Cubicle">Keterangan L3:</label>
                                        <textarea class="form-control" id="keteranganL3Cubicle" name="keteranganL3Cubicle" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganL3Cubicle', 'charCountKeteranganL3Cubicle')"></textarea>
                                        <small id="charCountKeteranganL3Cubicle" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="n_cubicle">d) N-(L1+L2+L3+body)</label>
                                    <div class="input-group">
                                        <input name="n_cubicle" type="number" class="form-control poinC4"
                                            id="n_cubicle" min="1">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNCubicle')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNCubicle" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganNCubicle">Keterangan N:</label>
                                        <textarea class="form-control" id="keteranganNCubicle" name="keteranganNCubicle" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganNCubicle', 'charCountKeteranganCubicle')"></textarea>
                                        <small id="charCountKeteranganNCubicle" class="text-muted">55 karakter
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_mekanik1">1. Pengujian Operasi LBS & ES
                                        (Torsi/Manual)</label>
                                    <div class="input-group">
                                        <select id="pengujian_mekanik1" name="pengujian_mekanik1"
                                            class="form-control poinD1" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Tidak baik">Tidak baik</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPengujianMekanik1')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPengujianMekanik1" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganPengujianMekanik1">Keterangan Pengujian Operasi LBS &
                                            ES:</label>
                                        <textarea class="form-control" id="keteranganPengujianMekanik1" name="keteranganPengujianMekanik1" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganPengujianMekanik1', 'charCountKeteranganPengujianMekanik1')"></textarea>
                                        <small id="charCountKeteranganPengujianMekanik1" class="text-muted">55
                                            karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_mekanik2">2. Pengujian Interlock Mekanik</label>
                                    <div class="input-group">
                                        <select id="pengujian_mekanik2" name="pengujian_mekanik2"
                                            class="form-control poinD2" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Tidak baik">Tidak baik</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPengujianMekanik2')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPengujianMekanik2" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganPengujianMekanik2">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganPengujianMekanik2" name="keteranganPengujianMekanik2" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganPengujianMekanik2', 'charCountKeteranganPengujianMekanik2')"></textarea>
                                        <small id="charCountKeteranganPengujianMekanik2" class="text-muted">55
                                            karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin D adalah mandatory.
                        </p>
                        <hr class="mb-3">

                        <!-- Bagian E: Kesimpulan -->
                        <h6 class="mb-3 font-weight-bold">E. Kesimpulan</h6>
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

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Script kesimpulan loaded"); // Debugging

        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById("tahun_produksi");
        const inputMasaPakai = document.getElementById("masa_pakai");
        const kesimpulanDropdown = document.getElementById("kesimpulan");

        // Generate tahun untuk dropdown tahun produksi
        for (let year = tahunSekarang; year >= 1970; year--) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            selectTahun.appendChild(option);
        }

        // Fungsi untuk mendapatkan nilai numerik dari masa pakai
        function getMasaPakai() {
            const text = inputMasaPakai.value;
            const match = text.match(/\d+/);
            return match ? parseInt(match[0]) : 0;
        }

        // Hitung masa pakai
        function hitungMasaPakai() {
            const tahunProduksi = parseInt(selectTahun.value);
            const masaPakai = !isNaN(tahunProduksi) ? tahunSekarang - tahunProduksi : 0;
            inputMasaPakai.value = `${masaPakai} tahun`;
            return masaPakai;
        }

        // Cek kondisi Poin B (3,4,5)
        function cekKondisiB() {
            const poinB3 = document.getElementById("busbar_penyangga").value === 'Ada';
            const poinB4 = document.getElementById("kondisi_pembumian").value === 'Ada';
            const poinB5 = document.getElementById("kondisi_selungkup").value === 'Tidak ada';

            // Jika salah satu dari B3, B4, B5 tidak sesuai, maka pengujian C tidak perlu dilakukan
            return !(poinB3 && poinB4 && poinB5);
        }

        // Update kesimpulan
        function updateKesimpulan() {
            console.log("Updating kesimpulan..."); // Debugging

            const masaPakai = getMasaPakai();
            const kondisiBValid = cekKondisiB();

            // Debugging nilai
            console.log("Masa pakai:", masaPakai);
            console.log("Kondisi B valid:", kondisiBValid);

            const poinB1 = document.getElementById("nameplate").value === 'Ada';
            const poinB2 = document.getElementById("kelengkapan_peralatan").value === 'Ada';

            const poinC1 = parseFloat(document.getElementById("l1_cubicle").value) || 0;
            const poinC2 = parseFloat(document.getElementById("l2_cubicle").value) || 0;
            const poinC3 = parseFloat(document.getElementById("l3_cubicle").value) || 0;
            const poinC4 = parseFloat(document.getElementById("n_cubicle").value) || 0;

            const poinD1 = document.getElementById("pengujian_mekanik1").value === 'Baik';
            const poinD2 = document.getElementById("pengujian_mekanik2").value === 'Baik';

            // Debugging nilai poin
            console.log("Poin B1:", poinB1, "B2:", poinB2);
            console.log("Poin C:", poinC1, poinC2, poinC3, poinC4);
            console.log("Poin D:", poinD1, poinD2);

            let kesimpulan = "Bekas tidak layak pakai (K8)";

            if (kondisiBValid) {
                const kondisiC = poinC1 >= 1 && poinC2 >= 1 && poinC3 >= 1 && poinC4 >= 1;
                const kondisiD = poinD1 && poinD2;

                if (masaPakai <= 40) {
                    if (poinB1 && poinB2 && kondisiC && kondisiD) {
                        kesimpulan = "Bekas layak pakai (K6)";
                    } else if ((poinB1 || poinB2) && (kondisiC || kondisiD)) {
                        kesimpulan = "Bekas bisa diperbaiki (K7)";
                    }
                }
            }

            console.log("Kesimpulan akhir:", kesimpulan); // Debugging

            // Set nilai kesimpulan
            kesimpulanDropdown.value = kesimpulan;
        }

        // Daftar semua input yang mempengaruhi kesimpulan
        const inputSelectors = [
            '#tahun_produksi',
            '#nameplate', '#kelengkapan_peralatan', '#busbar_penyangga',
            '#kondisi_pembumian', '#kondisi_selungkup',
            '#l1_cubicle', '#l2_cubicle', '#l3_cubicle', '#n_cubicle',
            '#pengujian_mekanik1', '#pengujian_mekanik2'
        ];

        // Pasang event listener ke semua input terkait
        inputSelectors.forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                element.addEventListener('change', updateKesimpulan);
                element.addEventListener('input', updateKesimpulan);
            }
        });

        // Inisialisasi awal
        selectTahun.addEventListener('change', hitungMasaPakai);
        hitungMasaPakai();
        updateKesimpulan();
    });
</script> --}}

<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     console.log("Script kesimpulan loaded"); // Debugging

    //     const tahunSekarang = new Date().getFullYear();
    //     const selectTahun = document.getElementById("tahun_produksi");
    //     const inputMasaPakai = document.getElementById("masa_pakai");
    //     const kesimpulanDropdown = document.getElementById("kesimpulan");

    //     // [MODIFIED] Generate tahun untuk dropdown tahun produksi - improved
    //     function generateTahunOptions() {
    //         // Clear existing options first
    //         selectTahun.innerHTML = '<option value="">-- Pilih Tahun --</option>';

    //         for (let year = tahunSekarang; year >= 1970; year--) {
    //             const option = document.createElement("option");
    //             option.value = year;
    //             option.textContent = year;
    //             selectTahun.appendChild(option);
    //         }
    //     }

    //     // [MODIFIED] Fungsi untuk mendapatkan nilai numerik dari masa pakai - simplified
    //     function getMasaPakai() {
    //         return parseInt(selectTahun.value) ? tahunSekarang - parseInt(selectTahun.value) : 0;
    //     }

    //     // [MODIFIED] Hitung masa pakai - improved with better handling
    //     function hitungMasaPakai() {
    //         const tahunProduksi = parseInt(selectTahun.value);

    //         if (!isNaN(tahunProduksi)) {
    //             const masaPakai = tahunSekarang - tahunProduksi;
    //             inputMasaPakai.value = `${masaPakai} tahun`;
    //             console.log(`Masa pakai: ${masaPakai} tahun`); // Debugging
    //             return masaPakai;
    //         } else {
    //             inputMasaPakai.value = "";
    //             return 0;
    //         }
    //     }

    //     // Cek kondisi Poin B (3,4,5)
    //     function cekKondisiB() {
    //         const poinB3 = document.getElementById("busbar_penyangga").value === 'Ada';
    //         const poinB4 = document.getElementById("kondisi_pembumian").value === 'Ada';
    //         const poinB5 = document.getElementById("kondisi_selungkup").value === 'Tidak ada';

    //         // Jika salah satu dari B3, B4, B5 tidak sesuai, maka pengujian C tidak perlu dilakukan
    //         return !(poinB3 && poinB4 && poinB5);
    //     }

    //     // Update kesimpulan
    //     function updateKesimpulan() {
    //         console.log("Updating kesimpulan..."); // Debugging

    //         const masaPakai = getMasaPakai();
    //         const kondisiBValid = cekKondisiB();

    //         // Debugging nilai
    //         console.log("Masa pakai:", masaPakai);
    //         console.log("Kondisi B valid:", kondisiBValid);

    //         const poinB1 = document.getElementById("nameplate").value === 'Ada';
    //         const poinB2 = document.getElementById("kelengkapan_peralatan").value === 'Ada';

    //         const poinC1 = parseFloat(document.getElementById("l1_cubicle").value) || 0;
    //         const poinC2 = parseFloat(document.getElementById("l2_cubicle").value) || 0;
    //         const poinC3 = parseFloat(document.getElementById("l3_cubicle").value) || 0;
    //         const poinC4 = parseFloat(document.getElementById("n_cubicle").value) || 0;

    //         const poinD1 = document.getElementById("pengujian_mekanik1").value === 'Baik';
    //         const poinD2 = document.getElementById("pengujian_mekanik2").value === 'Baik';

    //         // Debugging nilai poin
    //         console.log("Poin B1:", poinB1, "B2:", poinB2);
    //         console.log("Poin C:", poinC1, poinC2, poinC3, poinC4);
    //         console.log("Poin D:", poinD1, poinD2);

    //         let kesimpulan = "Bekas tidak layak pakai (K8)";

    //         if (kondisiBValid) {
    //             const kondisiC = poinC1 >= 1 && poinC2 >= 1 && poinC3 >= 1 && poinC4 >= 1;
    //             const kondisiD = poinD1 && poinD2;

    //             if (masaPakai <= 40) {
    //                 if (poinB1 && poinB2 && kondisiC && kondisiD) {
    //                     kesimpulan = "Bekas layak pakai (K6)";
    //                 } else if ((poinB1 || poinB2) && (kondisiC || kondisiD)) {
    //                     kesimpulan = "Bekas bisa diperbaiki (K7)";
    //                 }
    //             }
    //         }

    //         console.log("Kesimpulan akhir:", kesimpulan); // Debugging

    //         // Set nilai kesimpulan
    //         kesimpulanDropdown.value = kesimpulan;
    //     }

    //     // Daftar semua input yang mempengaruhi kesimpulan
    //     const inputSelectors = [
    //         '#tahun_produksi',
    //         '#nameplate', '#kelengkapan_peralatan', '#busbar_penyangga',
    //         '#kondisi_pembumian', '#kondisi_selungkup',
    //         '#l1_cubicle', '#l2_cubicle', '#l3_cubicle', '#n_cubicle',
    //         '#pengujian_mekanik1', '#pengujian_mekanik2'
    //     ];

    //     // Pasang event listener ke semua input terkait
    //     inputSelectors.forEach(selector => {
    //         const element = document.querySelector(selector);
    //         if (element) {
    //             element.addEventListener('change', function() {
    //                 if (selector === '#tahun_produksi') {
    //                     hitungMasaPakai();
    //                 }
    //                 updateKesimpulan();
    //             });
    //             element.addEventListener('input', updateKesimpulan);
    //         }
    //     });

    //     // [MODIFIED] Inisialisasi awal - improved sequence
    //     generateTahunOptions(); // Generate tahun options first
    //     selectTahun.addEventListener('change', hitungMasaPakai);

    //     // Trigger initial calculations
    //     if (selectTahun.value) {
    //         hitungMasaPakai();
    //     }
    //     updateKesimpulan();
    // });

    document.addEventListener("DOMContentLoaded", function() {
        console.log("Script kesimpulan loaded"); // Debugging

        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById("tahun_produksi");
        const inputMasaPakai = document.getElementById("masa_pakai");
        const kesimpulanDropdown = document.getElementById("kesimpulan");

        // Generate tahun untuk dropdown tahun produksi
        function generateTahunOptions() {
            selectTahun.innerHTML = '<option value="">-- Pilih Tahun --</option>';

            for (let year = tahunSekarang; year >= 1970; year--) {
                const option = new Option(year, year);
                selectTahun.add(option);
            }
        }

        // Hitung dan tampilkan masa pakai
        function hitungMasaPakai() {
            const tahunProduksi = parseInt(selectTahun.value);

            if (tahunProduksi) {
                const masaPakai = tahunSekarang - tahunProduksi;
                inputMasaPakai.value = `${masaPakai} tahun`;
                console.log(`Masa pakai: ${masaPakai} tahun`);
                return masaPakai;
            } else {
                inputMasaPakai.value = "";
                return 0;
            }
        }

        // Get masa pakai value (simplified)
        function getMasaPakai() {
            return selectTahun.value ? tahunSekarang - parseInt(selectTahun.value) : 0;
        }

        // Cek kondisi Poin B (3,4,5)
        function cekKondisiB() {
            const poinB3 = document.getElementById("busbar_penyangga").value === 'Ada';
            const poinB4 = document.getElementById("kondisi_pembumian").value === 'Ada';
            const poinB5 = document.getElementById("kondisi_selungkup").value === 'Tidak ada';

            return !(poinB3 && poinB4 && poinB5);
        }

        // Update kesimpulan
        function updateKesimpulan() {
            console.log("Updating kesimpulan...");
            const masaPakai = getMasaPakai();
            const kondisiBValid = cekKondisiB();

            const poinB1 = document.getElementById("nameplate").value === 'Ada';
            const poinB2 = document.getElementById("kelengkapan_peralatan").value === 'Ada';
            const poinC1 = parseFloat(document.getElementById("l1_cubicle").value) || 0;
            const poinC2 = parseFloat(document.getElementById("l2_cubicle").value) || 0;
            const poinC3 = parseFloat(document.getElementById("l3_cubicle").value) || 0;
            const poinC4 = parseFloat(document.getElementById("n_cubicle").value) || 0;
            const poinD1 = document.getElementById("pengujian_mekanik1").value === 'Baik';
            const poinD2 = document.getElementById("pengujian_mekanik2").value === 'Baik';

            let kesimpulan = "Bekas tidak layak pakai (K8)";

            if (kondisiBValid) {
                const kondisiC = poinC1 >= 1 && poinC2 >= 1 && poinC3 >= 1 && poinC4 >= 1;
                const kondisiD = poinD1 && poinD2;

                if (masaPakai <= 40) {
                    if (poinB1 && poinB2 && kondisiC && kondisiD) {
                        kesimpulan = "Bekas layak pakai (K6)";
                    } else if ((poinB1 || poinB2) && (kondisiC || kondisiD)) {
                        kesimpulan = "Bekas bisa diperbaiki (K7)";
                    }
                }
            }

            kesimpulanDropdown.value = kesimpulan;
        }

        // Inisialisasi Select2 untuk tahun_produksi
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $(selectTahun).select2({
                width: '100%'
            }).on('change', function() {
                hitungMasaPakai();
                updateKesimpulan();
            });
        });

        // Event delegation untuk semua input terkait
        document.addEventListener('change', function(e) {
            const relevantSelectors = [
                '#nameplate', '#kelengkapan_peralatan', '#busbar_penyangga',
                '#kondisi_pembumian', '#kondisi_selungkup',
                '#l1_cubicle', '#l2_cubicle', '#l3_cubicle', '#n_cubicle',
                '#pengujian_mekanik1', '#pengujian_mekanik2'
            ];

            if (relevantSelectors.some(selector => e.target.matches(selector))) {
                updateKesimpulan();
            }
        });

        // Inisialisasi
        generateTahunOptions();
    });
</script>

<x-layouts.footer />
