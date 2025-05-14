<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Trafo Arus (CT)</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" name="formInspeksi"
                        action="{{ route('form-retur-ct.update', $trafo_arus->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Bagian Unit, Gudang, dan Tanggal -->
                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="12">
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
                                        <option value="">-- Pilih Gudang --</option>
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
                                    <label for="tgl_inspeksi">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl_inspeksi" name="tgl_inspeksi"
                                        value="{{ old('tgl_inspeksi', $trafo_arus->tgl_inspeksi) }}" readonly>
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
                                        value="{{ old('lokasi_akhir_terpasang', $trafo_arus->lokasi_akhir_terpasang) }}"
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
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            id="tahun_produksi" name="tahun_produksi" required>
                                            <option value="">-- Pilih Tahun --</option>
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('tahun_produksi', $selectedTahunProduksi) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun sekarang - Tahun produksi"
                                            value="{{ old('masa_pakai', $trafo_arus->masa_pakai) }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tipe_trafo_arus">Tipe Trafo Arus</label>
                                    <select class="form-control" id="tipe_trafo_arus" name="tipe_trafo_arus" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="Indoor"
                                            {{ old('tipe_trafo_arus', $trafo_arus->tipe_trafo_arus) == 'Indoor' ? 'selected' : '' }}>
                                            Indoor</option>
                                        <option value="Outdoor"
                                            {{ old('tipe_trafo_arus', $trafo_arus->tipe_trafo_arus) == 'Outdoor' ? 'selected' : '' }}>
                                            Outdoor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="text" class="form-control" id="no_serial" name="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $trafo_arus->no_serial) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                <div class="form-group">
                                    <label for="rasio">Rasio</label>
                                    <select class="form-control" id="rasio" name="rasio" required>
                                        <option value="">-- Pilih Rasio --</option>
                                        <option value="Rasio 50/5A"
                                            {{ old('rasio', $trafo_arus->rasio) == 'Rasio 50/5A' ? 'selected' : '' }}>
                                            Rasio 50/5A</option>
                                        <option value="Rasio 100/5A"
                                            {{ old('rasio', $trafo_arus->rasio) == 'Rasio 100/5A' ? 'selected' : '' }}>
                                            Rasio 100/5A</option>
                                        <option value="Rasio 200/5A"
                                            {{ old('rasio', $trafo_arus->rasio) == 'Rasio 200/5A' ? 'selected' : '' }}>
                                            Rasio 200/5A</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_pengukuran">Kelas Pengukuran</label>
                                    <select class="form-control" id="kelas_pengukuran" name="kelas_pengukuran"
                                        required>
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="Kelas 0.1"
                                            {{ old('kelas_pengukuran', $trafo_arus->kelas_pengukuran) == 'Kelas 0.1' ? 'selected' : '' }}>
                                            Kelas 0.1</option>
                                        <option value="Kelas 0.2"
                                            {{ old('kelas_pengukuran', $trafo_arus->kelas_pengukuran) == 'Kelas 0.2' ? 'selected' : '' }}>
                                            Kelas 0.2</option>
                                        <option value="Kelas 0.5"
                                            {{ old('kelas_pengukuran', $trafo_arus->kelas_pengukuran) == 'Kelas 0.5' ? 'selected' : '' }}>
                                            Kelas 0.5</option>
                                        <option value="Kelas 1"
                                            {{ old('kelas_pengukuran', $trafo_arus->kelas_pengukuran) == 'Kelas 1' ? 'selected' : '' }}>
                                            Kelas 1</option>
                                        <option value="Kelas 3"
                                            {{ old('kelas_pengukuran', $trafo_arus->kelas_pengukuran) == 'Kelas 3' ? 'selected' : '' }}>
                                            Kelas 3</option>
                                        <option value="Kelas 5"
                                            {{ old('kelas_pengukuran', $trafo_arus->kelas_pengukuran) == 'Kelas 5' ? 'selected' : '' }}>
                                            Kelas 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_proteksi">Kelas Proteksi</label>
                                    <select class="form-control" id="kelas_proteksi" name="kelas_proteksi" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="Kelas 5P"
                                            {{ old('kelas_proteksi', $trafo_arus->kelas_proteksi) == 'Kelas 5P' ? 'selected' : '' }}>
                                            Kelas 5P</option>
                                        <option value="Kelas 10P"
                                            {{ old('kelas_proteksi', $trafo_arus->kelas_proteksi) == 'Kelas 10P' ? 'selected' : '' }}>
                                            Kelas 10P</option>
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
                                    <label for="retak_pada_resin">1. Retak pada resin</label>
                                    <select class="form-control" id="retak_pada_resin" name="retak_pada_resin"
                                        required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('retak_pada_resin', $trafo_arus->retak_pada_resin) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('retak_pada_resin', $trafo_arus->retak_pada_resin) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nameplate">2. Nameplate</label>
                                    <select class="form-control" id="nameplate" name="nameplate" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('nameplate', $trafo_arus->nameplate) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('nameplate', $trafo_arus->nameplate) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penandaan_terminal">3. Penandaan terminal primer dan sekunder</label>
                                    <select class="form-control" id="penandaan_terminal" name="penandaan_terminal"
                                        required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('penandaan_terminal', $trafo_arus->penandaan_terminal) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('penandaan_terminal', $trafo_arus->penandaan_terminal) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelengkapan_baut_primer">4. Kelengkapan baut terminal primer</label>
                                    <select class="form-control" id="kelengkapan_baut_primer"
                                        name="kelengkapan_baut_primer" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('kelengkapan_baut_primer', $trafo_arus->kelengkapan_baut_primer) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('kelengkapan_baut_primer', $trafo_arus->kelengkapan_baut_primer) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelengkapan_baut_sekunder">5. Kelengkapan baut terminal
                                        sekunder</label>
                                    <select class="form-control" id="kelengkapan_baut_sekunder"
                                        name="kelengkapan_baut_sekunder" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('kelengkapan_baut_sekunder', $trafo_arus->kelengkapan_baut_sekunder) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('kelengkapan_baut_sekunder', $trafo_arus->kelengkapan_baut_sekunder) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cover_terminal">6. Cover terminal sekunder</label>
                                    <select class="form-control" id="cover_terminal" name="cover_terminal" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('cover_terminal', $trafo_arus->cover_terminal) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('cover_terminal', $trafo_arus->cover_terminal) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan:
                                <br> a. Jika item mandatory poin B (1,2,3,6) ada yang tidak sesuai maka pengujianpoin C
                                tidak perlu dilakukan
                                <br> b. Poin 4 dan 5 dapat diperbaiki menggunakan baut baru yang sesuai ukuran
                            </p>
                        </div>

                        <hr class="mb-3">
                        <!-- Bagian C: Pengujian Elektrik -->
                        <div id="sectionC" style="display: none;">
                            <h6 class="mb-3 font-weight-bold">C. Pengujian Elektrik</h6>
                            <h6 class="mb-3">1. Pengujian Tahanan Isolasi (>20 M OHM)</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nilai_pengujian_primer">a) Primer - (sekunder + ground)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="nilai_pengujian_primer"
                                                name="nilai_pengujian_primer" min="0" step="0.01"
                                                title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                value="{{ old('nilai_pengujian_primer', $trafo_arus->nilai_pengujian_primer) }}">
                                            <span class="input-group-text">MΩ</span>
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('keteranganNilaiPengujianPrimer')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="keteranganNilaiPengujianPrimer" class="form-group mt-2"
                                            style="display: none;">
                                            <label for="keterangan_nilai_pengujian_primer">Keterangan Pengujian Tahanan
                                                Isolasi Primer:
                                            </label>
                                            <textarea class="form-control" id="keterangan_nilai_pengujian_primer" name="keterangan_nilai_pengujian_primer"
                                                rows="2" maxlength="55" placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keterangan_nilai_pengujian_primer', 'charCountNilaiPengujianPrimer')">{{ old('keterangan_nilai_pengujian_primer', $trafo_arus->keterangan_nilai_pengujian_primer) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nilai_pengujian_sekunder">b) Sekunder - (primer + ground)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="nilai_pengujian_sekunder"
                                                name="nilai_pengujian_sekunder" min="0" step="0.01"
                                                title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                value="{{ old('nilai_pengujian_sekunder', $trafo_arus->nilai_pengujian_sekunder) }}">
                                            <span class="input-group-text">MΩ</span>
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('keteranganNilaiPengujianSekunder')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="keteranganNilaiPengujianSekunder" class="form-group mt-2"
                                            style="display: none;">
                                            <label for="keterangan_nilai_pengujian_sekunder">Keterangan Pengujian
                                                Tahanan
                                                Isolasi Sekunder:
                                            </label>
                                            <textarea class="form-control" id="keterangan_nilai_pengujian_sekunder" name="keterangan_nilai_pengujian_sekunder"
                                                rows="2" maxlength="55" placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keterangan_nilai_pengujian_sekunder', 'charCountNilaiPengujianSekunder')">{{ old('keterangan_nilai_pengujian_sekunder', $trafo_arus->keterangan_nilai_pengujian_sekunder) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="mb-3">2. Akurasi Trafo Arus</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="batas_kesalahan">a) Batas Kesalahan</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="batas_kesalahan"
                                                name="batas_kesalahan" min="0" step="0.01"
                                                title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                                onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                value="{{ old('batas_kesalahan', $trafo_arus->batas_kesalahan) }}">
                                            <span class="input-group-text">%</span>
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('keteranganPengujianBatasKesalahan')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="keteranganPengujianBatasKesalahan" class="form-group mt-2"
                                            style="display: none;">
                                            <label for="keterangan_batas_kesalahan">Keterangan Batas Kesalahan:
                                            </label>
                                            <textarea class="form-control" id="keterangan_batas_kesalahan" name="keterangan_batas_kesalahan" rows="2"
                                                maxlength="55" placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keterangan_batas_kesalahan', 'charCountBatasKesalahan')">{{ old('keterangan_batas_kesalahan', $trafo_arus->keterangan_batas_kesalahan) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas_akurasi">Kelas Akurasi</label>
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <select class="form-control" id="kelas_akurasi" name="kelas_akurasi">
                                                    <option value="">-- Pilih Akurasi --</option>
                                                    <option value="Kelas 0,1"
                                                        {{ old('kelas_akurasi', $trafo_arus->kelas_akurasi) == 'Kelas 0,1' ? 'selected' : '' }}>
                                                        Kelas 0,1</option>
                                                    <option value="Kelas 0,2"
                                                        {{ old('kelas_akurasi', $trafo_arus->kelas_akurasi) == 'Kelas 0,2' ? 'selected' : '' }}>
                                                        Kelas 0,2</option>
                                                    <option value="Kelas 0,5"
                                                        {{ old('kelas_akurasi', $trafo_arus->kelas_akurasi) == 'Kelas 0,5' ? 'selected' : '' }}>
                                                        Kelas 0,5</option>
                                                    <option value="Kelas 1,0"
                                                        {{ old('kelas_akurasi', $trafo_arus->kelas_akurasi) == 'Kelas 1,0' ? 'selected' : '' }}>
                                                        Kelas 1,0</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kesesuaian_batas_kesalahan"
                                                        name="kesesuaian_batas_kesalahan" value="1"
                                                        {{ $trafo_arus->kesesuaian_batas_kesalahan === 'yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="kesesuaian_batas_kesalahan">Sesuai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin C adalah
                                    mandatory.</p>
                            </div>

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
                                                {{ old('kesimpulan', $trafo_arus->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $trafo_arus->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $trafo_arus->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
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
                                                {{ old('kesimpulan', $trafo_arus->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $trafo_arus->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $trafo_arus->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
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
                                                        alt="Gambar Evidence Trafo Arus (CT) {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence Trafo Arus (CT) {{ $key + 1 }}"
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

                        <!-- Modal Bootstrap -->
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

@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");
            const sectionC = document.getElementById("sectionC");

            // Poin B
            const retakResin = document.getElementById("retak_pada_resin"); // Poin 1
            const nameplate = document.getElementById("nameplate"); // Poin 2
            const penandaanTerminal = document.getElementById("penandaan_terminal"); // Poin 3
            const bautPrimer = document.getElementById("kelengkapan_baut_primer"); // Poin 4
            const bautSekunder = document.getElementById("kelengkapan_baut_sekunder"); // Poin 5
            const coverSekunder = document.getElementById("cover_terminal"); // Poin 6

            // Poin C
            const primerSekunderGround = document.getElementById("nilai_pengujian_primer");
            const sekunderPrimerGround = document.getElementById("nilai_pengujian_sekunder");
            const batasKesalahan = document.getElementById("batas_kesalahan");
            const kelasAkurasi = document.getElementById("kelas_akurasi");

            const kesimpulan = document.getElementById("kesimpulan");

            // Isi dropdown tahun produksi dari 1980 hingga tahun sekarang
            for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
                let option = new Option(tahun, tahun);
                selectTahun.appendChild(option);
            }

            // Inisialisasi Select2 menggunakan jQuery
            jQuery.noConflict();
            jQuery(document).ready(function($) {
                $(selectTahun).select2();

                // Event listener untuk Select2
                $(selectTahun).on('change', function() {
                    hitungMasaPakai();
                });
            });

            // Fungsi untuk menghitung masa pakai
            function hitungMasaPakai() {
                const tahunProduksi = parseInt(selectTahun.value);
                if (!isNaN(tahunProduksi)) {
                    inputMasaPakai.value = (tahunSekarang - tahunProduksi) + " tahun";
                    updateKesimpulan();
                } else {
                    inputMasaPakai.value = ""; // Kosongkan jika tahun tidak valid
                }
            }
            // Tampilkan/sembunyikan section C berdasarkan kondisi
            function toggleSectionC() {
                const kondisiRetakResin = retakResin.value;
                const kondisiNameplate = nameplate.value;
                const kondisiPenandaanTerminal = penandaanTerminal.value;
                const kondisiCoverSekunder = coverSekunder.value;

                // Section C ditampilkan jika:
                // - Retak pada resin = "Tidak ada"
                // - Nameplate = "Ada"
                // - Penandaan terminal = "Ada"
                // - Cover terminal sekunder = "Ada"
                sectionC.style.display = (
                    kondisiRetakResin === "Tidak ada" &&
                    kondisiNameplate === "Ada" &&
                    kondisiPenandaanTerminal === "Ada" &&
                    kondisiCoverSekunder === "Ada"
                ) ? "block" : "none";
            }

            // Cek apakah ada kerusakan di poin mandatory (1, 2, 3, 6 di B atau C)
            function cekKerusakanMandatory() {
                const kondisiRetakResin = retakResin.value; // Poin 1
                const kondisiNameplate = nameplate.value; // Poin 2
                const kondisiPenandaanTerminal = penandaanTerminal.value; // Poin 3
                const kondisiCoverSekunder = coverSekunder.value; // Poin 6

                // Jika ada kerusakan di poin mandatory B
                if (
                    kondisiRetakResin === "Ada" || // Poin 1
                    kondisiNameplate === "Tidak ada" || // Poin 2
                    kondisiPenandaanTerminal === "Tidak ada" || // Poin 3
                    kondisiCoverSekunder === "Tidak ada" // Poin 6
                ) {
                    return true; // Ada kerusakan
                }

                // Jika Section C ditampilkan, cek juga poin C
                if (sectionC.style.display === "block") {
                    const kondisiPrimerSekunderGround = parseFloat(primerSekunderGround.value);
                    const kondisiSekunderPrimerGround = parseFloat(sekunderPrimerGround.value);
                    const kondisiBatasKesalahan = parseFloat(batasKesalahan.value);
                    const kondisiKelasAkurasi = kelasAkurasi.value;

                    // Jika ada yang tidak valid di Poin C
                    if (
                        isNaN(kondisiPrimerSekunderGround) || // Primer - (sekunder + ground)
                        isNaN(kondisiSekunderPrimerGround) || // Sekunder - (primer + ground)
                        isNaN(kondisiBatasKesalahan) || // Batas Kesalahan
                        kondisiKelasAkurasi === "" // Kelas Akurasi
                    ) {
                        return true; // Ada kerusakan
                    }
                }

                return false; // Tidak ada kerusakan
            }

            // Update kesimpulan dan catatan perbaikan
            function updateKesimpulan() {
                const masaPakai = parseInt(inputMasaPakai.value) || 0;

                // Jika ada kerusakan di poin mandatory, langsung K8
                if (cekKerusakanMandatory()) {
                    kesimpulan.value = "Bekas tidak layak pakai (K8)";
                    return;
                }

                // Jika masa pakai > 40 tahun, langsung K8
                if (masaPakai > 40) {
                    kesimpulan.value = "Bekas tidak layak pakai (K8)";
                    return;
                }

                // Jika masa pakai <= 40 tahun
                if (masaPakai <= 40) {
                    // Periksa Poin B dan C
                    const kondisiRetakResin = retakResin.value;
                    const kondisiNameplate = nameplate.value;
                    const kondisiPenandaanTerminal = penandaanTerminal.value;
                    const kondisiCoverSekunder = coverSekunder.value;

                    const kondisiPrimerSekunderGround = parseFloat(primerSekunderGround.value);
                    const kondisiSekunderPrimerGround = parseFloat(sekunderPrimerGround.value);
                    const kondisiBatasKesalahan = parseFloat(batasKesalahan.value);
                    const kondisiKelasAkurasi = kelasAkurasi.value;

                    // Jika semua poin B dan C baik
                    if (
                        kondisiRetakResin === "Tidak ada" &&
                        kondisiNameplate === "Ada" &&
                        kondisiPenandaanTerminal === "Ada" &&
                        kondisiCoverSekunder === "Ada" &&
                        !isNaN(kondisiPrimerSekunderGround) &&
                        !isNaN(kondisiSekunderPrimerGround) &&
                        !isNaN(kondisiBatasKesalahan) &&
                        kondisiKelasAkurasi !== ""
                    ) {
                        kesimpulan.value = "Bekas layak pakai (K6)";
                    } else {
                        kesimpulan.value = "Bekas bisa diperbaiki (K7)";

                    }
                }
            }

            // Event listeners
            selectTahun.addEventListener("change", hitungMasaPakai);
            [retakResin, nameplate, penandaanTerminal, bautPrimer, bautSekunder, coverSekunder,
                primerSekunderGround, sekunderPrimerGround, batasKesalahan, kelasAkurasi
            ].forEach(el => {
                el.addEventListener("change", () => {
                    toggleSectionC();
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
                    toastr.success('Data berhasil disetujui!');
                }
            });

            // Inisialisasi
            hitungMasaPakai();
            toggleSectionC();
            updateKesimpulan();
        });
    </script>
@elseif (auth()->user()->hasRole('Petugas'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");
            const sectionC = document.getElementById("sectionC");

            // Poin B
            const retakResin = document.getElementById("retak_pada_resin"); // Poin 1
            const nameplate = document.getElementById("nameplate"); // Poin 2
            const penandaanTerminal = document.getElementById("penandaan_terminal"); // Poin 3
            const bautPrimer = document.getElementById("kelengkapan_baut_primer"); // Poin 4
            const bautSekunder = document.getElementById("kelengkapan_baut_sekunder"); // Poin 5
            const coverSekunder = document.getElementById("cover_terminal"); // Poin 6

            // Poin C
            const primerSekunderGround = document.getElementById("nilai_pengujian_primer");
            const sekunderPrimerGround = document.getElementById("nilai_pengujian_sekunder");
            const batasKesalahan = document.getElementById("batas_kesalahan");
            const kelasAkurasi = document.getElementById("kelas_akurasi");

            const kesimpulan = document.getElementById("kesimpulan");

            // Isi dropdown tahun produksi dari 1980 hingga tahun sekarang
            for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
                let option = new Option(tahun, tahun);
                selectTahun.appendChild(option);
            }

            // Inisialisasi Select2 menggunakan jQuery
            jQuery.noConflict();
            jQuery(document).ready(function($) {
                $(selectTahun).select2();

                // Event listener untuk Select2
                $(selectTahun).on('change', function() {
                    hitungMasaPakai();
                });
            });

            // Fungsi untuk menghitung masa pakai
            function hitungMasaPakai() {
                const tahunProduksi = parseInt(selectTahun.value);
                if (!isNaN(tahunProduksi)) {
                    inputMasaPakai.value = (tahunSekarang - tahunProduksi) + " tahun";
                    updateKesimpulan();
                } else {
                    inputMasaPakai.value = ""; // Kosongkan jika tahun tidak valid
                }
            }
            // Tampilkan/sembunyikan section C berdasarkan kondisi
            function toggleSectionC() {
                const kondisiRetakResin = retakResin.value;
                const kondisiNameplate = nameplate.value;
                const kondisiPenandaanTerminal = penandaanTerminal.value;
                const kondisiCoverSekunder = coverSekunder.value;

                // Section C ditampilkan jika:
                // - Retak pada resin = "Tidak ada"
                // - Nameplate = "Ada"
                // - Penandaan terminal = "Ada"
                // - Cover terminal sekunder = "Ada"
                sectionC.style.display = (
                    kondisiRetakResin === "Tidak ada" &&
                    kondisiNameplate === "Ada" &&
                    kondisiPenandaanTerminal === "Ada" &&
                    kondisiCoverSekunder === "Ada"
                ) ? "block" : "none";
            }

            // Cek apakah ada kerusakan di poin mandatory (1, 2, 3, 6 di B atau C)
            function cekKerusakanMandatory() {
                const kondisiRetakResin = retakResin.value; // Poin 1
                const kondisiNameplate = nameplate.value; // Poin 2
                const kondisiPenandaanTerminal = penandaanTerminal.value; // Poin 3
                const kondisiCoverSekunder = coverSekunder.value; // Poin 6

                // Jika ada kerusakan di poin mandatory B
                if (
                    kondisiRetakResin === "Ada" || // Poin 1
                    kondisiNameplate === "Tidak ada" || // Poin 2
                    kondisiPenandaanTerminal === "Tidak ada" || // Poin 3
                    kondisiCoverSekunder === "Tidak ada" // Poin 6
                ) {
                    return true; // Ada kerusakan
                }

                // Jika Section C ditampilkan, cek juga poin C
                if (sectionC.style.display === "block") {
                    const kondisiPrimerSekunderGround = parseFloat(primerSekunderGround.value);
                    const kondisiSekunderPrimerGround = parseFloat(sekunderPrimerGround.value);
                    const kondisiBatasKesalahan = parseFloat(batasKesalahan.value);
                    const kondisiKelasAkurasi = kelasAkurasi.value;

                    // Jika ada yang tidak valid di Poin C
                    if (
                        isNaN(kondisiPrimerSekunderGround) || // Primer - (sekunder + ground)
                        isNaN(kondisiSekunderPrimerGround) || // Sekunder - (primer + ground)
                        isNaN(kondisiBatasKesalahan) || // Batas Kesalahan
                        kondisiKelasAkurasi === "" // Kelas Akurasi
                    ) {
                        return true; // Ada kerusakan
                    }
                }

                return false; // Tidak ada kerusakan
            }

            // Update kesimpulan dan catatan perbaikan
            function updateKesimpulan() {
                const masaPakai = parseInt(inputMasaPakai.value) || 0;

                // Jika ada kerusakan di poin mandatory, langsung K8
                if (cekKerusakanMandatory()) {
                    kesimpulan.value = "Bekas tidak layak pakai (K8)";
                    return;
                }

                // Jika masa pakai > 40 tahun, langsung K8
                if (masaPakai > 40) {
                    kesimpulan.value = "Bekas tidak layak pakai (K8)";
                    return;
                }

                // Jika masa pakai <= 40 tahun
                if (masaPakai <= 40) {
                    // Periksa Poin B dan C
                    const kondisiRetakResin = retakResin.value;
                    const kondisiNameplate = nameplate.value;
                    const kondisiPenandaanTerminal = penandaanTerminal.value;
                    const kondisiCoverSekunder = coverSekunder.value;

                    const kondisiPrimerSekunderGround = parseFloat(primerSekunderGround.value);
                    const kondisiSekunderPrimerGround = parseFloat(sekunderPrimerGround.value);
                    const kondisiBatasKesalahan = parseFloat(batasKesalahan.value);
                    const kondisiKelasAkurasi = kelasAkurasi.value;

                    // Jika semua poin B dan C baik
                    if (
                        kondisiRetakResin === "Tidak ada" &&
                        kondisiNameplate === "Ada" &&
                        kondisiPenandaanTerminal === "Ada" &&
                        kondisiCoverSekunder === "Ada" &&
                        !isNaN(kondisiPrimerSekunderGround) &&
                        !isNaN(kondisiSekunderPrimerGround) &&
                        !isNaN(kondisiBatasKesalahan) &&
                        kondisiKelasAkurasi !== ""
                    ) {
                        kesimpulan.value = "Bekas layak pakai (K6)";
                    } else {
                        kesimpulan.value = "Bekas bisa diperbaiki (K7)";

                    }
                }
            }

            // Event listeners
            selectTahun.addEventListener("change", hitungMasaPakai);
            [retakResin, nameplate, penandaanTerminal, bautPrimer, bautSekunder, coverSekunder,
                primerSekunderGround, sekunderPrimerGround, batasKesalahan, kelasAkurasi
            ].forEach(el => {
                el.addEventListener("change", () => {
                    toggleSectionC();
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
            toggleSectionC();
            updateKesimpulan();
        });
    </script>
@endif

<x-layouts.footer />
