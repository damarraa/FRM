<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Conductor</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" name="formInspeksi" action="{{ route('form-retur-conductor.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="5">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select name="up3_id" id="up3_id" class="form-control" required>
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
                                    <select id="gudang_id" name="gudang_id" class="form-control" required>
                                        <option value="">-- Pilih Gudang --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_inspeksi">Tanggal</label>
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
                                    <input name="lokasi_akhir_terpasang" type="text" class="form-control"
                                        id="lokasi_akhir_terpasang" placeholder="Masukkan Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select id="ulp_id" name="ulp_id" class="form-control" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-4">
                                    <div class="w-50">
                                        <label for="tahun_pemasangan" class="tahun_pemasangan">Tahun Pemasangan</label>
                                        <select name="tahun_pemasangan" class="form-control select2"
                                            id="tahun_pemasangan" required>
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
                                <div class="d-flex gap-4 mb-3">
                                    <div class="w-50">
                                        <label for="jenis_conductor">Jenis Conductor</label>
                                        <select class="form-control select2-conductor" name="jenis_conductor"
                                            id="jenis_conductor" required>
                                            <option value="">-- Pilih Jenis Conductor --</option>
                                            <option value="AAAC">AAAC</option>
                                            <option value="AAAC-S">AAAC-S</option>
                                            <option value="CCSXT">CCSXT</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="ukuran_conductor">Ukuran</label>
                                        <div class="input-group">
                                            <input type="text" name="ukuran_conductor" id="ukuran_conductor"
                                                class="form-control" placeholder="Masukkan ukuran konduktor" required>
                                            <span class="input-group-text" id="basic-addon2">mm2</span>
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
                                    <label for="panjang_conductor">Panjang</label>
                                    <div class="input-group">
                                        <input name="panjang_conductor" type="number" class="form-control"
                                            id="panjang_conductor" placeholder="Masukkan Panjang" required
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nilai_pengujian_dimensi">2. Pengujian dimensi (+/- 1% dari standar
                                        konduktor)</label>
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
                        <h6 class="mb-3 font-weight-bold" id="pengujianElektrikSection">C. Pengujian Elektrik (hanya
                            untuk AAAC-S dan CCSXT)</h6>
                        <div class="row" id="pengujianElektrikContent">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nilai_uji_tahanan_isolasi">Uji Tahanan Isolasi (Tidak Tembus atau
                                        bernilai > 0
                                        ohm)</label>
                                    <div class="input-group">
                                        <input name="nilai_uji_tahanan_isolasi" type="number" class="form-control"
                                            id="nilai_uji_tahanan_isolasi" placeholder="Hasil pengujian"
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
                                        <input type="text" class="form-control" id="kesimpulan_k6"
                                            name="kesimpulan_k6" placeholder="Masukkan Panjang Konduktor"
                                            required><span class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan_k8">Bekas tidak layak pakai (K8)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kesimpulan_k8"
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

{{-- <script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "2000",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "newestOnTop": true
    };

    // Deklarasi variabel global
    let formInspeksi;

    // Fungsi untuk mengecek apakah form memiliki perubahan
    function hasFormChanges() {
        const savedData = localStorage.getItem("formInspeksiData");
        return savedData !== null;
    }

    // Fungsi untuk mereset form secara menyeluruh
    function resetFormCompletely() {
        if (!formInspeksi) return;

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

        // Jalankan fungsi lain yang diperlukan
        if (typeof updateKesimpulan === 'function') {
            updateKesimpulan();
        }
        if (typeof hitungMasaPakai === 'function') {
            hitungMasaPakai();
        }

        // Tampilkan toast sukses
        toastr.success('Form telah berhasil dikosongkan.');
    }

    // Fungsi untuk menghitung masa pakai dengan validasi
    function hitungMasaPakai() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById('tahun_pemasangan');
        const inputMasaPakai = document.getElementById('masa_pakai');

        // Validasi elemen
        if (!selectTahun || !inputMasaPakai) {
            console.error("Elemen tahun_pemasangan atau masa_pakai tidak ditemukan");
            return;
        }

        const tahunPemasangan = parseInt(selectTahun.value);

        // Validasi input
        if (isNaN(tahunPemasangan)) {
            inputMasaPakai.value = "";
            return;
        }

        // Validasi tahun tidak boleh lebih besar dari tahun sekarang
        if (tahunPemasangan > tahunSekarang) {
            inputMasaPakai.value = "Tahun invalid";
            return;
        }

        // Hitung dan tampilkan masa pakai
        const masaPakai = tahunSekarang - tahunPemasangan;
        inputMasaPakai.value = masaPakai + " tahun";
    }

    // Fungsi untuk mengisi dropdown tahun
    function isiDropdownTahun() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById('tahun_pemasangan');

        if (!selectTahun) return;

        // Kosongkan dulu opsi yang ada
        selectTahun.innerHTML = '<option value="">-- Pilih Tahun --</option>';

        for (let tahun = tahunSekarang; tahun >= 1900; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }
    }

    // Fungsi untuk menyimpan data ke local storage
    function simpanDataForm() {
        if (!formInspeksi) return;

        const formData = new FormData(formInspeksi);
        const formObject = {};
        formData.forEach((value, key) => {
            formObject[key] = value;
        });
        localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
    }

    // Fungsi untuk memuat data dari local storage
    function muatDataForm() {
        if (!formInspeksi) return;

        const savedData = localStorage.getItem("formInspeksiData");
        if (savedData) {
            const formObject = JSON.parse(savedData);
            for (const key in formObject) {
                const inputElement = formInspeksi.querySelector(`[name="${key}"]`);
                if (inputElement && inputElement.type !== "file") {
                    inputElement.value = formObject[key];
                }
            }

            // Setelah memuat data, update komponen yang perlu diupdate
            if (typeof updateKesimpulan === 'function') {
                updateKesimpulan();
            }
            if (typeof hitungMasaPakai === 'function') {
                hitungMasaPakai();
            }
            if (typeof togglePengujianElektrik === 'function') {
                togglePengujianElektrik();
            }
        }
    }

    // Fungsi untuk menghapus data dari local storage
    function hapusDataForm() {
        localStorage.removeItem("formInspeksiData");
    }

    // Tambahkan event listener untuk perubahan jenis conductor
    document.getElementById('jenis_conductor')?.addEventListener('change', function() {
        togglePengujianElektrik();
        updateKesimpulan(); // Juga update kesimpulan karena bergantung pada jenis conductor
    });

    // Perbaiki fungsi togglePengujianElektrik
    function togglePengujianElektrik() {
        const jenisConductor = document.getElementById('jenis_conductor')?.value;
        const pengujianElektrikSection = document.getElementById('pengujianElektrikSection');
        const pengujianElektrikContent = document.getElementById('pengujianElektrikContent');
        const inputUjiTahanan = document.getElementById('nilai_uji_tahanan_isolasi');

        if (!pengujianElektrikSection || !pengujianElektrikContent) return;

        if (jenisConductor === 'AAAC-S' || jenisConductor === 'CCSXT') {
            pengujianElektrikSection.style.display = 'block';
            pengujianElektrikContent.style.display = 'block';
            if (inputUjiTahanan) inputUjiTahanan.required = true;
        } else {
            pengujianElektrikSection.style.display = 'none';
            pengujianElektrikContent.style.display = 'none';
            if (inputUjiTahanan) {
                inputUjiTahanan.required = false;
                inputUjiTahanan.value = ''; // Kosongkan nilai jika tidak diperlukan
            }
        }
    }

    // function togglePengujianElektrik() {
    //     const jenisCable = document.getElementById('jenis_conductor')?.value;
    //     const pengujianElektrikSection = document.getElementById('pengujianElektrikSection');
    //     const pengujianElektrikContent = document.getElementById('pengujianElektrikContent');

    //     if (!jenisCable || !pengujianElektrikSection || !pengujianElektrikContent) return;

    //     if (jenisCable === 'AAAC-S' || jenisCable === 'CCSXT') {
    //         pengujianElektrikSection.style.display = 'block';
    //         pengujianElektrikContent.style.display = 'block';
    //     } else {
    //         pengujianElektrikSection.style.display = 'none';
    //         pengujianElektrikContent.style.display = 'none';
    //     }
    // }

    function updateKesimpulan() {
        const tahunPemasangan = parseInt(document.getElementById('tahun_pemasangan')?.value) || 0;
        const pemeriksaanVisual = document.getElementById('nilai_pemeriksaan_kondisi_visual')?.value;
        const pengujianDimensi = parseFloat(document.getElementById('nilai_pengujian_dimensi')?.value) || 0;
        // const ujiKesalahan = parseFloat(document.getElementById('nilai_uji_tahanan_isolasi')?.value) || 0;
        // const kesimpulanDropdown = document.getElementById('kesimpulan');

        // if (!kesimpulanDropdown) return;

        // const umurMaterial = new Date().getFullYear() - tahunPemasangan;
        // let kesimpulan = '';

        // // Validasi Poin B2 (+/- 1% dari 0,5-16 mm²)
        // const dimensiValid = pengujianDimensi >= 0.495 && pengujianDimensi <= 16.16;
        const ujiTahanan = parseFloat(document.getElementById('nilai_uji_tahanan_isolasi')?.value) || 0;
        const kesimpulanK6 = document.getElementById('kesimpulan_k6');
        const kesimpulanK8 = document.getElementById('kesimpulan_k8');
        const panjangConductor = parseFloat(document.getElementById('panjang_conductor')?.value) || 0;

        if (!kesimpulanK6 || !kesimpulanK8) return;

        const umurMaterial = new Date().getFullYear() - tahunPemasangan;

        // Validasi Poin B2 (+/- 1% dari luas penampang)
        const luasPenampang = parseFloat(document.getElementById('luas_penampang')?.value) || 0;
        const toleransi = luasPenampang * 0.01;
        const dimensiValid = pengujianDimensi >= (luasPenampang - toleransi) && pengujianDimensi <= (luasPenampang +
            toleransi);

        // Validasi Poin C (jika ditampilkan)
        const jenisCable = document.getElementById('jenis_conductor')?.value;
        const elektrikValid = (jenisCable === 'AAAC-S' || jenisCable === 'CCSXT') ? ujiKesalahan > 0 : true;

        if (umurMaterial < 40 && pemeriksaanVisual === 'Baik' && dimensiValid && elektrikValid) {
            kesimpulan = 'Bekas layak pakai (K6)';
        } else {
            kesimpulan = 'Bekas tidak layak pakai (K8)';
        }

        kesimpulanDropdown.value = kesimpulan;
    }

    // Fungsi untuk memeriksa kesesuaian panjang
    function checkPanjang() {
        const panjangCablePower = parseFloat(document.getElementById('panjang_conductor')?.value) || 0;
        const panjangK6 = parseFloat(document.getElementById('kesimpulan_k6')?.value) || 0;
        const panjangK8 = parseFloat(document.getElementById('kesimpulan_k8')?.value) || 0;
        const warningMessageKesimpulan = document.getElementById('warningMessageKesimpulan');

        if (!warningMessageKesimpulan) return;

        const totalPanjang = panjangK6 + panjangK8;

        if (totalPanjang !== panjangCablePower) {
            warningMessageKesimpulan.style.display = 'block';
        } else {
            warningMessageKesimpulan.style.display = 'none';
        }
    }

    // Inisialisasi saat DOM siap
    document.addEventListener("DOMContentLoaded", function() {
        formInspeksi = document.getElementById("formInspeksi");
        if (!formInspeksi) {
            console.error("Form dengan ID 'formInspeksi' tidak ditemukan!");
            return;
        }

        // Cek ketersediaan Toastr
        if (typeof toastr === 'undefined') {
            console.error('Toastr is not loaded!');
        }

        // Inisialisasi Select2
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('.select2').parent(),
                closeOnSelect: true
            }).on('change', function() {
                if (typeof hitungMasaPakai === 'function') {
                    hitungMasaPakai();
                }
                $(this).trigger('blur');
            });

            // Untuk select khusus kabel (jika beda gaya atau form)
            $('.select2-conductor').each(function() {
                $(this).select2({
                    tags: true,
                    width: '100%',
                    dropdownParent: $(this).parent()
                });
            });
        });

        // Isi dropdown tahun dan inisialisasi masa pakai
        isiDropdownTahun();
        hitungMasaPakai();

        // Set tanggal hari ini
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("tgl_inspeksi").value = today;

        // Muat data dari localStorage
        muatDataForm();

        // Reset localStorage jika halaman dimuat melalui navigasi (bukan reload)
        if (window.performance?.navigation?.type === window.performance.navigation.TYPE_NAVIGATE) {
            localStorage.removeItem("formInspeksiData");
        }

        // Event listener untuk input dan change
        formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
            element.addEventListener("input", simpanDataForm);
            element.addEventListener("change", simpanDataForm);
        });

        // Event listener untuk form reset
        formInspeksi.addEventListener("reset", hapusDataForm);

        // Event listener untuk update kesimpulan
        document.querySelectorAll('#formInspeksi select, #formInspeksi input').forEach(el => {
            el.addEventListener('change', updateKesimpulan);
        });

        // Hitung rentang ±1% dari luas penampang
        const luasPenampangInput = document.getElementById('luas_penampang');
        const rentangToleransi = document.getElementById('rentangToleransi');
        const diameterKonduktorInput = document.getElementById('nilai_pengujian_dimensi');
        const warningMessageDimensi = document.getElementById('warningMessageDimensi');

        if (luasPenampangInput && rentangToleransi && diameterKonduktorInput && warningMessageDimensi) {
            luasPenampangInput.addEventListener('input', function() {
                const luasPenampang = parseFloat(luasPenampangInput.value) || 0;
                const toleransi = luasPenampang * 0.01;
                const min = luasPenampang - toleransi;
                const max = luasPenampang + toleransi;

                rentangToleransi.textContent =
                    `Rentang toleransi: ${min.toFixed(2)} mm - ${max.toFixed(2)} mm`;

                diameterKonduktorInput.addEventListener('input', function() {
                    const diameterKonduktor = parseFloat(diameterKonduktorInput.value) || 0;

                    if (diameterKonduktor < min || diameterKonduktor > max) {
                        warningMessageDimensi.style.display = 'block';
                        diameterKonduktorInput.style.borderColor = 'red';
                    } else {
                        warningMessageDimensi.style.display = 'none';
                        diameterKonduktorInput.style.borderColor = '';
                    }
                });
            });
        }

        // Tambahkan event listener untuk pengecekan panjang
        const panjangInputs = ['panjang_conductor', 'kesimpulan_k6', 'kesimpulan_k8'];
        panjangInputs.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', checkPanjang);
            }
        });

        // SweetAlert untuk Clear Form
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
        formInspeksi.addEventListener('submit', function(e) {
            // Hapus data dari localStorage saat form disubmit
            localStorage.removeItem("formInspeksiData");

            // Tampilkan toast sukses
            toastr.success('Data berhasil disimpan!');
        });

        // Sembunyikan atau tampilkan pengujian elektrik berdasarkan jenis konduktor
        togglePengujianElektrik();

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
    });
