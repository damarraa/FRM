<?php include 'components/Header.php'; ?>

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Form Elements</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Components</a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Elements</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Formulir Inspeksi Material Retur Trafo Distribusi</h5>
                    <hr class="mb-3">
                    <form id="formInspeksi">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Unit">Unit</label>
                                    <select class="form-control" required>
                                        <option value="">Pilih Unit</option>
                                        <option>Unit1</option>
                                        <option>Unit2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Unit">Gudang Retur</label>
                                    <select class="form-control" required>
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

                        <h6 class="mb-3">A. Data Material</h6>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasiTerpasang">Lokasi akhir terpasang</label>
                                    <input type="text" class="form-control" id="lokasiTerpasang"
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
                                <div class="form-group">
                                    <label for="tahunProduksi">Tahun produksi</label>
                                    <select class="form-control" id="tahunProduksi" required>
                                        <option value="">Pilih Tahun</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipeTrafo">Tipe Trafo Distribusi</label>
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
                                        <option>Pabrikan 1</option>
                                        <option>Pabrikan 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3">B. Pemeriksaan Visual</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Masa Pakai</label>
                                    <input type="text" class="form-control" id="masaPakai"
                                        placeholder="Tahun sekarang - Tahun produksi" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nameplate </label>
                                    <select class="form-control poin1" required>
                                        <option value="">Hasil Pemeriksaan</option>
                                        <option>Ada</option>
                                        <option>Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Penandaaan terminal primer dan sekunder </label>
                                    <select class="form-control poin2" required>
                                        <option value="">Hasil Pemeriksaan</option>
                                        <option>Ada</option>
                                        <option>Tidak ada</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pengaman tekanan lebih </label>
                                    <select class="form-control poin3" required>
                                        <option value="">Hasil Pemeriksaan</option>
                                        <option>Ada</option>
                                        <option>Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kondisi tangki (ada kebocoran/bengkak/cacat radiator(sirip)/seal top cover
                                        rembes)</label>
                                    <select class="form-control poin4" required>
                                        <option value="">Hasil Pemeriksaan</option>
                                        <option>Ada</option>
                                        <option>Tidak ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kondisi fisik bushing HV dan LV (ada retak/longgar dari tangki/seal bushing
                                        rembes)</label>
                                    <select class="form-control poin5" required>
                                        <option value="">Hasil Pemeriksaan</option>
                                        <option>Ada</option>
                                        <option>Tidak ada</option>
                                    </select>
                                </div>
                                <div class="kerusakan" style="display: none;">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                                                <label class="form-check-label" for="exampleCheck1">Rusak pada Fasa
                                                    R</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                                                <label class="form-check-label" for="exampleCheck1">Rusak pada Fasa
                                                    S</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                                                <label class="form-check-label" for="exampleCheck1">Rusak pada Fasa
                                                    T</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                                                <label class="form-check-label" for="exampleCheck1">Rusak pada N</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="sectionC" style="display: none;">
                            <hr class="mb-3">


                            <h6 class="mb-3">C. Pengujian Elektrik</h6>
                            <h6 class="mb-3">Pengujian tahana isolasi</h6>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hv-lv">HV - LV (M OHM)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="hv-lv"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text" id="basic-addon2">M OHM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hv-ground">HV - Ground (M OHM)</label>
                                        <div class="input-group"><input type="text" class="form-control" id="hv-ground"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text" id="basic-addon2">M OHM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lv-ground">LV - Ground (M OHM)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="lv-ground"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text" id="basic-addon2">M OHM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="mb-3">Rasio Belitan</h6>

                            <h7 class="mb-3">Tap 1</h7>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="1u-1v">1U-1V (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="1u-1v"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="1v-1w">1V-1W (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="1v-1w"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="1w-1u">1W-1U (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="1w-1u"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h7 class="mb-3">Tap 3</h7>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tap3-1u-1v">1U-1V (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tap3-1u-1v"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tap3-1v-1w">1V-1W (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tap3-1v-1w"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tap3-1w-1u">1W-1U (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tap3-1w-1u"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h7 class="mb-3">Tap 7</h7>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tap7-1u-1v">1U-1V (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tap7-1u-1v"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tap7-1v-1w">1V-1W (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tap7-1v-1w"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tap7-1w-1u">1W-1U (%)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tap7-1w-1u"
                                                placeholder="Hasil pengujian">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">


                        <h6 class="mb-3">D. Kesimpulan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesimpulan">Kesimpulan</label>
                                    <select id="kesimpulan" class="form-control">
                                        <option value="">Pilih Kesimpulan</option>
                                        <option value="Bekas layak pakai K6">Bekas layak pakai K6</option>
                                        <option value="Bekas bisa diperbaiki K7">Bekas bisa diperbaiki K7</option>
                                        <option value="Bekas tidak layak pakai K8">Bekas tidak layak pakai K8</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">

                        <h6 class="mb-3">E. Gambar Evidence</h6>
                        <div class="mb-4">
                            <label for="images" class="block text-gray-700 font-medium">Upload Gambar</label>
                            <input type="file" id="images" name="images[]" accept="image/*" multiple
                                class="w-full mt-2 p-2 border border-gray-300 rounded-lg" onchange="previewImages()">
                        </div>

                        <div id="preview-container" class="grid grid-cols-3 gap-2"></div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectTahun = document.getElementById("tahunProduksi");
        const inputMasaPakai = document.getElementById("masaPakai");
        const sectionC = document.querySelector(".sectionC");
        const kerusakan = document.querySelector(".kerusakan");

        const poin1 = document.querySelector(".poin1");
        const poin2 = document.querySelector(".poin2");
        const poin3 = document.querySelector(".poin3");
        const poin4 = document.querySelector(".poin4");
        const poin5 = document.querySelector(".poin5");

        const tahunSekarang = new Date().getFullYear();

        // Isi dropdown tahun produksi (dari tahun sekarang hingga 1980)
        for (let tahun = tahunSekarang; tahun >= 1980; tahun--) {
            let option = new Option(tahun, tahun);
            selectTahun.appendChild(option);
        }

        function hitungMasaPakai() {
            let tahunProduksi = parseInt(selectTahun.value);
            let masaPakai = tahunSekarang - tahunProduksi;

            if (!isNaN(masaPakai)) {
                inputMasaPakai.value = masaPakai + " tahun";
                inputMasaPakai.setAttribute("data-masa-pakai", masaPakai);
            } else {
                inputMasaPakai.value = "";
                inputMasaPakai.setAttribute("data-masa-pakai", "0");
            }
            toggleSectionC();
            toggleKerusakan();
            // Panggil updateKesimpulan() dari script terpisah
            if (typeof updateKesimpulan === "function") {
                updateKesimpulan();
            }
        }

        function toggleSectionC() {
            let valPoin3 = poin3?.value || "";
            let valPoin4 = poin4?.value || "";
            let valPoin5 = poin5?.value || "";

            sectionC.style.display = (valPoin3 === "Ada" && valPoin4 === "Tidak ada" && valPoin5 === "Tidak ada")
                ? "block"
                : "none";
        }

        function toggleKerusakan() {
            let valPoin5 = poin5?.value || "";
            kerusakan.style.display = (valPoin5 === "Ada") ? "block" : "none";
        }

        // Event Listeners
        selectTahun.addEventListener("change", hitungMasaPakai);

        [poin1, poin2, poin3, poin4, poin5].forEach(poin => {
            if (poin) {
                poin.addEventListener("change", () => {
                    toggleSectionC();
                    toggleKerusakan();
                    if (typeof updateKesimpulan === "function") {
                        updateKesimpulan();
                    }
                });
            }
        });

        // Hitung masa pakai dan update semua tampilan saat pertama kali dimuat
        hitungMasaPakai();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputMasaPakai = document.getElementById("masaPakai");
        const kesimpulanSelect = document.getElementById("kesimpulan");

        const poin1 = document.querySelector(".poin1");
        const poin2 = document.querySelector(".poin2");
        const poin3 = document.querySelector(".poin3");
        const poin4 = document.querySelector(".poin4");
        const poin5 = document.querySelector(".poin5");

        function updateKesimpulan() {
            let masaPakai = parseInt(inputMasaPakai.getAttribute("data-masa-pakai")) || 0;

            let valPoin1 = poin1?.value || "";
            let valPoin2 = poin2?.value || "";
            let valPoin3 = poin3?.value || "";
            let valPoin4 = poin4?.value || "";
            let valPoin5 = poin5?.value || "";

            let poinSesuai = valPoin3 === "Ada" && valPoin4 === "Tidak ada" && valPoin5 === "Tidak ada";
            let poin1dan2Sesuai = valPoin1 === "Ada" && valPoin2 === "Ada";

            let kesimpulan = "Bekas tidak layak pakai K8";

            if (masaPakai < 25) {
                kesimpulan = poinSesuai ?
                    (poin1dan2Sesuai ? "Bekas layak pakai K6" : "Bekas bisa diperbaiki K7") :
                    "Bekas bisa diperbaiki K7";
            } else if (masaPakai > 25) {
                kesimpulan = poinSesuai ?
                    (poin1dan2Sesuai ? "Bekas layak pakai K6" : "Bekas bisa diperbaiki K7") :
                    "Bekas tidak layak pakai K8";
            } else {
                kesimpulan = poinSesuai ?
                    "Bekas layak pakai K6" :
                    "Bekas tidak layak pakai K8";
            }

            console.log("Kesimpulan:", kesimpulan);

            // Validasi sebelum mengisi nilai
            if ([...kesimpulanSelect.options].some(option => option.value === kesimpulan)) {
                kesimpulanSelect.value = kesimpulan;
                console.log("Kesimpulan berhasil di-set:", kesimpulanSelect.value);
            } else {
                console.error("Kesimpulan tidak ditemukan dalam opsi select!");
            }
        }

        [inputMasaPakai, poin1, poin2, poin3, poin4, poin5].forEach(input => {
            if (input) {
                input.addEventListener("change", updateKesimpulan);
            }
        });

        updateKesimpulan();
    });

</script>
<?php include 'components/Footer.php'; ?>