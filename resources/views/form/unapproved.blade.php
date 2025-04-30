{{-- <x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Tunggu Persetujuan
                            @if (auth()->user()->hasRole('PIC_Gudang') && isset($gudang_user))
                                - {{ $gudang_user->nama_gudang ?? 'Gudang Tidak Diketahui' }}
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="table_id" class="table table-striped table-bordered">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">No. Retur</th>
                                                <th scope="col" class="px-6 py-3">Tgl. Retur</th>
                                                @if (auth()->user()->hasRole('Petugas'))
                                                    <th scope="col" class="px-6 py-3">Gudang Retur</th>
                                                @endif
                                                <th scope="col" class="px-6 py-3">Material</th>
                                                <th scope="col" class="px-6 py-3">Kesimpulan</th>
                                                <th scope="col" class="px-6 py-3">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allUnapproved as $data)
                                                <tr
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <td>{{ $data->no_surat }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data->tgl_inspeksi)->format('d/m/Y') }}
                                                    </td>
                                                    @if (auth()->user()->hasRole('Petugas'))
                                                        <td>{{ $data->gudang ? $data->gudang->nama_gudang : '-' }}</td>
                                                    @endif
                                                    <td>
                                                        @if ($data instanceof App\Models\KWHMeter)
                                                            KWH Meter
                                                        @elseif($data instanceof App\Models\MCB)
                                                            MCB
                                                        @elseif($data instanceof App\Models\Trafo)
                                                            Trafo Distribusi
                                                        @elseif ($data instanceof App\Models\CablePower)
                                                            Cable Power
                                                        @elseif ($data instanceof App\Models\Conductor)
                                                            Conductor
                                                        @elseif ($data instanceof App\Models\TrafoArus)
                                                            Trafo Arus (CT)
                                                        @elseif ($data instanceof App\Models\TrafoTegangan)
                                                            Trafo Tegangan (PT)
                                                        @elseif ($data instanceof App\Models\TiangListrik)
                                                            Tiang Listrik
                                                        @elseif ($data instanceof App\Models\LBS)
                                                            LBS
                                                        @endif
                                                    </td>
                                                    @if ($data instanceof App\Models\CablePower || $data instanceof App\Models\Conductor)
                                                        <td>K6: {{ $data->kesimpulan_k6 }}m dan K8:
                                                            {{ $data->kesimpulan_k8 }}m</td>
                                                    @else
                                                        <td>{{ $data->kesimpulan }}</td>
                                                    @endif
                                                    <td>
                                                        @if ($data instanceof App\Models\KWHMeter)
                                                            <a href="{{ route('form-retur-kwh-meter.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-kwh-meter.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif($data instanceof App\Models\MCB)
                                                            <a href="{{ route('form-retur-mcb.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-mcb.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif($data instanceof App\Models\Trafo)
                                                            <a href="{{ route('form-retur-trafo.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-trafo.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($data instanceof App\Models\CablePower)
                                                            <a href="{{ route('form-retur-cable-power.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-cable-power.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($data instanceof App\Models\Conductor)
                                                            <a href="{{ route('form-retur-conductor.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-conductor.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($data instanceof App\Models\TrafoArus)
                                                            <a href="{{ route('form-retur-ct.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-ct.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($data instanceof App\Models\TrafoTegangan)
                                                            <a href="{{ route('form-retur-pt.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-pt.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($data instanceof App\Models\TiangListrik)
                                                            <a href="{{ route('form-retur-tiang-listrik.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-tiang-listrik.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($data instanceof App\Models\LBS)
                                                            <a href="{{ route('form-retur-lbs.edit', $data->id) }}"
                                                                class="btn btn-primary btn-sm">Details</a>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                <form
                                                                    action="{{ route('form-retur-lbs.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $allUnapproved->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable dengan konfigurasi
        let table = $('#table_id').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "dom": '<"top"f>rt<"bottom"lip><"clear">',
            "language": {
                "search": "Pencarian:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari _MAX_ total data)"
            },
            "columnDefs": [{
                    "orderable": true,
                    "targets": [0, 1, 2, 3, 4]
                },
                {
                    "orderable": false,
                    "targets": [5]
                } // Kolom aksi tidak bisa diurutkan
            ]
        });

        // Custom filtering
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#filterGudang').on('change', function() {
            table.column(2).search(this.value).draw();
        });

        $('#filterMaterial').on('change', function() {
            table.column(3).search(this.value).draw();
        });

        $('#filterKesimpulan').on('keyup', function() {
            table.column(4).search(this.value).draw();
        });

        // Sembunyikan pagination Laravel jika DataTable aktif
        $('.pagination').hide();
    });
