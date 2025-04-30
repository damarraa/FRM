<x-layouts.header />
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Formulir Inspeksi Material Retur Cable Power</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" name="formInspeksi" action="{{ route('form-retur-cable-power.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="4">
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

                        <h6 class="mb-3 font-weight-bold">A. Data Material</h6>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi_akhir_terpasang">Lokasi Akhir Terpasang</label>
                                    <input type="text" class="form-control" id="lokasi_akhir_terpasang"
                                        name="lokasi_akhir_terpasang" placeholder="Masukkan lokasi akhir terpasang"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>

                                <div class="d-flex gap-4">
                                    <div class="w-50">
                                        <label for="tahun_pemasangan">Tahun Pemasangan</label>
                                        <select class="form-control select2" id="tahun_pemasangan"
                                            name="tahun_pemasangan" required>
                                            <option value="">-- Pilih Tahun --</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" placeholder="Masa Pakai" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="d-flex gap-4">
                                    <div class="w-50">
                                        <label for="jenis_cable_power">Jenis Cable Power:</label>
                                        <select class="form-control select2-cable" id="jenis_cable_power"
                                            name="jenis_cable_power" required>
                                            <option value="">-- Pilih Jenis Cable --</option>
                                            <option value="LVTIC">LVTIC</option>
                                            <option value="NYY">NYY</option>
                                            <option value="XLPE">XLPE</option>
                                            <option value="MVTIC">MVTIC</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="ukuran_cable_power">Ukuran</label>
                                        <div class="input-group">
                                            <input name="ukuran_cable_power" type="text" class="form-control"
                                                id="ukuran_cable_power" placeholder="Masukkan ukuran kabel" required>
                                            <span class="input-group-text">mm2</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="luas_penampang">Luas Penampang</label>
                                    <div class="input-group">
                                        <input name="luas_penampang" type="number" class="form-control"
                                            id="luas_penampang" placeholder="Masukkan luas penampang" required
                                            min="0" step="0.01" title="Currency"
                                            pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                            required>
                                        <span class="input-group-text" id="basic-addon2">mm2</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="panjang_cable_power">Panjang</label>
                                    <div class="input-group">
                                        <input name="panjang_cable_power" type="number" class="form-control"
                                            id="panjang_cable_power" placeholder="Masukkan Panjang" required
                                            min="0" step="0.01" title="Currency"
                                            pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                        <span class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">B. Pengujian Non Elektrik</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nilai_pemeriksaan_kondisi_visual">1. Pemeriksaan kondisi visual dan
                                        penandaan (Tidak Rantas,
                                        Tidak Mekar &
                                        Isolasi Tidak Rusak) </label>
                                    <div class="input-group">
                                        <select name="nilai_pemeriksaan_kondisi_visual" class="form-control"
                                            id="nilai_pemeriksaan_kondisi_visual" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNilaiPemeriksaanKondisiVisual')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNilaiPemeriksaanKondisiVisual" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keterangan_pemeriksaan">Keterangan Pemeriksaan Kondisi Visual:
                                        </label>
                                        <textarea class="form-control" id="keterangan_pemeriksaan" name="keterangan_pemeriksaan" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_pemeriksaan', 'charCountNilaiPemeriksaan')"></textarea>
                                        <small id="charCountNilaiPemeriksaan" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nilai_pengujian_dimensi">2. Pengujian dimensi (+/- 1% dari luas
                                        penampang)</label>
                                    <div class="input-group">
                                        <input name="nilai_pengujian_dimensi" type="number" class="form-control"
                                            id="nilai_pengujian_dimensi" placeholder="Masukkan diameter konduktor"
                                            required min="0" step="0.01" title="Currency"
                                            pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                        <span class="input-group-text" id="basic-addon2">mm</span>
                                    </div>
                                    <small id="rentangToleransi" class="form-text text-muted"></small>
                                    <!-- Tambahkan elemen untuk menampilkan pesan peringatan -->
                                    <div id="warningMessageDimensi" style="color: red; display: none;">
                                        ⚠ Nilai diameter konduktor berada di luar rentang toleransi.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">C. Pengujian Elektrik</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nilai_uji_tahanan_isolasi">Uji Tahanan Isolasi (Tidak Tembus atau
                                        bernilai > 0
                                        ohm)</label>
                                    <div class="input-group">
                                        <input name="nilai_uji_tahanan_isolasi" type="number" class="form-control"
                                            id="nilai_uji_tahanan_isolasi" placeholder="Hasil pengujian" required
                                            min="0" step="0.01" title="Currency"
                                            pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                        <span class="input-group-text" id="basic-addon2">MΩ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3 font-weight-bold">D. Kesimpulan</h6>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan_k6">Bekas layak pakai (K6)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="kesimpulan_k6"
                                            name="kesimpulan_k6" placeholder="Masukkan Panjang Konduktor"
                                            required><span class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan_k8">Bekas tidak layak pakai (K8)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="kesimpulan_k8"
                                            name="kesimpulan_k8" placeholder="Masukkan Panjang Konduktor"
                                            required><span class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Tambahkan elemen untuk menampilkan pesan warning -->
                            <div id="warningMessageKesimpulan" style="color: red; display: none;">
                                ⚠ Jumlah panjang K6 dan K8 tidak sesuai dengan panjang cable power.
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="font-weight-bold">E. Gambar Evidence</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar1" style="display: block">Gambar 1</label>
                                    <div id="preview1" class="mt-2"></div>
                                    <input type="file" name="gambar[0]" id="gambar1" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview1')">
                                </div>

                                <div class="form-group">
                                    <label for="gambar2" style="display: block">Gambar 2</label>
                                    <div id="preview2" class="mt-2"></div>
                                    <input type="file" name="gambar[1]" id="gambar2" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview2')">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar3" style="display: block">Gambar 3</label>
                                    <div id="preview3" class="mt-2"></div>
                                    <input type="file" name="gambar[2]" id="gambar3" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview3')">
                                </div>

                                <div class="form-group">
                                    <label for="gambar4" style="display: block">Gambar 4</label>
                                    <div id="preview4" class="mt-2"></div>
                                    <input type="file" name="gambar[3]" id="gambar4" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview4')">
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
        charCount.textContent = $ {
            remainingChars
        }
        karakter tersisa.;

        // Jika karakter habis, ubah warna teks menjadi merah
        if (remainingChars <= 0) {
            charCount.style.color = 'red';
        } else {
            charCount.style.color = 'gray';
        }
    }
</script>


<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "2000",
    };

    // Fungsi untuk mengecek apakah form memiliki perubahan
    function hasFormChanges() {
        const savedData = localStorage.getItem("formInspeksiData");
        return savedData !== null;
    }

    // SweetAlert untuk Clear Form
    document.addEventListener('DOMContentLoaded', function() {
        const clearButton = document.getElementById('clearFormButton');
        if (clearButton) {
            clearButton.addEventListener('click', function() {
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

                            // Hapus data dari localStorage
                            localStorage.removeItem("formInspeksiData");

                            // Jalankan fungsi lain yang diperlukan (opsional)
                            if (typeof updateKesimpulan === 'function') {
                                updateKesimpulan();
                            }

                            toastr.success('Form telah berhasil dikosongkan.');
                        }
                    }
                });
            });
        }

        // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
        const backButton = document.getElementById('backButton');
        if (backButton) {
            backButton.addEventListener('click', function(e) {
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
        }

        // Toast Notification untuk Submit Sukses
        const formInspeksi = document.getElementById('formInspeksi');
        if (formInspeksi) {
            formInspeksi.addEventListener('submit', function(e) {
                // Hapus data dari localStorage saat form disubmit
                localStorage.removeItem("formInspeksiData");

                // Tampilkan toast sukses
                toastr.success('Data berhasil disimpan!');
            });
        }

        // Tangkap pesan sukses dari Laravel (jika ada)
        // @if (Session::has('success'))
        //     toastr.success("{{ Session::get('success') }}");
        // @endif

        // Tangkap pesan error dari Laravel (jika ada)
        @if (Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ Session::get('error') }}"
            });
        @endif
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Dapatkan referensi form dengan benar
        const formInspeksi = document.getElementById("formInspeksi");

        if (!formInspeksi) {
            console.error("Form dengan ID 'formInspeksi' tidak ditemukan!");
            return;
        }

        // Muat data dari localStorage saat halaman dimuat
        muatDataForm();

        // Reset localStorage jika halaman dimuat melalui navigasi (bukan reload)
        if (window.performance && window.performance.navigation.type === window.performance.navigation
            .TYPE_NAVIGATE) {
            localStorage.removeItem("formInspeksiData");
        }
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            // Untuk semua select2 umum
            $('.select2').each(function() {
                $(this).select2({
                    tags: true,
                    width: '100%',
                    dropdownParent: $(this).parent(), // Set parent spesifik per elemen
                    closeOnSelect: true
                }).on('change', function() {
                    hitungMasaPakai();
                    $(this).trigger('blur');
                });
            });

            // Untuk select khusus kabel (jika beda gaya atau form)
            $('.select2-cable').each(function() {
                $(this).select2({
                    tags: true,
                    width: '100%',
                    dropdownParent: $(this).parent()
                });
            });
        });

        // Isi opsi tahun
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById('tahun_pemasangan');
        const inputMasaPakai = document.getElementById("masa_pakai");

        for (let tahun = tahunSekarang; tahun >= 1900; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }

        // Hitung masa pakai
        function hitungMasaPakai() {
            const tahun_pemasangan = parseInt(selectTahun
                .value); // Menggunakan .value dari JavaScript
            if (!isNaN(tahun_pemasangan)) {
                const masaPakai = tahunSekarang - tahun_pemasangan;
                inputMasaPakai.value = masaPakai + " tahun";
            } else {
                inputMasaPakai.value = ""; // Kosongkan jika tahun tidak valid
            }
        }

        // Tambahkan event listener untuk perubahan tahun pemasangan
        selectTahun.addEventListener('change', hitungMasaPakai);

        // Hitung rentang ±1% dari luas penampang
        const luasPenampangInput = document.getElementById('luas_penampang');
        const rentangToleransi = document.getElementById('rentangToleransi');
        const diameterKonduktorInput = document.getElementById('nilai_pengujian_dimensi');
        const warningMessageDimensi = document.getElementById(
            'warningMessageDimensi'); // Elemen pesan peringatan

        luasPenampangInput.addEventListener('input', function() {
            const luasPenampang = parseFloat(luasPenampangInput.value) || 0;
            const toleransi = luasPenampang * 0.01; // 1% dari luas penampang
            const min = luasPenampang - toleransi;
            const max = luasPenampang + toleransi;

            // Tampilkan rentang toleransi
            rentangToleransi.textContent =
                Rentang toleransi: $ {
                    min.toFixed(2)
                }
            mm - $ {
                max.toFixed(2)
            }
            mm;

            // Validasi diameter konduktor (hanya untuk peringatan, tidak memblokir submit)
            diameterKonduktorInput.addEventListener('input', function() {
                const diameterKonduktor = parseFloat(diameterKonduktorInput
                    .value) || 0;

                if (diameterKonduktor < min || diameterKonduktor > max) {
                    // Tampilkan pesan peringatan
                    warningMessageDimensi.style.display = 'block';
                    diameterKonduktorInput.style.borderColor =
                        'red'; // Beri warna border merah
                } else {
                    // Sembunyikan pesan peringatan
                    warningMessageDimensi.style.display = 'none';
                    diameterKonduktorInput.style.borderColor =
                        ''; // Kembalikan warna border default
                }
            });
        });

        const panjangCablePowerInput = document.getElementById('panjang_cable_power');
        const kesimpulanK6Input = document.getElementById('kesimpulan_k6');
        const kesimpulanK8Input = document.getElementById('kesimpulan_k8');
        const warningMessageKesimpulan = document.getElementById(
            'warningMessageKesimpulan'); // Elemen pesan warning

        // Fungsi untuk memeriksa kesesuaian panjang
        function checkPanjang() {
            const panjangCablePower = parseFloat(panjangCablePowerInput.value) || 0;
            const panjangK6 = parseFloat(kesimpulanK6Input.value) || 0;
            const panjangK8 = parseFloat(kesimpulanK8Input.value) || 0;

            const totalPanjang = panjangK6 + panjangK8;

            if (totalPanjang !== panjangCablePower) {
                // Tampilkan pesan warning
                warningMessageKesimpulan.style.display = 'block';
            } else {
                // Sembunyikan pesan warning
                warningMessageKesimpulan.style.display = 'none';
            }
        }

        // Tambahkan event listener untuk input panjang_cable_power, kesimpulan_k6, dan kesimpulan_k8
        panjangCablePowerInput.addEventListener('input', checkPanjang);
        kesimpulanK6Input.addEventListener('input', checkPanjang);
        kesimpulanK8Input.addEventListener('input', checkPanjang);

        // 📌 Fungsi untuk menyimpan data ke local storage
        function simpanDataForm() {
            const formData = new FormData(formInspeksi);
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });
            localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
        }

        // 📌 Fungsi untuk memuat data dari local storage
        function muatDataForm() {
            const savedData = localStorage.getItem("formInspeksiData");
            if (savedData) {
                const formObject = JSON.parse(savedData);
                for (const key in formObject) {
                    const inputElement = formInspeksi.querySelector([name = "${key}"]);
                    if (inputElement && inputElement.type !== "file") {
                        inputElement.value = formObject[key];
                    }
                }

                // Setelah memuat data, update kesimpulan
                if (typeof handleChange === 'function') {
                    handleChange();
                }
            }
        }

        // 📌 Fungsi untuk menghapus data dari local storage
        function hapusDataForm() {
            localStorage.removeItem("formInspeksiData");
        }

        // 📌 Event listener untuk input dan change
        formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
            element.addEventListener("input", simpanDataForm);
            element.addEventListener("change", simpanDataForm);
        });

        // 📌 Event listener untuk form reset
        formInspeksi.addEventListener("reset", function() {
            hapusDataForm();
        });
    });
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

<x-layouts.footer  />
