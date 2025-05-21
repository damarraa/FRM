<!-- Start Header -->
<x-layouts.header />
<!-- End Header -->

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        @if (auth()->user()->hasRole('Admin'))
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Dashboard Material Retur Distribusi</h5>
                        <hr class="mb-3">
                        <!-- Notifikasi -->
                        @if ($newUsers > 0)
                            <a href="{{ route('manajemen-user.index') }}"
                                class="block bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 hover:bg-yellow-200 transition duration-300 ease-in-out"
                                role="alert">
                                <p class="font-bold">Notifikasi</p>
                                <p>Ada {{ $newUsers }} user baru yang melakukan registrasi. Silakan periksa dan
                                    update role user.</p>
                            </a>
                        @endif

                        <!-- Grid untuk Statistik Utama -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-green-500">
                                <h2 class="text-lg font-semibold mb-2 text-gray-700">Jumlah Admin</h2>
                                <p class="text-3xl font-bold text-green-800">{{ $totalAdmin }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-red-500">
                                <h2 class="text-md font-semibold mb-2 text-gray-700">Jumlah PIC Gudang</h2>
                                <p class="text-3xl font-bold text-red-800">{{ $totalPICGudang }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-blue-500">
                                <h2 class="text-lg font-semibold mb-2 text-gray-700">Jumlah Petugas</h2>
                                <p class="text-3xl font-bold text-blue-800">{{ $totalPetugas }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-purple-500">
                                <h2 class="text-lg font-semibold mb-2 text-gray-700">User Aktif</h2>
                                <p class="text-3xl font-bold text-purple-800">{{ $activeUsersCount }}</p>
                            </div>
                        </div>

                        <!-- Chart Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <!-- Pie Chart: Distribusi Kategori Material -->
                            <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-center">
                                <div class="w-2/3">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Jumlah Barang berdasarkan
                                        kesimpulan</h2>
                                    <div class="h-64">
                                        <canvas id="materialCategoryChart"></canvas>
                                    </div>
                                </div>
                                <div class="w-2/3 text-center border-l pl-4">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Total Inspeksi</h3>
                                        <p class="text-2xl font-semibold text-blue-600" id="totalInspeksi">
                                            {{ $totalFormAdmin }}</p>
                                </div>
                            </div>
                            <!-- Line Chart: Tren Barang yang Di Retur -->
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h2 class="text-lg font-semibold mb-4 text-gray-700">Tren Barang yang Di Retur</h2>
                                <div class="h-64">
                                    <canvas id="returItemTrendChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Heatmap Chart: Persetujuan atau Penolakan Berdasarkan Hari -->
                        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                            <h2 class="text-lg font-semibold mb-4 text-gray-700">Aktivitas Approval (Mingguan)</h2>
                            <div class="h-64">
                                <canvas id="inspectorComparisonChart"></canvas>
                            </div>
                        </div>

                        <!-- Active Users Table -->
                        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                            <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar User Aktif</h2>
                            <div class="overflow-x-auto">
                                <table id="usersTable" class="min-w-full bg-white">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200 text-left text-gray-700">Nama
                                            </th>
                                            <th class="py-2 px-4 border-b border-gray-200 text-left text-gray-700">Email
                                            </th>
                                            <th class="py-2 px-4 border-b border-gray-200 text-left text-gray-700">Role
                                            </th>
                                            <th class="py-2 px-4 border-b border-gray-200 text-left text-gray-700">
                                                Terakhir Aktif</th>
                                            <th class="py-2 px-4 border-b border-gray-200 text-left text-gray-700">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeUsers as $user)
                                            <tr class="hover:bg-gray-50">
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $user->name }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    @foreach ($user->roles as $role)
                                                        <span
                                                            class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200"
                                                    data-order="{{ $user->last_active_at ? $user->last_active_at->timestamp : 0 }}">
                                                    {{ $user->last_active_at ? $user->last_active_at->diffForHumans() : 'Belum pernah' }}
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200"
                                                    data-order="{{ $user->isOnline() ? 1 : 0 }}">
                                                    @if ($user->isOnline())
                                                        <span
                                                            class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full flex items-center">
                                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                                            Online
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full flex items-center">
                                                            <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                                            Offline
                                                        </span>
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

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <!-- CSS Minimal untuk DataTables -->
            <style>
                #usersTable {
                    width: 100%;
                    border-collapse: collapse;
                }

                #usersTable thead th {
                    position: sticky;
                    top: 0;
                    background-color: #f3f4f6;
                }

                #usersTable_paginate .paginate_button {
                    padding: 0.5em 1em;
                    margin-left: 2px;
                    border: 1px solid #d1d5db;
                    border-radius: 0.375rem;
                }

                #usersTable_paginate .paginate_button.current {
                    background: #3b82f6;
                    color: white !important;
                    border: 1px solid #3b82f6;
                }

                #usersTable_filter input {
                    padding: 0.5em;
                    border: 1px solid #d1d5db;
                    border-radius: 0.375rem;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $('#usersTable').DataTable({
                        // Konfigurasi dasar
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: false,

                        // Default sorting by last active descending
                        order: [
                            [3, 'desc']
                        ],
                        dom: '<"top"lf>rt<"bottom"ip>', // Layout lebih sederhana
                        pagingType: 'simple_numbers', // Tampilan pagination minimal

                        // Konfigurasi bahasa (opsional)
                        language: {
                            search: "Cari:",
                            lengthMenu: "Tampilkan _MENU_ data per halaman",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            paginate: {
                                first: "Pertama",
                                last: "Terakhir",
                                next: "Selanjutnya",
                                previous: "Sebelumnya"
                            }
                        },

                        // Konfigurasi kolom
                        columnDefs: [{
                                targets: 2, // Kolom Role
                                orderable: false // Non-aktifkan sorting untuk kolom role
                            },
                            {
                                targets: [3, 4], // Kolom Terakhir Aktif dan Status
                                type: 'num' // Sorting numerik untuk timestamp
                            }
                        ]
                    });
                });
            </script>

            <script>
                // Pie Chart: Distribusi Kategori Material Retur
                document.addEventListener("DOMContentLoaded", function() {
                    const materialCategoryData = {
                        labels: ['K6', 'K7', 'K8'],
                        datasets: [{
                            data: [{{ $totalCategories['K6'] }}, {{ $totalCategories['K7'] }},
                                {{ $totalCategories['K8'] }}
                            ],
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                        }]
                    };

                    const ctx = document.getElementById('materialCategoryChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: materialCategoryData,
                    });
                });

                // Hitung total inspeksi
                const totalInspeksi = data.datasets[0].data.reduce((a, b) => a + b, 0);
                document.getElementById('totalInspeksi').textContent = totalInspeksi;
            </script>

            <script>
                // Line Chart: Tren Barang yang Di Retur
                document.addEventListener("DOMContentLoaded", function() {
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                    const returItemTrendData = {
                        labels: months,
                        datasets: [{
                            label: 'KWH Meter',
                            data: {!! json_encode(array_values($returData['KWH Meter'])) !!},
                            borderColor: '#36A2EB',
                            fill: false,
                        }, {
                            label: 'MCB',
                            data: {!! json_encode(array_values($returData['MCB'])) !!},
                            borderColor: '#FFCE56',
                            fill: false,
                        }, {
                            label: 'Trafo',
                            data: {!! json_encode(array_values($returData['Trafo'])) !!},
                            borderColor: '#FF6384',
                            fill: false,
                        }, {
                            label: 'Cable Power',
                            data: {!! json_encode(array_values($returData['Cable Power'])) !!},
                            borderColor: '#4BC0C0',
                            fill: false,
                        }, {
                            label: 'Conductor',
                            data: {!! json_encode(array_values($returData['Conductor'])) !!},
                            borderColor: '#9966FF',
                            fill: false,
                        }, {
                            label: 'Trafo Arus',
                            data: {!! json_encode(array_values($returData['Trafo Arus'])) !!},
                            borderColor: '#E74C3C',
                            fill: false,
                        }, {
                            label: 'Trafo Tegangan',
                            data: {!! json_encode(array_values($returData['Trafo Tegangan'])) !!},
                            borderColor: '#2ECC71',
                            fill: false,
                        }, {
                            label: 'Tiang Listrik',
                            data: {!! json_encode(array_values($returData['Tiang Listrik'])) !!},
                            borderColor: '#F39C12',
                            fill: false,
                        }, {
                            label: 'LBS',
                            data: {!! json_encode(array_values($returData['LBS'])) !!},
                            borderColor: '#1ABC9C',
                            fill: false,
                        }, {
                            label: 'Isolator',
                            data: {!! json_encode(array_values($returData['Isolator'])) !!},
                            borderColor: '#9B59B6',
                            fill: false,
                        }, {
                            label: 'Lightning Arrester',
                            data: {!! json_encode(array_values($returData['Lightning Arrester'])) !!},
                            borderColor: '#34495E',
                            fill: false,
                        }, {
                            label: 'Fuse Cut Out',
                            data: {!! json_encode(array_values($returData['Fuse Cut Out'])) !!},
                            borderColor: '#D35400',
                            fill: false,
                        }, {
                            label: 'PHBTR',
                            data: {!! json_encode(array_values($returData['PHBTR'])) !!},
                            borderColor: '#7F8C8D',
                            fill: false,
                        }, {
                            label: 'Cubicle',
                            data: {!! json_encode(array_values($returData['Cubicle'])) !!},
                            borderColor: '#BDC3C7',
                            fill: false,
                        }, {
                            label: 'Kotak APP',
                            data: {!! json_encode(array_values($returData['Kotak APP'])) !!},
                            borderColor: '#C0392B',
                            fill: false,
                        }]
                    };

                    const ctx = document.getElementById('returItemTrendChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: returItemTrendData,
                    });
                });
            </script>

            <script>
                var stackedBarData = @json($stackedBarData);
                // Stacked Bar Chart: Perbandingan Jumlah Inspeksi oleh Petugas
                document.addEventListener('DOMContentLoaded', function() {
                    const stackedBarData = window.stackedBarData;

                    const inspectorComparisonData = {
                        labels: stackedBarData.labels, // Tanggal dari backend
                        datasets: [{
                                label: 'Approved',
                                data: stackedBarData.approved,
                                backgroundColor: '#36A2EB',
                            },
                            {
                                label: 'Unapproved',
                                data: stackedBarData.unapproved,
                                backgroundColor: '#FF6384',
                            }
                        ]
                    };

                    const inspectorComparisonChart = new Chart(document.getElementById('inspectorComparisonChart'), {
                        type: 'bar',
                        data: inspectorComparisonData,
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    stacked: true
                                },
                                y: {
                                    stacked: true
                                }
                            }
                        }
                    });
                });
            </script>
        @elseif (auth()->user()->hasRole('PIC_Gudang'))
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Dashboard PIC Gudang @if (auth()->user()->hasRole('PIC_Gudang') && isset($gudang_user))
                                - {{ $gudang_user->nama_gudang ?? 'Gudang Tidak Diketahui' }}
                            @endif
                        </h5>
                        <hr class="mb-3">

                        <!-- Notifikasi -->
                        <a href="{{ route('form-unapproved') }}"
                            class="block bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 hover:bg-yellow-200 transition duration-300 ease-in-out"
                            role="alert">
                            <p class="font-bold">Notifikasi</p>
                            <p>Ada <span class="font-bold">{{ $totalUnapprovedByGudang }}</span> material retur baru
                                yang perlu
                                disetujui.</p>
                        </a>

                        <!-- Statistik Utama -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            <!-- Kartu di Kiri -->
                            <div class="md:col-span-1 space-y-6">
                                <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-blue-500">
                                    <h2 class="text-lg font-semibold mb-4">Total Material Retur</h2>
                                    <p class="text-4xl font-bold">{{ $totalFormsByGudang }}</p>
                                    @if (auth()->user()->hasRole('Admin'))
                                        <a href="{{ route('manajemen-laporan') }}"
                                            class="text-blue-500 hover:underline">Lihat
                                            Detail</a>
                                    @endif
                                    {{-- <a href="{{ route('laporan') }}" class="text-blue-500 hover:underline">Lihat
                                        Detail</a> --}}
                                </div>
                                <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-purple-500">
                                    <h2 class="text-lg font-semibold mb-4">Menunggu Persetujuan</h2>
                                    <p class="text-4xl font-bold">{{ $totalUnapprovedByGudang }}</p>
                                </div>
                            </div>

                            <!-- Tabel di Kanan -->
                            {{-- <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">
                                <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Material yang Perlu Ditinjau
                                </h2>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-200">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="py-3 px-4 border-b text-left">Material</th>
                                                <th class="py-3 px-4 border-b text-left">Kategori</th>
                                                <th class="py-3 px-4 border-b text-left">Tanggal</th>
                                                <th class="py-3 px-4 border-b text-left">Status</th>
                                                <th class="py-3 px-4 border-b text-left">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allUnapproved as $data)
                                                <tr class="border-b">
                                                    <td class="py-3 px-4">
                                                        {{ $data->jenisForm ? $data->jenisForm->nama_form : '-' }}</td>
                                                    @if ($data instanceof App\Models\CablePower || $data instanceof App\Models\Conductor)
                                                        <td class="py-3 px-4">K6: {{ $data->kesimpulan_k6 }}m <br>
                                                            K8: {{ $data->kesimpulan_k8 }}m</td>
                                                    @else
                                                        <td class="py-3 px-4">{{ $data->kesimpulan }}</td>
                                                    @endif
                                                    <td class="py-3 px-4">{{ $data->tgl_inspeksi }}</td>
                                                    <td class="py-3 px-4 text-yellow-600">{{ $data->status }}</td>
                                                    <td class="py-3 px-4">
                                                        @if ($data instanceof App\Models\KWHMeter)
                                                            <a href="{{ route('form-retur-kwh-meter.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
                                                        @elseif($data instanceof App\Models\MCB)
                                                            <a href="{{ route('form-retur-mcb.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
                                                        @elseif($data instanceof App\Models\Trafo)
                                                            <a href="{{ route('form-retur-trafo.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
                                                        @elseif ($data instanceof App\Models\CablePower)
                                                            <a href="{{ route('form-retur-cable-power.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
                                                        @elseif ($data instanceof App\Models\Conductor)
                                                            <a href="{{ route('form-retur-conductor.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
                                                        @elseif ($data instanceof App\Models\TrafoArus)
                                                            <a href="{{ route('form-retur-ct.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
                                                        @elseif ($data instanceof App\Models\TrafoTegangan)
                                                            <a href="{{ route('form-retur-pt.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
                                                        @elseif ($data instanceof App\Models\TiangListrik)
                                                            <a href="{{ route('form-retur-tiang-listrik.edit', $data->id) }}"
                                                                class="text-blue-500 hover:underline">Lihat Detail</a>
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
                            </div> --}}
                            <!-- Tabel di Kanan -->
                            <!-- Tabel di Kanan -->
                            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">
                                <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Material yang Perlu Ditinjau
                                </h2>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-200">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="py-3 px-4 border-b text-left">Material</th>
                                                <th class="py-3 px-4 border-b text-left">Kategori</th>
                                                <th class="py-3 px-4 border-b text-left">Tanggal</th>
                                                <th class="py-3 px-4 border-b text-left">Status</th>
                                                <th class="py-3 px-4 border-b text-left">Detail</th>
                                            </tr>
                                        </thead>
                                        <!-- Table Body -->
                                        <tbody>
                                            @forelse ($allUnapproved as $data)
                                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                                    <td class="py-3 px-4">
                                                        {{ $data->jenisForm ? $data->jenisForm->nama_form : '-' }}
                                                    </td>
                                                    @if ($data instanceof App\Models\CablePower || $data instanceof App\Models\Conductor)
                                                        <td class="py-3 px-4">
                                                            K6: {{ $data->kesimpulan_k6 }}m <br>
                                                            K8: {{ $data->kesimpulan_k8 }}m
                                                        </td>
                                                    @else
                                                        <td class="py-3 px-4">{{ $data->kesimpulan }}</td>
                                                    @endif
                                                    <td class="py-3 px-4">{{ $data->tgl_inspeksi }}</td>
                                                    <td class="py-3 px-4">
                                                        <span
                                                            class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                                            {{ $data->status }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        <a href="{{ route($data->route_name, $data->id) }}"
                                                            class="text-blue-500 hover:text-blue-700 hover:underline flex items-center">

                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                                                        Tidak ada data yang perlu ditinjau
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Modern Pagination -->
                                    @if ($allUnapproved->hasPages())
                                        <div class="mt-6 flex items-center justify-between">
                                            <div class="text-sm text-gray-700">
                                                Menampilkan <span
                                                    class="font-medium">{{ $allUnapproved->firstItem() }}</span>
                                                sampai <span
                                                    class="font-medium">{{ $allUnapproved->lastItem() }}</span>
                                                dari <span class="font-medium">{{ $allUnapproved->total() }}</span>
                                                hasil
                                            </div>
                                            <div class="flex space-x-2">
                                                <!-- Previous Page Link -->
                                                @if ($allUnapproved->onFirstPage())
                                                    <span
                                                        class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">
                                                        &laquo;
                                                    </span>
                                                @else
                                                    <a href="{{ $allUnapproved->previousPageUrl() }}"
                                                        class="px-3 py-1 rounded border border-gray-300 hover:bg-gray-100 transition-colors">
                                                        &laquo;
                                                    </a>
                                                @endif

                                                <!-- Current Page -->
                                                <span class="px-3 py-1 rounded bg-blue-500 text-white">
                                                    {{ $allUnapproved->currentPage() }}
                                                </span>

                                                <!-- Next Page (if exists) -->
                                                @if ($allUnapproved->hasMorePages())
                                                    <a href="{{ $allUnapproved->nextPageUrl() }}"
                                                        class="px-3 py-1 rounded border border-gray-300 hover:bg-gray-100 transition-colors">
                                                        {{ $allUnapproved->currentPage() + 1 }}
                                                    </a>
                                                @endif

                                                <!-- Next Page Link -->
                                                @if ($allUnapproved->hasMorePages())
                                                    <a href="{{ $allUnapproved->nextPageUrl() }}"
                                                        class="px-3 py-1 rounded border border-gray-300 hover:bg-gray-100 transition-colors">
                                                        &raquo;
                                                    </a>
                                                @else
                                                    <span
                                                        class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">
                                                        &raquo;
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    {{-- <tbody>
                                            @forelse ($allUnapproved as $data)
                                                <tr class="border-b">
                                                    <td class="py-3 px-4">
                                                        {{ $data->jenisForm ? $data->jenisForm->nama_form : '-' }}
                                                    </td>
                                                    @if ($data instanceof App\Models\CablePower || $data instanceof App\Models\Conductor)
                                                        <td class="py-3 px-4">
                                                            K6: {{ $data->kesimpulan_k6 }}m <br>
                                                            K8: {{ $data->kesimpulan_k8 }}m
                                                        </td>
                                                    @else
                                                        <td class="py-3 px-4">{{ $data->kesimpulan }}</td>
                                                    @endif
                                                    <td class="py-3 px-4">{{ $data->tgl_inspeksi }}</td>
                                                    <td class="py-3 px-4 text-yellow-600">{{ $data->status }}</td>
                                                    <td class="py-3 px-4">
                                                        <a href="{{ route($data->route_name, $data->id) }}"
                                                            class="text-blue-500 hover:underline">Lihat Detail</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                                                        Tidak ada data yang perlu ditinjau
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $allUnapproved->links() }}
                                    </div> --}}
                                </div>
                            </div>
                        </div>


                        <!-- Chart Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <!-- Pie Chart: Distribusi Kategori Material Retur -->
                            <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-center">
                                <div class="w-2/3">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Jumlah Barang berdasarkan
                                        kesimpulan</h2>
                                    <div class="h-64">
                                        <canvas id="materialCategoryChart"></canvas>
                                    </div>
                                </div>
                                <div class="w-2/3 text-center border-l pl-4">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Total Inspeksi</h3>
                                        <p class="text-2xl font-semibold text-blue-600" id="totalInspeksi">
                                            {{ $totalFormsByGudang }}</p>
                                </div>
                            </div>


                            <!-- Line Chart: Tren Barang yang Di Retur -->
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h2 class="text-lg font-semibold mb-4 text-gray-700">Tren Barang yang Di Retur</h2>
                                <div class="h-64">
                                    <canvas id="returItemTrendChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script untuk Chart -->
            <script>
                // Pie Chart: Distribusi Kategori Material Retur
                document.addEventListener("DOMContentLoaded", function() {
                    const materialCategoryData = {
                        labels: ['K6', 'K7', 'K8'],
                        datasets: [{
                            data: [{{ $totalCategoriesByGudang['K6'] }}, {{ $totalCategoriesByGudang['K7'] }},
                                {{ $totalCategoriesByGudang['K8'] }}
                            ],
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                        }]
                    };

                    const ctx = document.getElementById('materialCategoryChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: materialCategoryData,
                    });
                });
            </script>

            <script>
                // Line Chart: Tren Barang yang Di Retur
                document.addEventListener("DOMContentLoaded", function() {
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                    const returItemTrendData = {
                        labels: months,
                        datasets: [{
                            label: 'KWH Meter',
                            data: {!! json_encode(array_values($returData['KWH Meter'])) !!},
                            borderColor: '#36A2EB',
                            fill: false,
                        }, {
                            label: 'MCB',
                            data: {!! json_encode(array_values($returData['MCB'])) !!},
                            borderColor: '#FFCE56',
                            fill: false,
                        }, {
                            label: 'Trafo',
                            data: {!! json_encode(array_values($returData['Trafo'])) !!},
                            borderColor: '#FF6384',
                            fill: false,
                        }, {
                            label: 'Cable Power',
                            data: {!! json_encode(array_values($returData['Cable Power'])) !!},
                            borderColor: '#4BC0C0',
                            fill: false,
                        }, {
                            label: 'Conductor',
                            data: {!! json_encode(array_values($returData['Conductor'])) !!},
                            borderColor: '#9966FF',
                            fill: false,
                        }, {
                            label: 'Trafo Arus',
                            data: {!! json_encode(array_values($returData['Trafo Arus'])) !!},
                            borderColor: '#E74C3C',
                            fill: false,
                        }, {
                            label: 'Trafo Tegangan',
                            data: {!! json_encode(array_values($returData['Trafo Tegangan'])) !!},
                            borderColor: '#2ECC71',
                            fill: false,
                        }, {
                            label: 'Tiang Listrik',
                            data: {!! json_encode(array_values($returData['Tiang Listrik'])) !!},
                            borderColor: '#F39C12',
                            fill: false,
                        }, {
                            label: 'LBS',
                            data: {!! json_encode(array_values($returData['LBS'])) !!},
                            borderColor: '#1ABC9C',
                            fill: false,
                        }, {
                            label: 'Isolator',
                            data: {!! json_encode(array_values($returData['Isolator'])) !!},
                            borderColor: '#9B59B6',
                            fill: false,
                        }, {
                            label: 'Lightning Arrester',
                            data: {!! json_encode(array_values($returData['Lightning Arrester'])) !!},
                            borderColor: '#34495E',
                            fill: false,
                        }, {
                            label: 'Fuse Cut Out',
                            data: {!! json_encode(array_values($returData['Fuse Cut Out'])) !!},
                            borderColor: '#D35400',
                            fill: false,
                        }, {
                            label: 'PHBTR',
                            data: {!! json_encode(array_values($returData['PHBTR'])) !!},
                            borderColor: '#7F8C8D',
                            fill: false,
                        }, {
                            label: 'Cubicle',
                            data: {!! json_encode(array_values($returData['Cubicle'])) !!},
                            borderColor: '#BDC3C7',
                            fill: false,
                        }, {
                            label: 'Kotak APP',
                            data: {!! json_encode(array_values($returData['Kotak APP'])) !!},
                            borderColor: '#C0392B',
                            fill: false,
                        }]
                    };

                    const ctx = document.getElementById('returItemTrendChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: returItemTrendData,
                    });
                });
            </script>
        @elseif (auth()->user()->hasRole('Petugas'))
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Dashboard Pengiriman Formulir & Pengantaran Barang</h5>
                        <hr class="mb-3">

                        <!-- Notifikasi Unapproved -->
                        @if ($unapprovedForms->isNotEmpty())
                            @foreach ($unapprovedForms as $index => $form)
                                <div id="notification-{{ $index }}"
                                    data-id="notification-{{ $index }}"
                                    class="notification relative bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 hover:bg-yellow-200 transition duration-300 ease-in-out">

                                    <!-- Tombol Close -->
                                    <button onclick="closeNotification('notification-{{ $index }}')"
                                        class="absolute top-2 right-2 text-yellow-700 hover:text-yellow-900">
                                        &times;
                                    </button>

                                    <!-- Isi Notifikasi -->
                                    <a href="{{ route('form-unapproved') }}" class="block">
                                        <p class="font-bold">Notifikasi</p>
                                        <p>Material {{ $form->nama_form }} dengan nomor surat {{ $form->no_surat }}
                                            menunggu persetujuan PIC Gudang.</p>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500">Tidak ada material yang perlu diantar ke gudang.</p>
                        @endif

                        <!-- Notifikasi Approved -->
                        @if ($approvedForms->isNotEmpty())
                            @foreach ($approvedForms as $index => $form)
                                <div id="approved-notification-{{ $index }}"
                                    data-id="approved-notification-{{ $index }}"
                                    class="notification relative bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 hover:bg-green-200 transition duration-300 ease-in-out">

                                    <!-- Tombol Close -->
                                    <button
                                        onclick="closeNotification('approved-notification-{{ $index }}', true)"
                                        class="absolute top-2 right-2 text-green-700 hover:text-green-900">
                                        &times;
                                    </button>

                                    <!-- Isi Notifikasi -->
                                    <a href="#" class="block">
                                        <p class="font-bold">Notifikasi</p>
                                        <p>Material {{ $form->nama_form }} dengan nomor surat
                                            {{ $form->no_surat }}
                                            telah disetujui oleh PIC Gudang. Klik untuk melihat detail.</p>
                                    </a>
                                </div>
                            @endforeach
                        @endif


                        <!-- Statistik Utama -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            <!-- Kartu di Kiri -->
                            <div class="md:col-span-1 space-y-6">
                                <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-blue-500">
                                    <h2 class="text-lg font-semibold mb-4">Formulir Dikirim</h2>
                                    <p class="text-4xl font-bold">{{ $totalForms ?? 0 }}</p>
                                </div>
                                <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-purple-500">
                                    <h2 class="text-lg font-semibold mb-4">Barang Perlu Diantar</h2>
                                    <p class="text-4xl font-bold">{{ $totalUnapproved ?? 0 }}</p>
                                </div>
                            </div>

                            <!-- Chart di Kanan -->
                            <div
                                class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row justify-between items-center">
                                <div class="w-full md:w-2/3">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Jumlah Material Retur
                                        berdasarkan
                                        Kesimpulan</h2>
                                    <div class="h-64">
                                        <canvas id="deliveryStatusChart"></canvas>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/3 text-center border-l pl-4 mt-4 md:mt-0">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Total Inspeksi</h2>
                                    <p class="text-2xl font-semibold text-blue-600" id="totalInspeksi">
                                        {{ $totalForms }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script untuk Chart -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Ambil data dari Blade
                    const totalApproved = @json($totalApproved);
                    const totalUnapproved = @json($totalUnapproved);

                    // Data untuk Pie Chart
                    const deliveryStatusData = {
                        labels: ['Sudah di Approve', 'Belum di Approve'],
                        datasets: [{
                            data: [totalApproved, totalUnapproved], // Gunakan data dari backend
                            backgroundColor: ['#36A2EB', '#FF6384'],
                        }]
                    };

                    // Render Pie Chart
                    new Chart(document.getElementById('deliveryStatusChart'), {
                        type: 'pie',
                        data: deliveryStatusData,
                    });
                });

                // Line Chart: Tren Pengiriman Formulir
                const formSubmissionTrendData = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Formulir Dikirim',
                        data: @json($formSubmissionData),
                        borderColor: '#36A2EB',
                        fill: false,
                    }]
                };

                const formSubmissionTrendChart = new Chart(document.getElementById('formSubmissionTrendChart'), {
                    type: 'line',
                    data: formSubmissionTrendData,
                });
            </script>
            <!-- Script untuk Menutup Notifikasi -->
            <script>
                function closeNotification(id, isApproved = false) {
                    let notification = document.getElementById(id);
                    if (notification) {
                        notification.style.display = 'none';

                        // Jika notifikasi adalah "approved", simpan ke localStorage
                        if (isApproved) {
                            let closedNotifications = JSON.parse(localStorage.getItem('closedApprovedNotifications')) || [];
                            if (!closedNotifications.includes(id)) {
                                closedNotifications.push(id);
                                localStorage.setItem('closedApprovedNotifications', JSON.stringify(closedNotifications));
                            }
                        }
                    }
                }

                function checkNotifications() {
                    let closedApprovedNotifications = JSON.parse(localStorage.getItem('closedApprovedNotifications')) || [];
                    document.querySelectorAll('.notification').forEach(notification => {
                        let notificationId = notification.getAttribute('data-id');

                        // Jika notifikasi termasuk dalam kategori approved dan sudah ditutup sebelumnya, sembunyikan
                        if (notificationId.startsWith('approved-notification') && closedApprovedNotifications.includes(
                                notificationId)) {
                            notification.style.display = 'none';
                        }
                    });
                }

                // Cek status notifikasi saat halaman dimuat
                document.addEventListener('DOMContentLoaded', checkNotifications);
            </script>


        @endif
    </div>
</div>

<x-layouts.footer />
