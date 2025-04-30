{{-- <x-layouts.header /> --}}

<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Trafo Distribusi</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-trafo.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="6">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select class="form-control" id="up3_id" name="up3_id" required>
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
                                    <select class="form-control" id="gudang_id" name="gudang_id" required>
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
                                    <input type="text" class="form-control" id="lokasi_akhir_terpasang"
                                        name="lokasi_akhir_terpasang" placeholder="Masukkan Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-4">
                                    <div class="w-50">
                                        <label for="tahun_produksi">Tahun Produksi</label>
                                        <select class="form-control select2" id="tahun_produksi" name="tahun_produksi"
                                            required>
                                            <option value="">-- Pilih Tahun --</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control" id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun sekarang - Tahun produksi" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_trafo">Tipe Trafo Distribusi</label>
                                    <select class="form-control" id="tipe_trafo" name="tipe_trafo" required>
                                        <option value="">-- Pilih Tipe Trafo --</option>
                                        <option value="Trafo Kering (Dry Type Transformer)">Trafo Kering (Dry Type
                                            Transformer)</option>
                                        <option value="Trafo Berisi Minyak (Oil-Immersed Transformer)">Trafo Berisi
                                            Minyak (Oil-Immersed Transformer)
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="number" class="form-control" id="no_serial" name="no_serial"
                                        placeholder="Masukkan No Serial" required>
                                </div>
                                <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <select class="form-control" id="pabrikan_id" name="pabrikan_id" required>
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
                                        <select class="form-control poin1" id="nameplate" name="nameplate" required>
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
                                        <label for="keterangan_nameplate">Keterangan Nameplate:</label>
                                        <textarea class="form-control" id="keterangan_nameplate" name="keterangan_nameplate" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keterangan_nameplate', 'charCountNameplate')"></textarea>
                                        <small id="charCountNameplate" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penandaan_terminal">2. Penandaaan terminal primer dan sekunder </label>
                                    <div class="input-group">
                                        <select class="form-control poin2" id="penandaan_terminal"
                                            name="penandaan_terminal" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPenandaanTerminal')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPenandaanTerminal" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keterangan_penandaan_terminal">Keterangan Penandaan Terminal Primer
                                            dan Sekunder:</label>
                                        <textarea class="form-control" id="keterangan_penandaan_terminal" name="keterangan_penandaan_terminal"
                                            rows="2" maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_penandaan_terminal', 'charCountPenandaanTerminal')"></textarea>
                                        <small id="charCountPenandaanTerminal" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pengaman_tekanan">3. Pengaman tekanan lebih</label>
                                    <div class="input-group">
                                        <select class="form-control poin3" id="pengaman_tekanan"
                                            name="pengaman_tekanan" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPengamanTekanan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPengamanTekanan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keterangan_pengaman_tekanan">Keterangan Pengaman Tekanan:</label>
                                        <textarea class="form-control" id="keterangan_pengaman_tekanan" name="keterangan_pengaman_tekanan" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_pengaman_tekanan', 'charCountPengamanTekanan')"></textarea>
                                        <small id="charCountPengamanTekanan" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kondisi_tangki">4. Kondisi tangki (ada kebocoran/bengkak/cacat
                                        radiator(sirip)/seal top cover
                                        rembes)</label>
                                    <div class="input-group">
                                        <select class="form-control poin4" id="kondisi_tangki" name="kondisi_tangki"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKondisiTangki')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKondisiTangki" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_kondisi_tangki">Keterangan Kondisi Tangki:</label>
                                        <textarea class="form-control" id="keterangan_kondisi_tangki" name="keterangan_kondisi_tangki" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_kondisi_tangki', 'charCountKondisiTangki')"></textarea>
                                        <small id="charCountKondisiTangki" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_fisik_bushing">5. Kondisi fisik bushing HV dan LV (ada
                                        retak/longgar dari tangki/seal bushing
                                        rembes)</label>
                                    <select class="form-control poin5" id="kondisi_fisik_bushing"
                                        name="kondisi_fisik_bushing" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
                                    </select>
                                </div>

                                <div class="kerusakan" id="kerusakan" name="kerusakan" style="display: none;">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_r"
                                                    name="kerusakan_fasa[]" value="R" />
                                                <label class="form-check-label" for="kerusakan_fasa_r"> Rusak pada
                                                    Fasa
                                                    R</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_s"
                                                    name="kerusakan_fasa[]" value="S" />
                                                <label class="form-check-label" for="kerusakan_fasa_s"> Rusak pada
                                                    Fasa
                                                    S</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_t"
                                                    name="kerusakan_fasa[]" value="T" />
                                                <label class="form-check-label" for="kerusakan_fasa_t"> Rusak pada
                                                    Fasa
                                                    T</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_n"
                                                    name="kerusakan_fasa[]" value="N" />
                                                <label class="form-check-label" for="kerusakan_fasa_n"> Rusak pada
                                                    Fasa
                                                    N</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan:
                                <br> a. Poin 1 dan 2 bila terdapat cacat dapat diperbaiki dengan dibuat penanda baru.
                                <br> b. Kesesuaian poin B (3,4,5) adalah mandatory, jika ada yang tidak sesuai maka
                                pengujian poin C tidak perlu dilakukan.
                            </p>
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian C: Pengujian Elektrik -->
                        <div id="sectionC" style="display: none;">
                            <h6 class="mb-3 font-weight-bold">C. Pengujian Elektrik</h6>
                            <h6 class="mb-3 font-weight-bold">Pengujian Tahanan Isolasi</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_hv_lv">HV - LV (MΩ)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_hv_lv"
                                                        name="nilai_hv_lv" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text">MΩ</span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiHvLv')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiHvLv" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_hv_lv">Keterangan Nilai HV - LV
                                                        (MΩ):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_hv_lv" name="keterangan_nilai_hv_lv" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_hv_lv', 'charCountNilaiHvLv')"></textarea>
                                                    <small id="charCountNilaiHvLv" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_hv_lv" name="kesesuaian_nilai_hv_lv"
                                                        value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_hv_lv">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_hv_ground">HV - Ground (MΩ)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_hv_ground"
                                                        name="nilai_hv_ground" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text">MΩ</span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiHvGround')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiHvGround" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_hv_ground">Keterangan Nilai HV -
                                                        Ground
                                                        (MΩ):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_hv_ground" name="keterangan_nilai_hv_ground" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_hv_ground', 'charCountNilaiHvGround')"></textarea>
                                                    <small id="charCountNilaiHvGround" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_hv_ground"
                                                        name="kesesuaian_nilai_hv_ground" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_hv_ground">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_lv_ground">LV - Ground (MΩ)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_lv_ground"
                                                        name="nilai_lv_ground" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text">MΩ</span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiLvGround')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiLvGround" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_lv_ground">Keterangan Nilai LV -
                                                        Ground
                                                        (MΩ):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_lv_ground" name="keterangan_nilai_lv_ground" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_lv_ground', 'charCountNilaiLvGround')"></textarea>
                                                    <small id="charCountNilaiLvGround" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_lv_ground"
                                                        name="kesesuaian_nilai_lv_ground" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_lv_ground">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="mb-3 font-weight-bold">Rasio Belitan (kesesuaian toleransi perbedaan rasio +-
                                0,5%)</h6>
                            <!-- Tap 1 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap1_1u_1v">Tap 1 - 1U-1V (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap1_1u_1v"
                                                        name="nilai_tap1_1u_1v" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap1UV')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap1UV" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap1_1u_1v">Keterangan Tap 1 - 1U-1V
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap1_1u_1v" name="keterangan_nilai_tap1_1u_1v" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap1_1u_1v', 'charCountNilaiTap1UV')"></textarea>
                                                    <small id="charCountNilaiTap1UV" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap1_1u_1v"
                                                        name="kesesuaian_nilai_tap1_1u_1v" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap1_1u_1v">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap1_1v_1w">Tap 1 - 1V-1W (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap1_1v_1w"
                                                        name="nilai_tap1_1v_1w" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap1VW')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap1VW" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap1_1v_1w">Keterangan Tap 1 - 1V-1W
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap1_1v_1w" name="keterangan_nilai_tap1_1v_1w" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap1_1v_1w', 'charCountNilaiTap1VW')"></textarea>
                                                    <small id="charCountNilaiTap1VW" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap1_1v_1w"
                                                        name="kesesuaian_nilai_tap1_1v_1w" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap1_1v_1w">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap1_1w_1u">Tap 1 - 1W-1U (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap1_1w_1u"
                                                        name="nilai_tap1_1w_1u" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap1WU')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap1WU" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap1_1w_1u">Keterangan Tap 1 - 1W-1U
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap1_1w_1u" name="keterangan_nilai_tap1_1w_1u" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap1_1w_1u', 'charCountNilaiTap1WU')"></textarea>
                                                    <small id="charCountNilaiTap1WU" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap1_1w_1u"
                                                        name="kesesuaian_nilai_tap1_1w_1u" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap1_1w_1u">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tap 3 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap3_1u_1v">Tap 3 - 1U-1V (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap3_1u_1v"
                                                        name="nilai_tap3_1u_1v" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap3UV')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap3UV" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap3_1u_1v">Keterangan Tap 3 - 1U-1V
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap3_1u_1v" name="keterangan_nilai_tap3_1u_1v" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap3_1u_1v', 'charCountNilaiTap3UV')"></textarea>
                                                    <small id="charCountNilaiTap3UV" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap3_1u_1v"
                                                        name="kesesuaian_nilai_tap3_1u_1v" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap3_1u_1v">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap3_1v_1w">Tap 3 - 1V-1W (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap3_1v_1w"
                                                        name="nilai_tap3_1v_1w" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap3VW')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap3VW" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap3_1v_1w">Keterangan Tap 3 - 1V-1W
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap3_1v_1w" name="keterangan_nilai_tap3_1v_1w" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap3_1v_1w', 'charCountNilaiTap3VW')"></textarea>
                                                    <small id="charCountNilaiTap3VW" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap3_1v_1w"
                                                        name="kesesuaian_nilai_tap3_1v_1w" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap3_1v_1w">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap3_1w_1u">Tap 3 - 1W-1U (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap3_1w_1u"
                                                        name="nilai_tap3_1w_1u" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap3WU')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap3WU" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap3_1w_1u">Keterangan Tap 3 - 1W-1U
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap3_1w_1u" name="keterangan_nilai_tap3_1w_1u" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap3_1w_1u', 'charCountNilaiTap3WU')"></textarea>
                                                    <small id="charCountNilaiTap3WU" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap3_1w_1u"
                                                        name="kesesuaian_nilai_tap3_1w_1u" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap3_1w_1u">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tap 7 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap7_1u_1v">Tap 7 - 1U-1V (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap7_1u_1v"
                                                        name="nilai_tap7_1u_1v" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap7UV')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap7UV" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap7_1u_1v">Keterangan Tap 7 - 1U-1V
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap7_1u_1v" name="keterangan_nilai_tap7_1u_1v" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('	keterangan_nilai_tap7_1u_1v', 'charCountNilaiTap7UV')"></textarea>
                                                    <small id="charCountNilaiTap7UV" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap7_1u_1v"
                                                        name="kesesuaian_nilai_tap7_1u_1v" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap7_1u_1v">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap7_1v_1w">Tap 7 - 1V-1W (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap7_1v_1w"
                                                        name="nilai_tap7_1v_1w" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap7VW')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap7VW" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap7_1v_1w">Keterangan Tap 7 - 1V-1W
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap7_1v_1w" name="keterangan_nilai_tap7_1v_1w" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap7_1v_1w', 'charCountNilaiTap7VW')"></textarea>
                                                    <small id="charCountNilaiTap7VW" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap7_1v_1w"
                                                        name="kesesuaian_nilai_tap7_1v_1w" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap7_1v_1w">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nilai_tap7_1w_1u">Tap 7 - 1W-1U (%)</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="nilai_tap7_1w_1u"
                                                        name="nilai_tap7_1w_1u" placeholder="0,00" min="0"
                                                        step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-percent"></i></span>
                                                    <span class="input-group-text" id="basic-addon2"
                                                        onclick="toggleKeterangan('keteranganNilaiTap7WU')">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                </div>
                                                <!-- Input keterangan toggle -->
                                                <div id="keteranganNilaiTap7WU" class="form-group mt-2"
                                                    style="display: none;">
                                                    <label for="keterangan_nilai_tap7_1w_1u">Keterangan Tap 7 - 1W-1U
                                                        (%):</label>
                                                    <textarea class="form-control" id="keterangan_nilai_tap7_1w_1u" name="keterangan_nilai_tap7_1w_1u" rows="2"
                                                        maxlength="55" placeholder="Masukkan keterangan..."
                                                        oninput="updateCharCount('keterangan_nilai_tap7_1w_1u', 'charCountNilaiTap7WU')"></textarea>
                                                    <small id="charCountNilaiTap7WU" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap7_1w_1u"
                                                        name="kesesuaian_nilai_tap7_1w_1u" value="1">
                                                    <label class="form-check-label"
                                                        for="kesesuaian_nilai_tap7_1w_1u">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">
                                Keterangan: Kesesuaian seluruh mata uji poin C adalah mandatory
                            </p>
                            <hr class="mb-3">
                        </div>

                        <!-- Bagian D: Kesimpulan -->
                        <h6 class="mb-3 font-weight-bold">D. Kesimpulan</h6>
                        <div class="row">
                            @if (auth()->user()->hasRole('Petugas'))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kesimpulan">Kesimpulan</label>
                                        <select class="form-control" id="kesimpulan" name="kesimpulan" required
                                            readonly>
                                            <option value="">-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)">Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)">Masih garansi (K7)</option>
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
                                            <option value="Masih garansi (K7)">Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)">Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian E: Gambar Evidence -->
                        <h6 class="mb-3 font-weight-bold">E. Gambar Evidence</h6>
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

                        <a href="{{ route('forms') }}" class="btn btn-secondary" id="backButton">Kembali</a>
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

<!-- Script untuk Toggle dan Hitung Karakter -->
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
    // Fungsi untuk preview gambar
    function previewImage(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        if (!previewContainer || !input) return;

        previewContainer.innerHTML = "";

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement("img");
                imgElement.src = e.target.result;
                imgElement.classList.add("h-40", "w-40", "object-cover", "rounded-lg", "border", "border-gray-300");
                imgElement.style.cursor = "pointer";
                imgElement.onclick = () => openImageModal(e.target.result);
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Fungsi untuk membuka modal gambar
    function openImageModal(imageSrc) {
        const modalImage = document.getElementById('modalImage');
        if (!modalImage) return;

        modalImage.src = imageSrc;

        // Inisialisasi modal Bootstrap jika tersedia
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElement = document.getElementById('imageModal');
            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            }
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
        "extendedTimeOut": "1000"
    };

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

    // Toast Notification untuk Submit Sukses
    // document.getElementById('formInspeksi').addEventListener('submit', function(e) {
    //     // Jika form valid, tampilkan toast sukses
    //     const submitButton = this.querySelector('button[type="submit"]');
    //     if (submitButton) {
    //         // Simpan data ke localStorage untuk menandai form telah disubmit
    //         localStorage.removeItem("formInspeksiData");

    //         // Tampilkan toast sukses
    //         toastr.success('Data berhasil disimpan!');
    //     }
    // });

    // [MODIFIKASI UTAMA] Toast Notification untuk Submit Sukses
    document.getElementById('formInspeksi').addEventListener('submit', function(e) {
        // Simpan referensi ke form
        const form = this;

        // Hapus data dari localStorage
        localStorage.removeItem("formInspeksiData");

        // Tampilkan toast sukses
        toastr.success('Data berhasil disimpan!')
            .on('hidden.bs.toast', function() {
                // Lanjutkan submit form setelah toast hilang
                form.submit();
            });

        // Alternatif jika event hidden.bs.toast tidak bekerja:
        // setTimeout(() => {
        //     form.submit();
        // }, 1500);
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
    document.addEventListener("DOMContentLoaded", function() {
        // Inisialisasi variabel global
        const formInspeksi = document.getElementById("formInspeksi");
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById("tahun_produksi");
        const inputMasaPakai = document.getElementById("masa_pakai");
        const sectionC = document.getElementById("sectionC");
        const kerusakanSection = document.getElementById("kerusakan");
        const kesimpulanSelect = document.getElementById("kesimpulan");

        // Inisialisasi fungsi
        initTahunProduksi();
        initEventListeners();
        loadFormData();

        // Fungsi inisialisasi tahun produksi
        function initTahunProduksi() {
            if (!selectTahun) return;

            // Kosongkan select terlebih dahulu
            selectTahun.innerHTML = '<option value="">-- Pilih Tahun --</option>';

            // Isi tahun dari sekarang sampai 1980
            for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
                const option = document.createElement("option");
                option.value = tahun;
                option.textContent = tahun;
                selectTahun.appendChild(option);
            }

            // Inisialisasi Select2 jika jQuery tersedia
            if (typeof jQuery !== 'undefined') {
                jQuery(selectTahun).select2();
            }
        }

        // Fungsi inisialisasi event listeners
        function initEventListeners() {
            // Tanggal inspeksi otomatis
            setCurrentDate();

            // Event listeners untuk elemen form
            if (selectTahun) {
                // Gunakan event change dari jQuery jika Select2 digunakan
                if (typeof jQuery !== 'undefined') {
                    jQuery(selectTahun).on('change', function() {
                        hitungMasaPakai();
                        simpanDataForm();
                    });
                } else {
                    selectTahun.addEventListener("change", function() {
                        hitungMasaPakai();
                        simpanDataForm();
                    });
                }
            }

            if (formInspeksi) {
                formInspeksi.addEventListener("change", simpanDataForm);
                formInspeksi.addEventListener("submit", hapusDataForm);
            }

            // Event listeners untuk elemen form
            if (selectTahun) selectTahun.addEventListener("change", hitungMasaPakai);
            if (formInspeksi) formInspeksi.addEventListener("change", simpanDataForm);
            if (formInspeksi) formInspeksi.addEventListener("submit", hapusDataForm);

            // Event listeners untuk pemeriksaan visual
            document.querySelectorAll(".poin1, .poin2, .poin3, .poin4, .poin5").forEach(el => {
                el.addEventListener("change", updateFormSections);
            });

            // Button reset form
            const clearFormButton = document.getElementById("clearFormButton");
            if (clearFormButton) {
                clearFormButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    if (confirm("Apakah Anda yakin ingin mengosongkan form?")) {
                        resetForm();
                    }
                });
            }
        }

        // Fungsi untuk mengatur tanggal inspeksi otomatis
        function setCurrentDate() {
            const tglInspeksi = document.getElementById("tgl_inspeksi");
            if (tglInspeksi) {
                const today = new Date();
                const formattedDate = today.toISOString().split('T')[0];
                tglInspeksi.value = formattedDate;
            }
        }

        // Fungsi hitung masa pakai
        // function hitungMasaPakai() {
        //     if (!selectTahun || !inputMasaPakai) return;

        //     const tahunProduksi = parseInt(selectTahun.value);
        //     if (!isNaN(tahunProduksi)) {
        //         const masaPakai = tahunSekarang - tahunProduksi;
        //         inputMasaPakai.value = masaPakai + " tahun";
        //         updateKesimpulan();
        //     } else {
        //         inputMasaPakai.value = "";
        //     }
        // }

        // Fungsi hitung masa pakai - Perbaikan
        function hitungMasaPakai() {
            if (!selectTahun || !inputMasaPakai) return;

            const tahunProduksi = parseInt(selectTahun.value);
            if (!isNaN(tahunProduksi)) {
                const masaPakai = tahunSekarang - tahunProduksi;
                inputMasaPakai.value = `${masaPakai} tahun`;
                console.log(`Masa pakai dihitung: ${masaPakai} tahun`); // Debugging
            } else {
                inputMasaPakai.value = "";
            }
        }

        // Fungsi update section form
        function updateFormSections() {
            toggleSectionC();
            toggleKerusakanSection();
            updateKesimpulan();
        }

        // Fungsi toggle section C
        function toggleSectionC() {
            if (!sectionC) return;

            const poin3 = document.querySelector(".poin3")?.value || "";
            const poin4 = document.querySelector(".poin4")?.value || "";
            const poin5 = document.querySelector(".poin5")?.value || "";

            // Section C ditampilkan jika:
            // - Poin 3 = "Ada"
            // - Poin 4 = "Tidak ada"
            // - Poin 5 = "Tidak ada"
            sectionC.style.display = (poin3 === "Ada" && poin4 === "Tidak ada" && poin5 === "Tidak ada") ?
                "block" :
                "none";
        }

        // Fungsi toggle section kerusakan
        function toggleKerusakanSection() {
            if (!kerusakanSection) return;

            const poin5 = document.querySelector(".poin5")?.value || "";
            kerusakanSection.style.display = (poin5 === "Ada") ? "block" : "none";
        }

        // Fungsi update kesimpulan
        function updateKesimpulan() {
            if (!kesimpulanSelect || !inputMasaPakai) return;

            const masaPakaiText = inputMasaPakai.value;
            const masaPakai = parseInt(masaPakaiText) || 0;

            const poin1 = document.querySelector(".poin1")?.value || "";
            const poin2 = document.querySelector(".poin2")?.value || "";
            const poin3 = document.querySelector(".poin3")?.value || "";
            const poin4 = document.querySelector(".poin4")?.value || "";
            const poin5 = document.querySelector(".poin5")?.value || "";

            let kesimpulan = "Bekas tidak layak pakai (K8)";

            if (masaPakai <= 25) {
                // Jika masa pakai <= 25 tahun
                if (poin1 === "Ada" && poin2 === "Ada" && poin3 === "Ada" &&
                    poin4 === "Tidak ada" && poin5 === "Tidak ada") {
                    kesimpulan = "Bekas layak pakai (K6)";
                } else if (poin3 === "Ada" && poin4 === "Tidak ada" && poin5 === "Tidak ada") {
                    kesimpulan = "Bekas bisa diperbaiki (K7)";
                }
            } else {
                // Jika masa pakai > 25 tahun
                if (poin3 === "Ada" && poin4 === "Tidak ada" && poin5 === "Tidak ada") {
                    kesimpulan = "Bekas bisa diperbaiki (K7)";
                }
            }

            // Set nilai kesimpulan di dropdown
            kesimpulanSelect.value = kesimpulan;
        }

        // Fungsi untuk reset form
        function resetForm() {
            if (!formInspeksi) return;

            // Simpan nilai tgl_inspeksi sebelum form di-reset
            const tglInspeksi = document.getElementById("tgl_inspeksi");
            const tglInspeksiValue = tglInspeksi ? tglInspeksi.value : '';

            // Reset form
            formInspeksi.reset();

            // Kembalikan nilai tgl_inspeksi
            if (tglInspeksi) {
                tglInspeksi.value = tglInspeksiValue;
            }

            // Hapus data dari localStorage
            localStorage.removeItem("formInspeksiData");

            // Reset Select2 jika ada
            if (typeof jQuery !== 'undefined' && selectTahun) {
                jQuery(selectTahun).val(null).trigger("change");
            }

            // Update form sections
            updateFormSections();

            // Tampilkan notifikasi
            toastr.success('Form telah berhasil dikosongkan.');
        }

        // Fungsi untuk menyimpan data form ke localStorage
        function simpanDataForm() {
            if (!formInspeksi) return;

            const formData = new FormData(formInspeksi);
            const formObject = {};

            formData.forEach((value, key) => {
                // Skip file inputs
                if (!key.startsWith("gambar")) {
                    formObject[key] = value;
                }
            });

            localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
        }

        // Fungsi untuk memuat data dari localStorage
        function loadFormData() {
            if (!formInspeksi) return;

            const savedData = localStorage.getItem("formInspeksiData");
            if (savedData) {
                try {
                    const formObject = JSON.parse(savedData);

                    for (const key in formObject) {
                        const inputElement = formInspeksi.querySelector(`[name="${key}"]`);
                        if (inputElement && inputElement.type !== "file") {
                            inputElement.value = formObject[key];
                        }
                    }

                    // Trigger Select2 jika ada
                    if (typeof jQuery !== 'undefined' && selectTahun) {
                        jQuery(selectTahun).trigger("change");
                    }

                    // Update form sections
                    updateFormSections();

                } catch (e) {
                    console.error("Error parsing saved form data:", e);
                    localStorage.removeItem("formInspeksiData");
                }
            }
        }

        // Fungsi untuk menghapus data dari localStorage saat form submit
        function hapusDataForm() {
            localStorage.removeItem("formInspeksiData");
        }
    });
</script>
<x-layouts.footer />
