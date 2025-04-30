<x-layouts.header />
<style>
    .non-active-user {
        background-color: rgba(255, 0, 0, 0.1) !important;
    }

    /* Untuk memastikan warna tetap konsisten saat hover */
    .non-active-user:hover {
        background-color: rgba(255, 0, 0, 0.2) !important;
    }
</style>

<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar User</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <!-- Filter Gudang -->
                            <div class="col-md-4">
                                <label for="filterGudang">Filter Gudang:</label>
                                <select id="filterGudang" class="form-control">
                                    <option value="">Semua</option>
                                    @foreach ($gudangList as $gudang)
                                        <option value="{{ $gudang->id }}">{{ $gudang->nama_gudang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pencarian -->
                            <div class="col-md-4">
                                <label for="searchInput">Pencarian:</label>
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Cari berdasarkan nama atau email...">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="table_id" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>No Handphone</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th id="gudangHeader">Gudang Retur</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allUsers as $index => $user)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->no_hp }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <select class="form-control role-select"
                                                    data-user-id="{{ $user->id }}">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control gudang-select"
                                                    data-user-id="{{ $user->id }}">
                                                    <option value="">Pilih Gudang</option>
                                                    @foreach ($gudangList as $gudang)
                                                        <option value="{{ $gudang->id }}"
                                                            {{ $user->gudang_id == $gudang->id ? 'selected' : '' }}>
                                                            {{ $gudang->nama_gudang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control status-select"
                                                    data-user-id="{{ $user->id }}">
                                                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>
                                                        Aktif</option>
                                                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>
                                                        Non-Aktif</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $allUsers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            let table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('manajemen-user.fetch') }}",
                    type: "GET",
                    data: function(d) {
                        d.gudang_id = $('#filterGudang').val();
                        d.search = $('#searchInput').val();
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "no_hp"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "role_name",
                        render: function(data, type, row) {
                            let roleOptions = @json($roles->pluck('name')->toArray());
                            let select =
                                `<select class="form-control role-select" data-user-id="${row.id}">`;
                            roleOptions.forEach(role => {
                                let selected = (role === data) ? "selected" : "";
                                select +=
                                    `<option value="${role}" ${selected}>${role}</option>`;
                            });
                            return select + `</select>`;
                        }
                    },
                    {
                        data: "gudang_id",
                        render: function(data, type, row) {
                            if (row.role_name === 'Petugas') {
                                return '<span class="gudang-placeholder">Tidak tersedia untuk Petugas</span>';
                            }

                            let dropdown =
                                `<select class="form-control gudang-select" data-user-id="${row.id}">`;
                            dropdown += `<option value="">Pilih Gudang</option>`;
                            @foreach ($gudangList as $gudang)
                                dropdown +=
                                    `<option value="{{ $gudang->id }}" ${data == {{ $gudang->id }} ? 'selected' : ''}>{{ $gudang->nama_gudang }}</option>`;
                            @endforeach
                            return dropdown + `</select>`;
                        }
                    },
                    {
                        data: "is_active",
                        render: function(data, type, row) {
                            return `<select class="form-control status-select" data-user-id="${row.id}">
                        <option value="1" ${data == 1 ? 'selected' : ''}>Aktif</option>
                        <option value="0" ${data == 0 ? 'selected' : ''}>Non-Aktif</option>
                    </select>`;
                        }
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    if (data.is_active == 0) {
                        $(row).addClass('non-active-user');
                    }
                },
                // Hapus drawCallback karena kita akan menggunakan delegated events
                order: [
                    [4, 'asc']
                ] // Kolom ke-4 adalah role_name
            });

            // Fungsi untuk mendapatkan nilai urutan role
            function getRoleOrderValue(roleName) {
                const roleOrder = {
                    'Admin': 1,
                    'PIC_Gudang': 2,
                    'Petugas': 3
                };
                return roleOrder[roleName] || 4; // Default jika role tidak dikenali
            }

            // Delegated event handlers (hanya dipasang sekali)
            $(document)
                // Handle perubahan role
                .off('change', '.role-select').on('change', '.role-select', function() {
                    const $row = $(this).closest('tr');
                    const userId = $(this).data('user-id');
                    const newRole = $(this).val();
                    const $gudangCell = $row.find('td:eq(5)');

                    // Update tampilan inputan Gudang Retur
                    if (newRole === 'Petugas') {
                        $gudangCell.html(
                            '<span class="gudang-placeholder">Tidak tersedia untuk Petugas</span>');
                    } else {
                        let dropdown =
                            `<select class="form-control gudang-select" data-user-id="${userId}">`;
                        dropdown += `<option value="">Pilih Gudang</option>`;
                        @foreach ($gudangList as $gudang)
                            dropdown +=
                                `<option value="{{ $gudang->id }}">{{ $gudang->nama_gudang }}</option>`;
                        @endforeach
                        dropdown += `</select>`;
                        $gudangCell.html(dropdown);
                    }

                    // AJAX call untuk update role
                    $.ajax({
                        url: `/manajemen-user/${userId}/update-role`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            role: newRole
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Role berhasil diupdate!');
                                table.order([4, 'asc']).draw();
                            }
                        }
                    });
                })
                // Handle perubahan gudang
                .off('change', '.gudang-select').on('change', '.gudang-select', function() {
                    let userId = $(this).data('user-id');
                    let newGudangId = $(this).val();

                    $.ajax({
                        url: `/manajemen-user/${userId}/update-gudang`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            gudang_id: newGudangId
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Gudang berhasil diupdate!');
                            }
                        }
                    });
                })
                // Handle perubahan status
                .off('change', '.status-select').on('change', '.status-select', function() {
                    let userId = $(this).data('user-id');
                    let newStatus = $(this).val();
                    const $row = $(this).closest('tr');

                    if (newStatus == 0) {
                        $row.addClass('non-active-user');
                    } else {
                        $row.removeClass('non-active-user');
                    }

                    $.ajax({
                        url: `/manajemen-user/${userId}/update-status`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: newStatus
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Status berhasil diupdate!');
                            }
                        }
                    });
                });

            // Filter pencarian & gudang
            $('#filterGudang, #searchInput').on('input change', function() {
                table.ajax.reload();
            });
        });
    </script>
    <x-layouts.footer />
