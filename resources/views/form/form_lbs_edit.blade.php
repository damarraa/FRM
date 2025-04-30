<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur LBS</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-lbs.update', $lbs->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Bagian Unit, Gudang, dan Tanggal -->
                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="14">
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
                                        value="{{ old('tgl_inspeksi', $lbs->tgl_inspeksi) }}" readonly>
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
                                        value="{{ old('lokasi_akhir_terpasang', $lbs->lokasi_akhir_terpasang) }}"
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
                                <div class="d-flex gap-4">
                                    <div class="w-50">
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
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun sekarang - Tahun produksi"
                                            value="{{ old('masa_pakai', $lbs->masa_pakai) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_lbs">Tipe LBS</label>
                                    <select name="tipe_lbs" class="form-control" id="tipe_lbs" required>
                                        <option value="">-- Pilih Tipe LBS --</option>
                                        <option value="Vacuum"
                                            {{ old('tipe_lbs', $lbs->tipe_lbs) == 'Vacuum' ? 'selected' : '' }}>Vacuum
                                        </option>
                                        <option value="SF6"
                                            {{ old('tipe_lbs', $lbs->tipe_lbs) == 'SF6' ? 'selected' : '' }}>SF6
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input name="no_serial" type="number" class="form-control" id="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $lbs->no_serial) }}" required>
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
                                    <label for="nameplate">1. Papan Nama</label>
                                    <select id="nameplate" name="nameplate" class="form-control poin1" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('nameplate', $lbs->nameplate) == 'Ada' ? 'selected' : '' }}>Ada
                                        </option>
                                        <option value="Tidak ada"
                                            {{ old('nameplate', $lbs->nameplate) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penandaan_terminal">2. Penandaan Terminal</label>
                                    <select id="penandaan_terminal" name="penandaan_terminal"
                                        class="form-control poin2" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('penandaan_terminal', $lbs->penandaan_terminal) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('penandaan_terminal', $lbs->penandaan_terminal) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="counter_lbs">3. Counter Mekanis LBS</label>
                                    <select id="counter_lbs" name="counter_lbs" class="form-control poin3" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('counter_lbs', $lbs->counter_lbs) == 'Ada' ? 'selected' : '' }}>Ada
                                        </option>
                                        <option value="Tidak ada"
                                            {{ old('counter_lbs', $lbs->counter_lbs) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bushing_lbs">4. Kondisi Fisik Bushing HV <i>(Ada retak/longgar dari
                                            tangki/seal bushing
                                            rembes)</i></label>
                                    <select id="bushing_lbs" name="bushing_lbs" class="form-control poin4" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('bushing_lbs', $lbs->bushing_lbs) == 'Ada' ? 'selected' : '' }}>Ada
                                        </option>
                                        <option value="Tidak ada"
                                            {{ old('bushing_lbs', $lbs->bushing_lbs) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="indikator_lbs">5. Indikator posisi LBS</label>
                                    <select id="indikator_lbs" name="indikator_lbs" class="form-control poin5"
                                        required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('indikator_lbs', $lbs->indikator_lbs) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('indikator_lbs', $lbs->indikator_lbs) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rtu_lbs">6. Fisik RTU</label>
                                    <select id="rtu_lbs" name="rtu_lbs" class="form-control poin6" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('rtu_lbs', $lbs->rtu_lbs) == 'Ada' ? 'selected' : '' }}>Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('rtu_lbs', $lbs->rtu_lbs) == 'Tidak ada' ? 'selected' : '' }}>Tidak
                                            ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="interuptor_lbs">7. Indikator Kegagalan Interuptor Pada Vacuum Atau
                                        Indikator Low Pressure
                                        Pada Gas SF6</label>
                                    <select id="interuptor_lbs" name="interuptor_lbs" class="form-control poin7"
                                        required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada"
                                            {{ old('interuptor_lbs', $lbs->interuptor_lbs) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak ada"
                                            {{ old('interuptor_lbs', $lbs->interuptor_lbs) == 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3"> Keterangan:
                                <br>a. Jika item mandatory poin B (4, 5, 6, 7) ada yang tidak sesuai maka pengujian poin
                                C tidak perlu dilakukan
                                <br>b. Poin 1, 2, 3 dapat diperbaiki/diganti
                            </p>
                        </div>

                        <!-- Bagian C: Pengujian Mekanik -->
                        <div class="row" id="sectionC">
                            <hr class="mb-3">
                            <h6 class="mb-3 font-weight-bold">C. Pengujian Mekanik</h6>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mekanik1_lbs">1. Buka Tutup Switch Secara Manual 5x</label>
                                    <div class="input-group">
                                        <select id="mekanik1_lbs" name="mekanik1_lbs" class="form-control poin7">
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Berhasil"
                                                {{ old('mekanik1_lbs', $lbs->mekanik1_lbs) == 'Berhasil' ? 'selected' : '' }}>
                                                Berhasil</option>
                                            <option value="Gagal"
                                                {{ old('mekanik1_lbs', $lbs->mekanik1_lbs) == 'Gagal' ? 'selected' : '' }}>
                                                Gagal</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganMekanikManual')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganMekanikManual" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganMekanikManual">Keterangan Pengujian:</label>
                                        <textarea class="form-control" id="keteranganMekanikManual" name="keteranganMekanikManual" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganMekanikManual', 'charCountMekanikManual')">{{ $lbs->keteranganMekanikManual }}</textarea>
                                        <small id="charCountMekanikManual" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mekanik2_lbs">2. Buka Tutup Switch Dengan Panel Kontrol 5x</label>
                                    <div class="input-group">
                                        <select id="mekanik2_lbs" name="mekanik2_lbs" class="form-control poin7">
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Berhasil"
                                                {{ old('mekanik2_lbs', $lbs->mekanik2_lbs) == 'Berhasil' ? 'selected' : '' }}>
                                                Berhasil</option>
                                            <option value="Gagal"
                                                {{ old('mekanik2_lbs', $lbs->mekanik2_lbs) == 'Gagal' ? 'selected' : '' }}>
                                                Gagal</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPanelKontrol')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPanelKontrol" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganPanelKontrol">Keterangan Pengujian:</label>
                                        <textarea class="form-control" id="keteranganPanelKontrol" name="keteranganPanelKontrol" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganPanelKontrol', 'charCountPanelKontrol')">{{ $lbs->keteranganPanelKontrol }}</textarea>
                                        <small id="charCountPanelKontrol" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">D. Pengujian Elektrik<i> (menggunakan micro-ohmeter)</i>
                        </h6>
                        <h6 class="mb-3"> 1. Pengujian Tahanan Kontak <i>(Persyaratan perbedaan nilai tahanan antar
                                fasa
                                tidak lebih dari 20%)</i></h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="elektrik_r">a) R</label>
                                    <div class="input-group">
                                        <input name="elektrik_r" type="number" class="form-control" id="elektrik_r"
                                            step="0.1" required placeholder="Masukkan Nilai R"
                                            value="{{ $lbs->elektrik_r }}">
                                        <span class="input-group-text">µOhm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="elektrik_s">b) S</label>
                                    <div class="input-group">
                                        <input name="elektrik_s" type="number" class="form-control" id="elektrik_s"
                                            step="0.1" required placeholder="Masukkan Nilai S"
                                            value="{{ $lbs->elektrik_s }}">
                                        <span class="input-group-text">µOhm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="elektrik_t">c) T</label>
                                    <div class="input-group">
                                        <input name="elektrik_t" type="number" class="form-control" id="elektrik_t"
                                            step="0.1" required placeholder="Masukkan Nilai T"
                                            value="{{ $lbs->elektrik_t }}">
                                        <span class="input-group-text">µOhm</span>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $lbs->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)"
                                                {{ old('kesimpulan', $lbs->kesimpulan) == 'Bekas bisa diperbaiki (K7)' ? 'selected' : '' }}>
                                                Bekas bisa diperbaiki (K7)
                                            </option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $lbs->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
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
                                                {{ old('kesimpulan', $lbs->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Bekas bisa diperbaiki (K7)"
                                                {{ old('kesimpulan', $lbs->kesimpulan) == 'Bekas bisa diperbaiki (K7)' ? 'selected' : '' }}>
                                                Bekas bisa diperbaiki (K7)
                                            </option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $lbs->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
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
                                                        alt="Gambar Evidence LBS {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence LBS {{ $key + 1 }}"
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

                        <a href="{{ route('forms') }}" class="btn btn-secondary">Kembali</a>
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
</script>

@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");
            const sectionC = document.getElementById("sectionC");
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

            // Fungsi untuk menampilkan/menyembunyikan sectionC
            function toggleSectionC() {
                const bushing = document.getElementById("bushing_lbs").value;
                const indikator = document.getElementById("indikator_lbs").value;
                const rtu = document.getElementById("rtu_lbs").value;
                const interuptor = document.getElementById("interuptor_lbs").value;

                // Jika semua poin B (4,5,6,7) bernilai "Tidak ada", tampilkan sectionC
                if (bushing === "Tidak ada" && indikator === "Ada" &&
                    rtu === "Ada" && interuptor === "Tidak ada") {
                    sectionC.style.display = "flex";

                    // Set required untuk input mekanik
                    document.getElementById("mekanik1_lbs").required = true;
                    document.getElementById("mekanik2_lbs").required = true;
                } else {
                    sectionC.style.display = "none";

                    // Hapus required dan reset nilai
                    document.getElementById("mekanik1_lbs").required = false;
                    document.getElementById("mekanik2_lbs").required = false;
                    document.getElementById("mekanik1_lbs").value = "";
                    document.getElementById("mekanik2_lbs").value = "";
                }
            }

            // Update kesimpulan
            // function updateKesimpulan() {
            //     const masaPakai = parseInt(inputMasaPakai.value) || 0;
            //     // const poin1 = document.querySelector(".poin1").value;
            //     // const poin2 = document.querySelector(".poin2").value;
            //     // const poin3 = document.querySelector(".poin3").value;
            //     // const poin4 = document.querySelector(".poin4").value;
            //     // const poin5 = document.querySelector(".poin5").value;
            //     // const poin6 = document.querySelector(".poin6").value;
            //     // const poin7 = document.querySelector(".poin7").value;
            //     const poin1 = document.getElementById("nameplate").value;
            //     const poin2 = document.getElementById("penandaan_terminal").value;
            //     const poin3 = document.getElementById("counter_lbs").value;
            //     const poin4 = document.getElementById("bushing_lbs").value;
            //     const poin5 = document.getElementById("indikator_lbs").value;
            //     const poin6 = document.getElementById("rtu_lbs").value;
            //     const poin7 = document.getElementById("interuptor_lbs").value;
            //     const cBerhasil = document.querySelector("select[name='mekanik1_lbs']")
            //         .value; // Ambil nilai dari pengujian mekanik
            //     const dR = parseFloat(document.getElementById("elektrik_r").value) || 0;
            //     const dS = parseFloat(document.getElementById("elektrik_s").value) || 0;
            //     const dT = parseFloat(document.getElementById("elektrik_t").value) || 0;

            //     // Hitung perbedaan nilai tahanan antar fasa
            //     const perbedaanRS = Math.abs(dR - dS);
            //     const perbedaanRT = Math.abs(dR - dT);
            //     const perbedaanST = Math.abs(dS - dT);
            //     const persentaseRS = dR !== 0 ? (perbedaanRS / dR) * 100 : 0;
            //     const persentaseRT = dR !== 0 ? (perbedaanRT / dR) * 100 : 0;
            //     const persentaseST = dS !== 0 ? (perbedaanST / dS) * 100 : 0;

            //     // Cek kesesuaian D (perbedaan tidak lebih dari 20%)
            //     const dSesuai = persentaseRS <= 20 && persentaseRT <= 20 && persentaseST <= 20;

            //     // Logika kesimpulan
            //     let kesimpulanValue = "Bekas tidak layak pakai (K8)";

            //     if (masaPakai > 40) {
            //         kesimpulanValue = "Bekas tidak layak pakai (K8)";
            //     } else if (
            //         poin1 === "Ada" &&
            //         poin2 === "Ada" &&
            //         poin3 === "Ada" &&
            //         poin4 === "Tidak ada" &&
            //         poin5 === "Ada" &&
            //         poin6 === "Ada" &&
            //         poin7 === "Tidak ada" &&
            //         cBerhasil === "Berhasil" &&
            //         dSesuai
            //     ) {
            //         kesimpulanValue = "Bekas layak pakai (K6)";
            //     } else if (
            //         poin1 === "Tidak ada" ||
            //         poin2 === "Tidak ada" ||
            //         poin3 === "Tidak ada" ||
            //         poin4 === "Ada" ||
            //         poin5 === "Tidak ada" ||
            //         poin6 === "Tidak ada" ||
            //         poin7 === "Ada" ||
            //         cBerhasil === "Gagal" ||
            //         dSesuai
            //     ) {
            //         kesimpulanValue = "Bekas bisa diperbaiki (K7)";
            //     }

            //     kesimpulan.value = kesimpulanValue;
            // }

            // Event listeners untuk poin-poin pemeriksaan visual
            document.getElementById("bushing_lbs").addEventListener("change", toggleSectionC);
            document.getElementById("indikator_lbs").addEventListener("change", toggleSectionC);
            document.getElementById("rtu_lbs").addEventListener("change", toggleSectionC);
            document.getElementById("interuptor_lbs").addEventListener("change", toggleSectionC);

            // Event listeners
            selectTahun.addEventListener("change", hitungMasaPakai);
            document.querySelectorAll(
                ".poin1, .poin2, .poin3, .poin4, .poin5, .poin6, .poin7, select[name='mekanik1_lbs'], #elektrik_r, #elektrik_s, #elektrik_t"
            ).forEach(el => {
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
            // updateKesimpulan();
        });
    </script>
@elseif(auth()->user()->hasRole('Petugas'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");
            const sectionC = document.getElementById("sectionC");
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

            // Fungsi untuk menampilkan/menyembunyikan sectionC
            function toggleSectionC() {
                const bushing = document.getElementById("bushing_lbs").value;
                const indikator = document.getElementById("indikator_lbs").value;
                const rtu = document.getElementById("rtu_lbs").value;
                const interuptor = document.getElementById("interuptor_lbs").value;

                // Jika semua poin B (4,5,6,7) bernilai "Tidak ada", tampilkan sectionC
                if (bushing === "Tidak ada" && indikator === "Ada" &&
                    rtu === "Ada" && interuptor === "Tidak ada") {
                    sectionC.style.display = "flex";

                    // Set required untuk input mekanik
                    document.getElementById("mekanik1_lbs").required = true;
                    document.getElementById("mekanik2_lbs").required = true;
                } else {
                    sectionC.style.display = "none";

                    // Hapus required dan reset nilai
                    document.getElementById("mekanik1_lbs").required = false;
                    document.getElementById("mekanik2_lbs").required = false;
                    document.getElementById("mekanik1_lbs").value = "";
                    document.getElementById("mekanik2_lbs").value = "";
                }
            }


            // Update kesimpulan
            function updateKesimpulan() {
                const masaPakai = parseInt(inputMasaPakai.value) || 0;
                // const poin1 = document.querySelector(".poin1").value;
                // const poin2 = document.querySelector(".poin2").value;
                // const poin3 = document.querySelector(".poin3").value;
                // const poin4 = document.querySelector(".poin4").value;
                // const poin5 = document.querySelector(".poin5").value;
                // const poin6 = document.querySelector(".poin6").value;
                // const poin7 = document.querySelector(".poin7").value;
                const poin1 = document.getElementById("nameplate").value;
                const poin2 = document.getElementById("penandaan_terminal").value;
                const poin3 = document.getElementById("counter_lbs").value;
                const poin4 = document.getElementById("bushing_lbs").value;
                const poin5 = document.getElementById("indikator_lbs").value;
                const poin6 = document.getElementById("rtu_lbs").value;
                const poin7 = document.getElementById("interuptor_lbs").value;
                const cBerhasil = document.querySelector("select[name='mekanik1_lbs']")
                    .value; // Ambil nilai dari pengujian mekanik
                const dR = parseFloat(document.getElementById("elektrik_r").value) || 0;
                const dS = parseFloat(document.getElementById("elektrik_s").value) || 0;
                const dT = parseFloat(document.getElementById("elektrik_t").value) || 0;

                // Hitung perbedaan nilai tahanan antar fasa
                const perbedaanRS = Math.abs(dR - dS);
                const perbedaanRT = Math.abs(dR - dT);
                const perbedaanST = Math.abs(dS - dT);
                const persentaseRS = dR !== 0 ? (perbedaanRS / dR) * 100 : 0;
                const persentaseRT = dR !== 0 ? (perbedaanRT / dR) * 100 : 0;
                const persentaseST = dS !== 0 ? (perbedaanST / dS) * 100 : 0;

                // Cek kesesuaian D (perbedaan tidak lebih dari 20%)
                const dSesuai = persentaseRS <= 20 && persentaseRT <= 20 && persentaseST <= 20;

                // Logika kesimpulan
                let kesimpulanValue = "Bekas tidak layak pakai (K8)";

                if (masaPakai > 40) {
                    kesimpulanValue = "Bekas tidak layak pakai (K8)";
                } else if (
                    poin1 === "Ada" &&
                    poin2 === "Ada" &&
                    poin3 === "Ada" &&
                    poin4 === "Tidak ada" &&
                    poin5 === "Ada" &&
                    poin6 === "Ada" &&
                    poin7 === "Tidak ada" &&
                    cBerhasil === "Berhasil" &&
                    dSesuai
                ) {
                    kesimpulanValue = "Bekas layak pakai (K6)";
                } else if (
                    poin1 === "Tidak ada" ||
                    poin2 === "Tidak ada" ||
                    poin3 === "Tidak ada" ||
                    poin4 === "Ada" ||
                    poin5 === "Tidak ada" ||
                    poin6 === "Tidak ada" ||
                    poin7 === "Ada" ||
                    cBerhasil === "Gagal" ||
                    dSesuai
                ) {
                    kesimpulanValue = "Bekas bisa diperbaiki (K7)";
                }

                kesimpulan.value = kesimpulanValue;
            }

            // Event listeners untuk poin-poin pemeriksaan visual
            document.getElementById("bushing_lbs").addEventListener("change", toggleSectionC);
            document.getElementById("indikator_lbs").addEventListener("change", toggleSectionC);
            document.getElementById("rtu_lbs").addEventListener("change", toggleSectionC);
            document.getElementById("interuptor_lbs").addEventListener("change", toggleSectionC);

            // Event listeners
            selectTahun.addEventListener("change", hitungMasaPakai);
            document.querySelectorAll(
                ".poin1, .poin2, .poin3, .poin4, .poin5, .poin6, .poin7, select[name='mekanik1_lbs'], #elektrik_r, #elektrik_s, #elektrik_t"
            ).forEach(el => {
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
