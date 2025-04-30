<x-layouts.header />
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur kWh Meter</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" name="formInspeksi" action="{{ route('form-retur-kwh-meter.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="1">
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
                                    <select class="form-control" name="gudang_id" id="gudang_id" required>
                                        <option value="">-- Pilih Gudang Retur --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_inspeksi">Tanggal Inspeksi</label>
                                    <input type="date" name="tgl_inspeksi" id="tgl_inspeksi" class="form-control"
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
                                    <label for="tahun_produksi">Tahun Produksi</label>
                                    <select class="form-control" id="tahun_produksi" name="tahun_produksi" required>
                                        <option value="">-- Pilih Tahun --</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_kwh_meter">Tipe kWh Meter</label>
                                    <select class="form-control" id="tipe_kwh_meter" name="tipe_kwh_meter" required>
                                        <option value="">-- Pilih Tipe kWh Meter --</option>
                                        <option value="Prabayar">Prabayar</option>
                                        <option value="Pascabayar">Pascabayar</option>
                                    </select>
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
                                            <option value="{{ $pabrikan->id }}">{{ $pabrikan->nama_pabrikan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="font-weight-bold">B. Pemeriksaan Visual dan Konstruksi</h6>

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masa_pakai">1. Masa Pakai</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun sekarang - Tahun produksi" readonly>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganMasaPakai')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganMasaPakai" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_masa_pakai">Keterangan Masa Pakai:</label>
                                        <textarea class="form-control" id="keterangan_masa_pakai" name="keterangan_masa_pakai" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_masa_pakai', 'charCountMasaPakai')"></textarea>
                                        <small id="charCountMasaPakai" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_body_kwh_meter">2. Kondisi Body kWh Meter (Termasuk kaca depan
                                        meter)</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="kondisi_body_kwh_meter"
                                            name="kondisi_body_kwh_meter" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganBodyKwhMeter')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganBodyKwhMeter" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_body_kwh_meter">Keterangan Body kWh Meter:</label>
                                        <textarea class="form-control" id="keterangan_body_kwh_meter" name="keterangan_body_kwh_meter" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_body_kwh_meter', 'charCountBodyKwhMeter')"></textarea>
                                        <small id="charCountBodyKwhMeter" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_segel_meterologi">3. Kondisi Segel Meterologi</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="kondisi_segel_meterologi"
                                            name="kondisi_segel_meterologi" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganSegelMeterologi')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganSegelMeterologi" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keterangan_segel_meterologi">Keterangan Segel Meterologi:</label>
                                        <textarea class="form-control" id="keterangan_segel_meterologi" name="keterangan_segel_meterologi" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_segel_meterologi', 'charCountSegelMeterologi')"></textarea>
                                        <small id="charCountSegelMeterologi" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_terminal">4. Kondisi Terminal</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="kondisi_terminal"
                                            name="kondisi_terminal" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganTerminal')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganTerminal" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_terminal">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keterangan_terminal" name="keterangan_terminal" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keterangan_terminal', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kondisi_stand_kwh_meter">5. Kondisi Stand kWh Meter</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="kondisi_stand_kwh_meter"
                                            name="kondisi_stand_kwh_meter" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganStandKwhMeter')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganStandKwhMeter" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_stand_kwh_meter">Keterangan Stand kWh Meter:</label>
                                        <textarea class="form-control" id="keterangan_stand_kwh_meter" name="keterangan_stand_kwh_meter" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_stand_kwh_meter', 'charCountStandKwhMeter')"></textarea>
                                        <small id="charCountStandKwhMeter" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_cover_terminal_kwh_meter">6. Kondisi Cover Terminal kWh
                                        Meter (Tutup terminal dan MCB)</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="kondisi_cover_terminal_kwh_meter"
                                            name="kondisi_cover_terminal_kwh_meter" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganCoverTerminalKwhMeter')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganCoverTerminalKwhMeter" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keterangan_cover_terminal_kwh_meter">Keterangan Cover Terminal kWh
                                            Meter:</label>
                                        <textarea class="form-control" id="keterangan_cover_terminal_kwh_meter" name="keterangan_cover_terminal_kwh_meter"
                                            rows="2" maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keterangan_cover_terminal_kwh_meter', 'charCountCoverTerminalKwhMeter')"></textarea>
                                        <small id="charCountCoverTerminalKwhMeter" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi_nameplate">7. Kondisi Nameplate</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="kondisi_nameplate"
                                            name="kondisi_nameplate" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNameplate')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNameplate" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_nameplate">Keterangan Nameplate:</label>
                                        <textarea class="form-control" id="keterangan_nameplate" name="keterangan_nameplate" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keterangan_nameplate', 'charCountNameplate')"></textarea>
                                        <small id="charCountNameplate" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>

                            <p class="text-sm-left mb-3">Keterangan: Kesesuaian seluruh mata uji poin B adalah
                                mandatory.
                                Jika
                                seluruh poin B sesuai, maka dapat dilanjutkan ke pengujian poin C, jika tidak
                                maka poin selanjutnya tidak perlu diisi.</p>
                        </div>

                        <div class="sectionC">
                            <hr class="mb-3">
                            <h6 class="mb-3"><strong>C. Pengujian Karakteristik</strong></h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nilai_uji_kesalahan">Uji Kesalahan (%)<br>
                                            Error (%) = (Energi kWh Meter Uji − Energi Standar) / Energi Standar) ×
                                            100%</label>
                                        <div class="input-group">
                                            <input class="form-control" id="nilai_uji_kesalahan"
                                                name="nilai_uji_kesalahan" type="number" placeholder="0,00"
                                                min="0" step="0.01" title="Currency"
                                                pattern="^\d+(?:\,\d{1,2})?$"
                                                onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('keteranganUjiKesalahan')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="keteranganUjiKesalahan" class="form-group mt-2"
                                            style="display: none;">
                                            <label for="keterangan_uji_kesalahan">Keterangan Uji Kesalahan:</label>
                                            <textarea class="form-control" id="keterangan_uji_kesalahan" name="keterangan_uji_kesalahan" rows="3"
                                                placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keterangan_uji_kesalahan', 'charCountUjiKesalahan')"></textarea>
                                            <small id="charCountUjiKesalahan" class="text-muted">55 karakter
                                                tersisa.</small>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <br>
                                        <label>Kelas</label>
                                        <select id="kelas_pengujian" name="kelas_pengujian_id" class="form-control">
                                            <option value="">-- Pilih Kelas Pengujian --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
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
                                            <option value="Masih garansi (K7)">Masih garansi (K7)</option>
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
                                            <option value="Masih garansi (K7)">Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)">Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">E. Gambar Evidence</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar1" style="display: block">Gambar 1</label>
                                    <div id="preview1" class="mt-2"></div>
                                    {{-- <input type="file" name="gambar[0]" id="gambar1" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview1')"> --}}
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
        <!-- [ form-element ] end -->
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

<!-- Tambahkan di bagian head atau sebelum penutup body -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfigurasi Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "1000"
    };

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
            // if (result.isConfirmed) {
            //     // Simpan nilai tgl_inspeksi sebelum form di-reset
            //     const tglInspeksiValue = document.getElementById("tgl_inspeksi").value;

            //     // Reset form ke keadaan default
            //     formInspeksi.reset();

            //     // Kembalikan nilai tgl_inspeksi setelah form di-reset
            //     document.getElementById("tgl_inspeksi").value = tglInspeksiValue;

            //     // Hapus data dari localStorage
            //     localStorage.removeItem("formInspeksiData");

            //     // Trigger perubahan pada elemen Select2 (jika digunakan)
            //     setTimeout(() => {
            //         $(".select2").trigger("change");
            //     }, 100);

            //     // Jalankan fungsi lain yang diperlukan (opsional)
            //     updateKesimpulan();

            //     toastr.success('Form telah berhasil dikosongkan.');
            // }
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
    document.getElementById('formInspeksi').addEventListener('submit', function(e) {
        // Jika form valid, tampilkan toast sukses
        const submitButton = this.querySelector('button[type="submit"]');
        if (submitButton) {
            // Simpan data ke localStorage untuk menandai form telah disubmit
            localStorage.removeItem("formInspeksiData");

            // Tampilkan toast sukses
            toastr.success('Data berhasil disimpan!');
        }
    });

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
        // Dapatkan referensi form dengan benar
        const formInspeksi = document.getElementById("formInspeksi");

        // Muat data dari localStorage saat halaman dimuat
        muatDataForm();

        // Reset localStorage jika halaman dimuat melalui navigasi (bukan reload)
        if (window.performance && window.performance.navigation.type === window.performance.navigation
            .TYPE_NAVIGATE) {
            localStorage.removeItem("formInspeksiData");
        }

        // Inisialisasi variabel global untuk menyimpan batas toleransi
        let batasToleransiMap = {};

        // Inisialisasi elemen-elemen yang digunakan
        const selectTahun = document.getElementById("tahun_produksi");
        const inputMasaPakai = document.getElementById("masa_pakai");
        const tahunSekarang = new Date().getFullYear();
        const nilaiUjiKesalahan = document.getElementById("nilai_uji_kesalahan");
        const selectKelas = document.querySelector("select[name='kelas_pengujian_id']");
        const kesimpulanSelect = document.getElementById("kesimpulan");
        const sectionC = document.querySelector(".sectionC");
        const poinBElements = document.querySelectorAll(".poinB");

        // Set tanggal hari ini sesuai zona waktu GMT+7 (WIB)
        const now = new Date();
        const offset = 7; // GMT+7
        const localTime = new Date(now.getTime() + offset * 60 * 60 * 1000);
        const day = String(localTime.getUTCDate()).padStart(2, '0');
        const month = String(localTime.getUTCMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
        const year = localTime.getUTCFullYear();
        const formattedDate = `${day}/${month}/${year}`;
        document.getElementById("tgl_inspeksi").value = formattedDate;

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

        // Fetch data kelas pengujian dari database
        fetch('/kelas-pengujians') // Ambil data dari route web
            .then(response => response.json())
            .then(data => {
                // Isi dropdown dan simpan batas toleransi ke dalam objek
                data.forEach(item => {
                    let option = new Option(item.kelas_pengujian, item
                        .id); // Gunakan ID sebagai value
                    selectKelas.appendChild(option);

                    // Simpan batas toleransi ke dalam objek
                    batasToleransiMap[item.id] = item.batas_kesalahan;
                });

                // Setelah data di-fetch, jalankan inisialisasi awal
                hitungMasaPakai();
                updateKesimpulan();
                muatDataForm();
                checkPoinB(); // Panggil checkPoinB setelah data dimuat
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('Gagal memuat data kelas pengujian');
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

        // Fungsi untuk mengecek apakah semua poin B bernilai "Baik"
        function checkPoinB() {
            let allBaik = true;
            poinBElements.forEach(select => {
                if (select.value !== "Baik") {
                    allBaik = false;
                }
            });

            // Tampilkan atau sembunyikan bagian C berdasarkan hasil pengecekan
            sectionC.style.display = allBaik ? "block" : "none";

            // Jika tidak semua Baik, reset nilai di section C
            if (!allBaik) {
                nilaiUjiKesalahan.value = "";
                selectKelas.value = "";
            }
        }

        // Tambahkan event listener untuk setiap dropdown di poin B
        poinBElements.forEach(select => {
            select.addEventListener("change", function() {
                checkPoinB();
                updateKesimpulan();
            });
        });

        // Fungsi untuk memeriksa kesesuaian berdasarkan kelas
        function cekKesesuaianKelas() {
            const nilaiUji = parseFloat(nilaiUjiKesalahan.value) || 0;
            const kelasId = selectKelas.value; // Ambil ID kelas yang dipilih

            // Ambil batas toleransi dari objek batasToleransiMap
            const batasToleransi = batasToleransiMap[kelasId] || 0;

            // Kembalikan true jika nilai uji berada dalam batas toleransi
            return Math.abs(nilaiUji) <= batasToleransi;
        }

        // Fungsi untuk update kesimpulan berdasarkan kondisi
        function updateKesimpulan() {
            const masaPakai = parseInt(inputMasaPakai.value) || 0;
            let semuaBaik = true;

            // Periksa apakah semua kondisi poin B bernilai "Baik"
            poinBElements.forEach(select => {
                if (select.value !== "Baik") {
                    semuaBaik = false;
                }
            });

            const sesuaiKelas = cekKesesuaianKelas(); // Periksa kesesuaian berdasarkan kelas

            // Menentukan kategori kesimpulan
            let kesimpulanValue = "";
            if (semuaBaik && sesuaiKelas && masaPakai <= 5) {
                kesimpulanValue = "Bekas layak pakai (K6)"; // Bekas layak pakai
            } else if (masaPakai <= 5) {
                kesimpulanValue = "Masih garansi (K7)"; // Masih garansi
            } else {
                kesimpulanValue = "Bekas tidak layak pakai (K8)"; // Bekas tidak layak pakai
            }

            // Set nilai kesimpulan
            kesimpulanSelect.value = kesimpulanValue;
        }

        // Nonaktifkan perubahan manual untuk select kesimpulan jika user adalah Petugas
        if (document.getElementById('kesimpulan') &&
            {{ auth()->user()->hasRole('Petugas') ? 'true' : 'false' }}) {
            document.getElementById('kesimpulan').addEventListener('mousedown', function(e) {
                e.preventDefault();
                return false;
            });

            document.getElementById('kesimpulan').addEventListener('keydown', function(e) {
                e.preventDefault();
                return false;
            });
        }

        // Event listener untuk perubahan nilai uji kesalahan dan kelas
        nilaiUjiKesalahan.addEventListener("change", updateKesimpulan);
        selectKelas.addEventListener("change", updateKesimpulan);

        // Event listener untuk memaksa nilai kesimpulan kembali ke hasil logika
        kesimpulanSelect.addEventListener("change", function() {
            updateKesimpulan(); // Paksa nilai kembali ke hasil logika
        });

        // Event listener untuk form submit
        formInspeksi.addEventListener("submit", function(e) {
            const nilaiUji = parseFloat(nilaiUjiKesalahan.value) || 0;
            const kelasId = selectKelas.value;

            // Validasi: Jika nilai uji diisi, kelas pengujian harus dipilih
            if (nilaiUji !== 0 && !kelasId) {
                e.preventDefault(); // Hentikan submit form
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: 'Silakan pilih Kelas Pengujian jika Nilai Uji Kesalahan diisi.'
                });
                return;
            }

            // Lanjutkan submit form jika validasi terpenuhi
            hapusDataForm();
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
    });
</script>
<x-layouts.footer />
