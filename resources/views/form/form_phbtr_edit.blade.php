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
                    <form id="formInspeksi" action="{{ route('form-retur-phbtr.update', $phbtr->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

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
                                    <select name="gudang_id" class="form-control" id="gudang_id" required>
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
                                        value="{{ old('tgl_inspeksi', $phbtr->tgl_inspeksi) }}" readonly>
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
                                        id="lokasi_akhir_terpasang" placeholder="Masukkan Alamat"
                                        value="{{ old('lokasi_akhir_terpasang', $phbtr->lokasi_akhir_terpasang) }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select name="ulp_id" class="form-control" id="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                        @foreach ($ulps as $ulp)
                                            <option value="{{ $ulp->id }}"
                                                {{ old('ulp_id', $selectedUlpId ?? null) == $ulp->id ? 'selected' : '' }}>
                                                {{ $ulp->daerah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex gap-4 form-group">
                                    <div class="w-50">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            id="tahun_produksi" name="tahun_produksi" required>
                                            <option value="">-- Pilih Tahun --</option>
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('tahun_produksi', $phbtr->tahun_produksi ?? '') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai" placeholder="Masa Pakai"
                                            value="{{ old('masa_pakai', isset($phbtr->masa_pakai) ? $phbtr->masa_pakai . ' tahun' : '') }}"
                                            readonly>
                                        {{-- value="{{ old('masa_pakai', $phbtr->masa_pakai) }}" readonly> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_phbtr">Tipe PHBTR</label>
                                    <select name="tipe_phbtr" class="form-control select2" id="tipe_phbtr" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="PL-250-2-LBS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-250-2-LBS' ? 'selected' : '' }}>
                                            PL-250-2-LBS</option>
                                        <option value="PL-250-2-MCCB"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-250-2-MCCB' ? 'selected' : '' }}>
                                            PL-250-2-MCCB</option>
                                        <option value="PL-250-2-FS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-250-2-FS' ? 'selected' : '' }}>
                                            PL-250-2-FS</option>
                                        <option value="PL-400-2-LBS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-400-2-LBS' ? 'selected' : '' }}>
                                            PL-400-2-LBS</option>
                                        <option value="PL-400-2-MCCB"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-400-2-MCCB' ? 'selected' : '' }}>
                                            PL-400-2-MCCB</option>
                                        <option value="PL-400-2-FS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-400-2-FS' ? 'selected' : '' }}>
                                            PL-400-2-FS</option>
                                        <option value="PL-400-4-LBS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-400-4-LBS' ? 'selected' : '' }}>
                                            PL-400-4-LBS</option>
                                        <option value="PL-400-4-MCCB"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-400-4-MCCB' ? 'selected' : '' }}>
                                            PL-400-4-MCCB</option>
                                        <option value="PL-400-4-FS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-400-4-FS' ? 'selected' : '' }}>
                                            PL-400-4-FS</option>
                                        <option value="PL-4-LBS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-630-4-LBS' ? 'selected' : '' }}>
                                            PL-630-4-LBS</option>
                                        <option value="PL-4-MCCB"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-630-4-MCCB' ? 'selected' : '' }}>
                                            PL-630-4-MCCB</option>
                                        <option value="PL-4-FS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-630-4-FS' ? 'selected' : '' }}>
                                            PL-630-4-FS</option>
                                        <option value="PL-100-6-LBS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-100-6-LBS' ? 'selected' : '' }}>
                                            PL-100-6-LBS</option>
                                        <option value="PL-100-6-MCCB"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-100-6-MCCB' ? 'selected' : '' }}>
                                            PL-100-6-MCCB</option>
                                        <option value="PL-100-8-LBS"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-100-8-LBS' ? 'selected' : '' }}>
                                            PL-100-8-LBS</option>
                                        <option value="PL-100-8-MCCB"
                                            {{ old('tipe_phbtr', $phbtr->tipe_phbtr) == 'PL-100-8-MCCB' ? 'selected' : '' }}>
                                            PL-100-8-MCCB</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input name="no_serial" type="number" class="form-control" id="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $phbtr->no_serial) }}">
                                </div>
                                <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <select name="pabrikan_id" class="form-control" id="pabrikan_id" required>
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
                                        <select name="nameplate" id="nameplate" class="form-control poin1" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada"
                                                {{ old('nameplate', $phbtr->nameplate) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('nameplate', $phbtr->nameplate) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            oninput="updateCharCount('keteranganNameplate', 'charCountKeteranganNameplate')">{{ old('keteranganNameplate', $phbtr->keteranganNameplate) }}</textarea>
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
                                            <option value="Ada"
                                                {{ old('busbar_penyangga', $phbtr->busbar_penyangga) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('busbar_penyangga', $phbtr->busbar_penyangga) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada
                                            </option>
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
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganBusbar', 'charCountKeteranganBusbar')">{{ old('keteranganBusbar', $phbtr->keteranganBusbar) }}</textarea>
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
                                            <option value="Ada"
                                                {{ old('saklar_utama', $phbtr->saklar_utama) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('saklar_utama', $phbtr->saklar_utama) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            oninput="updateCharCount('keteranganSaklarUtama', 'charCountKeteranganSaklarUtama')">{{ old('keteranganSaklarUtama', $phbtr->keteranganSaklarUtama) }}</textarea>
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
                                            <option value="Ada"
                                                {{ old('nh_fuse', $phbtr->nh_fuse) == 'Ada' ? 'selected' : '' }}>Ada
                                            </option>
                                            <option value="Tidak ada"
                                                {{ old('nh_fuse', $phbtr->nh_fuse) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganNHFuse', 'charCountKeteranganNHFuse')">{{ old('keteranganNHFuse', $phbtr->keteranganNHFuse) }}</textarea>
                                        <small id="charCountKeteranganNHFuse" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fuse_rail">5. Fuse Rail</label>
                                    <div class="input-group">
                                        <select id="fuse_rail" name="fuse_rail" class="form-control poin5" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada"
                                                {{ old('fuse_rail', $phbtr->fuse_rail) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('fuse_rail', $phbtr->fuse_rail) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            oninput="updateCharCount('keteranganFuseRail', 'charCountKeteranganFuseRail')">{{ old('keteranganFuseRail', $phbtr->keteranganFuseRail) }}</textarea>
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
                                            <option value="Ada"
                                                {{ old('selungkup_phbtr', $phbtr->selungkup_phbtr) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('selungkup_phbtr', $phbtr->selungkup_phbtr) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
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
                                            oninput="updateCharCount('keteranganSelungkup', 'charCountKeteranganSelungkup')">{{ old('keteranganSelungkup', $phbtr->keteranganSelungkup) }}</textarea>
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
                                            min="1" value="{{ old('l1_phbtr', $phbtr->l1_phbtr) }}">
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
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL1PHBTR', 'charCountKeteranganL1PHBTR')">{{ old('keteranganL1PHBTR', $phbtr->keteranganL1PHBTR) }}</textarea>
                                        <small id="charCountKeteranganL1PHBTR" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="l2_phbtr">b) L2-(L1+L3+N+body)</label>
                                    <div class="input-group">
                                        <input id="l2_phbtr" name="l2_phbtr" type="number" class="form-control"
                                            min="1" value="{{ old('l2_phbtr', $phbtr->l2_phbtr) }}">
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
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL2PHBTR', 'charCountKeteranganL2PHBTR')">{{ old('keteranganL2PHBTR', $phbtr->keteranganL2PHBTR) }}</textarea>
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
                                            min="1" value="{{ old('l3_phbtr', $phbtr->l3_phbtr) }}">
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
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL3PHBTR', 'charCountKeteranganL3PHBTR')">{{ old('keteranganL3PHBTR', $phbtr->keteranganL3PHBTR) }}</textarea>
                                        <small id="charCountKeteranganL3PHBTR" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nphbtr">d) N-(L1+L2+L3+body)</label>
                                    <div class="input-group">
                                        <input name="nphbtr" type="number" class="form-control" id="nphbtr"
                                            min="1" value="{{ old('nphbtr', $phbtr->nphbtr) }}">
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
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganNPHBTR', 'charCountKeteranganNPHBTR')">{{ old('keteranganNPHBTR', $phbtr->keteranganNPHBTR) }}</textarea>
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
                                            <option value="Baik"
                                                {{ old('pengujian_mekanik1', $phbtr->pengujian_mekanik1) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Tidak baik"
                                                {{ old('pengujian_mekanik1', $phbtr->pengujian_mekanik1) == 'Tidak baik' ? 'selected' : '' }}>
                                                Tidak baik</option>
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
                                            oninput="updateCharCount('keteranganMekanik1', 'charCountKeteranganMekanik1')">{{ old('keteranganMekanik1', $phbtr->keteranganMekanik1) }}</textarea>
                                        <small id="charCountKeteranganMekanik1" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_mekanik2">b) Buka tutup pintu PHBTR untuk pasangan
                                        luar 5x</label>
                                    <div class="input-group">
                                        <select id="pengujian_mekanik2" name="pengujian_mekanik2"
                                            class="form-control" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Baik"
                                                {{ old('pengujian_mekanik2', $phbtr->pengujian_mekanik2) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Tidak baik"
                                                {{ old('pengujian_mekanik2', $phbtr->pengujian_mekanik2) == 'Tidak baik' ? 'selected' : '' }}>
                                                Tidak baik</option>
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
                                            oninput="updateCharCount('keteranganMekanik2', 'charCountKeteranganMekanik2')">{{ old('keteranganMekanik2', $phbtr->keteranganMekanik2) }}</textarea>
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
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $phbtr->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)"
                                                {{ old('kesimpulan', $phbtr->kesimpulan) == 'Bekas bisa diperbaiki (K7)' ? 'selected' : '' }}>
                                                Bekas bisa diperbaiki (K7)
                                            </option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $phbtr->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
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
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $phbtr->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)"
                                                {{ old('kesimpulan', $phbtr->kesimpulan) == 'Bekas bisa diperbaiki (K7)' ? 'selected' : '' }}>
                                                Bekas bisa diperbaiki (K7)
                                            </option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $phbtr->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
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
                                @foreach ($gambar as $key => $img)
                                    @if ($key < 2)
                                        <div class="form-group">
                                            <label for="gambar{{ $key + 1 }}" style="display: block">Gambar
                                                {{ $key + 1 }}</label>
                                            <div id="preview{{ $key + 1 }}" class="mt-2">
                                                @if ($img)
                                                    <img src="{{ asset($img) }}"
                                                        alt="Gambar Evidence PHBTR {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence PHBTR {{ $key + 1 }}"
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

                        @if (auth()->user()->hasRole('PIC_Gudang'))
                            <a href="{{ route('form-unapproved') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Setuju</button>
                        @elseif (auth()->user()->hasRole('Petugas'))
                            <a href="{{ route('form-unapproved') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        @else
                            <a href="{{ route('form-unapproved') }}" class="btn btn-secondary">Kembali</a>
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

@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
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
                    if (selectTahun.value) {
                        hitungMasaPakai();
                    }

                    selectTahun.addEventListener('change', function() {
                        hitungMasaPakai();
                        setTimeout(updateKesimpulan, 100);
                    })

                    // Inisialisasi Select2 jika belum
                    if ($(selectTahun).hasClass('select2-hidden-accessible') === false) {
                        $(selectTahun).select2();
                    }

                    // Kosongkan opsi yang sudah ada kecuali default
                    // while (selectTahun.options.length > 1) {
                    //     selectTahun.remove(1);
                    // }

                    // // Tambahkan opsi tahun
                    // for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
                    //     const option = new Option(tahun, tahun);
                    //     selectTahun.add(option);
                    // }

                    // Event listener untuk tahun produksi
                    // selectTahun.addEventListener('change', function() {
                    //     hitungMasaPakai();
                    //     setTimeout(updateKesimpulan, 100); // Delay kecil untuk Select2
                    // });
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
@elseif (auth()->user()->hasRole('Petugas'))
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
                    if (selectTahun.value) {
                        hitungMasaPakai();
                    }

                    selectTahun.addEventListener('change', function() {
                        hitungMasaPakai();
                        setTimeout(updateKesimpulan, 100);
                    })

                    // Inisialisasi Select2 jika belum
                    if ($(selectTahun).hasClass('select2-hidden-accessible') === false) {
                        $(selectTahun).select2();
                    }

                    // Kosongkan opsi yang sudah ada kecuali default
                    // while (selectTahun.options.length > 1) {
                    //     selectTahun.remove(1);
                    // }

                    // // Tambahkan opsi tahun
                    // for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
                    //     const option = new Option(tahun, tahun);
                    //     selectTahun.add(option);
                    // }

                    // Event listener untuk tahun produksi
                    // selectTahun.addEventListener('change', function() {
                    //     hitungMasaPakai();
                    //     setTimeout(updateKesimpulan, 100); // Delay kecil untuk Select2
                    // });
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
@endif

<x-layouts.footer />
