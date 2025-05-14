<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Cable Power</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" name="formInspeksi"
                        action="{{ route('form-retur-cable-power.update', $cable_powers->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="4">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select class="form-control" id="up3_id" name="up3_id" required>
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
                                        value="{{ old('tgl_inspeksi', $cable_powers->tgl_inspeksi) }}" readonly>
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
                                        name="lokasi_akhir_terpasang" placeholder="Masukkan Alamat"
                                        value="{{ old('lokasi_akhir_terpasang', $cable_powers->lokasi_akhir_terpasang) }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id" required>
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
                                        <label for="tahun_pemasangan" class="tahun_pemasangan">Tahun Pemasangan</label>
                                        <select class="form-control select2" id="tahun_pemasangan"
                                            name="tahun_pemasangan" required>
                                            <option value="">-- Pilih Tahun --</option>
                                            @php
                                                $currentYear = date('Y');
                                                $selectedYear = old(
                                                    'tahun_pemasangan',
                                                    $selectedTahunPemasangan ?? null,
                                                );
                                            @endphp
                                            @for ($i = $currentYear; $i >= 2000; $i--)
                                                <option value="{{ $i }}"
                                                    {{ (string) $selectedYear === (string) $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" placeholder="Masa Pakai" readonly
                                            value="{{ isset($selectedYear) ? $currentYear - (int) $selectedYear . ' tahun' : '' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="d-flex gap-4 mb-3">
                                    <div class="w-50">
                                        <label for="jenis_cable_power">Jenis Cable Power:</label>
                                        <select class="form-control select2-cable" name="jenis_cable_power"
                                            id="jenis_cable_power" required>
                                            <option value="">-- Pilih Jenis Cable --</option>
                                            <option value="LVTIC"
                                                {{ old('jenis_cable_power', $cable_powers->jenis_cable_power ?? '') == 'LVTIC' ? 'selected' : '' }}>
                                                LVTIC</option>
                                            <option value="NYY"
                                                {{ old('jenis_cable_power', $cable_powers->jenis_cable_power ?? '') == 'NYY' ? 'selected' : '' }}>
                                                NYY</option>
                                            <option value="XLPE"
                                                {{ old('jenis_cable_power', $cable_powers->jenis_cable_power ?? '') == 'XLPE' ? 'selected' : '' }}>
                                                XLPE</option>
                                            <option value="MVTIC"
                                                {{ old('jenis_cable_power', $cable_powers->jenis_cable_power ?? '') == 'MVTIC' ? 'selected' : '' }}>
                                                MVTIC</option>
                                            @if (!in_array($cable_powers->jenis_cable_power ?? '', ['LVTIC', 'NYY', 'XLPE', 'MVTIC']))
                                                <option value="{{ $cable_powers->jenis_cable_power ?? '' }}" selected>
                                                    {{ $cable_powers->jenis_cable_power ?? '' }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    {{-- <div class="w-50">
                                        <label for="jenis_cable_power" class="jenis_cable_power">Jenis Cable Power:</label>
                                        <input type="text" class="form-control" id="jenis_cable_power"
                                            name="jenis_cable_power" placeholder="Masukkan atau pilih jenis cable"
                                            list="jenisCableList"
                                            value="{{ old('jenis_cable_power', $cable_powers->jenis_cable_power) }}"
                                            required>
                                        <datalist name="jenis_cable_power" id="jenisCableList">
                                            <option value="LVTIC"></option>
                                            <option value="NYY"></option>
                                            <option value="XLPE"></option>
                                            <option value="MVTIC"></option>
                                        </datalist>
                                    </div> --}}
                                    <div class="w-50">
                                        <label for="ukuran_cable_power">Ukuran</label>
                                        <div class="input-group">
                                            <input name="ukuran_cable_power" type="text" class="form-control"
                                                id="ukuran_cable_power" placeholder="Masukkan ukuran kabel" required
                                                value="{{ old('ukuran_cable_power', $cable_powers->ukuran_cable_power) }}">
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
                                            required
                                            value="{{ old('luas_penampang', $cable_powers->luas_penampang) }}">
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
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                            value="{{ old('panjang_cable_power', $cable_powers->panjang_cable_power) }}">
                                        <span class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">B. Pengujian Non Elektrik</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="nilai_pemeriksaan_kondisi_visual">1. Pemeriksaan kondisi visual dan
                                        penandaan (Tidak Rantas,
                                        Tidak Mekar &
                                        Isolasi Tidak Rusak) </label>
                                    <div class="input-group">
                                        <select name="nilai_pemeriksaan_kondisi_visual" class="form-control"
                                            id="nilai_pemeriksaan_kondisi_visual" required>
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('nilai_pemeriksaan_kondisi_visual', $cable_powers->nilai_pemeriksaan_kondisi_visual) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('nilai_pemeriksaan_kondisi_visual', $cable_powers->nilai_pemeriksaan_kondisi_visual) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
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
                                            oninput="updateCharCount('keterangan_pemeriksaan', 'charCountNilaiPemeriksaan')">{{ $cable_powers->keterangan_pemeriksaan }}</textarea>
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
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                            value="{{ old('nilai_pengujian_dimensi', $cable_powers->nilai_pengujian_dimensi) }}">
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
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                            value="{{ old('nilai_uji_tahanan_isolasi', $cable_powers->nilai_uji_tahanan_isolasi) }}">
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
                                            name="kesimpulan_k6" placeholder="Masukkan Panjang Konduktor" required
                                            value="{{ old('kesimpulan_k6', $cable_powers->kesimpulan_k6) }}"><span
                                            class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan_k8">Bekas tidak layak pakai (K8)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="kesimpulan_k8"
                                            name="kesimpulan_k8" placeholder="Masukkan Panjang Konduktor" required
                                            value="{{ old('kesimpulan_k8', $cable_powers->kesimpulan_k8) }}"><span
                                            class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Tambahkan elemen untuk menampilkan pesan warning -->
                            <div id="warningMessageKesimpulan" style="color: red; display: none;">
                                ⚠ Jumlah panjang K6 dan K8 tidak sesuai dengan panjang cable power.
                            </div>
                        </div>
                        <hr class="mb-3">
                        <!-- Bagian E: Gambar Evidence -->
                        <h6 class="font-weight-bold">E. Gambar Evidence</h6>
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
                                                        alt="Gambar Evidence Cable Power {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence Cable Power {{ $key + 1 }}"
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

                        @if (auth()->user()->hasRole('PIC_Gudang'))
                            <a href="{{ route('form-unapproved') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Setuju</button>
                        @elseif (auth()->user()->hasRole('Petugas'))
                            <a href="{{ route('form-unapproved') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        @else
                            <a href="{{ route('form-unapproved') }}" class="btn btn-secondary">Kembali</a>
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

@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function previewImage(input, previewId) {
                const previewContainer = document.getElementById(previewId);
                previewContainer.innerHTML = ""; // Kosongkan preview sebelumnya

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgElement = document.createElement("img");
                        imgElement.src = e.target.result;
                        imgElement.classList.add("h-40", "w-40", "object-cover", "rounded-lg", "border",
                            "border-gray-300");
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

            (function($) {
                // =============================================
                // 1. KONFIGURASI AWAL & VARIABEL UTAMA
                // =============================================
                const config = {
                    debugMode: false, // Set false untuk production
                    tahunAwal: 1900, // Tahun paling awal yang ditampilkan
                    tahunSekarang: new Date().getFullYear()
                };

                const elements = {
                    selectTahun: $('#tahun_pemasangan'),
                    inputMasaPakai: $('#masa_pakai'),
                    luasPenampang: $('#luas_penampang'),
                    rentangToleransi: $('#rentangToleransi'),
                    diameterKonduktor: $('#nilai_pengujian_dimensi'),
                    warningDimensi: $('#warningMessageDimensi'),
                    panjangCable: $('#panjang_cable_power'),
                    kesimpulanK6: $('#kesimpulan_k6'),
                    kesimpulanK8: $('#kesimpulan_k8'),
                    warningKesimpulan: $('#warningMessageKesimpulan')
                };

                // Nilai dari database (string)
                const selectedValueFromDB = "{{ $selectedTahunPemasangan ?? '' }}";
                const selectedCableFromDB = "{{ $cable_powers->jenis_cable_power ?? '' }}";

                // =============================================
                // 2. FUNGSI UTAMA
                // =============================================

                /**
                 * Inisialisasi Select2 untuk jenis cable power dengan tags - VERSI PERBAIKAN
                 */
                function initSelectCable() {
                    try {
                        // Pastikan element ada di objects elements
                        elements.jenisCablePower = $('#jenis_cable_power');

                        // Inisialisasi Select2 dengan konfigurasi tags
                        elements.jenisCablePower.select2({
                            tags: true,
                            width: '100%',
                            dropdownParent: elements.jenisCablePower.parent(),
                            createTag: function(params) {
                                const term = $.trim(params.term);
                                if (term === '') return null;
                                if (term.length < 2) return null; // Minimal 2 karakter

                                return {
                                    id: term,
                                    text: term,
                                    newTag: true
                                };
                            },
                            insertTag: function(data, tag) {
                                // Masukkan tag baru di atas
                                data.unshift(tag);
                            }
                        });

                        // Handle nilai dari database
                        if (selectedCableFromDB) {
                            // Cari apakah value sudah ada di options
                            const existingOption = elements.jenisCablePower.find('option[value="' +
                                selectedCableFromDB + '"]');

                            if (existingOption.length === 0) {
                                // Jika tidak ada, buat option baru
                                const newOption = new Option(selectedCableFromDB, selectedCableFromDB, true,
                                    true);
                                elements.jenisCablePower.append(newOption);
                            } else {
                                // Jika ada, set sebagai selected
                                existingOption.prop('selected', true);
                            }

                            // Trigger change setelah set nilai
                            elements.jenisCablePower.trigger('change');
                        }

                        // Handle ketika user memilih/membuat tag baru
                        elements.jenisCablePower.on('select2:select', function(e) {
                            if (e.params.data.newTag) {
                                // Jika tag baru, pastikan tidak ada duplikat
                                const value = e.params.data.id;
                                const existingOptions = elements.jenisCablePower.find('option[value="' +
                                    value + '"]');

                                if (existingOptions.length > 1) {
                                    // Hapus duplikat
                                    existingOptions.not(':selected').remove();
                                }
                            }
                        });

                        logDebug('SelectCable initialized', elements.jenisCablePower.val());
                    } catch (error) {
                        logError('Error in initSelectCable', error);
                    }
                }

                /**
                 * Generate opsi tahun dan inisialisasi Select2
                 */
                function initSelectTahun() {
                    try {
                        // Kosongkan dan tambahkan default option
                        elements.selectTahun.empty().append('<option value="">-- Pilih Tahun --</option>');

                        // Generate opsi tahun
                        for (let tahun = config.tahunSekarang; tahun >= config.tahunAwal; tahun--) {
                            const isSelected = selectedValueFromDB === tahun.toString();
                            const $option = new Option(tahun, tahun, false, isSelected);
                            elements.selectTahun.append($option);
                        }

                        // Inisialisasi Select2
                        elements.selectTahun.select2({
                            width: '100%',
                            dropdownParent: elements.selectTahun.closest('.w-50'),
                            closeOnSelect: true
                        }).trigger('change');

                        logDebug('SelectTahun initialized', elements.selectTahun.val());
                    } catch (error) {
                        logError('Error in initSelectTahun', error);
                    }
                }

                /**
                 * Hitung masa pakai berdasarkan tahun pemasangan
                 */
                function hitungMasaPakai() {
                    try {
                        const tahunPemasangan = parseInt(elements.selectTahun.val());
                        const masaPakai = isNaN(tahunPemasangan) ? '' :
                            `${config.tahunSekarang - tahunPemasangan} tahun`;
                        elements.inputMasaPakai.val(masaPakai);
                        logDebug('Masa pakai calculated', masaPakai);
                    } catch (error) {
                        logError('Error in hitungMasaPakai', error);
                    }
                }

                /**
                 * Hitung rentang toleransi luas penampang
                 */
                function hitungRentangToleransi() {
                    try {
                        const luasPenampang = parseFloat(elements.luasPenampang.val()) || 0;
                        const toleransi = luasPenampang * 0.01;
                        const min = luasPenampang - toleransi;
                        const max = luasPenampang + toleransi;

                        elements.rentangToleransi.text(
                            `Rentang toleransi: ${min.toFixed(2)} mm - ${max.toFixed(2)} mm`
                        );

                        // Validasi diameter konduktor
                        elements.diameterKonduktor.off('input').on('input', function() {
                            const diameter = parseFloat($(this).val()) || 0;
                            const isInvalid = diameter < min || diameter > max;

                            elements.warningDimensi.toggle(isInvalid);
                            $(this).css('border-color', isInvalid ? 'red' : '');
                        });

                        logDebug('Rentang toleransi calculated', {
                            min,
                            max
                        });
                    } catch (error) {
                        logError('Error in hitungRentangToleransi', error);
                    }
                }

                /**
                 * Validasi panjang cable
                 */
                function validasiPanjangCable() {
                    try {
                        const panjangTotal = (parseFloat(elements.kesimpulanK6.val()) || 0) +
                            (parseFloat(elements.kesimpulanK8.val()) || 0);
                        const isInvalid = panjangTotal !== (parseFloat(elements.panjangCable.val()) || 0);

                        elements.warningKesimpulan.toggle(isInvalid);
                        logDebug('Validasi panjang cable', {
                            panjangTotal,
                            isInvalid
                        });
                    } catch (error) {
                        logError('Error in validasiPanjangCable', error);
                    }
                }

                // =============================================
                // 3. EVENT HANDLERS & INISIALISASI
                // =============================================
                function setupEventListeners() {
                    // Select2 events
                    elements.selectTahun.on('change select2:select', function() {
                        hitungMasaPakai();
                        $(this).trigger('blur');
                    });

                    // Luas penampang events
                    elements.luasPenampang.on('input', hitungRentangToleransi);

                    // Panjang cable events
                    elements.panjangCable.on('input', validasiPanjangCable);
                    elements.kesimpulanK6.on('input', validasiPanjangCable);
                    elements.kesimpulanK8.on('input', validasiPanjangCable);
                }

                function initialize() {
                    initSelectTahun();
                    setupEventListeners();
                    initSelectCable();

                    // Hitung nilai awal
                    hitungMasaPakai();
                    hitungRentangToleransi();
                    validasiPanjangCable();

                    logDebug('System initialized successfully');
                }

                // =============================================
                // 4. HELPER FUNCTIONS
                // =============================================
                function logDebug(message, data = null) {
                    if (config.debugMode) {
                        console.log(`[DEBUG] ${message}`, data || '');
                    }
                }

                function logError(message, error) {
                    console.error(`[ERROR] ${message}:`, error);
                }

                // =============================================
                // 5. START APPLICATION
                // =============================================
                setTimeout(initialize, 100); // Beri sedikit delay untuk memastikan DOM siap

            })(jQuery);

            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "extendedTimeOut": "2000"
            };
            // document.getElementById('formInspeksi').addEventListener('submit', function(e) {
            //     e.preventDefault(); // Mencegah submit langsung

            //     // Simpan data ke localStorage
            //     localStorage.removeItem("formInspeksiData");

            //     // Tampilkan toast - form akan disubmit via onShn callback
            //     toastr.success('Data berhasil disetujui!');
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
        });
    </script>
@elseif (auth()->user()->hasRole('Petugas'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function previewImage(input, previewId) {
                const previewContainer = document.getElementById(previewId);
                previewContainer.innerHTML = ""; // Kosongkan preview sebelumnya

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgElement = document.createElement("img");
                        imgElement.src = e.target.result;
                        imgElement.classList.add("h-40", "w-40", "object-cover", "rounded-lg", "border",
                            "border-gray-300");
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

            (function($) {
                // =============================================
                // 1. KONFIGURASI AWAL & VARIABEL UTAMA
                // =============================================
                const config = {
                    debugMode: false, // Set false untuk production
                    tahunAwal: 1900, // Tahun paling awal yang ditampilkan
                    tahunSekarang: new Date().getFullYear()
                };

                const elements = {
                    selectTahun: $('#tahun_pemasangan'),
                    inputMasaPakai: $('#masa_pakai'),
                    luasPenampang: $('#luas_penampang'),
                    rentangToleransi: $('#rentangToleransi'),
                    diameterKonduktor: $('#nilai_pengujian_dimensi'),
                    warningDimensi: $('#warningMessageDimensi'),
                    panjangCable: $('#panjang_cable_power'),
                    kesimpulanK6: $('#kesimpulan_k6'),
                    kesimpulanK8: $('#kesimpulan_k8'),
                    warningKesimpulan: $('#warningMessageKesimpulan')
                };

                // Nilai dari database (string)
                const selectedValueFromDB = "{{ $selectedTahunPemasangan ?? '' }}";
                const selectedCableFromDB = "{{ $cable_powers->jenis_cable_power ?? '' }}";

                // =============================================
                // 2. FUNGSI UTAMA
                // =============================================

                /**
                 * Inisialisasi Select2 untuk jenis cable power dengan tags - VERSI PETUGAS
                 */
                function initSelectCable() {
                    try {
                        // Pastikan element ada di objects elements
                        elements.jenisCablePower = $('#jenis_cable_power');

                        // Inisialisasi Select2 dengan konfigurasi tags
                        elements.jenisCablePower.select2({
                            tags: true,
                            width: '100%',
                            dropdownParent: elements.jenisCablePower.parent(),
                            createTag: function(params) {
                                const term = $.trim(params.term);
                                if (term === '') return null;
                                if (term.length < 2) return null; // Minimal 2 karakter

                                return {
                                    id: term,
                                    text: term,
                                    newTag: true
                                };
                            }
                        });

                        // Handle nilai dari database untuk Petugas (readonly mungkin)
                        if (selectedCableFromDB) {
                            // Untuk Petugas, mungkin tidak boleh membuat tag baru
                            const existingOption = elements.jenisCablePower.find('option[value="' +
                                selectedCableFromDB + '"]');

                            if (existingOption.length > 0) {
                                existingOption.prop('selected', true);
                                elements.jenisCablePower.trigger('change');
                            } else {
                                // Jika tidak ada di options, tampilkan sebagai teks biasa
                                const newOption = new Option(selectedCableFromDB, selectedCableFromDB, true,
                                    true);
                                elements.jenisCablePower.append(newOption).trigger('change');
                                elements.jenisCablePower.prop('disabled', true); // Nonaktifkan edit
                            }
                        }

                        logDebug('SelectCable initialized (Petugas)', elements.jenisCablePower.val());
                    } catch (error) {
                        logError('Error in initSelectCable (Petugas)', error);
                    }
                }

                /**
                 * Generate opsi tahun dan inisialisasi Select2
                 */
                function initSelectTahun() {
                    try {
                        // Kosongkan dan tambahkan default option
                        elements.selectTahun.empty().append('<option value="">-- Pilih Tahun --</option>');

                        // Generate opsi tahun
                        for (let tahun = config.tahunSekarang; tahun >= config.tahunAwal; tahun--) {
                            const isSelected = selectedValueFromDB === tahun.toString();
                            const $option = new Option(tahun, tahun, false, isSelected);
                            elements.selectTahun.append($option);
                        }

                        // Inisialisasi Select2
                        elements.selectTahun.select2({
                            width: '100%',
                            dropdownParent: elements.selectTahun.closest('.w-50'),
                            closeOnSelect: true
                        }).trigger('change');

                        logDebug('SelectTahun initialized', elements.selectTahun.val());
                    } catch (error) {
                        logError('Error in initSelectTahun', error);
                    }
                }

                /**
                 * Hitung masa pakai berdasarkan tahun pemasangan
                 */
                function hitungMasaPakai() {
                    try {
                        const tahunPemasangan = parseInt(elements.selectTahun.val());
                        const masaPakai = isNaN(tahunPemasangan) ? '' :
                            `${config.tahunSekarang - tahunPemasangan} tahun`;
                        elements.inputMasaPakai.val(masaPakai);
                        logDebug('Masa pakai calculated', masaPakai);
                    } catch (error) {
                        logError('Error in hitungMasaPakai', error);
                    }
                }

                /**
                 * Hitung rentang toleransi luas penampang
                 */
                function hitungRentangToleransi() {
                    try {
                        const luasPenampang = parseFloat(elements.luasPenampang.val()) || 0;
                        const toleransi = luasPenampang * 0.01;
                        const min = luasPenampang - toleransi;
                        const max = luasPenampang + toleransi;

                        elements.rentangToleransi.text(
                            `Rentang toleransi: ${min.toFixed(2)} mm - ${max.toFixed(2)} mm`
                        );

                        // Validasi diameter konduktor
                        elements.diameterKonduktor.off('input').on('input', function() {
                            const diameter = parseFloat($(this).val()) || 0;
                            const isInvalid = diameter < min || diameter > max;

                            elements.warningDimensi.toggle(isInvalid);
                            $(this).css('border-color', isInvalid ? 'red' : '');
                        });

                        logDebug('Rentang toleransi calculated', {
                            min,
                            max
                        });
                    } catch (error) {
                        logError('Error in hitungRentangToleransi', error);
                    }
                }

                /**
                 * Validasi panjang cable
                 */
                function validasiPanjangCable() {
                    try {
                        const panjangTotal = (parseFloat(elements.kesimpulanK6.val()) || 0) +
                            (parseFloat(elements.kesimpulanK8.val()) || 0);
                        const isInvalid = panjangTotal !== (parseFloat(elements.panjangCable.val()) || 0);

                        elements.warningKesimpulan.toggle(isInvalid);
                        logDebug('Validasi panjang cable', {
                            panjangTotal,
                            isInvalid
                        });
                    } catch (error) {
                        logError('Error in validasiPanjangCable', error);
                    }
                }

                // =============================================
                // 3. EVENT HANDLERS & INISIALISASI
                // =============================================
                function setupEventListeners() {
                    // Select2 events
                    elements.selectTahun.on('change select2:select', function() {
                        hitungMasaPakai();
                        $(this).trigger('blur');
                    });

                    // Luas penampang events
                    elements.luasPenampang.on('input', hitungRentangToleransi);

                    // Panjang cable events
                    elements.panjangCable.on('input', validasiPanjangCable);
                    elements.kesimpulanK6.on('input', validasiPanjangCable);
                    elements.kesimpulanK8.on('input', validasiPanjangCable);
                }

                function initialize() {
                    initSelectTahun();
                    setupEventListeners();
                    initSelectCable();

                    // Hitung nilai awal
                    hitungMasaPakai();
                    hitungRentangToleransi();
                    validasiPanjangCable();

                    logDebug('System initialized successfully');
                }

                // =============================================
                // 4. HELPER FUNCTIONS
                // =============================================
                function logDebug(message, data = null) {
                    if (config.debugMode) {
                        console.log(`[DEBUG] ${message}`, data || '');
                    }
                }

                function logError(message, error) {
                    console.error(`[ERROR] ${message}:`, error);
                }

                // =============================================
                // 5. START APPLICATION
                // =============================================
                setTimeout(initialize, 100); // Beri sedikit delay untuk memastikan DOM siap

            })(jQuery);

            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "extendedTimeOut": "3000"
            };
            // document.getElementById('formInspeksi').addEventListener('submit', function(e) {
            //     e.preventDefault(); // Mencegah submit langsung

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
                    toastr.success('Data berhasil diperbarui!');
                }
            });
        });
    </script>
@endif

<x-layouts.footer />
