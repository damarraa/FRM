<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Fuse Cut Out</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-fco.update', $fco->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="8">
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
                                    <label for="tgl_inspeksi">Tgl Inspeksi</label>
                                    <input type="date" class="form-control" id="tgl_inspeksi" name="tgl_inspeksi"
                                        value="{{ old('tgl_inspeksi', $fco->tgl_inspeksi) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">A. Data Material</h6>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi_akhir_terpasang">Lokasi Akhir Terpasang</label>
                                    <input name="lokasi_akhir_terpasang" type="text" class="form-control"
                                        id="lokasi_akhir_terpasang" placeholder="Masukkan Alamat"
                                        value="{{ old('lokasi_akhir_terpasang', $fco->lokasi_akhir_terpasang) }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                        @foreach ($ulps as $ulp)
                                            <option value="{{ $ulp->id }}"
                                                {{ old('ulp_id', $selectedUlpId ?? null) == $ulp->id ? 'selected' : '' }}>
                                                {{ $ulp->daerah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-1/2">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            name="tahun_produksi" id="tahun_produksi" required>
                                            <option value="">-- Pilih Tahun --</option>
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('tahun_produksi', $selectedTahunProduksi ?? null) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-1/2">
                                        <label class="block mb-1" for="masa_pakai">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun sekarang - Tahun produksi"
                                            value="{{ old('masa_pakai', $fco->masa_pakai) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_fco">Tipe Fuse Cut Out</label>
                                    <div class="input-group">
                                        <select id="tipe_fco" name="tipe_fco" class="form-control" required>
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="Polymer"
                                                {{ old('tipe_fco', $fco->tipe_fco) == 'Polymer' ? 'selected' : '' }}>
                                                Polymer</option>
                                            <option value="Keramik"
                                                {{ old('tipe_fco', $fco->tipe_fco) == 'Keramik' ? 'selected' : '' }}>
                                                Keramik</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <div class="input-group">
                                        <input name="no_serial" type="number" class="form-control" id="no_serial"
                                            placeholder="Masukkan No Serial"
                                            value="{{ old('no_serial', $fco->no_serial) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <div class="input-group">
                                        <select id="pabrikan_id" name="pabrikan_id" class="form-control" required>
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
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Penandaan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penandaan_fuse">1. Penandaan Pada Fuse Base</label>
                                    <div class="input-group">
                                        <select id="penandaan_fuse" name="penandaan_fuse" class="form-control poinB1"
                                            required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Ada"
                                                {{ old('penandaan_fuse', $fco->penandaan_fuse) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('penandaan_fuse', $fco->penandaan_fuse) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('penandaan_base')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="penandaan_base" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganPenandaanFuse">Keterangan Fuse Base:</label>
                                        <textarea class="form-control" id="keteranganPenandaanFuse" name="keteranganPenandaanFuse" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganPenandaanFuse', 'charCountKeteranganPenandaanFuse')">{{ old('keteranganPenandaanFuse', $fco->keteranganPenandaanFuse) }}</textarea>
                                        <small id="charCountKeteranganPenandaanFuse" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penandaan_carrier">2. Penandaan Pada Fuse Carrier</label>
                                    <div class="input-group">
                                        <select id="penandaan_carrier" name="penandaan_carrier"
                                            class="form-control poinB2" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Ada"
                                                {{ old('penandaan_carrier', $fco->penandaan_carrier) == 'Ada' ? 'selected' : '' }}>
                                                Ada</option>
                                            <option value="Tidak ada"
                                                {{ old('penandaan_carrier', $fco->penandaan_carrier) == 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPenandaanCarrier')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPenandaanCarrier" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganPenandaanCarrier">Keterangan Fuse Carrier:</label>
                                        <textarea class="form-control" id="keteranganPenandaanCarrier" name="keteranganPenandaanCarrier" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganPenandaanCarrier', 'charCountKeteranganPenandaanCarrier')">{{ old('keteranganPenandaanCarrier', $fco->keteranganPenandaanCarrier) }}</textarea>
                                        <small id="charCountKeteranganPenandaanCarrier" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">C. Pemeriksaan Konstruksi dan Kelengkapan Komponen</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Kolom Kiri -->
                                <div>
                                    <label>1. Bagian Utama Fuse Cut Out:</label>
                                    <br>
                                    <label>a. Fuse Holder, Terdiri Dari:</label>
                                    <div class="form-group">
                                        <label for="fuse_base" class="block text-sm">Fuse Base</label>
                                        <div class="input-group">
                                            <select id="fuse_base" name="fuse_base" class="form-control poinC1a">
                                                <option value="">-- Pilih Kondisi --</option>
                                                <option value="Baik"
                                                    {{ old('fuse_base', $fco->fuse_base) == 'Baik' ? 'selected' : '' }}>
                                                    Baik</option>
                                                <option value="Rusak"
                                                    {{ old('fuse_base', $fco->fuse_base) == 'Rusak' ? 'selected' : '' }}>
                                                    Rusak</option>
                                            </select>
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('fuse_holder_base')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="fuse_holder_base" class="form-group mt-2" style="display: none;">
                                            <label for="keteranganFuseBase">Keterangan Fuse Base:</label>
                                            <textarea class="form-control" id="keteranganFuseBase" name="keteranganFuseBase" rows="2" maxlength="55"
                                                placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keteranganFuseBase', 'charCountKeteranganFuseBase')">{{ old('keteranganFuseBase', $fco->keteranganFuseBase) }}</textarea>
                                            <small id="charCountKeteranganFuseBase" class="text-muted">55 karakter
                                                tersisa.</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fuse_carrier" class="block text-sm">Fuse Carrier</label>
                                        <div class="input-group">
                                            <select id="fuse_carrier" name="fuse_carrier"
                                                class="form-control poinC1aa">
                                                <option value="">-- Pilih Kondisi --</option>
                                                <option value="Baik"
                                                    {{ old('fuse_carrier', $fco->fuse_carrier) == 'Baik' ? 'selected' : '' }}>
                                                    Baik</option>
                                                <option value="Rusak"
                                                    {{ old('fuse_carrier', $fco->fuse_carrier) == 'Rusak' ? 'selected' : '' }}>
                                                    Rusak</option>
                                            </select>
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('fuse_holder_carrier')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="fuse_holder_carrier" class="form-group mt-2" style="display: none;">
                                            <label for="keteranganFuseCarrier">Keterangan Fuse Carrier:</label>
                                            <textarea class="form-control" id="keteranganFuseCarrier" name="keteranganFuseCarrier" rows="2"
                                                maxlength="55" placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keteranganFuseCarrier', 'charCountFuseCarrier')">{{ old('keteranganFuseCarrier', $fco->keteranganFuseCarrier) }}</textarea>
                                            <small id="charCountFuseCarrier" class="text-muted">55 karakter
                                                tersisa.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <br>
                                <label>b. Bracket:</label>
                                <div class="form-group">
                                    <label for="bracket" class="block text-sm">Bracket</label>
                                    <div class="input-group">
                                        <select id="bracket" name="bracket" class="form-control poinC1b">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('bracket', $fco->bracket) == 'Baik' ? 'selected' : '' }}>Baik
                                            </option>
                                            <option value="Rusak"
                                                {{ old('bracket', $fco->bracket) == 'Rusak' ? 'selected' : '' }}>Rusak
                                            </option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('bracket_keterangan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="bracket_keterangan" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganBracket">Keterangan Bracket:</label>
                                        <textarea class="form-control" id="keteranganBracket" name="keteranganBracket" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganBracket', 'charCountKeteranganBracket')">{{ old('keteranganBracket', $fco->keteranganBracket) }}</textarea>
                                        <small id="charCountKeteranganBracket" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Kolom Kiri -->
                                <div class="form-group">
                                    <label for="mekanisme_kontak">2. Mekanisme Kontak (Posisi Kontak Antara Fuse
                                        Carrier Dengan Fuse Base)</label>
                                    <div class="input-group">
                                        <select id="mekanisme_kontak" name="mekanisme_kontak"
                                            class="form-control poinC2">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('mekanisme_kontak', $fco->mekanisme_kontak) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('mekanisme_kontak', $fco->mekanisme_kontak) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('mekanisme_kontak_keterangan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="mekanisme_kontak_keterangan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganMekanismeKontak">Keterangan Mekanisme Kontak:</label>
                                        <textarea class="form-control" id="keteranganMekanismeKontak" name="keteranganMekanismeKontak" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganMekanismeKontak', 'charCountKeteranganMekanismeKontak')">{{ old('keteranganMekanismeKontak', $fco->keteranganMekanismeKontak) }}</textarea>
                                        <small id="charCountKeteranganMekanismeKontak" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_fuse_base">3. Fuse Base</label>
                                    <div class="input-group">
                                        <select id="kondisi_fuse_base" name="kondisi_fuse_base"
                                            class="form-control poinC3">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_fuse_base', $fco->kondisi_fuse_base) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_fuse_base', $fco->kondisi_fuse_base) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('kondisi_fuse_base_keterangan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="kondisi_fuse_base_keterangan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganKondisiFuseBase">Keterangan Fuse Base:</label>
                                        <textarea class="form-control" id="keteranganKondisiFuseBase" name="keteranganKondisiFuseBase" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiFuseBase', 'charCountKeteranganKondisiFuseBase')">{{ old('keteranganKondisiFuseBase', $fco->keteranganKondisiFuseBase) }}</textarea>
                                        <small id="charCountKeteranganKondisiFuseBase" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_insulator">4. Kondisi Insulator (Bebas Retak dan Rongga
                                        (Void))</label>
                                    <div class="input-group">
                                        <select id="kondisi_insulator" name="kondisi_insulator"
                                            class="form-control poinC4">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_insulator', $fco->kondisi_insulator) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_insulator', $fco->kondisi_insulator) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('kondisi_insulator_keterangan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="kondisi_insulator_keterangan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganKondisiInsulator">Keterangan Kondisi Insulator:</label>
                                        <textarea class="form-control" id="keteranganKondisiInsulator" name="keteranganKondisiInsulator" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiInsulator', 'charCountKeteranganKondisiInsulator')">{{ old('keteranganKondisiInsulator', $fco->keteranganKondisiInsulator) }}</textarea>
                                        <small id="charCountKeteranganKondisiInsulator" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Kolom Kanan -->
                                <div class="form-group">
                                    <label for="kondisi_bracket">5. Bracket</label>
                                    <div class="input-group">
                                        <select id="kondisi_bracket" name="kondisi_bracket"
                                            class="form-control poinC5">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_bracket', $fco->kondisi_bracket) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_bracket', $fco->kondisi_bracket) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('kondisi_bracket_keterangan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="kondisi_bracket_keterangan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganKondisiBracket">Keterangan Kondisi Bracket:</label>
                                        <textarea class="form-control" id="keteranganKondisiBracket" name="keteranganKondisiBracket" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiBracket', 'charCountKeteranganKondisiBracket')">{{ old('keteranganKondisiBracket', $fco->keteranganKondisiBracket) }}</textarea>
                                        <small id="charCountKeteranganKondisiBracket" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_fuse_carrier">6. Fuse Carrier <i>(Terdiri Dari Tabung Pelebur,
                                            Konektor Tabung Pelebur, Kepala Tabung, Trunnion)</i></label>
                                    <div class="input-group">
                                        <select id="kondisi_fuse_carrier" name="kondisi_fuse_carrier"
                                            class="form-control poinC6">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_fuse_carrier', $fco->kondisi_fuse_carrier) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_fuse_carrier', $fco->kondisi_fuse_carrier) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('kondisi_fuse_carrier_keterangan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="kondisi_fuse_carrier_keterangan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganKondisiFuseCarrier">Keterangan Kondisi Fuse
                                            Carrier:</label>
                                        <textarea class="form-control" id="keteranganKondisiFuseCarrier" name="keteranganKondisiFuseCarrier" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiFuseCarrier', 'charCountKeteranganKondisiFuseCarrier')">{{ old('keteranganKondisiFuseCarrier', $fco->keteranganKondisiFuseCarrier) }}</textarea>
                                        <small id="charCountKeteranganKondisiFuseCarrier" class="text-muted">55
                                            karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p class="text-sm-left mb-3">Keterangan:
                                    <br> a. Jika item mandatory poin C (1 s.d 5) ada yang tidak sesuai maka pengujian
                                    poin D tidak perlu dilakukan
                                    <br> b. Poin 6 dapat diperbaiki/diganti.
                                </p>
                            </div>
                        </div>
                        <div class="row" id="sectionD">
                            <hr class="mb-3">
                            <h6 class="mb-3 font-weight-bold">D. Pengujian Elektrik</h6>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uji_tahanan_isolasi">1. Uji Tahanan Isolasi (Persyaratan > 20
                                        MΩ)</label>
                                    <div class="input-group">
                                        <input name="uji_tahanan_isolasi" type="number" class="form-control poinD"
                                            id="uji_tahanan_isolasi" placeholder="Hasil Pengujian"
                                            value="{{ old('uji_tahanan_isolasi', $fco->uji_tahanan_isolasi) }}">
                                        <span class="input-group-text" id="basic-addon2">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keterangan_uji_tahanan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keterangan_uji_tahanan" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_uji_tahanan">Keterangan Pengujian:</label>
                                        <textarea class="form-control" id="keterangan_uji_tahanan" name="keterangan_uji_tahanan" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_uji_tahanan', 'charCountKeteranganUjiTahanan')">{{ old('keterangan_uji_tahanan', $fco->keterangan_uji_tahanan) }}</textarea>
                                        <small id="charCountKeteranganUjiTahanan" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji Poin D adalah
                                Mandatory.</p>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">E. Kesimpulan</h6>
                        <div class="row">
                            @if (auth()->user()->hasRole('Petugas'))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kesimpulan">Kesimpulan</label>
                                        <select class="form-control" id="kesimpulan" name="kesimpulan" required
                                            readonly>
                                            <option value="">-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $fco->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)"
                                                {{ old('kesimpulan', $fco->kesimpulan) == 'Bekas bisa diperbaiki (K7)' ? 'selected' : '' }}>
                                                Bekas bisa diperbaiki (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $fco->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
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
                                                {{ old('kesimpulan', $fco->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)"
                                                {{ old('kesimpulan', $fco->kesimpulan) == 'Bekas bisa diperbaiki (K7)' ? 'selected' : '' }}>
                                                Bekas bisa diperbaiki (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $fco->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <hr class="mb-3">
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
                                                        alt="Gambar Evidence Fuse Cut Out {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence Fuse Cut Out {{ $key + 1 }}"
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById("tahun_produksi");
        const inputMasaPakai = document.getElementById("masa_pakai");
        const kesimpulanDropdown = document.getElementById('kesimpulan');
        const sectionD = document.getElementById("sectionD");

        // Generate tahun dari 1980 hingga tahun sekarang
        for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }

        // Inisialisasi Select2 menggunakan jQuery
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $(selectTahun).select2().on("change", hitungMasaPakai);
        });

        // Hitung masa pakai
        function hitungMasaPakai() {
            const tahunPemasangan = parseInt(selectTahun.value);
            if (!isNaN(tahunPemasangan)) {
                const masaPakai = tahunSekarang - tahunPemasangan;
                inputMasaPakai.value = masaPakai + " tahun";

                // Update warna berdasarkan masa pakai
                if (masaPakai < 3) {
                    inputMasaPakai.classList.remove("text-yellow-600", "text-red-600");
                    inputMasaPakai.classList.add("text-green-600");
                } else if (masaPakai >= 3 && masaPakai <= 6) {
                    inputMasaPakai.classList.remove("text-green-600", "text-red-600");
                    inputMasaPakai.classList.add("text-yellow-600");
                } else {
                    inputMasaPakai.classList.remove("text-green-600", "text-yellow-600");
                    inputMasaPakai.classList.add("text-red-600");
                }

                updateKesimpulan(); // Panggil fungsi updateKesimpulan
            } else {
                inputMasaPakai.value = ""; // Kosongkan jika tahun tidak valid
            }
        }

        // Cek kelayakan section C
        function cekKondisiC() {
            const mandatoryC = [
                '.poinC1a', '.poinC1aa', '.poinC1b',
                '.poinC2', '.poinC3', '.poinC4', '.poinC5'
            ].map(selector =>
                document.querySelector(selector)?.value === 'Baik'
            );

            const semuaBaik = mandatoryC.every(status => status);
            sectionD.style.display = semuaBaik ? 'block' : 'none';

            if (!semuaBaik) {
                document.querySelector('.poinD').value = '';
            }

            return semuaBaik;
        }

        // Update kesimpulan
        function updateKesimpulan() {
            const masaPakai = parseInt(inputMasaPakai.value) || 0;
            const kondisiCValid = cekKondisiC();

            const poinB1 = document.querySelector(".poinB1")?.value || "";
            const poinB2 = document.querySelector(".poinB2")?.value || "";
            const poinC6 = document.querySelector(".poinC6")?.value || "";
            const poinD = parseFloat(document.querySelector(".poinD")?.value || 0);

            let kesimpulan = "Bekas tidak layak pakai (K8)";

            // Logika baru dengan mempertimbangkan kondisiCValid
            if (kondisiCValid) {
                if (masaPakai <= 40) {
                    if (poinB1 === "Ada" && poinB2 === "Ada" &&
                        poinC6 === "Baik" && poinD > 20) {
                        kesimpulan = "Bekas layak pakai (K6)";
                    } else {
                        kesimpulan = "Bekas bisa diperbaiki (K7)";
                    }
                } else {
                    if (poinB1 === "Ada" && poinB2 === "Ada" &&
                        poinC6 === "Baik" && poinD > 20) {
                        kesimpulan = "Bekas bisa diperbaiki (K7)";
                    }
                }
            } else {
                kesimpulan = "Bekas tidak layak pakai (K8)";
            }

            // Set nilai kesimpulan dan nonaktifkan dropdown
            kesimpulanDropdown.value = kesimpulan;
            // kesimpulanDropdown.disabled = true; // Mencegah perubahan manual
        }

        // Event listeners
        const allInputs = [
            '.poinB1', '.poinB2',
            '.poinC1a', '.poinC1aa', '.poinC1b',
            '.poinC2', '.poinC3', '.poinC4', '.poinC5',
            '.poinC6', '.poinD', selectTahun
        ];

        allInputs.forEach(selector => {
            const el = typeof selector === 'string' ?
                document.querySelector(selector) :
                selector;
            el?.addEventListener("change", updateKesimpulan);
        });

        @if (auth()->user()->hasRole('Admin'))
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
        @elseif (auth()->user()->hasRole('PIC_Gudang'))
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
        @endif

        // Inisialisasi awal
        hitungMasaPakai();
        cekKondisiC();
        updateKesimpulan();
    });
</script>

<x-layouts.footer />
