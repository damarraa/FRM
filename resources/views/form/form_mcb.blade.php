<x-layouts.header />
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur MCB</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-mcb.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="jenis_form_id" value="2">
                        <input type="hidden" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                        <div class="row">
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
                                    <select class="form-control" name="gudang_id" id="gudang_id" required>
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
                                    <label for="id_pelanggan">ID Pelanggan</label>
                                    <input type="number" class="form-control" id="id_pelanggan" name="id_pelanggan"
                                        placeholder="Masukkan ID Pelanggan" required>
                                </div>

                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="TipeMCB">Tipe MCB</label>
                                    <select class="form-control" name="tipe_mcb" id="tipe_mcb" required>
                                        <option value="">-- Pilih Tipe MCB --</option>
                                        <option value="1 fasa">1 fasa</option>
                                        <option value="3 fasa">3 fasa</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="number" class="form-control" id="no_serial" name="no_serial"
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

                                <div class="form-group">
                                    <label for="nilai_ampere">Nilai Ampere</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="nilai_ampere" id="nilai_ampere"
                                            placeholder="Masukkan Nilai Ampere MCB" pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==3) return false;" required>
                                        <span class="input-group-text" id="basic-addon2">A</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Visual dan Konstruksi</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masa_pakai">1. Masa Pakai</label>
                                    <div class="input-group">
                                        <select class="form-control" id="masa_pakai" name="masa_pakai" required>
                                            <option value="">-- Pilih Masa Pakai --</option>
                                            <option value="<=10">
                                                ≤ 10 tahun</option>
                                            <option value=">=10">≥ 10 tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pengujian_ketidakhapusan_penandaan">2. Pengujian ketidakhapusan
                                        pendanaan</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="pengujian_ketidakhapusan_penandaan"
                                            name="pengujian_ketidakhapusan_penandaan" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKetidakhapusanPenandaan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKetidakhapusanPenandaan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keterangan_ketidakhapusan_penandaan">Keterangan Ketidakhapusan
                                            Penandaan:</label>
                                        <textarea class="form-control" id="keterangan_ketidakhapusan_penandaan" name="keterangan_ketidakhapusan_penandaan"
                                            rows="2" maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_ketidakhapusan_penandaan', 'charCountKetidakhapusanPenandaan')"></textarea>
                                        <small id="charCountKetidakhapusanPenandaan" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pengujian_toggle_switch">3. Pengujian toggle switch</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="pengujian_toggle_switch"
                                            name="pengujian_toggle_switch" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganToggleSwitch')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganToggleSwitch" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_toggle_switch">Keterangan Toggle Switch:</label>
                                        <textarea class="form-control" id="keterangan_toggle_switch" name="keterangan_toggle_switch" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_toggle_switch', 'charCountToggleSwitch')"></textarea>
                                        <small id="charCountToggleSwitch" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_keandalan_sekrup">4. Pengujian keandalan sekrup, bagian yang
                                        menghantar arus dan sambungan</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="pengujian_keandalan_sekrup"
                                            name="pengujian_keandalan_sekrup" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pengujian_keandalan_terminal">5. Pengujian keandalan terminal untuk
                                        penghantar luar (Dilakukan bersamaan
                                        dengan memutar sekrup)</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="pengujian_keandalan_terminal"
                                            name="pengujian_keandalan_terminal" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sectionC">
                            <hr class="mb-3">
                            <h6 class="mb-3 font-weight-bold">C. Pengujian Karakteristik</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pengujian_pemutusan_arus">Pengujian Pemutusan Arus
                                            (I<sub>nominal</sub> x
                                            1.2, Persyaratan ≤ 5 detik)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="pengujian_pemutusan_arus"
                                                name="pengujian_pemutusan_arus" placeholder="Hasil pengujian (Detik)">
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('keteranganPemutusanArus')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="keteranganPemutusanArus" class="form-group mt-2"
                                            style="display: none;">
                                            <label for="keteranganPemutusanArus">Keterangan Pemutusan Arus:</label>
                                            <textarea class="form-control" id="keterangan_pemutusan_arus" name="keterangan_pemutusan_arus" rows="2"
                                                maxlength="55" placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keterangan_pemutusan_arus', 'charCountPemutusanArus')"></textarea>
                                            <small id="charCountPemutusanArus" class="text-muted">55 karakter
                                                tersisa.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">D. Kesimpulan</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan">Kesimpulan</label>
                                    <select class="form-control" id="kesimpulan" name="kesimpulan" readOnly>
                                        <option>-- Pilih Kesimpulan --</option>
                                        <option value="Bekas layak pakai (K6)">Bekas layak pakai (K6)</option>
                                        <option value="Masih garansi (K7)">Masih garansi (K7)</option>
                                        <option value="Bekas tidak layak pakai (K8)">Bekas tidak layak pakai (K8)
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
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
        background-color: #f8f9fa;
        cursor: not-allowed;
        pointer-events: none;
    }
</style>

