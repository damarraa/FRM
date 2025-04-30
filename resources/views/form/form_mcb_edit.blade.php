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
                    <form id="formInspeksi" action="{{ route('form-retur-mcb.update', $mcb->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="jenis_form_id" value="2">
                        <input type="hidden" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select class="form-control" id="up3_id" name="up3_id" required>
                                        <option value="">-- Pilih UP3 --</option>
                                        @foreach ($up3s as $up3)
                                            <option value="{{ $up3->id }}"
                                                {{ old('up3_id', $selectedUp3Id ?? null) == $up3->id ? 'selected' : '' }}>
                                                {{ $up3->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gudang_id">Gudang Retur</label>
                                    <select class="form-control" name="gudang_id" id="gudang_id" required>
                                        <option value="">-- Pilih Gudang Retur --</option>
                                        @foreach ($gudangs as $gudang)
                                            <option value="{{ $gudang->id }}"
                                                {{ old('gudang_id', $selectedGudang) == $gudang->id ? 'selected' : '' }}>
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
                                        value="{{ old('tgl_inspeksi', $mcb->tgl_inspeksi) }}" readonly>
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
                                        placeholder="Masukkan ID Pelanggan"
                                        value="{{ old('id_pelanggan', $mcb->id_pelanggan) }}" required>
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

                                <div class="form-group">
                                    <label for="TipeMCB">Tipe MCB</label>
                                    <select class="form-control" name="tipe_mcb" id="tipe_mcb" required>
                                        <option value="">-- Pilih Tipe MCB --</option>
                                        <option value="1 fasa"
                                            {{ old('tipe_mcb', $mcb->tipe_mcb) == '1 fasa' ? 'selected' : '' }}>1 fasa
                                        </option>
                                        <option value="3 fasa"
                                            {{ old('tipe_mcb', $mcb->tipe_mcb) == '3 fasa' ? 'selected' : '' }}>3 fasa
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="number" class="form-control" id="no_serial" name="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $mcb->no_serial) }}">
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

                                <div class="form-group">
                                    <label for="nilai_ampere">Nilai Ampere</label>
                                    <input type="number" class="form-control" name="nilai_ampere" id="nilai_ampere"
                                        placeholder="Masukkan Nilai Ampere MCB" pattern="/^-?\d+\.?\d*$/"
                                        onKeyPress="if(this.value.length==4) return false;"
                                        value="{{ old('nilai_ampere', $mcb->nilai_ampere) }}" required>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Visual dan Konstruksi</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masa_pakai">1. Masa Pakai</label>
                                    <select class="form-control" id="masa_pakai" name="masa_pakai" required>
                                        <option value="">-- Pilih Masa Pakai --</option>
                                        <option value="<=10"
                                            {{ old('masa_pakai', $mcb->masa_pakai) == '<=10' ? 'selected' : '' }}>
                                            ≤ 10 tahun</option>
                                        <option value=">=10"
                                            {{ old('masa_pakai', $mcb->masa_pakai) == '>=10' ? 'selected' : '' }}>
                                            ≥ 10 tahun</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pengujian_ketidakhapusan_penandaan">2. Pengujian ketidakhapusan
                                        pendanaan</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="pengujian_ketidakhapusan_penandaan"
                                            name="pengujian_ketidakhapusan_penandaan" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('pengujian_ketidakhapusan_penandaan', $mcb->pengujian_ketidakhapusan_penandaan) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('pengujian_ketidakhapusan_penandaan', $mcb->pengujian_ketidakhapusan_penandaan) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
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
                                            oninput="updateCharCount('keterangan_ketidakhapusan_penandaan', 'charCountKetidakhapusanPenandaan')">{{ $mcb->keterangan_ketidakhapusan_penandaan }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pengujian_toggle_switch">3. Pengujian toggle switch</label>
                                    <div class="input-group">
                                        <select class="form-control poinB" id="pengujian_toggle_switch"
                                            name="pengujian_toggle_switch" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('pengujian_toggle_switch', $mcb->pengujian_toggle_switch) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('pengujian_toggle_switch', $mcb->pengujian_toggle_switch) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
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
                                            oninput="updateCharCount('keterangan_toggle_switch', 'charCountToggleSwitch')">{{ $mcb->keterangan_toggle_switch }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_keandalan_sekrup">4. Pengujian keandalan sekrup, bagian yang
                                        menghantar arus dan sambungan</label>
                                    <select class="form-control poinB" id="pengujian_keandalan_sekrup"
                                        name="pengujian_keandalan_sekrup" required>
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="Baik"
                                            {{ old('pengujian_keandalan_sekrup', $mcb->pengujian_keandalan_sekrup) == 'Baik' ? 'selected' : '' }}>
                                            Baik</option>
                                        <option value="Rusak"
                                            {{ old('pengujian_keandalan_sekrup', $mcb->pengujian_keandalan_sekrup) == 'Rusak' ? 'selected' : '' }}>
                                            Rusak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pengujian_keandalan_terminal">5. Pengujian keandalan terminal untuk
                                        penghantar luar (dilakukan bersamaan
                                        dengan memutar sekrup)</label>
                                    <select class="form-control poinB" id="pengujian_keandalan_terminal"
                                        name="pengujian_keandalan_terminal" required>
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="Baik"
                                            {{ old('pengujian_keandalan_terminal', $mcb->pengujian_keandalan_terminal) == 'Baik' ? 'selected' : '' }}>
                                            Baik</option>
                                        <option value="Rusak"
                                            {{ old('pengujian_keandalan_terminal', $mcb->pengujian_keandalan_terminal) == 'Rusak' ? 'selected' : '' }}>
                                            Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="sectionC">
                            <hr class="mb-3">
                            <h6 class="mb-3 font-weight-bold">C. Pengujian Karakteristik</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pengujian_pemutusan_arus">Pengujian Pemutusan Arus (Inominal x
                                            1,2)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="pengujian_pemutusan_arus"
                                                name="pengujian_pemutusan_arus" placeholder="Hasil pengujian (Detik)"
                                                value="{{ old('pengujian_pemutusan_arus', $mcb->pengujian_pemutusan_arus) }}">
                                            <span class="input-group-text" id="basic-addon2"
                                                onclick="toggleKeterangan('keteranganPemutusanArus')">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </div>
                                        <!-- Input keterangan toggle -->
                                        <div id="keteranganPemutusanArus" class="form-group mt-2"
                                            style="display: none;">
                                            <label for="keterangan_toggle_switch">Keterangan Pemutusan Arus:</label>
                                            <textarea class="form-control" id="keterangan_pemutusan_arus" name="keterangan_pemutusan_arus" rows="2"
                                                maxlength="55" placeholder="Masukkan keterangan..."
                                                oninput="updateCharCount('keterangan_pemutusan_arus', 'charCountPemutusanArus')">{{ $mcb->keterangan_pemutusan_arus }}</textarea>
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
                                    @if (auth()->user()->hasRole('Petugas'))
                                        <input type="text" class="form-control"
                                            value="{{ old('kesimpulan', $mcb->kesimpulan) }}" readonly
                                            style="background-color: #f8f9fa; cursor: not-allowed;">
                                        <input type="hidden" name="kesimpulan"
                                            value="{{ old('kesimpulan', $mcb->kesimpulan) }}">
                                    @else
                                        <select class="form-control" id="kesimpulan" name="kesimpulan" required>
                                            <option value="">-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $mcb->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $mcb->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $mcb->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
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
                                                        alt="Gambar Evidence kWh Meter {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence kWh Meter {{ $key + 1 }}"
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
</script>

<!-- CSS untuk membatasi tinggi textarea -->
<style>
    textarea.form-control {
        resize: none;
        overflow: hidden;
        height: auto;
        min-height: 60px;
    }

    select[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
        pointer-events: none;
    }
</style>

{{-- JS untuk otomatisasi Kesimpulan MCB --}}
@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        // Pastikan select box kesimpulan tidak disabled
        document.addEventListener("DOMContentLoaded", function() {
            const kesimpulanSelect = document.getElementById("kesimpulan");
            if (kesimpulanSelect) {
                kesimpulanSelect.readOnly = false;
            }
        });

        // Preview image
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
        // document.getElementById('formInspeksi').addEventListener('submit', function(e) {
        //     // e.preventDefault(); // Mencegah submit langsung

        //     // Simpan data ke localStorage
        //     localStorage.removeItem("formInspeksiData");

        //     // Tampilkan toast - form akan disubmit via onShn callback
        //     toastr.success('Data berhasil diperbarui!');
        // });

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
    </script>
@elseif(auth()->user()->hasRole('Petugas'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectMasaPakai = document.getElementById("masa_pakai");
            const kesimpulanDisplay = document.querySelector("input[name='kesimpulan']");
            const kondisiSelects = document.querySelectorAll(".poinB");

            function updateKesimpulan() {
                if (!selectMasaPakai.value) return;

                let adaYangRusak = Array.from(kondisiSelects).some(select => select.value === "Rusak");

                if (selectMasaPakai.value === ">=10") {
                    kesimpulanDisplay.value = "Bekas tidak layak pakai (K8)";
                } else if (adaYangRusak) {
                    kesimpulanDisplay.value = "Masih garansi (K7)";
                } else {
                    kesimpulanDisplay.value = "Bekas layak pakai (K6)";
                }

                // if (selectMasaPakai.value === "<=10") {
                //     kesimpulanDisplay.value = "Masih garansi (K7)";
                // } else if (adaYangRusak) {
                //     kesimpulanDisplay.value = "Bekas tidak layak pakai (K8)";
                // } else {
                //     kesimpulanDisplay.value = "Bekas layak pakai (K6)";
                // }

                // Update juga tampilan
                document.querySelector("input[type='text'][readonly]").value = kesimpulanDisplay.value;
            }

            // Event listeners
            selectMasaPakai.addEventListener("change", updateKesimpulan);
            kondisiSelects.forEach(select => {
                select.addEventListener("change", updateKesimpulan);
            });

            // Inisialisasi awal
            updateKesimpulan();
        });

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

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "extendedTimeOut": "1000"
        };

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
    </script>
@endif

<x-layouts.footer />
