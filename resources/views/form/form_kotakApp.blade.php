<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><strong>Formulir Inspeksi Material Retur Kotak APP</strong></h5>
                    <hr class="mb-3">
                    <form id="formInspeksi">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Unit">Unit</label>
                                    <select class="form-control" id="unit" required>
                                        <option value="">Pilih Unit</option>
                                        <option>Unit1</option>
                                        <option>Unit2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gudangRetur">Gudang Retur</label>
                                    <select class="form-control" id="gudangRetur" required>
                                        <option value="">Pilih gudang</option>
                                        <option>Gudang1</option>
                                        <option>Gudang2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggalHariIni">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggalHariIni" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3"><strong>A. Data Material</strong></h6>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi Akhir Terpasang</label>
                                    <input type="text" class="form-control" id="lokasi"
                                        placeholder="Masukkan Lokasi akhir terpasang" required>
                                </div>
                                <div class="form-group">
                                    <label for="unitLayanan">Unit Layanan Pelanggan</label>
                                    <select class="form-control" required>
                                        <option value="">Pilih Unit</option>
                                        <option>Unit1</option>
                                        <option>Unit2</option>
                                    </select>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-1/2">
                                        <label for="tahunProduksi" class="block mb-1">Tahun Produksi</label>
                                        <select class="form-control select2 w-full p-2 border rounded"
                                            id="tahunProduksi" required>
                                            <option value="">Pilih Tahun</option>
                                        </select>
                                    </div>
                                    <div class="w-1/2">
                                        <label class="block mb-1">Masa Pakai</label>
                                        <input type="text" class="form-control w-full p-2 border rounded"
                                            id="masaPakai" placeholder="Masa Pakai" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipeKotak">Tipe Kotak APP</label>
                                    <select class="form-control" required>
                                        <option value="">Pilih Tipe</option>
                                        <option>Tipe1</option>
                                        <option>Tipe2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="noSerial">No Serial</label>
                                    <input type="text" class="form-control" id="noSerial"
                                        placeholder="Masukkan No Serial" required>
                                </div>
                                <div class="form-group">
                                    <label for="namaPabrikan">Nama Pabrikan</label>
                                    <select class="form-control" required>
                                        <option value="">Pilih Pabrikan</option>
                                        <option>Pabrikan1</option>
                                        <option>Pabrikan2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3"><strong>B. Pemeriksaan Visual</strong></h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>1. Nameplate <i>(Nama pabrikan, merek, SN, Tipe, IPXX, tegangan dan arus
                                            pengenal,
                                            tahun pembuatan, dan standar)</i></label>
                                    <div class="input-group">
                                        <select class="form-control poin1" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('nameplate')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="nameplate" class="form-group mt-2" style="display: none;">
                                        <label for="nameplate">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="nameplate" name="nameplate" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('nameplate', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>2. Kondisi selungkup dan pintu kotak APP <i>(+tutup gembok untuk tipe
                                            APP-PTL)
                                            tidak ada retak/longgar/karat/cacat lain</i></label>
                                    <div class="input-group"><select class="form-control poin2" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('selungkup')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="selungkup" class="form-group mt-2" style="display: none;">
                                        <label for="selungkup">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="selungkup" name="selungkup" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('selungkup', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>3. Kunci pengaman</label>
                                    <div class="input-group"><select class="form-control poin3" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('kunci_pengaman')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="kunci_pengaman" class="form-group mt-2" style="display: none;">
                                        <label for="kunci_pengaman">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="kunci_pengaman" name="kunci_pengaman" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('kunci_pengaman', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>4. Ventilasi</label>
                                    <div class="input-group"><select class="form-control poin4" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('ventilasi')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="ventilasi" class="form-group mt-2" style="display: none;">
                                        <label for="ventilasi">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="ventilasi" name="ventilasi" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('ventilasi', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>5. Jendela Kaca</label>
                                    <div class="input-group"><select class="form-control poin5" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('jendela_kaca')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="jendela_kaca" class="form-group mt-2" style="display: none;">
                                        <label for="jendela_kaca">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="jendela_kaca" name="jendela_kaca" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('jendela_kaca', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>6. Kuping pemasang</label>
                                    <div class="input-group"><select class="form-control poin6" required>
                                            <option value="">Hasil Pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('kuping_pemasang')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="kuping_pemasang" class="form-group mt-2" style="display: none;">
                                        <label for="kuping_pemasang">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="kuping_pemasang" name="kuping_pemasang" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('kuping_pemasang', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>7. Seal</label>
                                    <div class="input-group"><select class="form-control poin7" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('seal')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="seal" class="form-group mt-2" style="display: none;">
                                        <label for="seal">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="seal" name="seal" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('seal', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>8. Logo PLN dan tanda peringatan bahaya</label>
                                    <div class="input-group"><select class="form-control poin8" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('logo_pln')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="logo_pln" class="form-group mt-2" style="display: none;">
                                        <label for="logo_pln">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="logo_pln" name="logo_pln" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('logo_pln', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>9. Kotak Kontak</label>
                                    <div class="input-group"><select class="form-control poin9" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('kotak_kontak')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="kotak_kontak" class="form-group mt-2" style="display: none;">
                                        <label for="kotak_kontak">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="kotak_kontak" name="kotak_kontak" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('kotak_kontak', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>10. Papan montase</label>
                                    <div class="input-group"><select class="form-control poin10" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('papan_montase')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="papan_montase" class="form-group mt-2" style="display: none;">
                                        <label for="papan_montase">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="papan_montase" name="papan_montase" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('papan_montase', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>11. Rangka dan jendela MCB/MCCB (APP-PL-CB dan APP-PTL)</label>
                                    <div class="input-group"><select class="form-control poin11" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('rangka_jendela')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="rangka_jendela" class="form-group mt-2" style="display: none;">
                                        <label for="rangka_jendela">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="rangka_jendela" name="rangka_jendela" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('rangka_jendela', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>12. Rel MCB tipe DIN rail (APP-PL-CB dan APP-PTL)</label>
                                    <div class="input-group"><select class="form-control poin12" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('rel_mcb')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="rel_mcb" class="form-group mt-2" style="display: none;">
                                        <label for="rel_mcb">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="rel_mcb" name="rel_mcb" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('rel_mcb', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>13. Lubang kabel dilengkapi cable gland</label>
                                    <div class="input-group"><select class="form-control poin13" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('lubang_kabel')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="lubang_kabel" class="form-group mt-2" style="display: none;">
                                        <label for="lubang_kabel">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="lubang_kabel" name="lubang_kabel" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('lubang_kabel', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>14. Busbar Fasa R S T (APP-PTL)</label>
                                    <div class="input-group"><select class="form-control poin14" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('busbar_fasa')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="busbar_fasa" class="form-group mt-2" style="display: none;">
                                        <label for="busbar_fasa">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="busbar_fasa" name="busbar_fasa" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('busbar_fasa', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>15. Busbar Netral (APP-PTL-CB dan APP-PTL)</label>
                                    <div class="input-group"><select class="form-control poin15" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('busbar_netral')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="busbar_netral" class="form-group mt-2" style="display: none;">
                                        <label for="busbar_netral">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="busbar_netral" name="busbar_netral" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('busbar_netral', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>16. Insulator Busbar (APP-PL-CB dan APP-PTL)</label>
                                    <div class="input-group"><select class="form-control poin16" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('insulator_busbar')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="insulator_busbar" class="form-group mt-2" style="display: none;">
                                        <label for="insulator_busbar">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="insulator_busbar" name="insulator_busbar" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('insulator_busbar', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>17. Indikator shunt trip (APP-PTL)</label>
                                    <div class="input-group"><select class="form-control poin17" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('shunt_trip')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="shunt_trip" class="form-group mt-2" style="display: none;">
                                        <label for="shunt_trip">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="shunt_trip" name="shunt_trip" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('shunt_trip', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>18. Saku modem, lubang modem dan topi pelindung antena</label>
                                    <div class="input-group"><select class="form-control poin18" required>
                                            <option value="">Hasil pemeriksaan</option>
                                            <option>Ada</option>
                                            <option>Tidak ada</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('saku_modem')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="saku_modem" class="form-group mt-2" style="display: none;">
                                        <label for="saku_modem">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="saku_modem" name="saku_modem" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('saku_modem', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
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
                        <h6 class="mb-3"><strong>C. Uji Elektrik</strong></h6>
                        <h7 class="mb-3">Pengujian tahanan isolasi:</h7>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>L1 - (L2+L3+N+body) </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control poinC1" id="poinC1"
                                            placeholder="Inputkan Nilai">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('c1')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="c1" class="form-group mt-2" style="display: none;">
                                        <label for="c1">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="c1" name="c1" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('c1', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>L2 - (L1+L3+N+body)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control poinC2" id="poinC1"
                                            placeholder="Inputkan Nilai">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('c2')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="c2" class="form-group mt-2" style="display: none;">
                                        <label for="c2">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="c2" name="c2" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('c2', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>L3 - (L1+L2+N+body) </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control poinC3" id="poinC1"
                                            placeholder="Inputkan Nilai">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('c3')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="c3" class="form-group mt-2" style="display: none;">
                                        <label for="c3">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="c3" name="c3" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('c3', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>N - (L1+L2+L3+body) </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control poinC4" id="poinC1"
                                            placeholder="Inputkan Nilai">
                                        <span class="input-group-text">MΩ</span>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('c4')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="c4" class="form-group mt-2" style="display: none;">
                                        <label for="c4">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="c4" name="c4" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('c4', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3"><strong>D. Uji Mekanik</strong></h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengujianMekanik">Buka tutup pintu kotak APP 5x </label>
                                    <div class="input-group"> <select class="form-control poinD" required>
                                            <option value="">Hasil Pengujian</option>
                                            <option>Baik</option>
                                            <option>Tidak baik</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('uji_mekanik')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="uji_mekanik" class="form-group mt-2" style="display: none;">
                                        <label for="uji_mekanik">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="uji_mekanik" name="uji_mekanik" rows="2" maxlength="55"
                                            placeholder="Masukkan keterangan..." oninput="updateCharCount('uji_mekanik', 'charCountTerminal')"></textarea>
                                        <small id="charCountTerminal" class="text-muted">55 karakter tersisa.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3"><strong>E. Kesimpulan</strong></h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan">Kesimpulan</label>
                                    <select class="form-control" id="kesimpulan" required>
                                        <option value="">Pilih Kesimpulan</option>
                                        <option>Bekas layak pakai (K6)</option>
                                        <option>Bekas bisa diperbaiki (K7)</option>
                                        <option>Bekas tidak layak pakai (K8)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3"><strong>F. Gambar Evidence</strong></h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar1" style="display: block">Gambar 1</label>
                                    <div id="preview1" class="image-preview mt-2"></div>
                                    <input type="file" name="gambar[0]" id="gambar1" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview1')"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="gambar2" style="display: block">Gambar 2</label>
                                    <div id="preview2" class="image-preview mt-2"></div>
                                    <input type="file" name="gambar[1]" id="gambar2" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview2')"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar3" style="display: block">Gambar 3</label>
                                    <div id="preview3" class="image-preview mt-2"></div>
                                    <input type="file" name="gambar[2]" id="gambar3" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview3')"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="gambar4" style="display: block">Gambar 4</label>
                                    <div id="preview4" class="image-preview mt-2"></div>
                                    <input type="file" name="gambar[3]" id="gambar4" accept="image/*"
                                        capture="camera" onchange="previewImage(this, 'preview4')"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Modal Bootstrap untuk menampilkan gambar lebih besar -->
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="" id="modalImage" class="img-fluid" alt="Gambar Preview">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tahunSekarang = new Date().getFullYear();
        const selectTahun = document.getElementById("tahunProduksi");
        const inputMasaPakai = document.getElementById("masaPakai");

        // Generate tahun dari 1980 hingga tahun sekarang
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
