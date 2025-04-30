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
                    <form id="formInspeksi" action="{{ route('form-retur-trafo.update', $trafo->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="6">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select class="form-control" id="up3_id" name="up3_id" required>
                                        <option value="">-- Pilih UP3 --</option>
                                        @foreach ($up3s as $up3)
                                            <option value="{{ $up3->id }}"
                                                {{ old('up3_id', $selectedUp3Id ?? null) == $up3->id ? 'selected' : '' }}>
                                                {{ $up3->unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gudang_id">Gudang Retur</label>
                                    <select class="form-control" id="gudang_id" name="gudang_id" required>
                                        <option value="">-- Pilih Gudang Retur --</option>
                                        @foreach ($gudangs as $gudang)
                                            <option value="{{ $gudang->id }}"
                                                {{ old('gudang_id', $selectedGudang ?? null) == $gudang->id ? 'selected' : '' }}>
                                                {{ $gudang->nama_gudang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_inspeksi">Tanggal Inspeksi</label>
                                    <input type="date" class="form-control" id="tgl_inspeksi" name="tgl_inspeksi"
                                        value="{{ old('tgl_inspeksi', $trafo->tgl_inspeksi) }}" readonly>
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
                                        name="lokasi_akhir_terpasang" placeholder="Masukkan Alamat"
                                        value="{{ old('lokasi_akhir_terpasang', $trafo->lokasi_akhir_terpasang) }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id" required>
                                        @foreach ($ulps as $ulp)
                                            <option value="{{ $ulp->id }}"
                                                {{ old('ulp_id', $selectedUlpId ?? null) == $ulp->id ? 'selected' : '' }}>
                                                {{ $ulp->daerah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex gap-4">
                                    <div class="w-50">
                                        <label for="tahun_produksi">Tahun Produksi</label>
                                        <select class="form-control select2" id="tahun_produksi" name="tahun_produksi"
                                            required>
                                            <option value="">-- Pilih Tahun --</option>
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('tahun_produksi', $selectedTahunProduksi ?? null) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control" id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun sekarang - Tahun produksi"
                                            value="{{ old('masa_pakai', $trafo->masa_pakai) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_trafo">Tipe Trafo Distribusi</label>
                                    <select class="form-control" id="tipe_trafo" name="tipe_trafo" required>
                                        <option value="">-- Pilih Tipe Trafo --</option>
                                        <option value="Trafo Kering (Dry Type Transformer)"
                                            {{ old('tipe_trafo', $trafo->tipe_trafo) == 'Trafo Kering (Dry Type Transformer)' ? 'selected' : '' }}>
                                            Trafo Kering (Dry Type
                                            Transformer)</option>
                                        <option value="Trafo Berisi Minyak (Oil-Immersed Transformer)"
                                            {{ old('tipe_trafo', $trafo->tipe_trafo) == 'Trafo Berisi Minyak (Oil-Immersed Transformer)' ? 'selected' : '' }}>
                                            Trafo Berisi
                                            Minyak (Oil-Immersed Transformer)
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="number" class="form-control" id="no_serial" name="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $trafo->no_serial) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <select class="form-control" id="pabrikan_id" name="pabrikan_id" required>
                                        <option value="">-- Pilih Pabrikan --</option>
                                        @foreach ($pabrikans as $pabrikan)
                                            <option value="{{ $pabrikan->id }}"
                                                {{ old('pabrikan_id', $selectedPabrikanId ?? null) == $pabrikan->id ? 'selected' : '' }}>
                                                {{ $pabrikan->nama_pabrikan }}
                                            </option>
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
                                            <option value="Ada"
                                                {{ old('nameplate', $trafo->nameplate) == 'Ada' ? 'selected' : '' }}>
                                                Ada
                                            </option>
                                            <option value="Tidak ada"
                                                {{ old('nameplate', $trafo->nameplate) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keterangan_nameplate', 'charCountNameplate')">{{ $trafo->keterangan_nameplate }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penandaan_terminal">2. Penandaaan terminal primer dan sekunder </label>
                                    <div class="input-group">
                                        <select class="form-control poin2" id="penandaan_terminal"
                                            name="penandaan_terminal" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada"
                                                {{ old('penandaan_terminal', $trafo->penandaan_terminal) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('penandaan_terminal', $trafo->penandaan_terminal) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            oninput="updateCharCount('keterangan_penandaan_terminal', 'charCountPenandaanTerminal')">{{ $trafo->keterangan_penandaan_terminal }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pengaman_tekanan">3. Pengaman tekanan lebih</label>
                                    <div class="input-group">
                                        <select class="form-control poin3" id="pengaman_tekanan"
                                            name="pengaman_tekanan" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada"
                                                {{ old('pengaman_tekanan', $trafo->pengaman_tekanan) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('pengaman_tekanan', $trafo->pengaman_tekanan) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            oninput="updateCharCount('keterangan_pengaman_tekanan', 'charCountPengamanTekanan')">{{ $trafo->keterangan_pengaman_tekanan }}</textarea>
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
                                            <option value="Ada"
                                                {{ old('kondisi_tangki', $trafo->kondisi_tangki) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('kondisi_tangki', $trafo->kondisi_tangki) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            oninput="updateCharCount('keterangan_kondisi_tangki', 'charCountKondisiTangki')">{{ $trafo->keterangan_kondisi_tangki }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_fisik_bushing">5. Kondisi fisik bushing HV dan LV (ada
                                        retak/longgar dari tangki/seal bushing
                                        rembes)</label>
                                    <select class="form-control poin5" id="kondisi_fisik_bushing"
                                        name="kondisi_fisik_bushing" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('kondisi_fisik_bushing', $trafo->kondisi_fisik_bushing) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('kondisi_fisik_bushing', $trafo->kondisi_fisik_bushing) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>

                                <div class="kerusakan" id="kerusakan" name="kerusakan">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_r"
                                                    name="kerusakan_fasa[]" value="R"
                                                    {{ is_array($kerusakan_terpilih) && in_array('R', $kerusakan_terpilih) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="kerusakan_fasa_r">Rusak pada Fasa
                                                    R</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_s"
                                                    name="kerusakan_fasa[]" value="S"
                                                    {{ is_array($kerusakan_terpilih) && in_array('S', $kerusakan_terpilih) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="kerusakan_fasa_s">Rusak pada Fasa
                                                    S</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_t"
                                                    name="kerusakan_fasa[]" value="T"
                                                    {{ is_array($kerusakan_terpilih) && in_array('T', $kerusakan_terpilih) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="kerusakan_fasa_t">Rusak pada Fasa
                                                    T</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="kerusakan_fasa_n"
                                                    name="kerusakan_fasa[]" value="N"
                                                    {{ is_array($kerusakan_terpilih) && in_array('N', $kerusakan_terpilih) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="kerusakan_fasa_n">Rusak pada
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_hv_lv }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_hv_lv', 'charCountNilaiHvLv')">{{ $trafo->keterangan_nilai_hv_lv }}</textarea>
                                                    <small id="charCountNilaiHvLv" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_hv_lv" name="kesesuaian_nilai_hv_lv"
                                                        value="1"
                                                        {{ $trafo->kesesuaian_nilai_hv_lv === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_hv_ground }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_hv_ground', 'charCountNilaiHvGround')">{{ $trafo->keterangan_nilai_hv_ground }}</textarea>
                                                    <small id="charCountNilaiHvGround" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_hv_ground"
                                                        name="kesesuaian_nilai_hv_ground" value="1"
                                                        {{ $trafo->kesesuaian_nilai_hv_ground === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_lv_ground }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_lv_ground', 'charCountNilaiLvGround')">{{ $trafo->keterangan_nilai_lv_ground }}</textarea>
                                                    <small id="charCountNilaiLvGround" class="text-muted">55 karakter
                                                        tersisa.</small>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_lv_ground"
                                                        name="kesesuaian_nilai_lv_ground" value="1"
                                                        {{ $trafo->kesesuaian_nilai_lv_ground === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap1_1u_1v }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap1_1u_1v', 'charCountNilaiTap1UV')">{{ $trafo->keterangan_nilai_tap1_1u_1v }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap1_1u_1v"
                                                        name="kesesuaian_nilai_tap1_1u_1v" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap1_1u_1v === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap1_1v_1w }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap1_1v_1w', 'charCountNilaiTap1VW')">{{ $trafo->keterangan_nilai_tap1_1v_1w }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap1_1v_1w"
                                                        name="kesesuaian_nilai_tap1_1v_1w" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap1_1v_1w === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap1_1w_1u }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap1_1w_1u', 'charCountNilaiTap1WU')">{{ $trafo->keterangan_nilai_tap1_1w_1u }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap1_1w_1u"
                                                        name="kesesuaian_nilai_tap1_1w_1u" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap1_1w_1u === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap3_1u_1v }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap3_1u_1v', 'charCountNilaiTap3UV')">{{ $trafo->keterangan_nilai_tap3_1u_1v }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap3_1u_1v"
                                                        name="kesesuaian_nilai_tap3_1u_1v" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap3_1u_1v === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap3_1v_1w }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap3_1v_1w', 'charCountNilaiTap3VW')">{{ $trafo->keterangan_nilai_tap3_1v_1w }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap3_1v_1w"
                                                        name="kesesuaian_nilai_tap3_1v_1w" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap3_1v_1w === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap3_1w_1u }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap3_1w_1u', 'charCountNilaiTap3WU')">{{ $trafo->keterangan_nilai_tap3_1w_1u }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap3_1w_1u"
                                                        name="kesesuaian_nilai_tap3_1w_1u" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap3_1w_1u === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap7_1u_1v }}">
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
                                                        oninput="updateCharCount('	keterangan_nilai_tap7_1u_1v', 'charCountNilaiTap7UV')">{{ $trafo->keterangan_nilai_tap7_1u_1v }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap7_1u_1v"
                                                        name="kesesuaian_nilai_tap7_1u_1v" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap7_1u_1v === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap7_1v_1w }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap7_1v_1w', 'charCountNilaiTap7VW')">{{ $trafo->keterangan_nilai_tap7_1v_1w }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap7_1v_1w"
                                                        name="kesesuaian_nilai_tap7_1v_1w" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap7_1v_1w === 'yes' ? 'checked' : '' }}>
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
                                                        onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                        value="{{ $trafo->nilai_tap7_1w_1u }}">
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
                                                        oninput="updateCharCount('keterangan_nilai_tap7_1w_1u', 'charCountNilaiTap7WU')">{{ $trafo->keterangan_nilai_tap7_1w_1u }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_nilai_tap7_1w_1u"
                                                        name="kesesuaian_nilai_tap7_1w_1u" value="1"
                                                        {{ $trafo->kesesuaian_nilai_tap7_1w_1u === 'yes' ? 'checked' : '' }}>
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
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $trafo->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $trafo->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $trafo->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kesimpulan">Kesimpulan</label>
                                        <select class="form-control" id="kesimpulan" name="kesimpulan" required>
                                            <option value="">-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $trafo->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $trafo->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $trafo->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
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
                                @foreach ($gambar as $key => $img)
                                    @if ($key < 2)
                                        <div class="form-group">
                                            <label for="gambar{{ $key + 1 }}" style="display: block">Gambar
                                                {{ $key + 1 }}</label>
                                            <div id="preview{{ $key + 1 }}" class="mt-2">
                                                @if ($img)
                                                    <img src="{{ asset($img) }}"
                                                        alt="Gambar Evidence Trafo Distribusi {{ $key + 1 }}"
                                                        class="img-thumbnail preview-img" width="200"
                                                        onclick="openImageModal('{{ asset($img) }}')">
                                                @endif
                                            </div>
                                            <input type="file" name="gambar[{{ $key }}]"
                                                id="gambar{{ $key + 1 }}" accept="image/*"
                                                onchange="previewImage(event, 'preview{{ $key + 1 }}')">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                @foreach ($gambar as $key => $img)
                                    @if ($key >= 2)
                                        <div class="form-group">
                                            <label for="gambar{{ $key + 1 }}" style="display: block">Gambar
                                                {{ $key + 1 }}</label>
                                            <div id="preview{{ $key + 1 }}" class="mt-2">
                                                @if ($img)
                                                    <img src="{{ asset($img) }}"
                                                        alt="Gambar Evidence Trafo Distribusi {{ $key + 1 }}"
                                                        class="img-thumbnail preview-img" width="200"
                                                        onclick="openImageModal('{{ asset($img) }}')">
                                                @endif
                                            </div>
                                            <input type="file" name="gambar[{{ $key }}]"
                                                id="gambar{{ $key + 1 }}" accept="image/*"
                                                onchange="previewImage(event, 'preview{{ $key + 1 }}')">
                                        </div>
                                    @endif
                                @endforeach
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

                        <a href="{{ route('form-unapproved') }}" class="btn btn-secondary">Kembali</a>
                        @if (auth()->user()->hasRole('PIC_Gudang'))
                            <button type="submit" class="btn btn-primary">Setuju</button>
                        @else
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
</script>

{{-- JS untuk otomatisasi kesimpulan Trafo --}}
{{-- Jika pengguna adalah Admin atau PIC_Gudang, maka tidak ada batasan tampilan --}}
@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pastikan semua section form ditampilkan untuk PIC_Gudang tanpa kondisi
            document.querySelectorAll('.form-section').forEach(section => {
                section.style.display = "block";
            });

            // Pastikan sectionC selalu ditampilkan untuk Admin dan PIC_Gudang
            const sectionC = document.getElementById("sectionC");
            if (sectionC) {
                sectionC.style.display = "block";
            }
        });

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

        // Toast Notification untuk Submit Sukses
        document.getElementById('formInspeksi').addEventListener('submit', function(e) {
            // Jika form valid, tampilkan toast sukses
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                // Simpan data ke localStorage untuk menandai form telah disubmit
                localStorage.removeItem("formInspeksiData");

                // Tampilkan toast sukses
                toastr.success('Data berhasil disetujui!');
            }
        });
    </script>
@elseif (auth()->user()->hasRole('Petugas'))
    <style>
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

        // logika form v2
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");
            const sectionC = document.getElementById("sectionC");
            const kerusakan = document.getElementById("kerusakan");

            // Isi dropdown tahun produksi
            for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
                let option = new Option(tahun, tahun);
                selectTahun.appendChild(option);
            }

            // Inisialisasi Select2
            jQuery.noConflict();
            jQuery(document).ready(function($) {
                $('.select2').select2();

                // Event listener untuk Select2
                $(selectTahun).on('change.select2', function() {
                    hitungMasaPakai();
                });
            });

            // Hitung masa pakai
            function hitungMasaPakai() {
                const tahunProduksi = parseInt($(selectTahun).val()); // Menggunakan .val() dari jQuery
                const masaPakai = tahunSekarang - tahunProduksi;
                inputMasaPakai.value = masaPakai + " tahun";
                updateKesimpulan();
            }

            // Tampilkan/sembunyikan section C berdasarkan kondisi
            function toggleSectionC() {
                const poin3 = document.querySelector(".poin3").value; // Pengaman tekanan lebih
                const poin4 = document.querySelector(".poin4").value; // Kondisi tangki
                const poin5 = document.querySelector(".poin5").value; // Kondisi fisik bushing

                // Cek jika user adalah Admin atau PIC_Gudang
                const isAdminOrPICGudang = @json(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'));

                // Section C ditampilkan jika:
                // - User adalah Admin atau PIC_Gudang, ATAU
                // - Poin 3 = "Ada" dan Poin 4 = "Tidak ada" dan Poin 5 = "Tidak ada"
                if (sectionC) {
                    sectionC.style.display = (isAdminOrPICGudang || (poin3 === "Ada" && poin4 === "Tidak ada" &&
                            poin5 === "Tidak ada")) ?
                        "block" : "none";
                } else {
                    console.error("Elemen dengan ID 'sectionC' tidak ditemukan.");
                }
            }

            // Tampilkan/sembunyikan section kerusakan berdasarkan kondisi
            function toggleKerusakan() {
                const poin5 = document.querySelector(".poin5").value; // Kondisi fisik bushing
                const kerusakan = document.getElementById("kerusakan");

                // Cek apakah elemen kerusakan ada
                if (kerusakan) {
                    // Section kerusakan ditampilkan jika:
                    // - Poin 5 = "Ada"
                    kerusakan.style.display = (poin5 === "Ada") ? "block" : "none";
                } else {
                    console.error("Elemen dengan ID 'kerusakan' tidak ditemukan.");
                }
            }

            // Update kesimpulan
            function updateKesimpulan() {
                const masaPakai = parseInt(inputMasaPakai.value) || 0;
                const poin1 = document.querySelector(".poin1").value; // Nameplate
                const poin2 = document.querySelector(".poin2").value; // Penandaan terminal
                const poin3 = document.querySelector(".poin3").value; // Pengaman tekanan lebih
                const poin4 = document.querySelector(".poin4").value; // Kondisi tangki
                const poin5 = document.querySelector(".poin5").value; // Kondisi fisik bushing

                let kesimpulan = "Bekas tidak layak pakai (K8)";

                if (masaPakai <= 25) {
                    // Jika masa pakai <= 25 tahun
                    if (poin1 === "Ada" && poin2 === "Ada" && poin3 === "Ada" && poin4 === "Tidak ada" && poin5 ===
                        "Tidak ada") {
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
                document.getElementById("kesimpulan").value = kesimpulan;
            }

            // Event listeners
            document.querySelectorAll(".poin1, .poin2, .poin3, .poin4, .poin5").forEach(el => {
                el.addEventListener("change", () => {
                    toggleSectionC();
                    toggleKerusakan();
                    updateKesimpulan();
                });
            });

            // Toast Notification untuk Submit Sukses
            document.getElementById('formInspeksi').addEventListener('submit', function(e) {
                // Jika form valid, tampilkan toast sukses
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    // Simpan data ke localStorage untuk menandai form telah disubmit
                    localStorage.removeItem("formInspeksiData");

                    // Tampilkan toast sukses
                    toastr.success('Data berhasil diperbarui!');
                }
            });

            // Inisialisasi
            hitungMasaPakai();
            toggleKerusakan();
            toggleSectionC();
            updateKesimpulan();
        });
    </script>
@endif
<x-layouts.footer />
