<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Lightning Arrester</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-lightning-arrester.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Bagian Unit, Gudang, dan Tanggal -->
                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="7">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select id="up3_id" name="up3_id" class="form-control" required>
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

                        <!-- Bagian Data Material -->
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
                                    <label for="tipe_la">Tipe Lightning Arrester:</label>
                                    <select class="form-control" id="tipe_la" name="tipe_la" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="Polymer">Polymer</option>
                                        <option value="Keramik">Keramik</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input id="no_serial" name="no_serial" type="number" class="form-control"
                                        placeholder="Masukkan No Serial">
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

                        <!-- Bagian Pemeriksaan Visual dan Konstruksi -->
                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Visual dan Konstruksi</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kondisi_visual">Pemeriksaan Kondisi Visual / Sifat Tampak</label>
                                    <div class="input-group">
                                        <select name="kondisi_visual" class="form-control" id="kondisi_visual"
                                            required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keterangan_kondisi_visual')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keterangan_kondisi_visual" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_uji_tahanan">Keterangan Kondisi Visual:</label>
                                        <textarea class="form-control" id="keterangan_kondisi_visual" name="keterangan_kondisi_visual" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_kondisi_visual', 'charCountKondisiVisual')"></textarea>
                                        <small id="charCountKondisiVisual" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin B adalah
                                mandatory. Jika seluruh poin B sesuai, maka dapat dilanjutkan ke pengujian poin C, jika
                                tidak maka poin selanjutnya tidak perlu diisi.</p>
                        </div>


                        <!-- Bagian Uji Tahanan Isolasi (Section C) -->
                        <div class="row" id="sectionC" style="display: none;">
                            <hr class="mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uji_tahanan" class="font-weight-bold">C. Uji Tahanan Isolasi
                                        (Persyaratan >20
                                        MΩ)</label>
                                    <div class="input-group">
                                        <input name="uji_tahanan" type="number" class="form-control"
                                            id="uji_tahanan" placeholder="Hasil Pengujian">
                                        <span class="input-group-text" id="basic-addon2">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('tahanan_isolasi')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="tahanan_isolasi" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_uji_tahanan">Keterangan Uji Tahanan:</label>
                                        <textarea class="form-control" id="keterangan_uji_tahanan" name="keterangan_uji_tahanan" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_uji_tahanan', 'charCountUjiTahanan')"></textarea>
                                        <small id="charCountUjiTahanan" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin C adalah
                                mandatory
                            </p>
                        </div>
                        <hr class="mb-3">

                        <!-- Bagian Kesimpulan -->
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

                        <!-- Bagian Gambar Evidence -->
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

<script>
    // Fungsi untuk menghitung masa pakai (VERSI DISEMPURNAKAN)
    function hitungMasaPakai() {
        const tahunProduksi = parseInt(document.getElementById("tahun_produksi").value);
        const tahunSekarang = new Date().getFullYear();
        const masaPakaiInput = document.getElementById("masa_pakai");

        if (!isNaN(tahunProduksi)) {
            const masaPakai = tahunSekarang - tahunProduksi;
            masaPakaiInput.value = masaPakai + " tahun";

            // Reset kelas dasar dan tambahkan kelas warna sesuai kondisi
            masaPakaiInput.className = "form-control w-full p-2 border rounded";

            if (masaPakai < 30) {
                masaPakaiInput.classList.add("text-green-600");
            } else if (masaPakai >= 30 && masaPakai <= 40) {
                masaPakaiInput.classList.add("text-yellow-600");
            } else {
                masaPakaiInput.classList.add("text-red-600");
            }
        } else {
            masaPakaiInput.value = "";
            masaPakaiInput.className = "form-control w-full p-2 border rounded text-gray-500";
        }
    }

    // Fungsi untuk menampilkan atau menyembunyikanew bagian C
    function toggleSectionC() {
        const kondisiVisual = document.getElementById("kondisi_visual");
        const sectionC = document.getElementById("sectionC");

        if (kondisiVisual.value === 'Baik') {
            sectionC.style.display = 'block'; // Tampilkan bagian C
        } else {
            sectionC.style.display = 'none'; // Sembunyikan bagian C
        }
    }

    // Fungsi untuk mengupdate kesimpulan otomatis (DISESUAIKAN)
    function updateKesimpulan() {
        const kondisiVisual = document.getElementById("kondisi_visual").value;
        const ujiKesalahan = parseFloat(document.getElementById("uji_tahanan").value) || 0;
        const masaPakaiText = document.getElementById("masa_pakai").value;
        const masaPakai = parseInt(masaPakaiText) || 0;
        const kesimpulanDropdown = document.getElementById("kesimpulan");

        let kesimpulan = '';

        // Logika kesimpulan yang lebih robust
        if (masaPakaiText === "") {
            kesimpulan = '';
        } else if (kondisiVisual === 'Baik' && ujiKesalahan > 20 && masaPakai < 40) {
            kesimpulan = 'Bekas layak pakai (K6)';
        } else if (kondisiVisual === 'Baik' && ujiKesalahan <= 20 && masaPakai < 40) {
            kesimpulan = 'Bekas bisa diperbaiki (K7)';
        } else {
            kesimpulan = 'Bekas tidak layak pakai (K8)';
        }

        kesimpulanDropdown.value = kesimpulan;
    }

    // Fungsi untuk validasi form sebelum submit
    function validateForm() {
        const kondisiVisual = document.getElementById("kondisi_visual").value;
        const ujiKesalahan = document.getElementById("uji_tahanan").value;
        const kesimpulan = document.getElementById("kesimpulan").value;

        if (kondisiVisual === 'Baik' && ujiKesalahan === '') {
            alert("Harap isi hasil pengujian tahanan isolasi.");
            return false;
        }

        if (kesimpulan === '') {
            alert("Harap pilih kesimpulan.");
            return false;
        }

        return true; // Form dapat disubmit
    }

    // Inisialisasi saat halaman dimuat (DISEMPURNAKAN)
    document.addEventListener("DOMContentLoaded", function() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById('tahun_produksi');

        // Isi opsi tahun dari 1980 hingga tahun sekarang (sesuai referensi)
        for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }

        // Inisialisasi Select2 menggunakan jQuery
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $('.select2').select2();

            // Event listener untuk Select2 tahun produksi
            $(selectTahun).on('change', function() {
                hitungMasaPakai();
                updateKesimpulan();
            });

            // Event listener untuk kondisi visual
            $('#kondisi_visual').on('change', function() {
                toggleSectionC();
                updateKesimpulan();
            });

            // Event listener untuk uji kesalahan
            $('#uji_tahanan').on('change', function() {
                updateKesimpulan();
            });
        });

        // Set tanggal hari ini
        document.getElementById('tgl_inspeksi').value = new Date().toISOString().split('T')[0];

        // Hitung masa pakai saat pertama kali load
        hitungMasaPakai();
    });
