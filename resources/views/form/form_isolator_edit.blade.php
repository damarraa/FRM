<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Isolator</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-isolator.update', $isolator->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Bagian A. Data Material -->
                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="9">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select id="up3_id" name="up3_id" class="form-control" required>
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
                                        value="{{ old('tgl_inspeksi', $isolator->tgl_inspeksi) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian A. Data Material -->
                        <h6 class="mb-3 font-weight-bold">A. Data Material</h6>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi_akhir_terpasang">Lokasi Akhir Terpasang</label>
                                    <input type="text" class="form-control" id="lokasi_akhir_terpasang"
                                        name="lokasi_akhir_terpasang" placeholder="Masukkan Alamat"
                                        value="{{ old('lokasi_akhir_terpasang', $isolator->lokasi_akhir_terpasang) }}"
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
                                <div class="d-flex gap-4">
                                    <div class="w-50">
                                        <label for="tahun_produksi">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            id="tahun_produksi" name="tahun_produksi" required>
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
                                            value="{{ old('masa_pakai', $isolator->masa_pakai) }}"
                                            placeholder="Tahun sekarang - Tahun produksi" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_isolator">Tipe Isolator</label>
                                    <div class="input-group">
                                        <select name="tipe_isolator" class="form-control" id="tipe_isolator" required>
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="Pin"
                                                {{ old('tipe_isolator', $isolator->tipe_isolator) == 'Pin' ? 'selected' : '' }}>
                                                Pin</option>
                                            <option value="Pin Post"
                                                {{ old('tipe_isolator', $isolator->tipe_isolator) == 'Pin Post' ? 'selected' : '' }}>
                                                Pin Post</option>
                                            <option value="Line Post"
                                                {{ old('tipe_isolator', $isolator->tipe_isolator) == 'Line Post' ? 'selected' : '' }}>
                                                Line Post</option>
                                            <option value="Suspension"
                                                {{ old('tipe_isolator', $isolator->tipe_isolator) == 'Suspension' ? 'selected' : '' }}>
                                                Suspension</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="number" class="form-control" id="no_serial" name="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $isolator->no_serial) }}" required>
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

                        <!-- Bagian B. Pemeriksaan Visual dan Konstruksi -->
                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Visual dan Konstruksi</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kondisi_visual">1. Pengujian visual / sifat tampak</label>
                                    <div class="input-group">
                                        <select name="kondisi_visual" class="form-control kondisiVisual"
                                            id="kondisi_visual" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_visual', $isolator->kondisi_visual) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_visual', $isolator->kondisi_visual) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganVisualTampak')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganVisualTampak" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganVisualTampak">Keterangan Visual / Sifat Tampak:</label>
                                        <textarea class="form-control" id="keteranganVisualTampak" name="keteranganVisualTampak" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganVisualTampak', 'charCountVisualTampak')">{{ $isolator->keteranganVisualTampak }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_warna">a. Perubahan warna</label>
                                    <div class="input-group">
                                        <select name="kondisi_warna" class="form-control kondisiVisual"
                                            id="kondisi_warna" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_warna', $isolator->kondisi_warna) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_warna', $isolator->kondisi_warna) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKondisiWarna')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKondisiWarna" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganKondisiWarna">Keterangan Kondisi:</label>
                                        <textarea class="form-control" id="keteranganKondisiWarna" name="keteranganKondisiWarna" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiWarna', 'charCountKeteranganKondisiWarna')">{{ $isolator->keteranganKondisiWarna }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_pecah">b. Tidak Pecah</label>
                                    <div class="input-group">
                                        <select name="kondisi_pecah" class="form-control kondisiVisual"
                                            id="kondisi_pecah" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_pecah', $isolator->kondisi_pecah) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_pecah', $isolator->kondisi_pecah) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKondisiPecah')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKondisiPecah" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganKondisiPecah">Keterangan Kondisi:</label>
                                        <textarea class="form-control" id="keteranganKondisiPecah" name="keteranganKondisiPecah" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiPecah', 'charCountKeteranganKondisiPecah')">{{ $isolator->keteranganKondisiPecah }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kondisi_permukaan">c. Gores Permukaan</label>
                                    <div class="input-group">
                                        <select name="kondisi_permukaan" class="form-control kondisiVisual"
                                            id="kondisi_permukaan" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_permukaan', $isolator->kondisi_permukaan) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_permukaan', $isolator->kondisi_permukaan) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKondisiPermukaan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKondisiPermukaan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganKondisiPermukaan">Keterangan Kondisi:</label>
                                        <textarea class="form-control" id="keteranganKondisiPermukaan" name="keteranganKondisiPermukaan" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiPermukaan', 'charCountKeteranganKondisiPermukaan')">{{ $isolator->keteranganKondisiPermukaan }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_korosi">d. Korosi</label>
                                    <div class="input-group">
                                        <select name="kondisi_korosi" class="form-control kondisiVisual"
                                            id="kondisi_korosi" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_korosi', $isolator->kondisi_korosi) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_korosi', $isolator->kondisi_korosi) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKondisiKorosi')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKondisiKorosi" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganKondisiKorosi">Keterangan Kondisi:</label>
                                        <textarea class="form-control" id="keteranganKondisiKorosi" name="keteranganKondisiKorosi" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKondisiKorosi', 'charCountKondisiKorosi')">{{ $isolator->keteranganKondisiKorosi }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan: Seluruh mata uji poin B adalah mandatory. Jika
                                seluruh poin B sesuai, maka dapat dilanjutkan ke pengujian poin C, jika tidak maka poin
                                selanjutnya tidak perlu diisi.</p>
                        </div>
                        <hr class="mb-3">
                        <div class="row" id="sectionC">
                            <!-- Bagian C. Pengujian Elektrik -->
                            <h6 class="mb-3 font-weight-bold">C. Pengujian Elektrik</h6>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_isolasi">1. Pengujian Tahanan Isolasi (Persyaratan >20
                                        MΩ)</label>
                                    <div class="input-group">
                                        <input name="pengujian_isolasi" type="number" class="form-control"
                                            id="pengujian_isolasi" placeholder="Hasil pengujian"
                                            value="{{ old('pengujian_isolasi', $isolator->pengujian_isolasi) }}">
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganTahananIsolasi')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganTahananIsolasi" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganTahananIsolasi">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganTahananIsolasi" name="keteranganTahananIsolasi" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganTahananIsolasi', 'charCountTahananIsolasi')">{{ $isolator->keteranganTahananIsolasi }}</textarea>
                                    </div>
                                </div>
                                <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin C adalah
                                    mandatory.</p>
                            </div>
                            <hr class="mb-3">
                        </div>

                        <!-- Bagian D. Kesimpulan -->
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
                                                {{ old('kesimpulan', $isolator->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $isolator->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $isolator->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
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
                                                {{ old('kesimpulan', $isolator->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $isolator->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $isolator->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian E. Gambar Evidence -->
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
                                                        alt="Gambar Evidence Isolator {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence Isolator {{ $key + 1 }}"
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

<!-- Script untuk Preview Gambar -->
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

<!-- Tambahkan di bagian head atau sebelum penutup body -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "3000"
    };

    // Toast Notification untuk Submit Sukses
    document.getElementById('formInspeksi').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Disable submit button selama proses
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses...';

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.status === 422) {
                    return response.json().then(errors => {
                        throw errors;
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw data;
                }

                // Jika sukses
                toastr.success('Data berhasil disimpan!');
                localStorage.removeItem("formInspeksiData");

                // Redirect setelah 2 detik
                setTimeout(() => {
                    window.location.href = "{{ route('form-retur-isolator.create') }}";
                }, 2000);
            })
            .catch(error => {
                submitButton.disabled = false;
                submitButton.innerHTML = 'Simpan';

                if (error.errors) {
                    // Handle validation errors
                    let errorMessages = [];
                    for (let field in error.errors) {
                        errorMessages.push(error.errors[field][0]);
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        html: errorMessages.join('<br>')
                    });
                } else if (error.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.error
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data'
                    });
                }
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
</script> --}}

<!-- Script untuk Logika Kesimpulan dan Tampilan -->
@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Dapatkan referensi form dengan benar
            const formInspeksi = document.getElementById("formInspeksi");

            // Muat data dari localStorage saat halaman dimuat
            muatDataForm();

            // Reset localStorage jika halaman dimuat melalui navigasi (bukan reload)
            if (window.performance && window.performance.navigation.type === window.performance.navigation
                .TYPE_NAVIGATE) {
                localStorage.removeItem("formInspeksiData");
            }

            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");
            const kondisiVisualElements = document.querySelectorAll('.kondisiVisual');
            const sectionC = document.getElementById('sectionC');
            const kesimpulan = document.getElementById('kesimpulan');
            const ujiKesalahan = document.getElementById('pengujian_isolasi');

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

            // Update kesimpulan berdasarkan kondisi
            function updateKesimpulan() {
                const tahunProduksi = parseInt(selectTahun.value);
                const masaPakai = isNaN(tahunProduksi) ? 0 : tahunSekarang - tahunProduksi;
                const semuaBaik = Array.from(kondisiVisualElements).every(select => select.value === 'Baik');
                const nilaiC = parseFloat(ujiKesalahan.value) || 0;

                if (masaPakai > 40) {
                    kesimpulan.value = 'Bekas tidak layak pakai (K8)'; // Masa pakai > 40 tahun
                    sectionC.style.display = 'none';
                } else if (!semuaBaik) {
                    kesimpulan.value = 'Masih garansi (K7)'; // Ada poin B yang rusak
                    sectionC.style.display = 'none';
                } else if (semuaBaik && nilaiC >= 20) {
                    kesimpulan.value = 'Bekas layak pakai (K6)'; // Semua poin B baik dan nilai C >= 20
                    sectionC.style.display = 'block';
                } else if (semuaBaik && nilaiC < 20) {
                    kesimpulan.value = 'Masih garansi (K7)'; // Semua poin B baik tapi nilai C < 20
                    sectionC.style.display = 'block';
                } else {
                    kesimpulan.value = ''; // Tidak ada kesimpulan
                    sectionC.style.display = 'block';
                }
            }

            // Event listener untuk kondisi visual
            kondisiVisualElements.forEach(select => {
                select.addEventListener('change', updateKesimpulan);
            });

            // Event listener untuk uji kesalahan
            ujiKesalahan.addEventListener('input', updateKesimpulan);

            // Set tanggal hari ini
            document.getElementById('tgl_inspeksi').valueAsDate = new Date();

            // Fungsi untuk menyimpan data ke local storage
            function simpanDataForm() {
                const formData = new FormData(formInspeksi);
                const formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
                localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
            }

            // Fungsi untuk memuat data dari local storage
            function muatDataForm() {
                const savedData = localStorage.getItem("formInspeksiData");
                if (savedData) {
                    const formObject = JSON.parse(savedData);
                    for (const key in formObject) {
                        const inputElement = formInspeksi.querySelector(`[name="${key}"]`);
                        if (inputElement && inputElement.type !== "file") {
                            inputElement.value = formObject[key];
                        }
                    }
                    // Trigger change event untuk Select2
                    setTimeout(() => {
                        $(".select2").trigger("change");
                    }, 100);
                }
            }

            // Fungsi untuk menghapus data dari local storage
            function hapusDataForm() {
                localStorage.removeItem("formInspeksiData");
            }

            // Event listener untuk input dan change
            formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
                element.addEventListener("input", simpanDataForm);
                element.addEventListener("change", simpanDataForm);
            });

            // Event listener untuk form reset
            formInspeksi.addEventListener("reset", function() {
                hapusDataForm();
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
        });
    </script>
