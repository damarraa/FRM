<x-layouts.header />

<style>
    .filter-section {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
    }

    .filter-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        padding: 10px;
        border: 1px solid #e0e0e0;
    }

    .table th {
        background-color: #f5f7fa;
        color: #4a5568;
        font-weight: 600;
        padding: 12px 15px;
    }

    .table td {
        padding: 12px 15px;
        vertical-align: middle;
    }

    /* Action buttons styling */
    .btn-group {
        display: flex;
        gap: 5px;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 13px;
        display: inline-block !important;
    }

    .btn-preview {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-download {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .bulk-actions {
        background-color: #f8f9fa;
        padding: 10px 15px;
        border-radius: 5px;
        border: 1px solid #dee2e6;
        margin-top: 10px;
    }

    #selectedCount {
        font-size: 14px;
        color: #6c757d;
    }

    .row-checkbox {
        cursor: pointer;
    }

    /* Fix for buttons visibility */
    .action-column {
        white-space: nowrap;
        min-width: 100px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-section .row>div {
            margin-bottom: 15px;
        }
    }

    /* Date range picker styles */
    .daterangepicker {
        z-index: 1100;
    }

    .search-container {
        position: relative;
    }

    .search-container .input-group-text {
        background-color: white;
        border-right: none;
    }

    .search-container .form-control {
        border-left: none;
    }

    .reset-btn {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
    }

    .reset-btn:hover {
        background-color: #e9ecef;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
        padding: 15px 20px;
    }

    .card-title {
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .badge-filter {
        background-color: #e9ecef;
        color: #495057;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        margin-right: 8px;
        display: inline-flex;
        align-items: center;
    }

    .badge-filter i {
        margin-right: 5px;
        font-size: 10px;
    }
</style>

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Daftar Laporan</h5>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-section">
                            <div class="filter-title">
                                <i class="fas fa-filter"></i> Filter Data
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filterGudang">Unit Layanan Pelanggan:</label>
                                        <select id="filterGudang" class="form-control">
                                            <option value="">Semua ULP</option>
                                            @foreach ($ulp_Approveds as $ulp)
                                                <option value="{{ $ulp->daerah }}">
                                                    {{ $ulp->daerah }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filterMaterial">Material:</label>
                                        <select id="filterMaterial" class="form-control">
                                            <option value="">Semua Material</option>
                                            <option value="KWH Meter">KWH Meter</option>
                                            <option value="MCB">MCB</option>
                                            <option value="Trafo Distribusi">Trafo Distribusi</option>
                                            <option value="Cable Power">Cable Power</option>
                                            <option value="Conductor">Conductor</option>
                                            <option value="Trafo Arus">Trafo Arus (CT)</option>
                                            <option value="Trafo Tegangan">Trafo Tegangan (PT)</option>
                                            <option value="Load Break Switch">Load Break Switch</option>
                                            <option value="Isolator">Isolator</option>
                                            <option value="Lightning Arrester">Lightning Arrester</option>
                                            <option value="Fuse Cut Out">Fuse Cut Out</option>
                                            <option value="PHBTR">PHBTR</option>
                                            <option value="Cubicle">Cubicle</option>
                                            <option value="Kotak App">Kotak App</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filterKesimpulan">Kesimpulan:</label>
                                        <select id="filterKesimpulan" class="form-control">
                                            <option value="">Semua Kesimpulan</option>
                                            @foreach ($allApproved->unique('kesimpulan') as $item)
                                                <option value="{{ $item->kesimpulan }}">{{ $item->kesimpulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dateRangeFilter">Rentang Tanggal:</label>
                                        <input type="text" id="dateRangeFilter" class="form-control"
                                            placeholder="Pilih Rentang Tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="search-container">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input type="text" id="searchInput" class="form-control"
                                                placeholder="Cari berdasarkan No. Retur, ULP, atau informasi lainnya...">
                                            <div class="input-group-append">
                                                <button id="resetFilters" class="btn reset-btn">
                                                    <i class="fas fa-undo"></i> Reset Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table Container -->
                        <div class="table-container">
                            <div class="table-responsive">
                                <table id="table_id" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="30px">
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>No. Retur</th>
                                            <th>Tgl. Retur</th>
                                            <th>Unit Layanan Pelanggan</th>
                                            <th>Material Retur</th>
                                            <th>Kesimpulan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allApproved as $data)
                                            <tr
                                                data-date="{{ \Carbon\Carbon::parse($data->tgl_inspeksi)->format('Y-m-d') }}">
                                                <td><input type="checkbox" class="row-checkbox"
                                                        value="{{ $data->id }}" data-type="{{ get_class($data) }}">
                                                </td>
                                                <td>{{ $data->no_surat }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->tgl_inspeksi)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $data->ulp ? $data->ulp->daerah : '-' }}</td>
                                                <td>
                                                    @if ($data instanceof App\Models\KWHMeter)
                                                        <span class="badge badge-primary">KWH Meter</span>
                                                    @elseif($data instanceof App\Models\MCB)
                                                        <span class="badge badge-secondary">MCB</span>
                                                    @elseif($data instanceof App\Models\Trafo)
                                                        <span class="badge badge-info">Trafo Distribusi</span>
                                                    @elseif ($data instanceof App\Models\CablePower)
                                                        <span class="badge badge-warning">Cable Power</span>
                                                    @elseif ($data instanceof App\Models\Conductor)
                                                        <span class="badge badge-danger">Conductor</span>
                                                    @elseif ($data instanceof App\Models\TrafoArus)
                                                        <span class="badge badge-dark">Trafo Arus (CT)</span>
                                                    @elseif ($data instanceof App\Models\TrafoTegangan)
                                                        <span class="badge badge-light">Trafo Tegangan (PT)</span>
                                                    @elseif ($data instanceof App\Models\TiangListrik)
                                                        <span class="badge badge-success">Tiang Listrik</span>
                                                    @elseif ($data instanceof App\Models\LBS)
                                                        <span class="badge badge-primary">Load Break Switch</span>
                                                    @elseif ($data instanceof App\Models\Isolator)
                                                        <span class="badge badge-secondary">Isolator</span>
                                                    @elseif ($data instanceof App\Models\LightningArrester)
                                                        <span class="badge badge-info">Lightning Arrester</span>
                                                    @elseif ($data instanceof App\Models\FuseCutOut)
                                                        <span class="badge badge-info">Fuse Cut Out</span>
                                                    @elseif ($data instanceof App\Models\PHBTR)
                                                        <span class="badge badge-info">PHBTR</span>
                                                    @elseif ($data instanceof App\Models\Cubicle)
                                                        <span class="badge badge-info">Cubicle</span>
                                                    @elseif ($data instanceof App\Models\KotakAPP)
                                                        <span class="badge badge-info">Kotak App</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data instanceof App\Models\CablePower || $data instanceof App\Models\Conductor)
                                                        K6: {{ $data->kesimpulan_k6 }}m dan K8:
                                                        {{ $data->kesimpulan_k8 }}m
                                                    @else
                                                        {{ $data->kesimpulan }}
                                                    @endif
                                                </td>
                                                <td class="action-column text-center">
                                                    <!-- Preview Button (Outside Dropdown) -->
                                                    @if (auth()->user()->hasRole('Admin'))
                                                        @if ($data instanceof App\Models\KWHMeter)
                                                            <a href="{{ route('previewPDF.kwh', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\MCB)
                                                            <a href="{{ route('previewPDF.mcb', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Trafo)
                                                            <a href="{{ route('previewPDF.trafo', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\CablePower)
                                                            <a href="{{ route('previewPDF.cable', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Conductor)
                                                            <a href="{{ route('previewPDF.conductor', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\TrafoArus)
                                                            <a href="{{ route('previewPDF.ct', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\TrafoTegangan)
                                                            <a href="{{ route('previewPDF.pt', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\TiangListrik)
                                                            <a href="{{ route('previewPDF.tiangListrik', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\LBS)
                                                            <a href="{{ route('previewPDF.lbs', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Isolator)
                                                            <a href="{{ route('previewPDF.isolator', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\LightningArrester)
                                                            <a href="{{ route('previewPDF.lightningArrester', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\FuseCutOut)
                                                            <a href="{{ route('previewPDF.fco', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\PHBTR)
                                                            <a href="{{ route('previewPDF.phbtr', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Cubicle)
                                                            <a href="{{ route('previewPDF.cubicle', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\KotakAPP)
                                                            <a href="{{ route('previewPDF.kotakApp', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if ($data instanceof App\Models\KWHMeter)
                                                            <a href="{{ route('preview.kwh', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\MCB)
                                                            <a href="{{ route('preview.mcb', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Trafo)
                                                            <a href="{{ route('preview.trafo', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\CablePower)
                                                            <a href="{{ route('preview.cable', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Conductor)
                                                            <a href="{{ route('preview.conductor', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\TrafoArus)
                                                            <a href="{{ route('preview.ct', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\TrafoTegangan)
                                                            <a href="{{ route('preview.pt', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\TiangListrik)
                                                            <a href="{{ route('preview.tiangListrik', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\LBS)
                                                            <a href="{{ route('preview.lbs', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Isolator)
                                                            <a href="{{ route('preview.isolator', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\LightningArrester)
                                                            <a href="{{ route('preview.lightningArrester', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\FuseCutOut)
                                                            <a href="{{ route('preview.fco', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\PHBTR)
                                                            <a href="{{ route('preview.phbtr', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\Cubicle)
                                                            <a href="{{ route('preview.cubicle', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @elseif($data instanceof App\Models\KotakAPP)
                                                            <a href="{{ route('preview.kotakApp', $data->id) }}"
                                                                class="btn btn-info btn-sm mr-1" target="_blank">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @endif
                                                    @endif

                                                    <!-- Dropdown Button for Download Options -->
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                            type="button" id="actionDropdown{{ $data->id }}"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Download
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="actionDropdown{{ $data->id }}">
                                                            @if (auth()->user()->hasRole('Admin'))
                                                                @if ($data instanceof App\Models\KWHMeter)
                                                                    <a href="{{ route('exportPDF.kwh', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exkwh', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\MCB)
                                                                    <a href="{{ route('exportPDF.mcb', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exmcb', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Trafo)
                                                                    <a href="{{ route('exportPDF.trafo', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.extrafo', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\CablePower)
                                                                    <a href="{{ route('exportPDF.cable', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.excable', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Conductor)
                                                                    <a href="{{ route('exportPDF.conductor', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exconductor', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\TrafoArus)
                                                                    <a href="{{ route('exportPDF.ct', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exct', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\TrafoTegangan)
                                                                    <a href="{{ route('exportPDF.pt', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.expt', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\TiangListrik)
                                                                    <a href="{{ route('exportPDF.tiangListrik', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.extiang', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\LBS)
                                                                    <a href="{{ route('exportPDF.lbs', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exlbs', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Isolator)
                                                                    <a href="{{ route('exportPDF.isolator', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exisolator', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\LightningArrester)
                                                                    <a href="{{ route('exportPDF.lightningArrester', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exla', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\FuseCutOut)
                                                                    <a href="{{ route('exportPDF.fco', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exfco', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\PHBTR)
                                                                    <a href="{{ route('exportPDF.phbtr', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exphbtr', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Cubicle)
                                                                    <a href="{{ route('exportPDF.cubicle', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.excubicle', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\KotakAPP)
                                                                    <a href="{{ route('exportPDF.kotakApp', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('exports.exkotakapp', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @endif
                                                            @else
                                                                @if ($data instanceof App\Models\KWHMeter)
                                                                    <a href="{{ route('export.kwh', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exkwhs', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\MCB)
                                                                    <a href="{{ route('export.mcb', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exmcbs', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Trafo)
                                                                    <a href="{{ route('export.trafo', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.extrafos', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\CablePower)
                                                                    <a href="{{ route('export.cable', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.excables', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Conductor)
                                                                    <a href="{{ route('export.conductor', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exconductors', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\TrafoArus)
                                                                    <a href="{{ route('export.ct', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.excts', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\TrafoTegangan)
                                                                    <a href="{{ route('export.pt', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.expts', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\TiangListrik)
                                                                    <a href="{{ route('export.tiangListrik', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.extiangs', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\LBS)
                                                                    <a href="{{ route('export.lbs', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exlbss', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Isolator)
                                                                    <a href="{{ route('export.isolator', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exisolators', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\LightningArrester)
                                                                    <a href="{{ route('export.lightningArrester', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exlas', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\FuseCutOut)
                                                                    <a href="{{ route('export.fco', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exfcos', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\PHBTR)
                                                                    <a href="{{ route('export.phbtr', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exphbtrs', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\Cubicle)
                                                                    <a href="{{ route('export.cubicle', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.excubicles', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @elseif($data instanceof App\Models\KotakAPP)
                                                                    <a href="{{ route('export.kotakApp', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-pdf mr-2"></i> Download
                                                                        PDF
                                                                    </a>
                                                                    <a href="{{ route('export.exkotakapps', $data->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="fas fa-file-excel mr-2"></i> Download
                                                                        Excel
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <!-- Tambahkan tombol bulk actions di bagian bawah tabel -->
                                    <div class="bulk-actions mt-3 mb-3" style="display: none;">
                                        <button class="btn btn-primary btn-sm" id="bulkDownloadExcel">
                                            <i class="fas fa-file-excel"></i> Download Excel Terpilih
                                        </button>
                                        <button class="btn btn-danger btn-sm" id="bulkDownloadPDF">
                                            <i class="fas fa-file-pdf"></i> Download PDF Terpilih (ZIP)
                                        </button>
                                        <span id="selectedCount" class="ml-2">0 item terpilih</span>
                                    </div>

                                </table>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $allApproved->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">

<script>
    $(document).ready(function() {
        // Initialize DataTable
        let table = $('#table_id').DataTable({
            "paging": true,
            "info": false,
            "searching": false,
            "order": [
                [1, "desc"]
            ],
        });

        // Initialize DateRangePicker
        $('#dateRangeFilter').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Clear',
                applyLabel: 'Terapkan',
                cancelLabel: 'Batal',
                fromLabel: 'Dari',
                toLabel: 'Sampai',
                customRangeLabel: 'Custom',
                weekLabel: 'W',
                daysOfWeek: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
                monthNames: [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ],
                firstDay: 1
            }
        });

        // Handle date range selection
        $('#dateRangeFilter').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                'DD/MM/YYYY'));
            filterTable();
        });

        // Handle date range clear
        $('#dateRangeFilter').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            filterTable();
        });

        // Filter function
        function filterTable() {
            let filterGudang = $('#filterGudang').val().toLowerCase();
            let filterMaterial = $('#filterMaterial').val().toLowerCase();
            let filterKesimpulan = $('#filterKesimpulan').val().toLowerCase();
            let searchText = $('#searchInput').val().toLowerCase();
            let dateRange = $('#dateRangeFilter').val();

            let startDate, endDate;

            if (dateRange) {
                let dates = dateRange.split(' - ');
                startDate = moment(dates[0], 'DD/MM/YYYY');
                endDate = moment(dates[1], 'DD/MM/YYYY');
            }

            $('table tbody tr').each(function() {
                let row = $(this);
                let ulp = row.find('td:eq(3)').text().toLowerCase();
                let material = row.find('td:eq(4)').text().toLowerCase();
                let kesimpulan = row.find('td:eq(5)').text().toLowerCase();
                let rowText = row.text().toLowerCase();
                let rowDate = row.data('date');

                let matchesGudang = !filterGudang || ulp.includes(filterGudang);
                let matchesMaterial = !filterMaterial || material.includes(filterMaterial);
                let matchesKesimpulan = !filterKesimpulan || kesimpulan.includes(filterKesimpulan);
                let matchesSearch = !searchText || rowText.includes(searchText);

                // Date range filter
                let matchesDate = true;
                if (dateRange) {
                    let itemDate = moment(rowDate);
                    matchesDate = itemDate.isBetween(startDate, endDate, null, '[]');
                }

                if (matchesGudang && matchesMaterial && matchesKesimpulan && matchesSearch &&
                    matchesDate) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        }

        // Attach filter events
        $('#filterGudang, #filterMaterial, #filterKesimpulan, #searchInput').on('input change', function() {
            filterTable();
        });

        // Reset filters
        $('#resetFilters').click(function() {
            $('#filterGudang, #filterMaterial, #filterKesimpulan').val('');
            $('#searchInput').val('');
            $('#dateRangeFilter').val('');
            filterTable();
            
            // Reset select all berdasarkan filer
            $('#selectAll').prop('checked', false);
            updateBulkActions();
        });
    });

    $(document).ready(function() {
        // Select/Deselect all (hanya yang visible)
        $('#selectAll').change(function() {
            const isChecked = $(this).prop('checked');
            $('tbody tr:visible .row-checkbox').prop('checked', isChecked);
            updateBulkActions();
        });

        // Row checkbox change
        $(document).on('change', '.row-checkbox', function() {
            updateBulkActions();
        });

        // Revisi mengikuti Select/Deselect all (hanya yang visible)
        function updateBulkActions() {
            const visibleCheckboxes = $('tbody tr:visible .row-checkbox');
            const checkedCount = visibleCheckboxes.filter(':checked').length;

            if (checkedCount > 0) {
                $('.bulk-actions').show();
                $('#selectedCount').text(checkedCount + ' item terpilih');
            } else {
                $('.bulk-actions').hide();
            }

            // Revisi select all checkbox untuk visible
            $('#selectAll').prop('checked',
                checkedCount > 0 && checkedCount === visibleCheckboxes.length
            );
        }

        // Bulk download Excel
        $('#bulkDownloadExcel').click(function() {
            const selectedItems = getSelectedItems();
            if (selectedItems.ids.length === 0) return;

            // Submit form untuk download
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('export.bulkExcel') }}';

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            const idsInput = document.createElement('input');
            idsInput.type = 'hidden';
            idsInput.name = 'ids';
            idsInput.value = JSON.stringify(selectedItems.ids);
            form.appendChild(idsInput);

            const typesInput = document.createElement('input');
            typesInput.type = 'hidden';
            typesInput.name = 'types';
            typesInput.value = JSON.stringify(selectedItems.types);
            form.appendChild(typesInput);

            document.body.appendChild(form);
            form.submit();
        });

        // Bulk download PDF (ZIP)
        $('#bulkDownloadPDF').click(function() {
            const selectedItems = getSelectedItems();
            if (selectedItems.ids.length === 0) return;

            // Submit form untuk download ZIP
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('export.bulkPDF') }}';

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            const idsInput = document.createElement('input');
            idsInput.type = 'hidden';
            idsInput.name = 'ids';
            idsInput.value = JSON.stringify(selectedItems.ids);
            form.appendChild(idsInput);

            const typesInput = document.createElement('input');
            typesInput.type = 'hidden';
            typesInput.name = 'types';
            typesInput.value = JSON.stringify(selectedItems.types);
            form.appendChild(typesInput);

            document.body.appendChild(form);
            form.submit();
        });

        function getSelectedItems() {
            const ids = [];
            const types = [];

            $('.row-checkbox:checked').each(function() {
                ids.push($(this).val());
                types.push($(this).data('type'));
            });

            return {
                ids,
                types
            };
        }
    });
</script>

<x-layouts.footer />