</script>

{{-- <script>
    // Fungsi untuk menampilkan preview gambar
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

    // Fungsi untuk membuka modal gambar
    function openImageModal(imageSrc) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }

    // Fungsi untuk menghitung masa pakai
    function hitungMasaPakai() {
        const tahunProduksi = parseInt(document.getElementById("tahun_produksi").value);
        const tahunSekarang = new Date().getFullYear();
        let masaPakaiText = document.getElementById("masa_pakai");
        let masaPakaiContainer = document.getElementById("masa_pakai");

        if (!isNaN(tahunProduksi)) {
            let masaPakai = tahunSekarang - tahunProduksi;
            masaPakaiText.textContent = masaPakai + " tahun";

            // Ubah warna teks sesuai masa pakai
            if (masaPakai < 30) {
                masaPakaiContainer.className = "flex items-center gap-2 text-green-600 p-2 border rounded";
            } else if (masaPakai >= 30 && masaPakai <= 40) {
                masaPakaiContainer.className = "flex items-center gap-2 text-yellow-600 p-2 border rounded";
            } else {
                masaPakaiContainer.className = "flex items-center gap-2 text-red-600 p-2 border rounded";
            }
        } else {
            masaPakaiText.textContent = "-";
            masaPakaiContainer.className = "flex items-center gap-2 text-gray-500 p-2 border rounded";
        }
    }

    // Fungsi untuk menampilkan atau menyembunyikan bagian C
    function toggleSectionC() {
        const kondisiVisual = document.getElementById("kondisi_visual");
        const sectionC = document.getElementById("sectionC");

        if (kondisiVisual.value === 'Baik') {
            sectionC.style.display = 'block'; // Tampilkan bagian C
        } else {
            sectionC.style.display = 'none'; // Sembunyikan bagian C
        }
    }

    // Fungsi untuk mengupdate kesimpulan otomatis
    function updateKesimpulan() {
        const kondisiVisual = document.getElementById("kondisi_visual").value;
        const ujiKesalahan = parseFloat(document.getElementById("uji_tahanan").value) || 0;
        const masaPakai = parseInt(document.getElementById("masa_pakai").textContent) || 0;
        const kesimpulanDropdown = document.getElementById("kesimpulan");

        let kesimpulan = '';

        if (kondisiVisual === 'Baik' && ujiKesalahan > 20 && masaPakai < 40) {
            kesimpulan = 'Bekas layak pakai (K6)'; // Bekas layak pakai
        } else if (kondisiVisual === 'Baik' && ujiKesalahan <= 20 && masaPakai < 40) {
            kesimpulan = 'Bekas bisa diperbaiki (K7)'; // Bekas bisa diperbaiki
        } else {
            kesimpulan = 'Bekas tidak layak pakai (K8)'; // Bekas tidak layak pakai
        }

        // Set nilai kesimpulan di dropdown
        kesimpulanDropdown.value = kesimpulan;
    }

    // Fungsi untuk validasi form sebelum submit
    function validateForm() {
        const kondisiVisual = document.getElementById("kondisi_visual").value;
        const ujiKesalahan = document.getElementById("uji_tahanan").value;
        const kesimpulan = document.getElementById("kesimpulan").value;

        if (kondisiVisual === 'Baik' && ujiKesalahan === '') {
            alert("Harap isi hasil pengujian tahanan isolasi.");
            return false;
        }

        if (kesimpulan === '') {
            alert("Harap pilih kesimpulan.");
            return false;
        }

        return true; // Form dapat disubmit
    }

    // Inisialisasi saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById('tahun_produksi');

        // Isi opsi tahun
        for (let tahun = tahunSekarang; tahun >= 1900; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }

        // Inisialisasi Select2 menggunakan jQuery
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $('.select2').select2();

            // Event listener untuk Select2
            $(selectTahun).on('change', function() {
                hitungMasaPakai();
                updateKesimpulan(); // Update kesimpulan saat tahun berubah
            });

            // Event listener untuk kondisi visual
            $('#kondisi_visual').on('change', function() {
                toggleSectionC();
                updateKesimpulan(); // Update kesimpulan saat kondisi visual berubah
            });

            // Event listener untuk uji kesalahan
            $('#uji_tahanan').on('change', function() {
                updateKesimpulan(); // Update kesimpulan saat hasil uji berubah
            });
        });

        // Set tanggal hari ini
        document.getElementById('tgl_inspeksi').value = new Date().toISOString().split('T')[0];
    });
</script> --}}

<x-layouts.footer />
