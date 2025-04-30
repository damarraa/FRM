<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Tiang Listrik</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-tiang-listrik.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="15">
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
                                    <label for="tgl_inspeksi">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl_inspeksi" name="tgl_inspeksi"
                                        required readonly>
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
                                    <input type="text" class="form-control" id="lokasi_akhir_terpasang"
                                        name="lokasi_akhir_terpasang" placeholder="Masukkan Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-4 form-group">
                                    <div class="w-50">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2" id="tahun_produksi" name="tahun_produksi"
                                            required>
                                            <option value="">-- Pilih Tahun --</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control" id="masa_pakai" name="masa_pakai"
                                            placeholder="Masa Pakai" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="grid grid-cols-2 gap-4 items-center">
                                        <!-- Input Text untuk Tipe Tiang -->
                                        <div class="flex flex-col">
                                            <label for="tipe_tiang_listrik">Tipe Tiang Listrik</label>
                                            <select class="form-control" name="tipe_tiang_listrik"
                                                id="tipe_tiang_listrik" required>
                                                <option value="">-- Pilih Tipe Tiang --</option>
                                                <option value="Baja">Baja</option>
                                                <option value="Beton">Beton</option>
                                            </select>
                                        </div>

                                        <!-- Select Box untuk Jenis Tiang -->
                                        <div class="flex flex-col">
                                            <label for="jenis_tiang" class="mb-1">Jenis
                                                Tiang</label>
                                            <select class="form-control" id="jenis_tiang" name="jenis_tiang"
                                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                required>
                                                <option value="">-- Pilih Jenis Tiang --</option>
                                                <option value="9/100">9/100</option>
                                                <option value="9/200">9/200</option>
                                                <option value="9/350">9/350</option>
                                                <option value="11/200">11/200</option>
                                                <option value="11/350">11/350</option>
                                                <option value="11/500">11/500</option>
                                                <option value="12/200">12/200</option>
                                                <option value="12/350">12/350</option>
                                                <option value="12/500">12/500</option>
                                                <option value="12/800">12/800</option>
                                                <option value="12/1200">12/1200</option>
                                                <option value="13/200">13/200</option>
                                                <option value="13/350">13/350</option>
                                                <option value="13/500">13/500</option>
                                                <option value="13/800">13/800</option>
                                                <option value="14/200">14/200</option>
                                                <option value="14/350">14/350</option>
                                                <option value="14/500">14/500</option>
                                                <option value="14/800">14/800</option>
                                                <option value="14/1200">14/1200</option>
                                            </select>
                                        </div>
                                    </div>
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
                        <h6 class="mb-3 font-weight-bold">B. Pengujian Visual</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="pengujian_visual">1. Pengujian visual / sifat tampak <i>(Jika Tiang
                                            Baja
                                            terdapat karatan ringan tanpa keropos, maka dapat diperbaiki (cat
                                            ulang))</i>
                                    </label>
                                    <select class="form-control" id="pengujian_visual" name="pengujian_visual"
                                        required>
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak">Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">C. Pengujian Dimensi</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_panjang">1. Panjang <i>(Beban kerja (daN) diisi jika masih
                                            ada di penandaan tiang)</i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="pengujian_panjang"
                                            name="pengujian_panjang" list="panjang-options"
                                            placeholder="Pilih atau masukkan panjang" required>
                                        <datalist id="panjang-options">
                                            <!-- Opsi akan diisi secara dinamis berdasarkan jenis_tiang -->
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">D. Pengujian Konstruksi</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="kelurusan_tiang">1. Kelurusan tiang</label>
                                    <div class="input-group">
                                        <select class="form-control" id="kelurusan_tiang" name="kelurusan_tiang"
                                            required>
                                            <option value="">-- Hasil Pengujian --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKelurusanTiang')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKelurusanTiang" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keterangan_kelurusan_tiang">Keterangan Kelurusan Tiang:</label>
                                        <textarea class="form-control" id="keterangan_kelurusan_tiang" name="keterangan_kelurusan_tiang" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_kelurusan_tiang', 'charCountKelurusanTiang')"></textarea>
                                        <small id="charCountKelurusanTiang" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="kualitasPenyambungContainer">
                                <div class="form-group ">
                                    <label for="kualitas_penyambungan">2. Kualitas penyambung <i>(untuk tiang listrik
                                            baja)</i></label>
                                    <select class="form-control" id="kualitas_penyambungan"
                                        name="kualitas_penyambungan">
                                        <option value="">-- Hasil Pengujian --</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak">Rusak</option>
                                    </select>
                                </div>
                            </div>
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

                        <hr class="mb-3">
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

