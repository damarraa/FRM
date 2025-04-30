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
                    <form id="formInspeksi" name="formInspeksi"
                        action="{{ route('form-retur-conductor.update', $conductor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="5">
                            <input type="hidden" id="uid_id" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="up3_id">Unit</label>
                                    <select name="up3_id" id="up3_id" class="form-control" required>
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
                                    <select id="gudang_id" name="gudang_id" class="form-control" required>
                                        <option value="">-- Pilih Gudang --</option>
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
                                    <label for="tgl_inspeksi">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl_inspeksi" name="tgl_inspeksi"
                                        value="{{ old('tgl_inspeksi', $conductor->tgl_inspeksi) }}" readonly>
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
                                        id="lokasi_akhir_terpasang" placeholder="Masukkan Alamat"
                                        value="{{ old('lokasi_akhir_terpasang', $conductor->lokasi_akhir_terpasang) }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select id="ulp_id" name="ulp_id" class="form-control" required>
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
                                        <label for="jenis_conductor">Jenis Conduktor</label>
                                        <select class="form-control select2-conductor" name="jenis_conductor"
                                            id="jenis_conductor" required>
                                            <option value="">-- Pilih Jenis Conductor --</option>
                                            <option value="AAAC"
                                                {{ old('jenis_conductor', $conductor->jenis_conductor ?? '') == 'AAAC' ? 'selected' : '' }}>
                                                AAAC
                                            </option>
                                            <option value="AAAC-S"
                                                {{ old('jenis_conductor', $conductor->jenis_conductor ?? '') == 'AAAC-S' ? 'selected' : '' }}>
                                                AAAC-S
                                            </option>
                                            <option value="CCSXT"
                                                {{ old('jenis_conductor', $conductor->jenis_conductor ?? '') == 'CCSXT' ? 'selected' : '' }}>
                                                CCSXT
                                            </option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="ukuran_conductor">Ukuran</label>
                                        <div class="input-group">
                                            <input type="text" name="ukuran_conductor" id="ukuran_conductor"
                                                class="form-control" placeholder="Masukkan ukuran konduktor" required
                                                value="{{ old('ukuran_conductor', $conductor->ukuran_conductor) }}">
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
                                            required value="{{ old('luas_penampang', $conductor->luas_penampang) }}">
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
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                            value="{{ old('panjang_conductor', $conductor->panjang_conductor) }}">
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
                                            <option value="Baik"
                                                {{ old('nilai_pemeriksaan_kondisi_visual', $conductor->nilai_pemeriksaan_kondisi_visual) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('nilai_pemeriksaan_kondisi_visual', $conductor->nilai_pemeriksaan_kondisi_visual) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
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
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                            value="{{ old('nilai_pengujian_dimensi', $conductor->nilai_pengujian_dimensi) }}">
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
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                            value="{{ old('nilai_uji_tahanan_isolasi', $conductor->nilai_uji_tahanan_isolasi) }}">
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
                                            name="kesimpulan_k6" placeholder="Masukkan Panjang Konduktor" required
                                            value="{{ old('kesimpulan_k6', $conductor->kesimpulan_k6) }}"><span
                                            class="input-group-text" id="basic-addon2">m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan_k8">Bekas tidak layak pakai (K8)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kesimpulan_k8"
                                            name="kesimpulan_k8" placeholder="Masukkan Panjang Konduktor" required
                                            value="{{ old('kesimpulan_k8', $conductor->kesimpulan_k8) }}"><span
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
                                                        alt="Gambar Evidence Conductor MV {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence Conductor MV {{ $key + 1 }}"
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

                        <a href="{{ route('forms') }}" class="btn btn-secondary">Kembali</a>
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

@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            (function($) {
                // =============================================
                // 1. KONFIGURASI AWAL & VARIABEL UTAMA
                // =============================================
                const config = {
                    debugMode: false, // Set false untuk production
                    tahunSekarang: new Date().getFullYear()
                };

                const elements = {
                    // Select2 dan Masa Pakai
                    selectTahun: $('#tahun_pemasangan'),
                    inputMasaPakai: $('#masa_pakai'),

                    // Validasi Dimensi
                    luasPenampang: $('#luas_penampang'),
                    rentangToleransi: $('#rentangToleransi'),
                    diameterKonduktor: $('#nilai_pengujian_dimensi'),
                    warningDimensi: $('#warningMessageDimensi'),

                    // Validasi Panjang Cable
                    panjangCable: $('#panjang_conductor'),
                    kesimpulanK6: $('#kesimpulan_k6'),
                    kesimpulanK8: $('#kesimpulan_k8'),
                    warningKesimpulan: $('#warningMessageKesimpulan'),

                    // Form Inspeksi
                    tglInspeksi: $('#tgl_inspeksi'),
                    formInspeksi: $('#formInspeksi'),
                    jenisConductor: $('#jenis_conductor'),
                    pengujianElektrikSection: $('#pengujianElektrikSection'),
                    pengujianElektrikContent: $('#pengujianElektrikContent'),
                    kesimpulanDropdown: $('#kesimpulan'),
                    nilaiPemeriksaanVisual: $('#nilai_pemeriksaan_kondisi_visual'),
                    nilaiUjiTahanan: $('#nilai_uji_tahanan_isolasi')
                };

                // Nilai dari database (string)
                const selectedValueFromDB = "{{ $selectedTahunPemasangan ?? '' }}";
                const selectedConductorFromDB = "{{ $conductor->jenis_conductor ?? '' }}";

                // =============================================
                // 2. INISIALISASI SELECT2 DENGAN BLADE VIEW
                // =============================================

                /**
                 * Inisialisasi Select2 untuk jenis cable power dengan tags - VERSI PERBAIKAN
                 */
                function initSelectConductor() {
                    try {
                        // Pastikan element ada di objects elements
                        elements.jenisConductor = $('#jenis_conductor');

                        // Inisialisasi Select2 dengan konfigurasi tags
                        elements.jenisConductor.select2({
                            tags: true,
                            width: '100%',
                            dropdownParent: elements.jenisConductor.parent(),
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
                        if (selectedConductorFromDB) {
                            // Cari apakah value sudah ada di options
                            const existingOption = elements.jenisConductor.find('option[value="' +
                                selectedConductorFromDB + '"]');

                            if (existingOption.length === 0) {
                                // Jika tidak ada, buat option baru
                                const newOption = new Option(selectedConductorFromDB, selectedConductorFromDB,
                                    true,
                                    true);
                                elements.jenisConductor.append(newOption);
                            } else {
                                // Jika ada, set sebagai selected
                                existingOption.prop('selected', true);
                            }

                            // Trigger change setelah set nilai
                            elements.jenisConductor.trigger('change');
                        }

                        // Handle ketika user memilih/membuat tag baru
                        elements.jenisConductor.on('select2:select', function(e) {
                            if (e.params.data.newTag) {
                                // Jika tag baru, pastikan tidak ada duplikat
                                const value = e.params.data.id;
                                const existingOptions = elements.jenisConductor.find('option[value="' +
                                    value + '"]');

                                if (existingOptions.length > 1) {
                                    // Hapus duplikat
                                    existingOptions.not(':selected').remove();
                                }
                            }
                        });

                        logDebug('SelectCable initialized', elements.jenisConductor.val());
                    } catch (error) {
                        logError('Error in initSelectCable', error);
                    }
                }

                function initSelectTahun() {
                    try {
                        // Pertahankan opsi yang sudah digenerate oleh Blade
                        // Hanya inisialisasi Select2 saja

                        // Inisialisasi Select2
                        elements.selectTahun.select2({
                            width: '100%',
                            dropdownParent: elements.selectTahun.closest('.w-50'),
                            closeOnSelect: true
                        });

                        // Set nilai terpilih dari Blade
                        if (selectedValueFromDB) {
                            elements.selectTahun.val(selectedValueFromDB).trigger('change');
                        }

                        logDebug('Select2 initialized with value:', selectedValueFromDB);
                    } catch (error) {
                        logError('Error in initSelectTahun', error);
                    }
                }

                // =============================================
                // 3. FUNGSI HITUNG MASA PAKAI
                // =============================================
                function hitungMasaPakai() {
                    try {
                        const tahunPemasangan = parseInt(elements.selectTahun.val());
                        if (!isNaN(tahunPemasangan)) {
                            const masaPakai = config.tahunSekarang - tahunPemasangan;
                            elements.inputMasaPakai.val(masaPakai + " tahun");
                        } else {
                            elements.inputMasaPakai.val("");
                        }
                    } catch (error) {
                        logError('Error in hitungMasaPakai', error);
                    }
                }

                // =============================================
                // 4. FUNGSI VALIDASI DIMENSI
                // =============================================
                function initValidasiDimensi() {
                    elements.luasPenampang.on('input', function() {
                        const luasPenampang = parseFloat($(this).val()) || 0;
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
                    });
                }

                // =============================================
                // 5. FUNGSI VALIDASI PANJANG CABLE
                // =============================================
                function initValidasiPanjang() {
                    function checkPanjang() {
                        const panjangCablePower = parseFloat(elements.panjangCable.val()) || 0;
                        const panjangK6 = parseFloat(elements.kesimpulanK6.val()) || 0;
                        const panjangK8 = parseFloat(elements.kesimpulanK8.val()) || 0;
                        const totalPanjang = panjangK6 + panjangK8;

                        elements.warningKesimpulan.toggle(totalPanjang !== panjangCablePower);
                    }

                    elements.panjangCable.add(elements.kesimpulanK6).add(elements.kesimpulanK8)
                        .on('input', checkPanjang);
                }

                // =============================================
                // 6. FUNGSI TOGGLE PENGUJIAN ELEKTRIK
                // =============================================
                function initTogglePengujianElektrik() {
                    function toggleSection() {
                        const jenisCable = elements.jenisConductor.val();
                        const isVisible = (jenisCable === 'AAAC-S' || jenisCable === 'CCSXT');

                        elements.pengujianElektrikSection.toggle(isVisible);
                        elements.pengujianElektrikContent.toggle(isVisible);
                    }

                    elements.jenisConductor.on('change', toggleSection);
                    toggleSection(); // Panggil sekali saat inisialisasi
                }

                // =============================================
                // 7. FUNGSI UPDATE KESIMPULAN
                // =============================================
                function initUpdateKesimpulan() {
                    function updateKesimpulan() {
                        const tahunPemasangan = parseInt(elements.selectTahun.val()) || 0;
                        const pemeriksaanVisual = elements.nilaiPemeriksaanVisual.val();
                        const pengujianDimensi = parseFloat(elements.diameterKonduktor.val()) || 0;
                        const ujiKesalahan = parseFloat(elements.nilaiUjiTahanan.val()) || 0;

                        const umurMaterial = config.tahunSekarang - tahunPemasangan;
                        const dimensiValid = pengujianDimensi >= 0.495 && pengujianDimensi <= 16.16;

                        const jenisCable = elements.jenisConductor.val();
                        const elektrikValid = (jenisCable === 'AAAC-S' || jenisCable === 'CCSXT') ?
                            ujiKesalahan > 0 : true;

                        if (umurMaterial < 40 && pemeriksaanVisual === 'Baik' && dimensiValid &&
                            elektrikValid) {
                            elements.kesimpulanDropdown.val('Bekas layak pakai (K6)');
                        } else {
                            elements.kesimpulanDropdown.val('Bekas tidak layak pakai (K8)');
                        }
                    }

                    elements.formInspeksi.find('select, input').on('change', updateKesimpulan);
                }

                // =============================================
                // 8. INISIALISASI AWAL
                // =============================================
                function initialize() {
                    // Set tanggal hari ini
                    elements.tglInspeksi.val(new Date().toISOString().split('T')[0]);

                    // Inisialisasi semua komponen
                    initSelectTahun();
                    initSelectConductor();
                    initValidasiDimensi();
                    initValidasiPanjang();
                    initTogglePengujianElektrik();
                    initUpdateKesimpulan();

                    // Hitung masa pakai awal
                    hitungMasaPakai();

                    logDebug('System initialized successfully');
                }

                // =============================================
                // 9. HELPER FUNCTIONS
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
                // 10. START APPLICATION
                // =============================================
                setTimeout(initialize, 100);

            })(jQuery);

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
@elseif (auth()->user()->hasRole('Petugas'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            (function($) {
                // =============================================
                // 1. KONFIGURASI AWAL & VARIABEL UTAMA
                // =============================================
                const config = {
                    debugMode: false, // Set false untuk production
                    tahunSekarang: new Date().getFullYear()
                };

                const elements = {
                    // Select2 dan Masa Pakai
                    selectTahun: $('#tahun_pemasangan'),
                    inputMasaPakai: $('#masa_pakai'),

                    // Validasi Dimensi
                    luasPenampang: $('#luas_penampang'),
                    rentangToleransi: $('#rentangToleransi'),
                    diameterKonduktor: $('#nilai_pengujian_dimensi'),
                    warningDimensi: $('#warningMessageDimensi'),

                    // Validasi Panjang Cable
                    panjangCable: $('#panjang_conductor'),
                    kesimpulanK6: $('#kesimpulan_k6'),
                    kesimpulanK8: $('#kesimpulan_k8'),
                    warningKesimpulan: $('#warningMessageKesimpulan'),

                    // Form Inspeksi
                    tglInspeksi: $('#tgl_inspeksi'),
                    formInspeksi: $('#formInspeksi'),
                    jenisConductor: $('#jenis_conductor'),
                    pengujianElektrikSection: $('#pengujianElektrikSection'),
                    pengujianElektrikContent: $('#pengujianElektrikContent'),
                    kesimpulanDropdown: $('#kesimpulan'),
                    nilaiPemeriksaanVisual: $('#nilai_pemeriksaan_kondisi_visual'),
                    nilaiUjiTahanan: $('#nilai_uji_tahanan_isolasi')
                };

                // Nilai dari database (string)
                const selectedValueFromDB = "{{ $selectedTahunPemasangan ?? '' }}";
                const selectedConductorFromDB = "{{ $conductor->jenis_conductor ?? '' }}";

                // =============================================
                // 2. INISIALISASI SELECT2 DENGAN BLADE VIEW
                // =============================================

                /**
                 * Inisialisasi Select2 untuk jenis cable power dengan tags - VERSI PERBAIKAN
                 */
                function initSelectConductor() {
                    try {
                        // Pastikan element ada di objects elements
                        elements.jenisConductor = $('#jenis_conductor');

                        // Inisialisasi Select2 dengan konfigurasi tags
                        elements.jenisConductor.select2({
                            tags: true,
                            width: '100%',
                            dropdownParent: elements.jenisConductor.parent(),
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
                        if (selectedConductorFromDB) {
                            // Cari apakah value sudah ada di options
                            const existingOption = elements.jenisConductor.find('option[value="' +
                                selectedConductorFromDB + '"]');

                            if (existingOption.length === 0) {
                                // Jika tidak ada, buat option baru
                                const newOption = new Option(selectedConductorFromDB, selectedConductorFromDB,
                                    true,
                                    true);
                                elements.jenisConductor.append(newOption);
                            } else {
                                // Jika ada, set sebagai selected
                                existingOption.prop('selected', true);
                            }

                            // Trigger change setelah set nilai
                            elements.jenisConductor.trigger('change');
                        }

                        // Handle ketika user memilih/membuat tag baru
                        elements.jenisConductor.on('select2:select', function(e) {
                            if (e.params.data.newTag) {
                                // Jika tag baru, pastikan tidak ada duplikat
                                const value = e.params.data.id;
                                const existingOptions = elements.jenisConductor.find('option[value="' +
                                    value + '"]');

                                if (existingOptions.length > 1) {
                                    // Hapus duplikat
                                    existingOptions.not(':selected').remove();
                                }
                            }
                        });

                        logDebug('SelectConductor initialized', elements.jenisConductor.val());
                    } catch (error) {
                        logError('Error in initSelectConductor', error);
                    }
                }

                function initSelectTahun() {
                    try {
                        // Pertahankan opsi yang sudah digenerate oleh Blade
                        // Hanya inisialisasi Select2 saja

                        // Inisialisasi Select2
                        elements.selectTahun.select2({
                            width: '100%',
                            dropdownParent: elements.selectTahun.closest('.w-50'),
                            closeOnSelect: true
                        });

                        // Set nilai terpilih dari Blade
                        if (selectedValueFromDB) {
                            elements.selectTahun.val(selectedValueFromDB).trigger('change');
                        }

                        logDebug('Select2 initialized with value:', selectedValueFromDB);
                    } catch (error) {
                        logError('Error in initSelectTahun', error);
                    }
                }

                // =============================================
                // 3. FUNGSI HITUNG MASA PAKAI
                // =============================================
                function hitungMasaPakai() {
                    try {
                        const tahunPemasangan = parseInt(elements.selectTahun.val());
                        if (!isNaN(tahunPemasangan)) {
                            const masaPakai = config.tahunSekarang - tahunPemasangan;
                            elements.inputMasaPakai.val(masaPakai + " tahun");
                        } else {
                            elements.inputMasaPakai.val("");
                        }
                    } catch (error) {
                        logError('Error in hitungMasaPakai', error);
                    }
                }

                // =============================================
                // 4. FUNGSI VALIDASI DIMENSI
                // =============================================
                function initValidasiDimensi() {
                    elements.luasPenampang.on('input', function() {
                        const luasPenampang = parseFloat($(this).val()) || 0;
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
                    });
                }

                // =============================================
                // 5. FUNGSI VALIDASI PANJANG CABLE
                // =============================================
                function initValidasiPanjang() {
                    function checkPanjang() {
                        const panjangCablePower = parseFloat(elements.panjangCable.val()) || 0;
                        const panjangK6 = parseFloat(elements.kesimpulanK6.val()) || 0;
                        const panjangK8 = parseFloat(elements.kesimpulanK8.val()) || 0;
                        const totalPanjang = panjangK6 + panjangK8;

                        elements.warningKesimpulan.toggle(totalPanjang !== panjangCablePower);
                    }

                    elements.panjangCable.add(elements.kesimpulanK6).add(elements.kesimpulanK8)
                        .on('input', checkPanjang);
                }

                // =============================================
                // 6. FUNGSI TOGGLE PENGUJIAN ELEKTRIK
                // =============================================
                function initTogglePengujianElektrik() {
                    function toggleSection() {
                        const jenisCable = elements.jenisConductor.val();
                        const isVisible = (jenisCable === 'AAAC-S' || jenisCable === 'CCSXT');

                        elements.pengujianElektrikSection.toggle(isVisible);
                        elements.pengujianElektrikContent.toggle(isVisible);
                    }

                    elements.jenisConductor.on('change', toggleSection);
                    toggleSection(); // Panggil sekali saat inisialisasi
                }

                // =============================================
                // 7. FUNGSI UPDATE KESIMPULAN
                // =============================================
                function initUpdateKesimpulan() {
                    function updateKesimpulan() {
                        const tahunPemasangan = parseInt(elements.selectTahun.val()) || 0;
                        const pemeriksaanVisual = elements.nilaiPemeriksaanVisual.val();
                        const pengujianDimensi = parseFloat(elements.diameterKonduktor.val()) || 0;
                        const ujiKesalahan = parseFloat(elements.nilaiUjiTahanan.val()) || 0;

                        const umurMaterial = config.tahunSekarang - tahunPemasangan;
                        const dimensiValid = pengujianDimensi >= 0.495 && pengujianDimensi <= 16.16;

                        const jenisCable = elements.jenisConductor.val();
                        const elektrikValid = (jenisCable === 'AAAC-S' || jenisCable === 'CCSXT') ?
                            ujiKesalahan > 0 : true;

                        if (umurMaterial < 40 && pemeriksaanVisual === 'Baik' && dimensiValid &&
                            elektrikValid) {
                            elements.kesimpulanDropdown.val('Bekas layak pakai (K6)');
                        } else {
                            elements.kesimpulanDropdown.val('Bekas tidak layak pakai (K8)');
                        }
                    }

                    elements.formInspeksi.find('select, input').on('change', updateKesimpulan);
                }

                // =============================================
                // 8. INISIALISASI AWAL
                // =============================================
                function initialize() {
                    // Set tanggal hari ini
                    elements.tglInspeksi.val(new Date().toISOString().split('T')[0]);

                    // Inisialisasi semua komponen
                    initSelectTahun();
                    initSelectConductor();
                    initValidasiDimensi();
                    initValidasiPanjang();
                    initTogglePengujianElektrik();
                    initUpdateKesimpulan();

                    // Hitung masa pakai awal
                    hitungMasaPakai();

                    logDebug('System initialized successfully');
                }

                // =============================================
                // 9. HELPER FUNCTIONS
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
                // 10. START APPLICATION
                // =============================================
                setTimeout(initialize, 100);

            })(jQuery);

            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "extendedTimeOut": "3000",
                // "onShown": function() {
                //     // Setelah toast muncul, submit form
                //     document.getElementById('formInspeksi').submit();
                // }
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
@endif
<x-layouts.footer />