<script>
    // Preview image
    function previewImage(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        if (!previewContainer) return;

        previewContainer.innerHTML = "";

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement("img");
                imgElement.src = e.target.result;
                imgElement.classList.add("h-40", "w-40", "object-cover", "rounded-lg", "border",
                    "border-gray-300");
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
</script>

<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "2000",
        // "onShown": function() {
        //     // Setelah toast muncul, submit form
        //     document.getElementById('formInspeksi').submit();
        // }
    };
    document.getElementById('formInspeksi').addEventListener('submit', function(e) {
        // Simpan data ke localStorage
        localStorage.removeItem("formInspeksiData");

        // Tampilkan toast - form akan disubmit via onShn callback
        toastr.success('Data berhasil diperbarui!');
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
    document.addEventListener('DOMContentLoaded', function() {
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
                        resetFormCompletely();
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
        // const formInspeksi = document.getElementById('formInspeksi');
        // if (formInspeksi) {
        //     formInspeksi.addEventListener('submit', function(e) {
        //         // Hapus data dari localStorage saat form disubmit
        //         localStorage.removeItem("formInspeksiData");

        //         // Tampilkan toast sukses
        //         toastr.success('Data berhasil disimpan!');
        //     });
        // }

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

{{-- JS untuk otomatisasi Kesimpulan MCB --}}
{{-- <script>
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

        const selectMasaPakai = document.getElementById("masa_pakai"); // Select Masa Pakai
        const kesimpulanSelect = document.getElementById("kesimpulan");
        const kondisiSelects = document.querySelectorAll(".poinB"); // Hanya untuk kondisi, bukan masa pakai

        // debug nilai awal dari form
        console.log("[Debug] Nilai awal kesimpulan: ", kesimpulanSelect ? kesimpulanSelect.value : 'null');

        function updateKesimpulan() {
            if (!selectMasaPakai || !kesimpulanSelect) return;

            // Validasi input wajib terisi
            if (!selectMasaPakai.value) {
                kesimpulanSelect.value = "";
                console.log("[Debug] Masa pakai belum dipilih, kosongkan kesimpulan");
                return;
            }

            let adaYangRusak = Array.from(kondisiSelects).some(select => select.value === "Rusak");

            if (selectMasaPakai.value === "<=10") {
                kesimpulanSelect.value = "Masih garansi (K7)";
                console.log("[Debug] Set kesimpulan: K7");
            } else if (adaYangRusak) {
                kesimpulanSelect.value = "Bekas tidak layak pakai (K8)";
                console.log("[Debug] Set kesimpulan: K8");
            } else {
                kesimpulanSelect.value = "Bekas layak pakai (K6)";
                console.log("[Debug] Set kesimpulan: K6");
            }

            // Debug: Pastikan nilai terset
            console.log("[Debug] Nilai kesimpulan setelah update:", kesimpulanSelect.value);

            kesimpulanSelect.readOnly = true;
            kesimpulanSelect.style.backgroundColor = "#f8f9fa";
            kesimpulanSelect.style.cursor = "not-allowed";
        }

        // pasang event listener
        function handleChange() {
            // pastikan semua field poin B terisi
            const semuaTerisi = Array.from(kondisiSelects).every(select => {
                if (!select.value) {
                    console.log(`[Debug] Field ${select.name} belum diisi`);
                    return false;
                }
                return true;
            });

            if (selectMasaPakai && selectMasaPakai.value && semuaTerisi) {
                console.log("[Debug] Semua field terisi, update kesimpulan....");
                updateKesimpulan();
            }
        }

        // Event listener untuk Masa Pakai
        if (selectMasaPakai) {
            selectMasaPakai.addEventListener("change", handleChange);
        }

        kondisiSelects.forEach(select => {
            select.addEventListener("change", handleChange);
        });

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
                    const inputElement = formInspeksi.querySelector(`[name="${key}"]`);
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

        // validasi awal
        handleChange();

        // prevent ganti value manual
        if (kesimpulanSelect) {
            kesimpulanSelect.addEventListener("mousedown", (e) => {
                e.preventDefault();
                return false;
            });

            kesimpulanSelect.addEventListener("keydown", (e) => {
                e.preventDefault();
                return false;
            });
        }
    });

    // *Ketentuan Poin B & Section C*
    document.addEventListener("DOMContentLoaded", function() {
        const poinBElements = document.querySelectorAll(".poinB"); // Hanya elemen Poin B
        const sectionC = document.querySelector(".sectionC");

        if (!sectionC) {
            console.error("Element .sectionC tidak ditemukan!");
            return;
        }

        function checkPoinB() {
            let allBaik = true;

            poinBElements.forEach(select => {
                if (select.value !== "Baik") {
                    allBaik = false;
                }
            });

            // Jika semua dropdown Poin B bernilai "Baik", tampilkan Section C
            sectionC.style.display = allBaik ? "block" : "none";
        }

        // Event listener untuk perubahan di Poin B
        poinBElements.forEach(select => {
            select.addEventListener("change", checkPoinB);
        });

        // Validasi awal saat halaman dimuat
        checkPoinB();
    });

    // Preview image
    function previewImage(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        if (!previewContainer) return;

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
        if (!modalImage) return;

        modalImage.src = imageSrc;
        const modalElement = document.getElementById('imageModal');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    }
</script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Dapatkan referensi form dengan benar
        const formInspeksi = document.getElementById("formInspeksi");

        if (!formInspeksi) {
            console.error("Form dengan ID 'formInspeksi' tidak ditemukan!");
            return;
        }

        // Elemen-elemen penting
        const selectMasaPakai = document.getElementById("masa_pakai");
        const kesimpulanSelect = document.getElementById("kesimpulan");
        const kondisiSelects = document.querySelectorAll(".poinB");
        const sectionC = document.querySelector(".sectionC");

        // Debug nilai awal
        console.log("[Debug] Elemen yang ditemukan:", {
            selectMasaPakai,
            kesimpulanSelect,
            kondisiSelects: kondisiSelects.length,
            sectionC
        });

        // Fungsi untuk mengecek apakah semua poin B bernilai "Baik"
        function cekSemuaBaik() {
            return Array.from(kondisiSelects).every(select => select.value === "Baik");
        }

        // Fungsi untuk menampilkan/sembunyikan section C
        function updateSectionC() {
            if (!sectionC) return;

            const semuaBaik = cekSemuaBaik();
            sectionC.style.display = semuaBaik ? "block" : "none";
            console.log(`[Debug] Section C ${semuaBaik ? "ditampilkan" : "disembunyikan"}`);
        }

        // Fungsi untuk mengupdate kesimpulan
        function updateKesimpulan() {
            if (!selectMasaPakai || !kesimpulanSelect) return;

            // Validasi input wajib terisi
            if (!selectMasaPakai.value) {
                kesimpulanSelect.value = "";
                console.log("[Debug] Masa pakai belum dipilih, kosongkan kesimpulan");
                return;
            }

            // Pastikan semua poin B sudah terisi
            const semuaTerisi = Array.from(kondisiSelects).every(select => {
                if (!select.value) {
                    console.log(`[Debug] Field ${select.name} belum diisi`);
                    return false;
                }
                return true;
            });

            if (!semuaTerisi) {
                kesimpulanSelect.value = "";
                console.log("[Debug] Ada poin B yang belum diisi, kosongkan kesimpulan");
                return;
            }

            const adaYangRusak = !cekSemuaBaik();
            console.log(`[Debug] Masa pakai: ${selectMasaPakai.value}, Ada yang rusak: ${adaYangRusak}`);

            // Logika kesimpulan
            if (selectMasaPakai.value === ">=10") {
                kesimpulanSelect.value = "Bekas tidak layak pakai (K8)";
                console.log("[Debug] Set kesimpulan: K7 (masih garansi)");
            } else if (adaYangRusak) {
                kesimpulanSelect.value = "Bekas tidak layak pakai (K8)";
                console.log("[Debug] Set kesimpulan: K8 (ada yang rusak)");
            } else {
                kesimpulanSelect.value = "Bekas layak pakai (K6)";
                console.log("[Debug] Set kesimpulan: K6 (semua baik)");
            }

            // Logika kesimpulan
            // if (selectMasaPakai.value === "<=10") {
            //     kesimpulanSelect.value = "Masih garansi (K7)";
            //     console.log("[Debug] Set kesimpulan: K7 (masih garansi)");
            // } else if (adaYangRusak) {
            //     kesimpulanSelect.value = "Bekas tidak layak pakai (K8)";
            //     console.log("[Debug] Set kesimpulan: K8 (ada yang rusak)");
            // } else {
            //     kesimpulanSelect.value = "Bekas layak pakai (K6)";
            //     console.log("[Debug] Set kesimpulan: K6 (semua baik)");
            // }

            // Set properti readonly dan styling
            kesimpulanSelect.readOnly = true;
            kesimpulanSelect.style.backgroundColor = "#f8f9fa";
            kesimpulanSelect.style.cursor = "not-allowed";
        }

        // Fungsi untuk menangani perubahan
        function handleChange() {
            updateSectionC();
            updateKesimpulan();
            simpanDataForm();
        }

        // Pasang event listener untuk semua elemen yang relevan
        if (selectMasaPakai) {
            selectMasaPakai.addEventListener("change", handleChange);
        }

        kondisiSelects.forEach(select => {
            select.addEventListener("change", handleChange);
        });

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
                // Setelah memuat data, update tampilan
                handleChange();
            }
        }

        // Fungsi untuk menghapus data dari local storage
        function hapusDataForm() {
            localStorage.removeItem("formInspeksiData");
        }

        // Event listener untuk input dan change
        formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
            element.addEventListener("input", handleChange);
            element.addEventListener("change", handleChange);
        });

        // Event listener untuk form reset
        formInspeksi.addEventListener("reset", function() {
            hapusDataForm();
        });

        // Muat data dari localStorage saat halaman dimuat
        muatDataForm();

        // Prevent manual change pada select kesimpulan
        if (kesimpulanSelect) {
            kesimpulanSelect.addEventListener("mousedown", (e) => {
                e.preventDefault();
                return false;
            });

            kesimpulanSelect.addEventListener("keydown", (e) => {
                e.preventDefault();
                return false;
            });
        }
    });
</script>

<x-layouts.footer />