<!-- Tambahkan script JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script>
    $(document).ready(function() {
        $('#tipe_tiang_listrik').on('input', function() {
            var tipeTiang = $(this).val();
            if (tipeTiang) {
                $.ajax({
                    url: '/get-pabrikans', // Route untuk mendapatkan pabrikans
                    type: 'GET',
                    data: {
                        tipe_tiang_listrik: tipeTiang
                    },
                    success: function(data) {
                        $('#pabrikan_id').empty();
                        $('#pabrikan_id').append(
                            '<option value="">-- Pilih Pabrikan --</option>');
                        $.each(data, function(key, value) {
                            $('#pabrikan_id').append('<option value="' + value.id +
                                '">' + value.nama_pabrikan + '</option>');
                        });
                    }
                });
            } else {
                $('#pabrikan_id').empty();
                $('#pabrikan_id').append('<option value="">-- Pilih Pabrikan --</option>');
            }
        });
    });

    document.getElementById('jenis_tiang').addEventListener('change', function() {
        const jenisTiang = this.value;
        const datalist = document.getElementById('panjang-options');

        // Clear existing options
        datalist.innerHTML = '';

        // Mapping antara jenis_tiang dan opsi pengujian_panjang
        const mappingPanjangTiang = {
            "9/100": [9],
            "9/200": [9],
            "9/350": [9],
            "11/200": [11],
            "11/350": [11],
            "11/500": [11],
            "12/200": [12],
            "12/350": [12],
            "12/500": [12],
            "12/800": [12],
            "12/1200": [12],
            "13/200": [13],
            "13/350": [13],
            "13/500": [13],
            "13/800": [13],
            "13/1200": [13],
            "14/200": [14],
            "14/350": [14],
            "14/500": [14],
            "14/800": [14],
            "14/1200": [14]
            // Tambahkan mapping lainnya sesuai kebutuhan
        };

        // Isi datalist dengan opsi yang sesuai
        if (mappingPanjangTiang[jenisTiang]) {
            mappingPanjangTiang[jenisTiang].forEach(panjang => {
                const option = document.createElement('option');
                option.value = panjang;
                datalist.appendChild(option);
            });
        }
    });
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

