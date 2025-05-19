<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Form Retur MDU" />
    <meta name="keywords" content="FRM">
    <meta name="author" content="PT PLN UID Riau dan Kepulauan Riau" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('icons/ic_launcher.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>Formulir Inspeksi Material Retur</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('icons/ic_launcher.png') }}" type="image/x-icon">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(() => console.log('Service Worker registered'));
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('templatev2/dist/assets/css/style.css') }}">
    <!-- vendor css -->
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('templatev2/dist/assets/css/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.min.css">
    <!-- jQuery (wajib untuk Select2 dan DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        :root {
            --primary-cyan: #06b6d4;
            --primary-cyan-dark: #0e7490;
            --primary-cyan-light: #a5f3fc;
            --accent-teal: #0d9488;
            --text-light: #f0f9ff;
            --text-dark: #083344;
        }

        /* Modern Header with subtle shadow */
        .pcoded-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
            background: var(--primary-cyan) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Modern Navbar with gradient */
        .pcoded-navbar {
            position: fixed;
            z-index: 1020;
            overflow-y: auto;
            background: linear-gradient(180deg, var(--primary-cyan-dark) 0%, #164e63 100%) !important;
        }

        /* Active navigation link - modern teal accent */
        .pcoded-navbar .nav-item.active>.nav-link,
        .pcoded-navbar .nav-item.pcoded-trigger>.nav-link {
            background: rgba(13, 148, 136, 0.3) !important;
            color: var(--primary-cyan-light) !important;
            border-left: 3px solid var(--accent-teal);
        }

        /* Default navbar link */
        .pcoded-navbar .nav-link {
            color: var(--text-light) !important;
            transition: all 0.2s ease;
        }

        /* Hover state - subtle effect */
        .pcoded-navbar .nav-link:hover {
            background: rgba(166, 243, 252, 0.1) !important;
            color: var(--primary-cyan-light) !important;
            transform: translateX(2px);
        }

        /* Menu caption - modern typography */
        .pcoded-navbar .pcoded-menu-caption {
            color: var(--primary-cyan-light) !important;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-bottom: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            opacity: 0.8;
        }

        /* User profile section */
        .main-menu-header {
            background: rgba(6, 182, 212, 0.2) !important;
            border-bottom: none;
        }

        .user-details span {
            color: white !important;
            font-weight: 500;
        }

        .user-details div {
            color: var(--primary-cyan-light) !important;
            opacity: 0.8;
        }

        /* Modern input styling */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Main content area */
        .main-content {
            margin-left: 250px;
            margin-top: 56px;
            height: calc(100vh - 56px);
            overflow-y: auto;
            padding: 24px;
            background: #f8fafc;
        }

        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-cyan);
            border-radius: 4px;
        }

        /* Responsive tahun_pemasangan */
        /* For width 400px and larger: */
        @media only screen and (max-width: 360px) {
            .tahun_pemasangan {
                font-size: 13px;
                line-height: 1px;
                margin-bottom: 2px;
            }

            .jenis_cable_power {
                font-size: 13px;
                line-height: 1px;
            }
        }

        /* Add these styles to your existing style section */
        .dropdown-menu {
            min-width: 180px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.25rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
        }
    </style>
</head>

<body class="pt-16">
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-content scroll-div">
                {{-- Ver1 --}}
                <div class="main-menu-header">
                    <div class="d-flex align-items-center gap-3 p-3 mt-4 pt-4">
                        @php
                            $profilePath = public_path('profile_pictures/' . $user->profile_picture);
                        @endphp

                        <div class="rounded-circle overflow-hidden border border-light"
                            style="width: 48px; height: 48px; flex-shrink: 0;">
                            <img src="{{ $user->profile_picture && file_exists($profilePath)
                                ? asset('profile_pictures/' . $user->profile_picture)
                                : asset('icons/user.png') }}"
                                alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <!-- Profile Picture - Perfect Circle -->
                        {{-- <div class="profile-picture">
                            <div class="rounded-circle overflow-hidden border border-light"
                                style="width: 48px; height: 48px; flex-shrink: 0;">
                                <img src="{{ $user->profile_picture ? asset('profile_pictures/' . $user->profile_picture) : asset('icons/user.png') }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div> --}}

                        <!-- User Details -->
                        <div class="user-details">
                            <div class="text-white fw-semibold" style="line-height: 1.2;">{{ $user->name }}</div>
                            <div class="text-light small opacity-75 text-xs" style="line-height: 1.2;">
                                {{ auth()->user()->roles->first()->desc ?? 'Tidak ada role' }}
                                @if (auth()->user()->hasRole('PIC_Gudang') && auth()->user()->gudang)
                                    <span class="d-block mt-1">{{ auth()->user()->gudang->nama_gudang }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Original --}}
                {{-- <div class="">
                    <div class="main-menu-header">
                        <div class="user-details mt-3">
                            <span>{{ $user->name }}</span>
                            <div id="more-details" class="text-sm">
                                {{ auth()->user()->roles->first()->desc ?? 'Tidak ada role' }}
                                @if (auth()->user()->hasRole('PIC_Gudang') && auth()->user()->gudang)
                                    <div>{{ auth()->user()->gudang->nama_gudang }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> --}}

                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    @if (auth()->user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-house"></i></span><span class="pcoded-mtext">Home</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Material Retur</label>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form-unapproved') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-file-earmark-x"></i></span><span
                                    class="pcoded-mtext">Unapproved</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('forms') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-box-seam"></i></span><span class="pcoded-mtext">Form Material
                                    Retur</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manajemen-laporan') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-file-earmark-text"></i></span><span
                                    class="pcoded-mtext">Laporan</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Administration</label>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manajemen-user.index') }}" class="nav-link "><span
                                    class="pcoded-micon"><i class="bi bi-people"></i></span><span
                                    class="pcoded-mtext">Manajemen
                                    User</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('edit-profile.edit') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-person-fill-gear"></i></span><span class="pcoded-mtext">Edit
                                    Profile</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="logoutUser()"><span class="pcoded-micon"><i
                                        class="bi bi-box-arrow-right"></i></span><span class="pcoded-mtext">Logout
                                </span></a>
                        </li>
                    @elseif(auth()->user()->hasRole('PIC_Gudang'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-house"></i></span><span class="pcoded-mtext">Home</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Material Retur</label>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form-unapproved') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-file-earmark-x"></i></span><span
                                    class="pcoded-mtext">Unapproved</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-file-earmark-text"></i></span><span
                                    class="pcoded-mtext">Laporan</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Administration</label>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('edit-profile.edit') }}" class="nav-link "><span
                                    class="pcoded-micon"><i class="bi bi-person-fill-gear"></i></span><span
                                    class="pcoded-mtext">Edit Profile</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="logoutUser()"><span class="pcoded-micon"><i
                                        class="bi bi-box-arrow-right"></i></span><span class="pcoded-mtext">Logout
                                </span></a>
                        </li>
                    @elseif(auth()->user()->hasRole('Petugas'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-house"></i></span><span class="pcoded-mtext">Home</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Material Retur</label>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('forms') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-box-seam"></i></span><span class="pcoded-mtext">Form Material
                                    Retur</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form-unapproved') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-file-earmark-x"></i></span><span
                                    class="pcoded-mtext">Unapproved</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="bi bi-file-earmark-text"></i></span><span
                                    class="pcoded-mtext">Approved</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Administration</label>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('edit-profile.edit') }}" class="nav-link "><span
                                    class="pcoded-micon"><i class="bi bi-person-fill-gear"></i></span><span
                                    class="pcoded-mtext">Edit Profile</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="logoutUser()"><span class="pcoded-micon"><i
                                        class="bi bi-box-arrow-right"></i></span><span class="pcoded-mtext">Logout
                                </span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->



    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark fixed-top">

        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <h6 style="color: white;">MATERIAL RETUR DISTRIBUSI</h6>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>
            </ul>
        </div>

    </header>
    <!-- [ Header ] end -->
