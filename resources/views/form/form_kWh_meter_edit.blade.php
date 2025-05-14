<x-layouts.header />
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3 font-weight-bold">Formulir Inspeksi Material Retur kWh Meter</h5>
                            <hr class="mb-3">
                        </div>
                    </div>

                    <form id="formInspeksi" action="{{ route('form-retur-kwh-meter.update', $kWh_Meter->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row justify-content-center-md-center">
                            <input type="hidden" id="jenis_form_id" name="jenis_form_id" value="1">
                            <input type="hidden" name="uid_id" value="{{ $uids->first()->id ?? '' }}">

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
                                    <select class="form-control" name="gudang_id" id="gudang_id" required>
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
                                    <input type="date" name="tgl_inspeksi" id="tgl_inspeksi" class="form-control"
                                        value="{{ old('tgl_inspeksi', $kWh_Meter->tgl_inspeksi) }}" readonly>
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
                                        value="{{ old('id_pelanggan', $kWh_Meter->id_pelanggan) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="ulp_id">Unit Layanan Pelanggan</label>
                                    <select class="form-control" id="ulp_id" name="ulp_id">
                                        @foreach ($ulps as $ulp)
                                            <option value="{{ $ulp->id }}"
                                                {{ old('ulp_id', $selectedUlpId ?? null) == $ulp->id ? 'selected' : '' }}>
                                                {{ $ulp->daerah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_produksi">Tahun Produksi</label>
                                    <select class="form-control" id="tahun_produksi" name="tahun_produksi" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        @for ($i = date('Y'); $i >= 2000; $i--)
                                            <option value="{{ $i }}"
                                                {{ old('tahun_produksi', $selectedTahunProduksi ?? null) == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_kwh_meter">Tipe kWh Meter</label>
                                    <select class="form-control" id="tipe_kwh_meter" name="tipe_kwh_meter">
                                        <option value="">-- Pilih Tipe kWh Meter --</option>
                                        <option value="Prabayar"
                                            {{ old('tipe_kwh_meter', $kWh_Meter->tipe_kwh_meter) == 'Prabayar' ? 'selected' : '' }}>
                                            Prabayar</option>
                                        <option value="Pascabayar"
                                            {{ old('tipe_kwh_meter', $kWh_Meter->tipe_kwh_meter) == 'Pascabayar' ? 'selected' : '' }}>
                                            Pascabayar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_serial">No Serial</label>
                                    <input type="number" class="form-control" id="no_serial" name="no_serial"
                                        placeholder="Masukkan No Serial"
                                        value="{{ old('no_serial', $kWh_Meter->no_serial) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="pabrikan_id">Nama Pabrikan</label>
                                    <select class="form-control" id="pabrikan_id" name="pabrikan_id">
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
                        <h6 class="mb-3 font-weight-bold">B. Pemeriksaan Visual dan Konstruksi</h6>

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masa_pakai">1. Masa Pakai</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control PoinB" id="masa_pakai"
                                            name="masa_pakai" placeholder="Tahun sekarang - Tahun produksi"
                                            value="{{ old('masa_pakai', $kWh_Meter->masa_pakai) }}" readonly>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganMasaPakai')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganMasaPakai" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_masa_pakai">Keterangan Masa Pakai:</label>
                                        <textarea class="form-control" id="keterangan_masa_pakai" name="keterangan_masa_pakai" rows="3"
                                            placeholder="Masukkan keterangan...">{{ old('keterangan_masa_pakai', $kWh_Meter->keterangan_masa_pakai) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_body_kwh_meter">2. Kondisi Body kWh Meter</label>
                                    <div class="input-group">
                                        <select class="form-control PoinB" id="kondisi_body_kwh_meter"
                                            name="kondisi_body_kwh_meter">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_body_kwh_meter', $kWh_Meter->kondisi_body_kwh_meter) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_body_kwh_meter', $kWh_Meter->kondisi_body_kwh_meter) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganBodyKwhMeter')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganBodyKwhMeter" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_body_kwh_meter">Keterangan Body kWh Meter:</label>
                                        <textarea class="form-control" id="keterangan_body_kwh_meter" name="keterangan_body_kwh_meter" rows="3"
                                            placeholder="Masukkan keterangan...">{{ old('keterangan_body_kwh_meter', $kWh_Meter->keterangan_body_kwh_meter) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_segel_meterologi">3. Kondisi Segel Meterologi</label>
                                    <div class="input-group">
                                        <select class="form-control PoinB" id="kondisi_segel_meterologi"
                                            name="kondisi_segel_meterologi">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_segel_meterologi', $kWh_Meter->kondisi_segel_meterologi) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_segel_meterologi', $kWh_Meter->kondisi_segel_meterologi) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
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
                                        <textarea class="form-control" id="keterangan_segel_meterologi" name="keterangan_segel_meterologi" rows="3"
                                            placeholder="Masukkan keterangan...">{{ old('keterangan_segel_meterologi', $kWh_Meter->keterangan_segel_meterologi) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_terminal">4. Kondisi Terminal</label>
                                    <div class="input-group">
                                        <select class="form-control PoinB" id="kondisi_terminal"
                                            name="kondisi_terminal">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_terminal', $kWh_Meter->kondisi_terminal) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_terminal', $kWh_Meter->kondisi_terminal) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganTerminal')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganTerminal" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_terminal">Keterangan Terminal:</label>
                                        <textarea class="form-control" id="keterangan_terminal" name="keterangan_terminal" rows="3"
                                            placeholder="Masukkan keterangan...">{{ old('keterangan_terminal', $kWh_Meter->keterangan_terminal) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kondisi_stand_kwh_meter">5. Kondisi Stand kWh Meter</label>
                                    <div class="input-group">
                                        <select class="form-control PoinB" id="kondisi_stand_kwh_meter"
                                            name="kondisi_stand_kwh_meter">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_stand_kwh_meter', $kWh_Meter->kondisi_stand_kwh_meter) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_stand_kwh_meter', $kWh_Meter->kondisi_stand_kwh_meter) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganStandKwhMeter')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganStandKwhMeter" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_stand_kwh_meter">Keterangan Stand kWh Meter:</label>
                                        <textarea class="form-control" id="keterangan_stand_kwh_meter" name="keterangan_stand_kwh_meter" rows="3"
                                            placeholder="Masukkan keterangan...">{{ old('keterangan_stand_kwh_meter', $kWh_Meter->keterangan_stand_kwh_meter) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_cover_terminal_kwh_meter">6. Kondisi Cover Terminal kWh
                                        Meter</label>
                                    <div class="input-group">
                                        <select class="form-control PoinB" id="kondisi_cover_terminal_kwh_meter"
                                            name="kondisi_cover_terminal_kwh_meter">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_cover_terminal_kwh_meter', $kWh_Meter->kondisi_cover_terminal_kwh_meter) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_cover_terminal_kwh_meter', $kWh_Meter->kondisi_cover_terminal_kwh_meter) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
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
                                            rows="3" placeholder="Masukkan keterangan...">{{ old('keterangan_cover_terminal_kwh_meter', $kWh_Meter->keterangan_cover_terminal_kwh_meter) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_nameplate">7. Kondisi Nameplate</label>
                                    <div class="input-group">
                                        <select class="form-control PoinB" id="kondisi_nameplate"
                                            name="kondisi_nameplate">
                                            <option value="">-- Pilih Kondisi --</option>
                                            <option value="Baik"
                                                {{ old('kondisi_nameplate', $kWh_Meter->kondisi_nameplate) == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Rusak"
                                                {{ old('kondisi_nameplate', $kWh_Meter->kondisi_nameplate) == 'Rusak' ? 'selected' : '' }}>
                                                Rusak</option>
                                        </select>
                                        <span class="input-group-text" id="basic-addon2"
                                            onclick="toggleKeterangan('keteranganNameplate')">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                    </div>
                                    <!-- Input keterangan toggle -->
                                    <div id="keteranganNameplate" class="form-group mt-2" style="display: none;">
                                        <label for="keterangan_nameplate">Keterangan Nameplate:</label>
                                        <textarea class="form-control" id="keterangan_nameplate" name="keterangan_nameplate" rows="3"
                                            placeholder="Masukkan keterangan...">{{ old('keterangan_nameplate', $kWh_Meter->keterangan_nameplate) }}</textarea>
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
                            <hr class="mb-3 ">
                            <h6 class="mb-3 font-weight-bold">C. Pengujian Karakteristik</h6>

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
                                                onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\,\d{1,2})?$/.test(this.value)?"
                                                value="{{ old('nilai_uji_kesalahan', $kWh_Meter->nilai_uji_kesalahan) }}">
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
                                                placeholder="Masukkan keterangan...">{{ old('keterangan_uji_kesalahan', $kWh_Meter->keterangan_uji_kesalahan) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas_pengujian_id">Kelas Pengujian</label>
                                        <select class="form-control" id="kelas_pengujian_id"
                                            name="kelas_pengujian_id">
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas_pengujians as $kelas)
                                                <option value="{{ $kelas->id }}"
                                                    {{ old('kelas_pengujian_id', $selectedKelasPengujianId ?? null) == $kelas->id ? 'selected' : '' }}>
                                                    {{ $kelas->kelas_pengujian }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <h6 class="mb-3 font-weight-bold">D. Kesimpulan</h6>

                        @if (auth()->user()->hasRole('Petugas'))
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kesimpulan">Kesimpulan</label>
                                        <select class="form-control" id="kesimpulan" name="kesimpulan" readOnly>
                                            <option>-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $kWh_Meter->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $kWh_Meter->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $kWh_Meter->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kesimpulan">Kesimpulan</label>
                                        <select class="form-control" id="kesimpulan" name="kesimpulan">
                                            <option>-- Pilih Kesimpulan --</option>
                                            <option value="Bekas layak pakai (K6)"
                                                {{ old('kesimpulan', $kWh_Meter->kesimpulan) == 'Bekas layak pakai (K6)' ? 'selected' : '' }}>
                                                Bekas layak pakai (K6)</option>
                                            <option value="Masih garansi (K7)"
                                                {{ old('kesimpulan', $kWh_Meter->kesimpulan) == 'Masih garansi (K7)' ? 'selected' : '' }}>
                                                Masih garansi (K7)</option>
                                            <option value="Bekas tidak layak pakai (K8)"
                                                {{ old('kesimpulan', $kWh_Meter->kesimpulan) == 'Bekas tidak layak pakai (K8)' ? 'selected' : '' }}>
                                                Bekas tidak layak pakai (K8)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif


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
                                                id="gambar{{ $key + 1 }}" accept="image/*" capture="camera"
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
                                                id="gambar{{ $key + 1 }}" accept="image/*" capture="camera"
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
    </div>
    <!-- [ Main Content ] end -->

    </div>
</section>

<!-- Script untuk Toggle -->
<script>
    function toggleKeterangan(id) {
        var element = document.getElementById(id);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>

{{-- JS untuk otomatisasi Kesimpulan kWh Meter --}}
@if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('PIC_Gudang'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function previewImage(event, previewId) {
                console.log("Preview image untuk:", previewId);
                const input = event.target;
                const previewContainer = document.getElementById(previewId);

                if (!previewContainer) {
                    console.error("Error: Element preview tidak ditemukan untuk ID:", previewId);
                    return;
                }

                previewContainer.innerHTML = "";

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgElement = document.createElement("img");
                        imgElement.src = e.target.result;
                        imgElement.classList.add("img-thumbnail", "preview-img");
                        imgElement.width = 200;
                        imgElement.style.cursor = "pointer";
                        imgElement.onclick = () => openImageModal(e.target.result);

                        previewContainer.appendChild(imgElement);
                        console.log("Gambar berhasil ditampilkan di:", previewId);
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    console.log("Tidak ada file yang dipilih atau browser tidak mendukung FileReader.");
                }
            }

            function openImageModal(imageSrc) {
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageSrc;
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                modal.show();
            }

            // Add event listeners to existing images
            document.querySelectorAll('.preview-img').forEach(img => {
                img.addEventListener('click', function() {
                    openImageModal(this.src);
                });
            });
        });

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
            // 1. Inisialisasi elemen-elemen penting
            const tahunProduksi = document.getElementById("tahun_produksi");
            const masaPakaiInput = document.getElementById("masa_pakai");
            const kesimpulanSelect = document.getElementById("kesimpulan");
            const nilaiUjiKesalahan = document.getElementById("nilai_uji_kesalahan");
            const selectKelas = document.querySelector("select[name='kelas_pengujian_id']");

            // Ambil semua select kondisi untuk poin B
            const kondisiSelects = document.querySelectorAll('select[name^="kondisi_"]');

            // Temukan section C - gunakan selector yang lebih reliable
            const sectionC = document.querySelector(".sectionC") ||
                document.getElementById("sectionC") ||
                document.querySelector("[data-section='C']");

            // Inisialisasi objek untuk menyimpan batas toleransi
            let batasToleransiMap = {};

            // 2. Fungsi untuk menghitung masa pakai
            function hitungMasaPakai() {
                const tahunSekarang = new Date().getFullYear();
                if (tahunProduksi.value) {
                    let masaPakai = tahunSekarang - parseInt(tahunProduksi.value);
                    masaPakaiInput.value = masaPakai + " tahun";
                }
                updateKesimpulan();
            }

            // 3. Fungsi untuk memeriksa kesesuaian berdasarkan kelas pengujian
            function cekKesesuaianKelas() {
                if (!nilaiUjiKesalahan.value || !selectKelas.value) return true;

                const nilaiUji = parseFloat(nilaiUjiKesalahan.value) || 0;
                const batasToleransi = batasToleransiMap[selectKelas.value] || 0;

                return Math.abs(nilaiUji) <= batasToleransi;
            }

            // 4. Fungsi untuk update kesimpulan
            function updateKesimpulan() {
                const masaPakai = parseInt(masaPakaiInput.value) || 0;
                let semuaBaik = true;

                // Periksa apakah semua kondisi poin B bernilai "Baik"
                kondisiSelects.forEach(select => {
                    if (select.value !== "Baik") {
                        semuaBaik = false;
                    }
                });

                const sesuaiKelas = cekKesesuaianKelas();

                // Tentukan kesimpulan berdasarkan kondisi
                let kesimpulanValue = "";
                if (semuaBaik && sesuaiKelas && masaPakai <= 5) {
                    kesimpulanValue = "Bekas layak pakai (K6)";
                } else if (masaPakai <= 5) {
                    kesimpulanValue = "Masih garansi (K7)";
                } else {
                    kesimpulanValue = "Bekas tidak layak pakai (K8)";
                }

                kesimpulanSelect.value = kesimpulanValue;
            }

            // 5. Fungsi untuk mengecek kondisi poin B dan menampilkan/sembunyikan section C
            function checkPoinB() {
                let allBaik = true;

                kondisiSelects.forEach(select => {
                    if (select.value !== "Baik") {
                        allBaik = false;
                    }
                });

                // Sembunyikan section C jika ada yang tidak Baik
                if (sectionC) {
                    sectionC.style.display = allBaik ? "block" : "none";

                    // Reset nilai section C jika disembunyikan
                    if (!allBaik) {
                        nilaiUjiKesalahan.value = "";
                        selectKelas.value = "";
                    }
                }
            }

            // 6. Fungsi untuk preview gambar
            function previewImage(event, previewId) {
                const input = event.target;
                const previewContainer = document.getElementById(previewId);

                if (!previewContainer) return;

                previewContainer.innerHTML = "";

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgElement = document.createElement("img");
                        imgElement.src = e.target.result;
                        imgElement.classList.add("img-thumbnail", "preview-img");
                        imgElement.width = 200;
                        imgElement.style.cursor = "pointer";
                        imgElement.onclick = () => openImageModal(e.target.result);

                        previewContainer.appendChild(imgElement);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function openImageModal(imageSrc) {
                const modalImage = document.getElementById('modalImage');
                if (modalImage) {
                    modalImage.src = imageSrc;
                    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                    modal.show();
                }
            }

            // 7. Load data kelas pengujian untuk batas toleransi
            function loadKelasPengujian() {
                fetch('/kelas-pengujians')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            batasToleransiMap[item.id] = item.batas_kesalahan;

                            // Isi dropdown kelas jika belum ada
                            if (selectKelas) {
                                const option = new Option(item.kelas_pengujian, item.id);
                                selectKelas.appendChild(option);
                            }
                        });

                        // Set nilai selectKelas jika ada data yang disimpan
                        if (selectKelas && selectKelas.dataset.selected) {
                            selectKelas.value = selectKelas.dataset.selected;
                        }
                    })
                    .catch(error => {
                        console.error('Error loading kelas pengujian:', error);
                    });
            }

            // 8. Inisialisasi event listeners
            if (tahunProduksi) {
                tahunProduksi.addEventListener("change", hitungMasaPakai);
            }

            kondisiSelects.forEach(select => {
                select.addEventListener("change", function() {
                    checkPoinB();
                    updateKesimpulan();
                });
            });

            if (nilaiUjiKesalahan) {
                nilaiUjiKesalahan.addEventListener("change", updateKesimpulan);
            }

            if (selectKelas) {
                selectKelas.addEventListener("change", updateKesimpulan);
            }

            // Event listener untuk preview gambar
            document.querySelectorAll('input[type="file"]').forEach(input => {
                const previewId = input.dataset.preview;
                if (previewId) {
                    input.addEventListener("change", (e) => previewImage(e, previewId));
                }
            });

            // 9. Inisialisasi awal
            hitungMasaPakai();
            checkPoinB();
            loadKelasPengujian();

            // 10. Handle form submit
            const formInspeksi = document.getElementById('formInspeksi');
            if (formInspeksi) {
                formInspeksi.addEventListener('submit', function(e) {
                    // Validasi section C jika ditampilkan
                    if (sectionC && sectionC.style.display !== "none") {
                        if (nilaiUjiKesalahan.value && !selectKelas.value) {
                            e.preventDefault();
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: 'Silakan pilih Kelas Pengujian jika mengisi Nilai Uji Kesalahan'
                            });
                            return;
                        }
                    }

                    // Tampilkan notifikasi sukses
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Data berhasil diperbarui!');
                    }
                });
            }
        });
    </script>
@endif

<x-layouts.footer  />
