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
                    <form id="formInspeksi" action="{{ route('form-retur-lbs.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

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
                                            <option value="{{ $up3->id }}">{{ $up3->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gudang_id">Gudang Retur</label>
                                    <select name="gudang_id" class="form-control" id="gudang_id" required>
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
                        <h6 class="mb-3"><strong>A. Data Material</strong></h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi_akhir_terpasang">Lokasi Akhir Terpasang</label>
                                    <input name="lokasi_akhir_terpasang" type="text" class="form-control"
                                        id="lokasi_akhir_terpasang" placeholder="Masukkan Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select name="ulp_id" class="form-control" id="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-4">
                                    <div class="w-50">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            name="tahun_produksi" id="tahun_produksi" required>
                                            <option value="">-- Pilih Tahun --</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun sekarang - Tahun produksi" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_lbs">Tipe LBS</label>
                                    <select name="tipe_lbs" class="form-control" id="tipe_lbs" required>
                                        <option value="">-- Pilih Tipe LBS --</option>
                                        <option value="Vacuum">Vacuum</option>
                                        <option value="SF6">SF6</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input name="no_serial" type="number" class="form-control" id="no_serial"
                                        placeholder="Masukkan No Serial" required>
                                </div>
                                <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <select name="pabrikan_id" class="form-control" id="pabrikan_id" required>
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
                                    <label for="nameplate">1. Papan Nama</label>
                                    <select id="nameplate" name="nameplate" class="form-control poin1" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penandaan_terminal">2. Penandaan Terminal</label>
                                    <select id="penandaan_terminal" name="penandaan_terminal"
                                        class="form-control poin2" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="counter_lbs">3. Counter Mekanis LBS</label>
                                    <select id="counter_lbs" name="counter_lbs" class="form-control poin3" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bushing_lbs">4. Kondisi Fisik Bushing HV <i>(Ada retak/longgar dari
                                            tangki/seal bushing
                                            rembes)</i></label>
                                    <select id="bushing_lbs" name="bushing_lbs" class="form-control poin4" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="indikator_lbs">5. Indikator posisi LBS</label>
                                    <select id="indikator_lbs" name="indikator_lbs" class="form-control poin5"
                                        required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rtu_lbs">6. Fisik RTU</label>
                                    <select id="rtu_lbs" name="rtu_lbs" class="form-control poin6" required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="interuptor_lbs">7. Indikator Kegagalan Interuptor Pada Vacuum Atau
                                        Indikator Low Pressure
                                        Pada Gas SF6</label>
                                    <select id="interuptor_lbs" name="interuptor_lbs" class="form-control poin7"
                                        required>
                                        <option value="">-- Hasil Pemeriksaan --</option>
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak ada">Tidak ada</option>
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
                                            <option value="Berhasil">Berhasil</option>
                                            <option value="Gagal">Gagal</option>
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
                                            oninput="updateCharCount('keteranganMekanikManual', 'charCountMekanikManual')"></textarea>
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
                                            <option value="Berhasil">Berhasil</option>
                                            <option value="Gagal">Gagal</option>
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
                                            oninput="updateCharCount('keteranganPanelKontrol', 'charCountPanelKontrol')"></textarea>
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
                                            step="0.1" required placeholder="Masukkan Nilai R">
                                        <span class="input-group-text">µOhm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="elektrik_s">b) S</label>
                                    <div class="input-group">
                                        <input name="elektrik_s" type="number" class="form-control" id="elektrik_s"
                                            step="0.1" required placeholder="Masukkan Nilai S">
                                        <span class="input-group-text">µOhm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="elektrik_t">c) T</label>
                                    <div class="input-group">
                                        <input name="elektrik_t" type="number" class="form-control" id="elektrik_t"
                                            step="0.1" required placeholder="Masukkan Nilai T">
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

                        <!-- Bagian F: Gambar Evidence -->
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

<!-- Tambahkan di bagian head atau sebelum penutup body -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "3000"
    };

    // Fungsi utama setelah DOM loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Inisialisasi form
        const formInspeksi = document.getElementById("formInspeksi");

        // [Bagian yang dimodifikasi] - Event submit form
        formInspeksi.addEventListener('submit', function(e) {
            // e.preventDefault(); // 1. Hentikan submit default

            // Simpan data ke localStorage
            localStorage.removeItem("formInspeksiData");

            // Tampilkan toast
            toastr.success('Data berhasil disimpan!');

            // Submit form setelah toast muncul
            setTimeout(() => {
                formInspeksi.submit();
            }, 1000);
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

        // Inisialisasi
        hitungMasaPakai();
        toggleSectionC();
        updateKesimpulan();
    });
</script>
<x-layouts.footer />