</script>

<x-layouts.footer /> --}}

<x-layouts.header />

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Tunggu Persetujuan
                            @if (auth()->user()->hasRole('PIC_Gudang') && isset($gudang_user))
                                - {{ $gudang_user->nama_gudang ?? 'Gudang Tidak Diketahui' }}
                            @endif
                        </h5>
                        <!-- Tambahkan filter di header -->
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Cari semua kolom...">
                            </div>
                            @if (auth()->user()->hasRole('Petugas'))
                                <div class="col-md-2">
                                    <select id="filterGudang" class="form-control">
                                        <option value="">Semua Gudang</option>
                                        @foreach ($gudangs as $gudang)
                                            <option value="{{ $gudang->nama_gudang }}">{{ $gudang->nama_gudang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-md-2">
                                <select id="filterMaterial" class="form-control">
                                    <option value="">Semua Material</option>
                                    <option value="KWH Meter">KWH Meter</option>
                                    <option value="MCB">MCB</option>
                                    <option value="Trafo Distribusi">Trafo Distribusi</option>
                                    <option value="Cable Power">Cable Power</option>
                                    <option value="Conductor">Conductor</option>
                                    <option value="Trafo Arus (CT)">Trafo Arus (CT)</option>
                                    <option value="Trafo Tegangan (PT)">Trafo Tegangan (PT)</option>
                                    <option value="Tiang Listrik">Tiang Listrik</option>
                                    <option value="Load Break Switch">Load Break Switch</option>
                                    <option value="Isolator">Isolator</option>
                                    <option value="Lightning Arrester">Lightning Arrester</option>
                                    <option value="Fuse Cut Out">Fuse Cut Out</option>
                                    <option value="PHBTR">PHBTR</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="filterKesimpulan" class="form-control">
                                    <option value="">Semua Kesimpulan</option>
                                    <option value="K6">Bekas layak pakai (K6)</option>
                                    <option value="K7">Bekas bisa diperbaiki (K7)</option>
                                    <option value="K8">Bekas tidak layak pakai (K8)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table id="returTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">No. Retur</th>
                                            <th scope="col" class="px-6 py-3">Tgl. Retur</th>
                                            @if (auth()->user()->hasRole('Petugas'))
                                                <th scope="col" class="px-6 py-3">Gudang Retur</th>
                                            @endif
                                            <th scope="col" class="px-6 py-3">Material</th>
                                            <th scope="col" class="px-6 py-3">Kesimpulan</th>
                                            <th scope="col" class="px-6 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allUnapproved as $data)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td>{{ $data->no_surat }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->tgl_inspeksi)->format('d/m/Y') }}
                                                </td>
                                                @if (auth()->user()->hasRole('Petugas'))
                                                    <td>{{ $data->gudang ? $data->gudang->nama_gudang : '-' }}</td>
                                                @endif
                                                <td>
                                                    @if ($data instanceof App\Models\KWHMeter)
                                                        KWH Meter
                                                    @elseif($data instanceof App\Models\MCB)
                                                        MCB
                                                    @elseif($data instanceof App\Models\Trafo)
                                                        Trafo Distribusi
                                                    @elseif ($data instanceof App\Models\CablePower)
                                                        Cable Power
                                                    @elseif ($data instanceof App\Models\Conductor)
                                                        Conductor
                                                    @elseif ($data instanceof App\Models\TrafoArus)
                                                        Trafo Arus (CT)
                                                    @elseif ($data instanceof App\Models\TrafoTegangan)
                                                        Trafo Tegangan (PT)
                                                    @elseif ($data instanceof App\Models\TiangListrik)
                                                        Tiang Listrik
                                                    @elseif ($data instanceof App\Models\LBS)
                                                        LBS
                                                    @elseif ($data instanceof App\Models\Isolator)
                                                        Isolator
                                                    @elseif ($data instanceof App\Models\LightningArrester)
                                                        Lightning Arrester
                                                    @elseif ($data instanceof App\Models\FuseCutOut)
                                                        Fuse Cut Out
                                                    @elseif ($data instanceof App\Models\PHBTR)
                                                        PHBTR
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
                                                <td class="d-flex gap-2">
                                                    @if ($data instanceof App\Models\KWHMeter)
                                                        <a href="{{ route('form-retur-kwh-meter.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-kwh-meter.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif($data instanceof App\Models\MCB)
                                                        <a href="{{ route('form-retur-mcb.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-mcb.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif($data instanceof App\Models\Trafo)
                                                        <a href="{{ route('form-retur-trafo.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-trafo.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\CablePower)
                                                        <a href="{{ route('form-retur-cable-power.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-cable-power.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\Conductor)
                                                        <a href="{{ route('form-retur-conductor.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-conductor.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\TrafoArus)
                                                        <a href="{{ route('form-retur-ct.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-ct.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\TrafoTegangan)
                                                        <a href="{{ route('form-retur-pt.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-pt.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\TiangListrik)
                                                        <a href="{{ route('form-retur-tiang-listrik.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-tiang-listrik.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\LBS)
                                                        <a href="{{ route('form-retur-lbs.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-lbs.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\Isolator)
                                                        <a href="{{ route('form-retur-isolator.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-isolator.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\LightningArrester)
                                                        <a href="{{ route('form-retur-lightning-arrester.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-lightning-arrester.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\FuseCutOut)
                                                        <a href="{{ route('form-retur-fco.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-fco.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($data instanceof App\Models\PHBTR)
                                                        <a href="{{ route('form-retur-phbtr.edit', $data->id) }}"
                                                            class="btn btn-primary btn-sm">Details</a>
                                                        @if (auth()->user()->hasRole('Petugas'))
                                                            <form
                                                                action="{{ route('form-retur-phbtr.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
<script>
    $(document).ready(function() {
        // Hitung jumlah kolom berdasarkan role user
        const isPetugas = {{ auth()->user()->hasRole('Petugas') ? 'true' : 'false' }};
        const columnCount = isPetugas ? 6 : 5;

        // Konfigurasi kolom yang bisa di-sort
        const columnDefs = [{
                targets: '_all',
                orderable: true
            }, // Aktifkan sorting untuk semua kolom
            {
                targets: columnCount - 1,
                orderable: false
            } // Nonaktifkan sorting untuk kolom terakhir (Aksi)
        ];

        // Inisialisasi DataTable
        const table = $('#returTable').DataTable({
            dom: '<"top"lf>rt<"bottom"ip>',
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: columnDefs
        });

        // Filter untuk semua kolom
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Filter khusus kolom Gudang (hanya untuk Petugas)
        if (isPetugas) {
            $('#filterGudang').on('change', function() {
                table.column(2).search(this.value).draw();
            });
        }

        // Filter khusus kolom Material
        $('#filterMaterial').on('change', function() {
            const colIndex = isPetugas ? 3 : 2;
            table.column(colIndex).search(this.value).draw();
        });

        // Filter khusus kolom Kesimpulan
        $('#filterKesimpulan').on('change', function() {
            const colIndex = isPetugas ? 4 : 3;
            table.column(colIndex).search(this.value).draw();
        });

        // Sembunyikan pagination Laravel
        $('.pagination').hide();
    });
</script>

<x-layouts.footer />
