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
                    <form id="formInspeksi" action="{{ route('form-retur-tiang-listrik.update', $tiang_listrik->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="15">
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
                                    <label for="tgl_inspeksi">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl_inspeksi" name="tgl_inspeksi"
                                        value="{{ old('tgl_inspeksi', $tiang_listrik->tgl_inspeksi) }}" required
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
                                        name="lokasi_akhir_terpasang" placeholder="Masukkan Alamat"
                                        value="{{ old('lokasi_akhir_terpasang', $tiang_listrik->lokasi_akhir_terpasang) }}"
                                        required>
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
                                <div class="d-flex gap-4 form-group">
                                    <div class="w-50">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2" id="tahun_produksi" name="tahun_produksi"
                                            required>
                                            <option value="">-- Pilih Tahun --</option>
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('tahun_produksi', $selectedTahunProduksi ?? null) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="masa_pakai" class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control" id="masa_pakai" name="masa_pakai"
                                            placeholder="Masa Pakai"
                                            value="{{ old('masa_pakai', $tiang_listrik->masa_pakai) }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="grid grid-cols-2 gap-4 items-center">
                                        <!-- Input Text untuk Tipe Tiang -->
                                        <div class="flex flex-col">
                                            <label for="tipe_tiang_listrik" class="mb-1 tahun_pemasangan">Tipe Tiang
                                                Listrik</label>
                                            <select
                                                class="form-control w-full rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                name="tipe_tiang_listrik" id="tipe_tiang_listrik" required>
                                                <option value="">-- Pilih Tipe Tiang --</option>
                                                <option value="Baja"
                                                    {{ old('tipe_tiang_listrik', $tiang_listrik->tipe_tiang_listrik) == 'Baja' ? 'selected' : '' }}>
                                                    Baja</option>
                                                <option value="Beton"
                                                    {{ old('tipe_tiang_listrik', $tiang_listrik->tipe_tiang_listrik) == 'Beton' ? 'selected' : '' }}>
                                                    Beton</option>
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
                                                <option value="9/100"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '9/100' ? 'selected' : '' }}>
                                                    9/100</option>
                                                <option value="9/200"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '9/200' ? 'selected' : '' }}>
                                                    9/200</option>
                                                <option value="9/350"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '9/350' ? 'selected' : '' }}>
                                                    9/350</option>
                                                <option value="11/200"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '11/200' ? 'selected' : '' }}>
                                                    11/200</option>
                                                <option value="11/350"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '11/350' ? 'selected' : '' }}>
                                                    11/350</option>
                                                <option value="11/500"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '11/500' ? 'selected' : '' }}>
                                                    11/500</option>
                                                <option value="12/200"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '12/200' ? 'selected' : '' }}>
                                                    12/200</option>
                                                <option value="12/350"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '12/350' ? 'selected' : '' }}>
                                                    12/350</option>
                                                <option value="12/500"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '12/500' ? 'selected' : '' }}>
                                                    12/500</option>
                                                <option value="12/800"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '12/800' ? 'selected' : '' }}>
                                                    12/800</option>
                                                <option value="12/1200"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '12/1200' ? 'selected' : '' }}>
                                                    12/1200</option>
                                                <option value="13/200"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '13/200' ? 'selected' : '' }}>
                                                    13/200</option>
                                                <option value="13/350"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '13/350' ? 'selected' : '' }}>
                                                    13/350</option>
                                                <option value="13/500"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '13/500' ? 'selected' : '' }}>
                                                    13/500</option>
                                                <option value="13/800"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '13/800' ? 'selected' : '' }}>
                                                    13/800</option>
                                                <option value="14/200"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '14/200' ? 'selected' : '' }}>
                                                    14/200</option>
                                                <option value="14/350"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '14/350' ? 'selected' : '' }}>
                                                    14/350</option>
                                                <option value="14/500"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '14/500' ? 'selected' : '' }}>
                                                    14/500</option>
                                                <option value="14/800"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '14/800' ? 'selected' : '' }}>
                                                    14/800</option>
                                                <option value="14/1200"
                                                    {{ old('jenis_tiang', $tiang_listrik->jenis_tiang) == '14/1200' ? 'selected' : '' }}>
                                                    14/1200</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="number" class="form-control" id="no_serial" name="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $tiang_listrik->no_serial) }}" required>
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
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">B. Pengujian Visual</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="pengujian_visual">1. Pengujian Visual / Sifat Tampak <i>(Jika Tiang
                                            Baja
                                            terdapat karatan ringan tanpa keropos, maka dapat diperbaiki (cat
                                            ulang))</i>
                                    </label>
                                    <select class="form-control" id="pengujian_visual" name="pengujian_visual"
                                        required>
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="Baik"
                                            {{ old('pengujian_visual', $tiang_listrik->pengujian_visual) == 'Baik' ? 'selected' : '' }}>
                                            Baik</option>
                                        <option value="Rusak"
                                            {{ old('pengujian_visual', $tiang_listrik->pengujian_visual) == 'Rusak' ? 'selected' : '' }}>
                                            Rusak</option>
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
                                            ada di
                                            penandaan tiang)</i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="pengujian_panjang"
                                            name="pengujian_panjang" list="panjang-options"
                                            placeholder="Pilih atau masukkan panjang"
                                            value="{{ old('pengujian_panjang', $tiang_listrik->pengujian_panjang) }}"
                                            required>
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
                                    <label for="kelurusan_tiang">1. Kelurusan Tiang</label>
                                    <div class="input-group">
                                        <select class="form-control" id="kelurusan_tiang" name="kelurusan_tiang"
                                            required>
                                            <option value="">-- Hasil Pengujian --</option>
                                            <option value="Baik"
                                                {{ old('kelurusan_tiang', $tiang_listrik->kelurusan_tiang) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kelurusan_tiang', $tiang_listrik->kelurusan_tiang) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
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
                                            oninput="updateCharCount('keterangan_kelurusan_tiang', 'charCountKelurusanTiang')">{{ old('keterangan_kelurusan_tiang', $tiang_listrik->keterangan_kelurusan_tiang) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="kualitasPenyambungContainer">
                                <div class="form-group">
                                    <label for="kualitas_penyambungan">2. Kualitas Penyambung <i>(untuk tiang listrik
                                            baja)</i></label>
                                    <select class="form-control" id="kualitas_penyambungan"
                                        name="kualitas_penyambungan">
                                        <option value="">-- Hasil Pengujian --</option>
                                        <option value="Baik"
                                            {{ old('kualitas_penyambungan', $tiang_listrik->kualitas_penyambungan) == 'Baik' ? 'selected' : '' }}>
                                            Baik</option>
                                        <option value="Rusak"
                                            {{ old('kualitas_penyambungan', $tiang_listrik->kualitas_penyambungan) == 'Rusak' ? 'selected' : '' }}>
                                            Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">E. Kesimpulan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan">Kesimpulan</label>
                                    <select class="form-control" id="kesimpulan" name="kesimpulan" required
                                        @if (auth()->user()->hasRole('Petugas')) readonly @endif>
                                        <option value="">-- Pilih Kesimpulan --</option>
                                        <option value="Bekas layak pakai (K6)"
                                            {{ old('kesimpulan', $tiang_listrik->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                            Bekas layak pakai (K6)</option>
                                        <option value="Bekas bisa diperbaiki (K7)"
                                            {{ old('kesimpulan', $tiang_listrik->kesimpulan) == 'Bekas bisa diperbaiki (K7)' ? 'selected' : '' }}>
                                            Bekas bisa diperbaiki (K7)</option>
                                        <option value="Bekas tidak layak pakai (K8)"
                                            {{ old('kesimpulan', $tiang_listrik->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                            Bekas tidak layak pakai (K8)
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">F. Gambar Evidence</h6>
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
                                                        alt="Gambar Evidence Tiang Listrik {{ $key + 1 }}"
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
                                                        alt="Gambar Evidence Tiang Listrik {{ $key + 1 }}"
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

<!-- Tambahkan script JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");

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

            // Set tanggal hari ini
            let today = new Date().toISOString().split('T')[0];
            document.getElementById("tgl_inspeksi").value = today;

            // Fungsi untuk mengatur tampilan kualitas penyambung
            function toggleKualitasPenyambung() {
                const tipeTiang = document.getElementById('tipe_tiang_listrik').value;
                const kualitasPenyambungContainer = document.getElementById('kualitasPenyambungContainer');
                const kualitasPenyambungSelect = document.getElementById('kualitas_penyambungan');

                if (tipeTiang === 'Beton') {
                    kualitasPenyambungContainer.style.display = 'none';
                    if (kualitasPenyambungSelect) kualitasPenyambungSelect.value = '';
                } else {
                    kualitasPenyambungContainer.style.display = 'block';
                }
            }

            // Panggil saat pertama kali load (untuk edit view)
            toggleKualitasPenyambung();

            // Event listener untuk perubahan tipe tiang
            document.getElementById('tipe_tiang_listrik').addEventListener('change', function() {
                toggleKualitasPenyambung();
                updateKesimpulan();
            });

            // Panggil fungsi updateKesimpulan saat halaman dimuat
            updateKesimpulan();

            // Event listener untuk update kesimpulan
            document.querySelectorAll('#formInspeksi select, #formInspeksi input').forEach(el => {
                el.addEventListener('change', updateKesimpulan);
            });

            // Event listener untuk tipe tiang
            document.getElementById('tipe_tiang_listrik').addEventListener('change', function() {
                const tipeTiang = this.value;
                const kualitasPenyambungContainer = document.getElementById('kualitasPenyambungContainer');

                if (tipeTiang === 'Beton') {
                    kualitasPenyambungContainer.style.display = 'none';
                } else {
                    kualitasPenyambungContainer.style.display = 'block';
                }
            });
        });

        function updateKesimpulan() {
            const tahunProduksi = parseInt(document.getElementById('tahun_produksi').value) || 0;
            const pengujianVisual = document.getElementById('pengujian_visual').value;
            const kelurusanTiang = document.getElementById('kelurusan_tiang').value;
            const kualitasPenyambung = document.getElementById('kualitas_penyambungan').value;
            const panjang = parseFloat(document.getElementById('pengujian_panjang').value) || 0;
            const kesimpulanDropdown = document.getElementById('kesimpulan');

            const umurMaterial = new Date().getFullYear() - tahunProduksi;
            let kesimpulan = '';

            // Validasi panjang
            const panjangValid = [7, 9, 11, 12, 14].includes(panjang);

            if (umurMaterial > 40) {
                kesimpulan = 'Bekas tidak layak pakai (K8)';
            } else {
                if (pengujianVisual === 'Baik' && kelurusanTiang === 'Baik' && panjangValid) {
                    kesimpulan = 'Bekas layak pakai (K6)';
                } else if (kelurusanTiang === 'Rusak' || kualitasPenyambung === 'Rusak') {
                    kesimpulan = 'Bekas tidak layak pakai (K8)';
                } else {
                    kesimpulan = 'Bekas bisa diperbaiki (K7)';
                }
            }

            kesimpulanDropdown.value = kesimpulan;

            // Jika role user adalah Petugas, set kesimpulan menjadi readonly
            if (@json(auth()->user()->hasRole('Petugas'))) {
                kesimpulanDropdown.setAttribute('readonly', true);
            }

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
        }
    </script>
@elseif (auth()->user()->hasRole('Petugas'))
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");

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

            // Set tanggal hari ini
            let today = new Date().toISOString().split('T')[0];
            document.getElementById("tgl_inspeksi").value = today;

            // Panggil fungsi updateKesimpulan saat halaman dimuat
            updateKesimpulan();

            // Event listener untuk update kesimpulan
            document.querySelectorAll('#formInspeksi select, #formInspeksi input').forEach(el => {
                el.addEventListener('change', updateKesimpulan);
            });

            // Event listener untuk tipe tiang
            document.getElementById('tipe_tiang_listrik').addEventListener('change', function() {
                const tipeTiang = this.value;
                const kualitasPenyambungContainer = document.getElementById('kualitasPenyambungContainer');

                if (tipeTiang === 'Beton') {
                    kualitasPenyambungContainer.style.display = 'none';
                } else {
                    kualitasPenyambungContainer.style.display = 'block';
                }
            });
        });

        function updateKesimpulan() {
            const tahunProduksi = parseInt(document.getElementById('tahun_produksi').value) || 0;
            const pengujianVisual = document.getElementById('pengujian_visual').value;
            const kelurusanTiang = document.getElementById('kelurusan_tiang').value;
            const kualitasPenyambung = document.getElementById('kualitas_penyambungan').value;
            const panjang = parseFloat(document.getElementById('pengujian_panjang').value) || 0;
            const kesimpulanDropdown = document.getElementById('kesimpulan');

            const umurMaterial = new Date().getFullYear() - tahunProduksi;
            let kesimpulan = '';

            // Validasi panjang
            const panjangValid = [7, 9, 11, 12, 14].includes(panjang);

            if (umurMaterial > 40) {
                kesimpulan = 'Bekas tidak layak pakai (K8)';
            } else {
                if (pengujianVisual === 'Baik' && kelurusanTiang === 'Baik' && panjangValid) {
                    kesimpulan = 'Bekas layak pakai (K6)';
                } else if (kelurusanTiang === 'Rusak' || kualitasPenyambung === 'Rusak') {
                    kesimpulan = 'Bekas tidak layak pakai (K8)';
                } else {
                    kesimpulan = 'Bekas bisa diperbaiki (K7)';
                }
            }

            kesimpulanDropdown.value = kesimpulan;

            // Jika role user adalah Petugas, set kesimpulan menjadi readonly
            if (@json(auth()->user()->hasRole('Petugas'))) {
                kesimpulanDropdown.setAttribute('readonly', true);
            }

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
        }
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tahunSekarang = new Date().getFullYear();
            const selectTahun = document.getElementById("tahun_produksi");
            const inputMasaPakai = document.getElementById("masa_pakai");

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

            // Set tanggal hari ini
            let today = new Date().toISOString().split('T')[0];
            document.getElementById("tgl_inspeksi").value = today;

            // Fungsi untuk mengatur tampilan kualitas penyambung
            function toggleKualitasPenyambung() {
                const tipeTiang = document.getElementById('tipe_tiang_listrik').value;
                const kualitasPenyambungContainer = document.getElementById('kualitasPenyambungContainer');
                const kualitasPenyambungSelect = document.getElementById('kualitas_penyambungan');

                if (tipeTiang === 'Beton') {
                    kualitasPenyambungContainer.style.display = 'none';
                    if (kualitasPenyambungSelect) kualitasPenyambungSelect.value = '';
                } else {
                    kualitasPenyambungContainer.style.display = 'block';
                }
            }

            // Panggil saat pertama kali load (untuk edit view)
            toggleKualitasPenyambung();

            // Event listener untuk perubahan tipe tiang
            document.getElementById('tipe_tiang_listrik').addEventListener('change', function() {
                toggleKualitasPenyambung();
                updateKesimpulan();
            });

            // Panggil fungsi updateKesimpulan saat halaman dimuat
            updateKesimpulan();

            // Event listener untuk update kesimpulan
            document.querySelectorAll('#formInspeksi select, #formInspeksi input').forEach(el => {
                el.addEventListener('change', updateKesimpulan);
            });

            // Event listener untuk tipe tiang
            document.getElementById('tipe_tiang_listrik').addEventListener('change', function() {
                const tipeTiang = this.value;
                const kualitasPenyambungContainer = document.getElementById('kualitasPenyambungContainer');

                if (tipeTiang === 'Beton') {
                    kualitasPenyambungContainer.style.display = 'none';
                } else {
                    kualitasPenyambungContainer.style.display = 'block';
                }
            });

            // Pindahkan event listener submit ke luar fungsi updateKesimpulan
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

        function updateKesimpulan() {
            const tahunProduksi = parseInt(document.getElementById('tahun_produksi').value) || 0;
            const pengujianVisual = document.getElementById('pengujian_visual').value;
            const kelurusanTiang = document.getElementById('kelurusan_tiang').value;
            const kualitasPenyambung = document.getElementById('kualitas_penyambungan').value;
            const panjang = parseFloat(document.getElementById('pengujian_panjang').value) || 0;
            const kesimpulanDropdown = document.getElementById('kesimpulan');

            const umurMaterial = new Date().getFullYear() - tahunProduksi;
            let kesimpulan = '';

            // Validasi panjang
            const panjangValid = [7, 9, 11, 12, 14].includes(panjang);

            if (umurMaterial > 40) {
                kesimpulan = 'Bekas tidak layak pakai (K8)';
            } else {
                if (pengujianVisual === 'Baik' && kelurusanTiang === 'Baik' && panjangValid) {
                    kesimpulan = 'Bekas layak pakai (K6)';
                } else if (kelurusanTiang === 'Rusak' || kualitasPenyambung === 'Rusak') {
                    kesimpulan = 'Bekas tidak layak pakai (K8)';
                } else {
                    kesimpulan = 'Bekas bisa diperbaiki (K7)';
                }
            }

            kesimpulanDropdown.value = kesimpulan;

            // Jika role user adalah Petugas, set kesimpulan menjadi readonly
            if (@json(auth()->user()->hasRole('Petugas'))) {
                kesimpulanDropdown.setAttribute('readonly', true);
            }
        }
    </script>
@endif
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<x-layouts.footer />