<!-- Script untuk handle form -->
<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "1000"
    };

    // Fungsi untuk preview image
    function previewImage(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        if (!previewContainer) return;

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

    function openImageModal(imageSrc) {
        const modalImage = document.getElementById('modalImage');
        if (!modalImage) return;

        modalImage.src = imageSrc;
        const modalElement = document.getElementById('imageModal');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Dapatkan referensi form dengan benar
        const formInspeksi = document.getElementById("formInspeksi");
        if (!formInspeksi) {
            console.error("Form tidak ditemukan");
            return;
        }

        // Fungsi untuk mengecek apakah form memiliki perubahan
        function hasFormChanges() {
            const savedData = localStorage.getItem("formInspeksiData");
            return savedData !== null;
        }

        // Fungsi untuk reset form dan localStorage
        function resetForm() {
            // Simpan nilai tgl_inspeksi sebelum form di-reset
            const tglInspeksi = document.getElementById("tgl_inspeksi");
            const tglInspeksiValue = tglInspeksi ? tglInspeksi.value : '';

            // Reset form ke keadaan default
            formInspeksi.reset();

            // Kembalikan nilai tgl_inspeksi setelah form di-reset
            if (tglInspeksi) {
                tglInspeksi.value = tglInspeksiValue;
            }

            // Hapus data dari localStorage
            localStorage.removeItem("formInspeksiData");

            // Reset Select2 jika ada
            if (jQuery().select2) {
                jQuery('.select2').val(null).trigger('change');
            }

            // Update kesimpulan setelah reset
            updateKesimpulan();

            // Tampilkan notifikasi
            toastr.success('Form telah berhasil dikosongkan.');
        }

        // Fungsi untuk menyimpan data form ke localStorage
        function simpanDataForm() {
            const formData = new FormData(formInspeksi);
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });
            localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
        }

        // Fungsi untuk memuat data dari localStorage
        function muatDataForm() {
            const savedData = localStorage.getItem("formInspeksiData");
            if (savedData) {
                const formObject = JSON.parse(savedData);
                for (const key in formObject) {
                    const inputElement = formInspeksi.querySelector(`[name="${key}"]`);
                    if (inputElement && inputElement.type !== "file") {
                        inputElement.value = formObject[key];

                        // Trigger event change untuk Select2
                        if (inputElement.classList.contains('select2-hidden-accessible')) {
                            jQuery(inputElement).trigger('change');
                        }
                    }
                }

                // Update kesimpulan setelah memuat data
                setTimeout(updateKesimpulan, 200);
            }
        }

        // Fungsi untuk menghapus data dari localStorage
        function hapusDataForm() {
            localStorage.removeItem("formInspeksiData");
        }

        // Muat data dari localStorage saat halaman dimuat
        muatDataForm();

        // Reset localStorage jika halaman dimuat melalui navigasi (bukan reload)
        if (window.performance && window.performance.navigation.type === window.performance.navigation
            .TYPE_NAVIGATE) {
            localStorage.removeItem("formInspeksiData");
        }

        // Inisialisasi tahun produksi
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById("tahun_produksi");
        const inputMasaPakai = document.getElementById("masa_pakai");

        // Isi dropdown tahun produksi dari 1980 hingga tahun sekarang
        if (selectTahun) {
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
                    simpanDataForm();
                    updateKesimpulan();
                });
            });
        }

        // Fungsi untuk menghitung masa pakai
        function hitungMasaPakai() {
            if (!selectTahun || !inputMasaPakai) return;

            const tahunProduksi = parseInt(selectTahun.value);
            if (!isNaN(tahunProduksi)) {
                inputMasaPakai.value = (tahunSekarang - tahunProduksi) + " tahun";
            } else {
                inputMasaPakai.value = "";
            }
        }

        // Set tanggal hari ini
        const tglInspeksi = document.getElementById("tgl_inspeksi");
        if (tglInspeksi) {
            let today = new Date().toISOString().split('T')[0];
            tglInspeksi.value = today;
        }

        // Event listener untuk update kesimpulan
        const inputsForKesimpulan = [
            'tahun_produksi', 'pengujian_visual', 'pengujian_panjang',
            'kelurusan_tiang', 'kualitas_penyambungan', 'tipe_tiang_listrik'
        ];

        inputsForKesimpulan.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener('change', function() {
                    updateKesimpulan();
                    simpanDataForm();
                });
            }
        });

        // Event listener untuk tipe tiang
        // Event listener tetap untuk menunjukkan/sembunyikan kualitas penyambung
        const tipeTiangSelect = document.getElementById('tipe_tiang_listrik');
        if (tipeTiangSelect) {
            tipeTiangSelect.addEventListener('change', function() {
                const kualitasPenyambungContainer = document.getElementById(
                    'kualitasPenyambungContainer');
                const kualitasPenyambung = document.getElementById('kualitas_penyambungan');
                kualitasPenyambungContainer.style.display = 'block';
                if (kualitasPenyambung) kualitasPenyambung.value = '';
                updateKesimpulan();
                simpanDataForm();
            });
        }

        // Event listener untuk tipe tiang
        // const tipeTiangSelect = document.getElementById('tipe_tiang_listrik');
        // if (tipeTiangSelect) {
        //     tipeTiangSelect.addEventListener('change', function() {
        //         const tipeTiang = this.value;
        //         const kualitasPenyambungContainer = document.getElementById(
        //             'kualitasPenyambungContainer');
        //         const kualitasPenyambung = document.getElementById('kualitas_penyambungan');

        //         if (tipeTiang === 'Beton') {
        //             kualitasPenyambungContainer.style.display = 'none';
        //             if (kualitasPenyambung) kualitasPenyambung.value = '';
        //         } else {
        //             kualitasPenyambungContainer.style.display = 'block';
        //         }
        //         updateKesimpulan();
        //         simpanDataForm();
        //     });
        // }

        function updateKesimpulan() {
            try {
                const kesimpulanDropdown = document.getElementById('kesimpulan');
                if (!kesimpulanDropdown) {
                    console.error("Dropdown kesimpulan tidak ditemukan");
                    return;
                }

                // Ambil nilai input
                const tipePanjang = $('#tipe_panjang_tiang').val() || ''; // e.g., "11/200"
                const tahunProduksi = parseInt($('#tahun_produksi').val()) || 0;
                const masaPakai = new Date().getFullYear() - tahunProduksi;

                // Inspeksi visual
                const pengujianVisual = $('#pengujian_visual').val() || '';

                // Panjang aktual hasil pengukuran
                const panjangInput = $('#pengujian_panjang').val() || '0';
                const panjang = parseFloat(panjangInput.toString().replace(',', '.')) || 0;

                // Inspeksi mekanik
                const kelurusanTiang = $('#kelurusan_tiang').val() || '';
                const kualitasPenyambung = $('#kualitas_penyambungan').val() || '';

                // Validasi panjang sesuai tipe panjang tiang
                let panjangValid = false;
                const panjangOptions = {
                    "9/100": [9],
                    "9/200": [9],
                    "9/350": [9],
                    "11/200": [11],
                    "11/350": [11],
                    "11/500": [11],
                    "12/200": [12],
                    "12/350": [12],
                    "12/500": [12],
                    "12/800": [12],
                    "12/1200": [12],
                    "13/200": [13],
                    "13/350": [13],
                    "13/500": [13],
                    "13/800": [13],
                    "13/1200": [13],
                    "14/200": [14],
                    "14/350": [14],
                    "14/500": [14],
                    "14/800": [14],
                    "14/1200": [14]
                };

                if (tipePanjang && panjangOptions[tipePanjang]) {
                    panjangValid = panjangOptions[tipePanjang].some(validLength => {
                        return Math.abs(panjang - validLength) <= 0.15;
                    });
                }

                // Logika penentuan kesimpulan
                let kesimpulan = '';

                // 1. Jika masa pakai > 40 tahun -> K8
                if (masaPakai > 40) {
                    kesimpulan = 'Bekas tidak layak pakai (K8)';
                }
                // 2. Jika ada kerusakan di Poin D -> K8
                else if (kelurusanTiang === 'Rusak' || kualitasPenyambung === 'Rusak') {
                    kesimpulan = 'Bekas tidak layak pakai (K8)';
                }
                // 3. Jika semua inspeksi bagus dan panjang valid -> K6
                else if (
                    masaPakai <= 40 &&
                    pengujianVisual === 'Baik' &&
                    kelurusanTiang === 'Baik' &&
                    kualitasPenyambung === 'Baik' &&
                    panjangValid
                ) {
                    kesimpulan = 'Bekas layak pakai (K6)';
                }
                // 4. Jika masa pakai masih aman tapi ada kekurangan -> K7
                else if (masaPakai <= 40) {
                    kesimpulan = 'Bekas bisa diperbaiki (K7)';
                }
                // 5. Default -> K8
                else {
                    kesimpulan = 'Bekas tidak layak pakai (K8)';
                }

                // Update nilai dropdown
                kesimpulanDropdown.value = kesimpulan;
                if ($(kesimpulanDropdown).hasClass('select2-hidden-accessible')) {
                    $(kesimpulanDropdown).val(kesimpulan).trigger('change');
                }

            } catch (error) {
                console.error("Error dalam updateKesimpulan:", error);
            }
        }

        // function updateKesimpulan() {
        //     try {
        //         const kesimpulanDropdown = document.getElementById('kesimpulan');
        //         if (!kesimpulanDropdown) {
        //             console.error("Dropdown kesimpulan tidak ditemukan");
        //             return;
        //         }

        //         // Ambil nilai dengan default value yang aman
        //         const tahunProduksi = parseInt($('#tahun_produksi').val()) || 0;
        //         const pengujianVisual = $('#pengujian_visual').val() || '';
        //         const kelurusanTiang = $('#kelurusan_tiang').val() || '';
        //         const kualitasPenyambung = $('#kualitas_penyambungan').val() || 'Baik';
        //         const panjangInput = $('#pengujian_panjang').val() || '0';
        //         const tipeTiang = $('#tipe_tiang_listrik').val() || '';

        //         // Konversi panjang yang aman
        //         const panjang = parseFloat(panjangInput.toString().replace(',', '.')) || 0;

        //         const umurMaterial = new Date().getFullYear() - tahunProduksi;
        //         let kesimpulan = '';

        //         // Validasi panjang berdasarkan tipe tiang
        //         let panjangValid = false;
        //         const panjangOptions = {
        //             "9/100": [9],
        //             "9/200": [9],
        //             "9/350": [9],
        //             "11/200": [11],
        //             "11/350": [11],
        //             "11/500": [11],
        //             "12/200": [12],
        //             "12/350": [12],
        //             "12/500": [12],
        //             "12/800": [12],
        //             "12/1200": [12],
        //             "13/200": [13],
        //             "13/350": [13],
        //             "13/500": [13],
        //             "13/800": [13],
        //             "13/1200": [13],
        //             "14/200": [14],
        //             "14/350": [14],
        //             "14/500": [14],
        //             "14/800": [14],
        //             "14/1200": [14]
        //         };

        //         if (tipeTiang && panjangOptions[tipeTiang]) {
        //             panjangValid = panjangOptions[tipeTiang].some(validLength => {
        //                 return Math.abs(panjang - validLength) <= 0.15; // toleransi 15cm
        //             });
        //         }

        //         // Logika penentuan kesimpulan
        //         if (umurMaterial > 40) {
        //             kesimpulan = 'Bekas tidak layak pakai (K8)';
        //         } else if (pengujianVisual === 'Baik' && kelurusanTiang === 'Baik' && panjangValid) {
        //             kesimpulan = 'Bekas layak pakai (K6)';
        //         } else if (kelurusanTiang === 'Rusak' || (tipeTiang !== 'Beton' && kualitasPenyambung ===
        //                 'Rusak')) {
        //             kesimpulan = 'Bekas tidak layak pakai (K8)';
        //         } else {
        //             kesimpulan = 'Bekas bisa diperbaiki (K7)';
        //         }

        //         // Set nilai kesimpulan
        //         kesimpulanDropdown.value = kesimpulan;

        //         // Jika menggunakan Select2, trigger change
        //         if ($(kesimpulanDropdown).hasClass('select2-hidden-accessible')) {
        //             $(kesimpulanDropdown).val(kesimpulan).trigger('change');
        //         }

        //         console.log('Kesimpulan di-set ke:', kesimpulan);
        //     } catch (error) {
        //         console.error("Error dalam updateKesimpulan:", error);
        //     }
        // }

        // Panggil fungsi saat elemen terkait berubah
        $('#tahun_produksi, #pengujian_visual, #kelurusan_tiang, #kualitas_penyambungan, #pengujian_panjang, #tipe_tiang_listrik')
            .on('change', updateKesimpulan);

        // Inisialisasi pertama kali
        $(document).ready(function() {
            updateKesimpulan();
        });

        // Nonaktifkan perubahan manual untuk select kesimpulan jika user adalah Petugas
        const kesimpulanSelect = document.getElementById('kesimpulan');
        if (kesimpulanSelect && {{ auth()->user()->hasRole('Petugas') ? 'true' : 'false' }}) {
            kesimpulanSelect.addEventListener('mousedown', function(e) {
                e.preventDefault();
                return false;
            });

            kesimpulanSelect.addEventListener('keydown', function(e) {
                e.preventDefault();
                return false;
            });
        }

        // Event listeners untuk input dan change pada form
        formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
            element.addEventListener("input", function() {
                simpanDataForm();
                if (inputsForKesimpulan.includes(element.id)) {
                    updateKesimpulan();
                }
            });
            element.addEventListener("change", function() {
                simpanDataForm();
                if (inputsForKesimpulan.includes(element.id)) {
                    updateKesimpulan();
                }
            });
        });

        // Event listener untuk form reset
        formInspeksi.addEventListener("reset", function() {
            hapusDataForm();
            setTimeout(updateKesimpulan, 100);
        });

        // Event listener untuk clear form
        const clearButton = document.getElementById('clearFormButton');
        if (clearButton) {
            clearButton.addEventListener('click', function(e) {
                e.preventDefault();
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
                        resetForm();
                    }
                });
            });
        }

        // Konfirmasi sebelum meninggalkan halaman
        const backButton = document.getElementById('backButton');
        if (backButton) {
            backButton.addEventListener('click', function(e) {
                if (hasFormChanges()) {
                    e.preventDefault();
                    const href = this.getAttribute('href');

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
                            window.location.href = href;
                        }
                    });
                }
            });
        }

        // Form submission handler
        formInspeksi.addEventListener('submit', function(e) {
            // Hapus data dari localStorage
            hapusDataForm();

            // Tampilkan toast sukses
            toastr.success('Data berhasil disimpan!');
        });

        // Tangkap pesan sukses dari Laravel
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        // Tangkap pesan error dari Laravel
        @if (Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ Session::get('error') }}"
            });
        @endif

        // Panggil updateKesimpulan sekali saat halaman dimuat
        setTimeout(updateKesimpulan, 300);
    });
</script>
<x-layouts.footer />