@elseif (auth()->user()->hasRole('Petugas'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Dapatkan referensi form dengan benar
            const formInspeksi = document.getElementById("formInspeksi");

            // Muat data dari localStorage saat halaman dimuat
            muatDataForm();

            // Reset localStorage jika halaman dimuat melalui navigasi (bukan reload)
            if (window.performance && window.performance.navigation.type === window.performance.navigation
                .TYPE_NAVIGATE) {
                localStorage.removeItem("formInspeksiData");
            }

            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");
            const kondisiVisualElements = document.querySelectorAll('.kondisiVisual');
            const sectionC = document.getElementById('sectionC');
            const kesimpulan = document.getElementById('kesimpulan');
            const ujiKesalahan = document.getElementById('pengujian_isolasi');

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

            // Update kesimpulan berdasarkan kondisi
            function updateKesimpulan() {
                const tahunProduksi = parseInt(selectTahun.value);
                const masaPakai = isNaN(tahunProduksi) ? 0 : tahunSekarang - tahunProduksi;
                const semuaBaik = Array.from(kondisiVisualElements).every(select => select.value === 'Baik');
                const nilaiC = parseFloat(ujiKesalahan.value) || 0;

                if (masaPakai > 40) {
                    kesimpulan.value = 'Bekas tidak layak pakai (K8)'; // Masa pakai > 40 tahun
                    sectionC.style.display = 'none';
                } else if (!semuaBaik) {
                    kesimpulan.value = 'Masih garansi (K7)'; // Ada poin B yang rusak
                    sectionC.style.display = 'none';
                } else if (semuaBaik && nilaiC >= 20) {
                    kesimpulan.value = 'Bekas layak pakai (K6)'; // Semua poin B baik dan nilai C >= 20
                    sectionC.style.display = 'block';
                } else if (semuaBaik && nilaiC < 20) {
                    kesimpulan.value = 'Masih garansi (K7)'; // Semua poin B baik tapi nilai C < 20
                    sectionC.style.display = 'block';
                } else {
                    kesimpulan.value = ''; // Tidak ada kesimpulan
                    sectionC.style.display = 'block';
                }
            }

            // Event listener untuk kondisi visual
            kondisiVisualElements.forEach(select => {
                select.addEventListener('change', updateKesimpulan);
            });

            // Event listener untuk uji kesalahan
            ujiKesalahan.addEventListener('input', updateKesimpulan);

            // Set tanggal hari ini
            document.getElementById('tgl_inspeksi').valueAsDate = new Date();

            // Fungsi untuk menyimpan data ke local storage
            function simpanDataForm() {
                const formData = new FormData(formInspeksi);
                const formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
                localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
            }

            // Fungsi untuk memuat data dari local storage
            function muatDataForm() {
                const savedData = localStorage.getItem("formInspeksiData");
                if (savedData) {
                    const formObject = JSON.parse(savedData);
                    for (const key in formObject) {
                        const inputElement = formInspeksi.querySelector(`[name="${key}"]`);
                        if (inputElement && inputElement.type !== "file") {
                            inputElement.value = formObject[key];
                        }
                    }
                    // Trigger change event untuk Select2
                    setTimeout(() => {
                        $(".select2").trigger("change");
                    }, 100);
                }
            }

            // Fungsi untuk menghapus data dari local storage
            function hapusDataForm() {
                localStorage.removeItem("formInspeksiData");
            }

            // Event listener untuk input dan change
            formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
                element.addEventListener("input", simpanDataForm);
                element.addEventListener("change", simpanDataForm);
            });

            // Event listener untuk form reset
            formInspeksi.addEventListener("reset", function() {
                hapusDataForm();
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
        });
    </script>
@endif

<x-layouts.footer />