</script> --}}

<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "2000",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "newestOnTop": true
    };

    // Deklarasi variabel global
    let formInspeksi;

    // Fungsi untuk mengecek apakah form memiliki perubahan
    function hasFormChanges() {
        const savedData = localStorage.getItem("formInspeksiData");
        return savedData !== null;
    }

    // Fungsi untuk mereset form secara menyeluruh
    function resetFormCompletely() {
        if (!formInspeksi) return;

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

        // Reset flag manual input
        document.getElementById('kesimpulan_k6').dataset.manualInput = 'false';
        document.getElementById('kesimpulan_k8').dataset.manualInput = 'false';

        // Hapus data dari localStorage
        localStorage.removeItem("formInspeksiData");

        // Jalankan fungsi lain yang diperlukan
        if (typeof updateKesimpulan === 'function') {
            updateKesimpulan();
        }
        if (typeof hitungMasaPakai === 'function') {
            hitungMasaPakai();
        }
        if (typeof togglePengujianElektrik === 'function') {
            togglePengujianElektrik();
        }

        // Tampilkan toast sukses
        toastr.success('Form telah berhasil dikosongkan.');
    }

    // Fungsi untuk menghitung masa pakai dengan validasi
    function hitungMasaPakai() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById('tahun_pemasangan');
        const inputMasaPakai = document.getElementById('masa_pakai');

        // Validasi elemen
        if (!selectTahun || !inputMasaPakai) {
            console.error("Elemen tahun_pemasangan atau masa_pakai tidak ditemukan");
            return;
        }

        const tahunPemasangan = parseInt(selectTahun.value);

        // Validasi input
        if (isNaN(tahunPemasangan)) {
            inputMasaPakai.value = "";
            return;
        }

        // Validasi tahun tidak boleh lebih besar dari tahun sekarang
        if (tahunPemasangan > tahunSekarang) {
            inputMasaPakai.value = "Tahun invalid";
            return;
        }

        // Hitung dan tampilkan masa pakai
        const masaPakai = tahunSekarang - tahunPemasangan;
        inputMasaPakai.value = masaPakai + " tahun";
    }

    // Fungsi untuk mengisi dropdown tahun
    function isiDropdownTahun() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById('tahun_pemasangan');

        if (!selectTahun) return;

        // Kosongkan dulu opsi yang ada
        selectTahun.innerHTML = '<option value="">-- Pilih Tahun --</option>';

        for (let tahun = tahunSekarang; tahun >= 1900; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }
    }

    // Fungsi untuk menyimpan data ke local storage
    function simpanDataForm() {
        if (!formInspeksi) return;

        const formData = new FormData(formInspeksi);
        const formObject = {};
        formData.forEach((value, key) => {
            formObject[key] = value;
        });
        localStorage.setItem("formInspeksiData", JSON.stringify(formObject));
    }

    // Fungsi untuk memuat data dari local storage
    function muatDataForm() {
        if (!formInspeksi) return;

        const savedData = localStorage.getItem("formInspeksiData");
        if (savedData) {
            const formObject = JSON.parse(savedData);
            for (const key in formObject) {
                const inputElement = formInspeksi.querySelector(`[name="${key}"]`);
                if (inputElement && inputElement.type !== "file") {
                    inputElement.value = formObject[key];
                }
            }

            // Setelah memuat data, update komponen yang perlu diupdate
            if (typeof updateKesimpulan === 'function') {
                updateKesimpulan();
            }
            if (typeof hitungMasaPakai === 'function') {
                hitungMasaPakai();
            }
            if (typeof togglePengujianElektrik === 'function') {
                togglePengujianElektrik();
            }
        }
    }

    // Fungsi untuk menghapus data dari local storage
    function hapusDataForm() {
        localStorage.removeItem("formInspeksiData");
    }

    // Fungsi untuk menampilkan/menyembunyikan section pengujian elektrik
    function togglePengujianElektrik() {
        const jenisConductor = document.getElementById('jenis_conductor')?.value;
        const pengujianElektrikSection = document.getElementById('pengujianElektrikSection');
        const pengujianElektrikContent = document.getElementById('pengujianElektrikContent');
        const inputUjiTahanan = document.getElementById('nilai_uji_tahanan_isolasi');

        if (!pengujianElektrikSection || !pengujianElektrikContent) return;

        if (jenisConductor === 'AAAC-S' || jenisConductor === 'CCSXT') {
            pengujianElektrikSection.style.display = 'block';
            pengujianElektrikContent.style.display = 'block';
            if (inputUjiTahanan) inputUjiTahanan.required = true;
        } else {
            pengujianElektrikSection.style.display = 'none';
            pengujianElektrikContent.style.display = 'none';
            if (inputUjiTahanan) {
                inputUjiTahanan.required = false;
                inputUjiTahanan.value = '';
            }
        }
    }

    // Fungsi untuk mengupdate kesimpulan berdasarkan input form
    function updateKesimpulan() {
        const tahunPemasangan = parseInt(document.getElementById('tahun_pemasangan')?.value) || 0;
        const pemeriksaanVisual = document.getElementById('nilai_pemeriksaan_kondisi_visual')?.value;
        const pengujianDimensi = parseFloat(document.getElementById('nilai_pengujian_dimensi')?.value) || 0;
        const ujiTahanan = parseFloat(document.getElementById('nilai_uji_tahanan_isolasi')?.value) || 0;
        const kesimpulanK6 = document.getElementById('kesimpulan_k6');
        const kesimpulanK8 = document.getElementById('kesimpulan_k8');
        const panjangConductor = parseFloat(document.getElementById('panjang_conductor')?.value) || 0;

        if (!kesimpulanK6 || !kesimpulanK8) return;

        // Jika user sudah menginput manual, jangan diubah otomatis
        if (kesimpulanK6.dataset.manualInput === 'true' || kesimpulanK8.dataset.manualInput === 'true') {
            checkPanjang();
            return;
        }

        const umurMaterial = new Date().getFullYear() - tahunPemasangan;

        // Validasi Poin B2 (+/- 1% dari luas penampang)
        const luasPenampang = parseFloat(document.getElementById('luas_penampang')?.value) || 0;
        const toleransi = luasPenampang * 0.01;
        const dimensiValid = pengujianDimensi >= (luasPenampang - toleransi) && pengujianDimensi <= (luasPenampang +
            toleransi);

        // Validasi Poin C (hanya jika jenis conductor memerlukan)
        const jenisConductor = document.getElementById('jenis_conductor')?.value;
        const elektrikValid = (jenisConductor === 'AAAC-S' || jenisConductor === 'CCSXT') ? ujiTahanan > 0 : true;

        if (umurMaterial < 40 && pemeriksaanVisual === 'Baik' && dimensiValid && elektrikValid) {
            kesimpulanK6.value = panjangConductor;
            kesimpulanK8.value = 0;
        } else {
            kesimpulanK6.value = 0;
            kesimpulanK8.value = panjangConductor;
        }

        checkPanjang();
    }

    // Fungsi untuk memeriksa kesesuaian panjang
    function checkPanjang() {
        const panjangCablePower = parseFloat(document.getElementById('panjang_conductor')?.value) || 0;
        const panjangK6 = parseFloat(document.getElementById('kesimpulan_k6')?.value) || 0;
        const panjangK8 = parseFloat(document.getElementById('kesimpulan_k8')?.value) || 0;
        const warningMessageKesimpulan = document.getElementById('warningMessageKesimpulan');

        if (!warningMessageKesimpulan) return;

        const totalPanjang = panjangK6 + panjangK8;

        if (Math.abs(totalPanjang - panjangCablePower) > 0.01) {
            warningMessageKesimpulan.style.display = 'block';
            document.getElementById('kesimpulan_k6').classList.add('is-invalid');
            document.getElementById('kesimpulan_k8').classList.add('is-invalid');
        } else {
            warningMessageKesimpulan.style.display = 'none';
            document.getElementById('kesimpulan_k6').classList.remove('is-invalid');
            document.getElementById('kesimpulan_k8').classList.remove('is-invalid');
        }
    }

    // Fungsi untuk validasi manual input kesimpulan
    function validateManualInput() {
        const panjangConductor = document.getElementById('panjang_conductor');
        const kesimpulanK6 = document.getElementById('kesimpulan_k6');
        const kesimpulanK8 = document.getElementById('kesimpulan_k8');

        if (!panjangConductor || !kesimpulanK6 || !kesimpulanK8) return;

        // Jika user mengubah nilai K6, hitung K8 sebagai selisihnya
        kesimpulanK6.addEventListener('input', function() {
            const panjang = parseFloat(panjangConductor.value) || 0;
            const nilaiK6 = parseFloat(this.value) || 0;
            const nilaiK8 = panjang - nilaiK6;

            if (nilaiK8 >= 0) {
                kesimpulanK8.value = nilaiK8.toFixed(2);
            } else {
                kesimpulanK6.value = panjang;
                kesimpulanK8.value = 0;
            }

            // Tandai sebagai input manual
            this.dataset.manualInput = 'true';
            kesimpulanK8.dataset.manualInput = 'true';

            checkPanjang();
        });

        // Jika user mengubah nilai K8, hitung K6 sebagai selisihnya
        kesimpulanK8.addEventListener('input', function() {
            const panjang = parseFloat(panjangConductor.value) || 0;
            const nilaiK8 = parseFloat(this.value) || 0;
            const nilaiK6 = panjang - nilaiK8;

            if (nilaiK6 >= 0) {
                kesimpulanK6.value = nilaiK6.toFixed(2);
            } else {
                kesimpulanK8.value = panjang;
                kesimpulanK6.value = 0;
            }

            // Tandai sebagai input manual
            this.dataset.manualInput = 'true';
            kesimpulanK6.dataset.manualInput = 'true';

            checkPanjang();
        });

        // Reset flag manual input ketika panjang conductor diubah
        panjangConductor.addEventListener('input', function() {
            kesimpulanK6.dataset.manualInput = 'false';
            kesimpulanK8.dataset.manualInput = 'false';
        });
    }

    // Inisialisasi saat DOM siap
    document.addEventListener("DOMContentLoaded", function() {
        formInspeksi = document.getElementById("formInspeksi");
        if (!formInspeksi) {
            console.error("Form dengan ID 'formInspeksi' tidak ditemukan!");
            return;
        }

        // Cek ketersediaan Toastr
        if (typeof toastr === 'undefined') {
            console.error('Toastr is not loaded!');
        }

        // Inisialisasi Select2
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('.select2').parent(),
                closeOnSelect: true
            }).on('change', function() {
                if (typeof hitungMasaPakai === 'function') {
                    hitungMasaPakai();
                }
                $(this).trigger('blur');
            });

            $('.select2-conductor').each(function() {
                $(this).select2({
                    tags: true,
                    width: '100%',
                    dropdownParent: $(this).parent()
                }).on('change', function() {
                    togglePengujianElektrik();
                    updateKesimpulan();
                });
            });
        });

        // Isi dropdown tahun dan inisialisasi masa pakai
        isiDropdownTahun();
        hitungMasaPakai();

        // Set tanggal hari ini
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("tgl_inspeksi").value = today;

        // Muat data dari localStorage
        muatDataForm();

        // Reset localStorage jika halaman dimuat melalui navigasi (bukan reload)
        if (window.performance?.navigation?.type === window.performance.navigation.TYPE_NAVIGATE) {
            localStorage.removeItem("formInspeksiData");
        }

        // Event listener untuk input dan change
        formInspeksi.querySelectorAll("input, select, textarea").forEach(element => {
            element.addEventListener("input", simpanDataForm);
            element.addEventListener("change", simpanDataForm);
        });

        // Event listener untuk form reset
        formInspeksi.addEventListener("reset", function() {
            document.getElementById('kesimpulan_k6').dataset.manualInput = 'false';
            document.getElementById('kesimpulan_k8').dataset.manualInput = 'false';
            hapusDataForm();
        });

        // Event listener untuk update kesimpulan
        document.querySelectorAll('#formInspeksi select, #formInspeksi input').forEach(el => {
            if (el.id !== 'kesimpulan_k6' && el.id !== 'kesimpulan_k8') {
                el.addEventListener('change', updateKesimpulan);
            }
        });

        // Hitung rentang ±1% dari luas penampang
        const luasPenampangInput = document.getElementById('luas_penampang');
        const rentangToleransi = document.getElementById('rentangToleransi');
        const diameterKonduktorInput = document.getElementById('nilai_pengujian_dimensi');
        const warningMessageDimensi = document.getElementById('warningMessageDimensi');

        if (luasPenampangInput && rentangToleransi && diameterKonduktorInput && warningMessageDimensi) {
            luasPenampangInput.addEventListener('input', function() {
                const luasPenampang = parseFloat(luasPenampangInput.value) || 0;
                const toleransi = luasPenampang * 0.01;
                const min = luasPenampang - toleransi;
                const max = luasPenampang + toleransi;

                rentangToleransi.textContent =
                    `Rentang toleransi: ${min.toFixed(2)} mm - ${max.toFixed(2)} mm`;

                diameterKonduktorInput.addEventListener('input', function() {
                    const diameterKonduktor = parseFloat(diameterKonduktorInput.value) || 0;

                    if (diameterKonduktor < min || diameterKonduktor > max) {
                        warningMessageDimensi.style.display = 'block';
                        diameterKonduktorInput.style.borderColor = 'red';
                    } else {
                        warningMessageDimensi.style.display = 'none';
                        diameterKonduktorInput.style.borderColor = '';
                    }
                });
            });
        }

        // Inisialisasi validasi manual input kesimpulan
        validateManualInput();

        // SweetAlert untuk Clear Form
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

        // Validasi sebelum submit form
        formInspeksi.addEventListener('submit', function(e) {
            const panjangCablePower = parseFloat(document.getElementById('panjang_conductor')?.value) ||
                0;
            const panjangK6 = parseFloat(document.getElementById('kesimpulan_k6')?.value) || 0;
            const panjangK8 = parseFloat(document.getElementById('kesimpulan_k8')?.value) || 0;
            const totalPanjang = panjangK6 + panjangK8;

            if (Math.abs(totalPanjang - panjangCablePower) > 0.01) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Panjang tidak sesuai',
                    text: 'Jumlah panjang K6 dan K8 harus sama dengan panjang conductor!',
                });
                return;
            }

            localStorage.removeItem("formInspeksiData");
            toastr.success('Data berhasil disimpan!');
        });

        // Sembunyikan atau tampilkan pengujian elektrik berdasarkan jenis konduktor
        togglePengujianElektrik();

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
<x-layouts.footer />
