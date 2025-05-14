<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur Kotak APP</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi" action="{{ route('form-retur-kotak-app.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="3">
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
                                    <select name="ulp_id" class="form-control" id="ulp_id" required>
                                        <option value="">-- Pilih ULP --</option>
                                    </select>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-1/2">
                                        <label for="tahun_produksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            name="tahun_produksi" id="tahun_produksi" required>
                                            <option value="">-- Pilih Tahun --</option>
                                        </select>
                                    </div>
                                    <div class="w-1/2">
                                        <label class="block mb-1" for="masa_pakai">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masa_pakai" name="masa_pakai"
                                            placeholder="Tahun Sekarang - Tahun Produksi" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_kotak">Tipe Kotak APP</label>
                                    <select class="form-control" id="tipe_kotak" name="tipe_kotak" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="Pemasangan di Dinding">Pemasangan di Dinding</option>
                                        <option value="Pemasangan di Tiang">Pemasangan di Tiang</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input name="no_serial" type="number" class="form-control" id="no_serial"
                                        placeholder="Masukkan No Serial">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <select name="pabrikan_id" class="form-control" id="pabrikan_id" required>
                                        <option value="">-- Pilih Pabrikan --</option>
                                        @foreach ($pabrikans as $pabrikan)
                                            <option value="{{ $pabrikan->id }}">{{ $pabrikan->nama_pabrikan }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="pabrikan">Nama Pabrikan</label>
                                    <select name="pabrikan" class="form-control select2-app" id="pabrikan" required>
                                        <option value="">-- Pilih Pabrikan --</option>
                                        @foreach ($existingPabrikans as $pabrikan)
                                            <option value="{{ $pabrikan }}"
                                                {{ old('pabrikan') == $pabrikan ? 'selected' : '' }}>
                                                {{ $pabrikan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Visual</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nameplate">1. Nameplate <i>(Nama pabrikan, merek, SN, tipe, IPXX,
                                            tegangan dan arus
                                            pengenal,
                                            tahun pembuatan, dan standar)</i></label>
                                    <div class="input-group">
                                        <select class="form-control poin1" id="nameplate" name="nameplate" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNameplate')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNameplate" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganNameplate">Keterangan Nameplate:</label>
                                        <textarea class="form-control" id="keteranganNameplate" name="keteranganNameplate" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganNameplate', 'charCountKeteranganNameplate')"></textarea>
                                        <small id="charCountKeteranganNameplate" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_selungkup">2. Kondisi selungkup dan pintu kotak APP <i>(+tutup
                                            gembok untuk tipe
                                            APP-PTL)
                                            tidak ada retak/longgar/karat/cacat lain</i></label>
                                    <div class="input-group">
                                        <select class="form-control poin2" id="kondisi_selungkup"
                                            name="kondisi_selungkup" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganSelungkup')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganSelungkup" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganSelungkup">Keterangan Selungkup:</label>
                                        <textarea class="form-control" id="keteranganSelungkup" name="keteranganSelungkup" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganSelungkup', 'charCountKeteranganSelungkup')"></textarea>
                                        <small id="charCountKeteranganSelungkup" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kunci_pengaman">3. Kunci Pengaman</label>
                                    <div class="input-group">
                                        <select class="form-control poin3" id="kunci_pengaman" name="kunci_pengaman"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKunciPengaman')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKunciPengaman" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganKunciPengaman">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keteranganKunciPengaman" name="keteranganKunciPengaman" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKunciPengaman', 'charCountKeteranganKunciPengaman')"></textarea>
                                        <small id="charCountKeteranganKunciPengaman" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ventilasi">4. Ventilasi</label>
                                    <div class="input-group">
                                        <select class="form-control poin4" id="ventilasi" name="ventilasi" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganVentilasi')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganVentilasi" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganVentilasi">Keterangan Ventilasi:</label>
                                        <textarea class="form-control" id="keteranganVentilasi" name="keteranganVentilasi" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganVentilasi', 'charCountKeteranganVentilasi')"></textarea>
                                        <small id="charCountKeteranganVentilasi" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jendela_kaca">5. Jendela Kaca</label>
                                    <div class="input-group">
                                        <select class="form-control poin5" id="jendela_kaca" name="jendela_kaca"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganJendelaKaca')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganJendelaKaca" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganJendelaKaca">Keterangan Jendela Kaca:</label>
                                        <textarea class="form-control" id="keteranganJendelaKaca" name="keteranganJendelaKaca" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganJendelaKaca', 'charCountJendelaKaca')"></textarea>
                                        <small id="charCountJendelaKaca" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kuping_pemasang">6. Kuping Pemasang</label>
                                    <div class="input-group">
                                        <select class="form-control poin6" id="kuping_pemasang"
                                            name="kuping_pemasang" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKupingPemasang')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKupingPemasang" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganKupingPemasang">Keterangan Kuping Pemasang:</label>
                                        <textarea class="form-control" id="keteranganKupingPemasang" name="keteranganKupingPemasang" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKupingPemasang', 'charCountKeteranganKupingPemasang')"></textarea>
                                        <small id="charCountKeteranganKupingPemasang" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="seal">7. Seal</label>
                                    <div class="input-group">
                                        <select class="form-control poin7" id="seal" name="seal" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganSeal')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganSeal" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganSeal">Keterangan Seal:</label>
                                        <textarea class="form-control" id="keteranganSeal" name="keteranganSeal" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganSeal', 'charCountKeteranganSeal')"></textarea>
                                        <small id="charCountKeteranganSeal" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="logo_peringatan">8. Logo PLN dan tanda peringatan bahaya</label>
                                    <div class="input-group">
                                        <select class="form-control poin8" id="logo_peringatan"
                                            name="logo_peringatan" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganLogoPeringatan')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganLogoPeringatan" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganLogoPeringatan">Keterangan Logo:</label>
                                        <textarea class="form-control" id="keteranganLogoPeringatan" name="keteranganLogoPeringatan" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganLogoPeringatan', 'charCountKeteranganLogoPeringatan')"></textarea>
                                        <small id="charCountKeteranganLogoPeringatan" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kotak_kontak">9. Kotak Kontak</label>
                                    <div class="input-group">
                                        <select class="form-control poin9" id="kotak_kontak" name="kotak_kontak"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganKotakKontak')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganKotakKontak" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganKotakKontak">Keterangan Kotak Kontak:</label>
                                        <textarea class="form-control" id="keteranganKotakKontak" name="keteranganKotakKontak" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganKotakKontak', 'charCountKeteranganKotakKontak')"></textarea>
                                        <small id="charCountKeteranganKotakKontak" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="papan_montase">10. Papan montase</label>
                                    <div class="input-group">
                                        <select class="form-control poin10" id="papan_montase" name="papan_montase"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganPapanMontase')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganPapanMontase" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganPapanMontase">Keterangan Papan Montase:</label>
                                        <textarea class="form-control" id="keteranganPapanMontase" name="keteranganPapanMontase" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganPapanMontase', 'charCountKeteranganPapanMontase')"></textarea>
                                        <small id="charCountKeteranganPapanMontase" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rangka_jendela">11. Rangka dan Jendela MCB/MCCB (APP-PL-CB dan
                                        APP-PTL)</label>
                                    <div class="input-group">
                                        <select class="form-control poin11" id="rangka_jendela" name="rangka_jendela"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganRangkaJendela')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganRangkaJendela" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganRangkaJendela">Keterangan Rangka Jendela:</label>
                                        <textarea class="form-control" id="keteranganRangkaJendela" name="keteranganRangkaJendela" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganRangkaJendela', 'charCountKeteranganRangkaJendela')"></textarea>
                                        <small id="charCountKeteranganRangkaJendela" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rel_mcb">12. Rel MCB Tipe DIN Rail (APP-PL-CB dan APP-PTL)</label>
                                    <div class="input-group">
                                        <select class="form-control poin12" id="rel_mcb" name="rel_mcb" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganRelMCB')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganRelMCB" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganRelMCB">Keterangan Rel MCB:</label>
                                        <textarea class="form-control" id="keteranganRelMCB" name="keteranganRelMCB" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganRelMCB', 'charCountKeteranganRelMCB')"></textarea>
                                        <small id="charCountKeteranganRelMCB" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lubang_kabel">13. Lubang Kabel Dilengkapi Cable Gland</label>
                                    <div class="input-group">
                                        <select class="form-control poin13" id="lubang_kabel" name="lubang_kabel"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganLubangKabel')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganLubangKabel" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganLubangKabel">Keterangan Lubang Kabel:</label>
                                        <textarea class="form-control" id="keteranganLubangKabel" name="keteranganLubangKabel" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganLubangKabel', 'charCountKeteranganLubangKabel')"></textarea>
                                        <small id="charCountKeteranganLubangKabel" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="busbar_fasa">14. Busbar Fasa R S T (APP-PTL)</label>
                                    <div class="input-group">
                                        <select class="form-control poin14" id="busbar_fasa" name="busbar_fasa"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganBusbarFasa')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganBusbarFasa" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganBusbarFasa">Keterangan Busbar Fasa:</label>
                                        <textarea class="form-control" id="keteranganBusbarFasa" name="keteranganBusbarFasa" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganBusbarFasa', 'charCountKeteranganBusbarFasa')"></textarea>
                                        <small id="charCountKeteranganBusbarFasa" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="busbar_netral">15. Busbar Netral (APP-PTL-CB dan APP-PTL)</label>
                                    <div class="input-group">
                                        <select class="form-control poin15" id="busbar_netral" name="busbar_netral"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganBusbarNetral')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganBusbarNetral" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganBusbarNetral">Keterangan Busbar Netral:</label>
                                        <textarea class="form-control" id="keteranganBusbarNetral" name="keteranganBusbarNetral" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganBusbarNetral', 'charCountKeteranganBusbarNetral')"></textarea>
                                        <small id="charCountKeteranganBusbarNetral" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="insulator_busbar">16. Insulator Busbar (APP-PL-CB dan APP-PTL)</label>
                                    <div class="input-group">
                                        <select class="form-control poin16" id="insulator_busbar"
                                            name="insulator_busbar" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganInsulatorBusbar')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganInsulatorBusbar" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganInsulatorBusbar">Keterangan Insulator Busbar:</label>
                                        <textarea class="form-control" id="keteranganInsulatorBusbar" name="keteranganInsulatorBusbar" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganInsulatorBusbar', 'charCountKeteranganInsulatorBusbar')"></textarea>
                                        <small id="charCountKeteranganInsulatorBusbar" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="indikator_shunt">17. Indikator Shunt Trip (APP-PTL)</label>
                                    <div class="input-group">
                                        <select class="form-control poin17" id="indikator_shunt"
                                            name="indikator_shunt" required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganIndikatorShunt')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganIndikatorShunt" class="form-group mt-2"
                                        style="display: none;">
                                        <label for="keteranganIndikatorShunt">Keterangan Indikator:</label>
                                        <textarea class="form-control" id="keteranganIndikatorShunt" name="keteranganIndikatorShunt" rows="2"
                                            maxlength="55" placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganIndikatorShunt', 'charCountKeteranganIndikatorShunt')"></textarea>
                                        <small id="charCountKeteranganIndikatorShunt" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="saku_modem">18. Saku Modem, Lubang Modem dan Topi Pelindung
                                        Antena</label>
                                    <div class="input-group">
                                        <select class="form-control poin18" id="saku_modem" name="saku_modem"
                                            required>
                                            <option value="">-- Hasil Pemeriksaan --</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganSakuModem')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganSakuModem" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganSakuModem">Keterangan Saku Modem, Lubang Modem dan Topi
                                            Pelindung Antena:</label>
                                        <textarea class="form-control" id="keteranganSakuModem" name="keteranganSakuModem" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..."
                                            oninput="updateCharCount('keteranganSakuModem', 'charCountKeteranganSakuModem')"></textarea>
                                        <small id="charCountKeteranganSakuModem" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm-left mb-3">Keterangan:
                                <br> a. Poin 1 dan 18 bila terdapat cacat dapat diperbaiki atau dilengkapi, poin yang
                                lainnya adalah mandatory (tidak boleh diperbaiki)
                                <br> b. Fungsi MCB/MCCB dan meter pada kotak APP diperiksa berdasarkan FORMULIR INSPEKSI
                                Material MDU MCB dan Meter
                            </p>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">C. Uji Elektrik</h6>
                        <h7 class="mb-3">Pengujian Tahanan Isolasi:</h7>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l1_app">L1 - (L2+L3+N+body) </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control poinC1" id="l1_app"
                                            name="l1_app" placeholder="Inputkan Nilai" min="0"
                                            step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL1APP')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL1APP" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL1APP">Keterangan Pengujian L1:</label>
                                        <textarea class="form-control" id="keteranganL1APP" name="keteranganL1APP" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL1APP', 'charCountKeteranganL1APP')"></textarea>
                                        <small id="charCountKeteranganL1APP" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="l2_app">L2 - (L1+L3+N+body)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control poinC2" id="l2_app"
                                            name="l2_app" placeholder="Inputkan Nilai" min="0"
                                            step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL2APP')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL2APP" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL2APP">Keterangan Pengujian L2:</label>
                                        <textarea class="form-control" id="keteranganL2APP" name="keteranganL2APP" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL2APP', 'charCountKeteranganL2APP')"></textarea>
                                        <small id="charCountKeteranganL2APP" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l3_app">L3 - (L1+L2+N+body)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control poinC3" id="l3_app"
                                            name="l3_app" placeholder="Inputkan Nilai" min="0"
                                            step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganL3APP')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganL3APP" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganL3APP">Keterangan Pengujian L3:</label>
                                        <textarea class="form-control" id="keteranganL3APP" name="keteranganL3APP" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganL3APP', 'charCountKeteranganL3APP')"></textarea>
                                        <small id="charCountKeteranganL3APP" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="n_app">N - (L1+L2+L3+body)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control poinC4" id="n_app"
                                            name="n_app" placeholder="Inputkan Nilai" min="0"
                                            step="0.01" title="Currency" pattern="^\d+(?:\,\d{1,2})?$"
                                            onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNAPP')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNAPP" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganNAPP">Keterangan Pengujian N:</label>
                                        <textarea class="form-control" id="keteranganNAPP" name="keteranganNAPP" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganNAPP', 'charCountKeteranganNAPP')"></textarea>
                                        <small id="charCountKeteranganNAPP" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3 font-weight-bold">D. Uji Mekanik</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujian_mekanik">Buka tutup pintu kotak APP 5x </label>
                                    <div class="input-group">
                                        <select class="form-control poinD" id="pengujian_mekanik"
                                            name="pengujian_mekanik" required>
                                            <option value="">-- Hasil Pengujian --</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Tidak baik">Tidak baik</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganMekanik')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganMekanik" class="form-group mt-2" style="display: none;">
                                        <label for="keteranganMekanik">Keterangan Pengujian Mekanik:</label>
                                        <textarea class="form-control" id="keteranganMekanik" name="keteranganMekanik" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('keteranganMekanik', 'charCountKeteranganMekanik')"></textarea>
                                        <small id="charCountKeteranganMekanik" class="text-muted">55 karakter
                                            tersisa.</small>
                                    </div>
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

        // Generate tahun dari 1980 hingga tahun sekarang
        for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }

        jQuery.noConflict();
        jQuery(document).ready(function($) {
            // Inisialisasi Select2 dengan auto-formatting
            $('#pabrikan').select2({
                tags: true,
                width: '100%',
                dropdownParent: $('#pabrikan').parent(),
                createTag: function(params) {
                    // Format capitalize each word
                    const formattedText = params.term
                        .toLowerCase()
                        .split(' ')
                        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                        .join(' ');

                    // Cek jika sudah ada di dropdown
                    if ($('#pabrikan').find(`option[value="${formattedText}"]`).length) {
                        return null; // Tidak buat tag baru jika sudah ada
                    }

                    return {
                        id: formattedText,
                        text: formattedText,
                        newTag: true
                    };
                }
            });

            // Ambil daftar pabrikan yang sudah ada dari database
            function loadExistingPabrikans() {
                $.ajax({
                    url: '/form-retur-kotak-app/pabrikans',
                    method: 'GET',
                    success: function(data) {
                        // Tambahkan opsi yang sudah ada
                        data.forEach(function(pabrikan) {
                            if (!$('#pabrikan').find(`option[value="${pabrikan}"]`)
                                .length) {
                                $('#pabrikan').append(new Option(pabrikan,
                                    pabrikan));
                            }
                        });
                    }
                });
            }

            // Panggil saat select2 dibuka
            $('#pabrikan').on('select2:open', function() {
                loadExistingPabrikans();
            });
        });

        // Inisialisasi Select2 menggunakan jQuery
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $(selectTahun).select2();

            // Event listener untuk Select2
            $(selectTahun).on('change', function() {
                hitungMasaPakai();
            });
        });

        // Hitung masa pakai
        function hitungMasaPakai() {
            const tahunProduksi = parseInt(selectTahun.value); // Menggunakan .value dari JavaScript
            if (!isNaN(tahunProduksi)) {
                const masaPakai = tahunSekarang - tahunProduksi;
                inputMasaPakai.value = masaPakai + " tahun";
                updateKesimpulan();
            } else {
                inputMasaPakai.value = ""; // Kosongkan jika tahun tidak valid
            }
        }

        // Update kesimpulan
        function updateKesimpulan() {
            const masaPakai = parseInt(inputMasaPakai.value) || 0;

            // Ambil nilai dari poin B (Pemeriksaan Visual)
            const poin1 = document.querySelector(".poin1").value; // Nameplate
            const poin2 = document.querySelector(".poin2").value; // Kondisi selungkup dan pintu
            const poin3 = document.querySelector(".poin3").value; // Kunci pengaman
            const poin4 = document.querySelector(".poin4").value; // Ventilasi
            const poin5 = document.querySelector(".poin5").value; // Jendela kaca
            const poin6 = document.querySelector(".poin6").value; // Kuping pemasang
            const poin7 = document.querySelector(".poin7").value; // Seal
            const poin8 = document.querySelector(".poin8").value; // Logo PLN dan tanda peringatan
            const poin9 = document.querySelector(".poin9").value; // Kotak kontak
            const poin10 = document.querySelector(".poin10").value; // Papan montase
            const poin11 = document.querySelector(".poin11").value; // Rangka dan jendela MCB/MCCB
            const poin12 = document.querySelector(".poin12").value; // Rel MCB tipe DIN rail
            const poin13 = document.querySelector(".poin13").value; // Lubang kabel
            const poin14 = document.querySelector(".poin14").value; // Busbar Fasa R S T
            const poin15 = document.querySelector(".poin15").value; // Busbar Netral
            const poin16 = document.querySelector(".poin16").value; // Insulator Busbar
            const poin17 = document.querySelector(".poin17").value; // Indikator shunt trip
            const poin18 = document.querySelector(".poin18").value; // Saku modem dan antena

            // Ambil nilai dari poin C (Uji Elektrik) sebagai angka
            const poinC1 = parseFloat(document.querySelector(".poinC1").value) || 0; // L1 - (L2+L3+N+body)
            const poinC2 = parseFloat(document.querySelector(".poinC2").value) || 0; // L2 - (L1+L3+N+body)
            const poinC3 = parseFloat(document.querySelector(".poinC3").value) || 0; // L3 - (L1+L2+N+body)
            const poinC4 = parseFloat(document.querySelector(".poinC4").value) || 0; // N - (L1+L2+L3+body)

            // Ambil nilai dari poin D (Uji Mekanik)
            const poinD = document.querySelector(".poinD").value; // Buka tutup pintu kotak APP 5x

            // Variabel untuk menyimpan kesimpulan
            let kesimpulan = "Bekas tidak layak pakai (K8)";

            // Logika pengambilan kesimpulan
            if (masaPakai <= 40) {
                // Jika masa pakai <= 40 tahun
                if (
                    poin1 === "Ada" && poin2 === "Tidak ada" && poin3 === "Ada" && poin4 === "Ada" &&
                    poin5 === "Ada" && poin6 === "Ada" && poin7 === "Ada" && poin8 === "Ada" &&
                    poin9 === "Ada" && poin10 === "Ada" && poin11 === "Ada" && poin12 === "Ada" &&
                    poin13 === "Ada" && poin14 === "Ada" && poin15 === "Ada" && poin16 === "Ada" &&
                    poin17 === "Ada" && poin18 === "Ada" &&
                    poinC1 > 1 && poinC2 > 1 && poinC3 > 1 && poinC4 > 1 && // Poin C harus > 1
                    poinD === "Baik"
                ) {
                    kesimpulan = "Bekas layak pakai (K6)";
                } else if (
                    poin1 === "Tidak ada" || poin2 === "Ada" || poin3 === "Tidak ada" || poin4 ===
                    "Tidak ada" ||
                    poin5 === "Tidak ada" || poin6 === "Tidak ada" || poin7 === "Tidak ada" || poin8 ===
                    "Tidak ada" ||
                    poin9 === "Tidak ada" || poin10 === "Tidak ada" || poin11 === "Tidak ada" || poin12 ===
                    "Tidak ada" ||
                    poin13 === "Tidak ada" || poin14 === "Tidak ada" || poin15 === "Tidak ada" || poin16 ===
                    "Tidak ada" ||
                    poin17 === "Tidak ada" || poin18 === "Tidak ada" ||
                    poinC1 < 1 || poinC2 < 1 || poinC3 < 1 || poinC4 < 1 || // Poin C harus > 1
                    poinD === "Tidak baik"
                ) {
                    kesimpulan = "Bekas bisa diperbaiki (K7)";
                } else kesimpulan = "Bekas tidak layak pakai (K8)"
            } else kesimpulan = "Bekas tidak layak pakai (K8)"
            // Set nilai kesimpulan di dropdown
            document.getElementById("kesimpulan").value = kesimpulan;
        }

        // Event listeners untuk semua poin
        document.querySelectorAll(
            ".poin1, .poin2, .poin3, .poin4, .poin5, .poin6, .poin7, .poin8, .poin9, .poin10, .poin11, .poin12, .poin13, .poin14, .poin15, .poin16, .poin17, .poin18, .poinC1, .poinC2, .poinC3, .poinC4, .poinD"
        ).forEach(el => {
            el.addEventListener("change", () => {
                updateKesimpulan();
            });
        });

        // Inisialisasi
        hitungMasaPakai();
        updateKesimpulan();
    });
</script>

<x-layouts.footer />
