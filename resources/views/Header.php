<!DOCTYPE html>
<html lang="en">

<!-- kesimpulan dari tiang listrik -->
// Fungsi untuk mengupdate kesimpulan
        // function updateKesimpulan() {
        //     const kesimpulanDropdown = document.getElementById('kesimpulan');
        //     if (!kesimpulanDropdown) {
        //         console.error("Dropdown kesimpulan tidak ditemukan");
        //         return;
        //     }

        //     const tahunProduksi = parseInt(document.getElementById('tahun_produksi')?.value) || 0;
        //     const pengujianVisual = document.getElementById('pengujian_visual')?.value || '';
        //     const kelurusanTiang = document.getElementById('kelurusan_tiang')?.value || '';
        //     const kualitasPenyambung = document.getElementById('kualitas_penyambungan')?.value || 'Baik';
        //     const panjangInput = document.getElementById('pengujian_panjang')?.value || '';
        //     const panjang = parseFloat(panjangInput.replace(',', '.')) || 0;
        //     const tipeTiang = document.getElementById('tipe_tiang_listrik')?.value || '';

        //     const umurMaterial = new Date().getFullYear() - tahunProduksi;
        //     let kesimpulan = '';

        //     // Validasi panjang berdasarkan tipe tiang
        //     let panjangValid = false;
        //     if (tipeTiang) {
        //         const panjangOptions = {
        //             "9/100": [9],
        //             "9/200": [9],
        //             "9/350": [9],
        //             "11/200": [11],
        //             "11/350": [11],
        //             "11/500": [11],
        //             "12/200": [12],
        //             "12/350": [12],
        //             "12/500": [12],
        //             "12/800": [12],
        //             "12/1200": [12],
        //             "13/200": [13],
        //             "13/350": [13],
        //             "13/500": [13],
        //             "13/800": [13],
        //             "13/1200": [13],
        //             "14/200": [14],
        //             "14/350": [14],
        //             "14/500": [14],
        //             "14/800": [14],
        //             "14/1200": [14]
        //         };

        //         if (panjangOptions[tipeTiang]) {
        //             panjangValid = panjangOptions[tipeTiang].some(validLength => {
        //                 return Math.abs(panjang - validLength) < 0.1; // toleransi 0.1
        //             });
        //         }
        //     }

        //     // Logika penentuan kesimpulan
        //     // if (umurMaterial > 40) {
        //     //     kesimpulan = 'Bekas tidak layak pakai (K8)';
        //     // } else if (pengujianVisual === 'Baik' && kelurusanTiang === 'Baik' && panjangValid) {
        //     //     kesimpulan = 'Bekas layak pakai (K6)';
        //     // } else if (kelurusanTiang === 'Rusak' || (tipeTiang !== 'Beton' && kualitasPenyambung ===
        //     //     'Rusak')) {
        //     //     kesimpulan = 'Bekas tidak layak pakai (K8)';
        //     // } else {
        //     //     kesimpulan = 'Bekas bisa diperbaiki (K7)';
        //     // }

        //     // Logika penentuan kesimpulan
        //     if (umurMaterial > 40) {
        //         kesimpulan = 'Bekas tidak layak pakai (K8)';
        //     } else {
        //         if (pengujianVisual === 'Baik' && kelurusanTiang === 'Baik' && panjangValid) {
        //             kesimpulan = 'Bekas layak pakai (K6)';
        //         } else if (kelurusanTiang === 'Rusak' || kualitasPenyambung === 'Rusak') {
        //             kesimpulan = 'Bekas tidak layak pakai (K8)';
        //         } else {
        //             kesimpulan = 'Bekas bisa diperbaiki (K7)';
        //         }
        //     }

        //     // Set nilai kesimpulan
        //     kesimpulanDropdown.value = kesimpulan;

        //     // Jika role user adalah Petugas, set kesimpulan menjadi readonly
        //     if ({{ auth()->user()->hasRole('Petugas') ? 'true' : 'false' }}) {
        //         kesimpulanDropdown.setAttribute('readonly', true);
        //     }
        // }
        // Fungsi untuk mengupdate kesimpulan (Versi Diperbaiki)
        // function updateKesimpulan() {
        //     try {
        //         const kesimpulanDropdown = $('#kesimpulan'); // Menggunakan jQuery untuk Select2
        //         if (!kesimpulanDropdown.length) {
        //             console.error("Dropdown kesimpulan tidak ditemukan");
        //             return;
        //         }

        //         // Ambil nilai dengan default value yang aman
        //         const tahunProduksi = parseInt($('#tahun_produksi').val()) || 0;
        //         const pengujianVisual = $('#pengujian_visual').val() || 'Baik';
        //         const kelurusanTiang = $('#kelurusan_tiang').val() || 'Baik';
        //         const kualitasPenyambung = $('#kualitas_penyambungan').val() || 'Baik';
        //         const panjangInput = $('#pengujian_panjang').val() || '0';
        //         const tipeTiang = $('#tipe_tiang_listrik').val() || '';

        //         // Konversi panjang yang aman (handle both comma and dot decimal)
        //         const panjang = parseFloat(panjangInput.toString().replace(',', '.')) || 0;

        //         const umurMaterial = new Date().getFullYear() - tahunProduksi;
        //         let kesimpulan = 'Bekas tidak layak pakai (K8)'; // Default value

        //         // Validasi panjang berdasarkan tipe tiang
        //         let panjangValid = false;
        //         const panjangOptions = {
        //             "9/100": [9],
        //             "9/200": [9],
        //             "9/350": [9],
        //             "11/200": [11],
        //             "11/350": [11],
        //             "11/500": [11],
        //             "12/200": [12],
        //             "12/350": [12],
        //             "12/500": [12],
        //             "12/800": [12],
        //             "12/1200": [12],
        //             "13/200": [13],
        //             "13/350": [13],
        //             "13/500": [13],
        //             "13/800": [13],
        //             "13/1200": [13],
        //             "14/200": [14],
        //             "14/350": [14],
        //             "14/500": [14],
        //             "14/800": [14],
        //             "14/1200": [14]
        //         };

        //         if (tipeTiang && panjangOptions[tipeTiang]) {
        //             panjangValid = panjangOptions[tipeTiang].some(validLength => {
        //                 return Math.abs(panjang - validLength) <= 0.15; // toleransi 15cm
        //             });
        //         }

        //         // Logika penentuan kesimpulan yang lebih robust
        //         // if (umurMaterial <= 40) {
        //         //     if (pengujianVisual === 'Baik' && kelurusanTiang === 'Baik' && panjangValid) {
        //         //         kesimpulan = 'Bekas layak pakai (K6)';
        //         //     } else if (kelurusanTiang !== 'Rusak' &&
        //         //         (tipeTiang === 'Beton' || kualitasPenyambung === 'Baik')) {
        //         //         kesimpulan = 'Bekas bisa diperbaiki (K7)';
        //         //     }
        //         // }
        //         // Logika penentuan kesimpulan yang diperbaiki
        //         if (umurMaterial <= 40) {
        //             // Kondisi untuk K6 - Semua parameter harus baik
        //             if (pengujianVisual === 'Baik' &&
        //                 kelurusanTiang === 'Baik' &&
        //                 kualitasPenyambung === 'Baik' &&
        //                 panjangValid) {
        //                 kesimpulan = 'Bekas layak pakai (K6)';
        //             }
        //             // Kondisi untuk K7 - Minimal tidak ada yang rusak parah
        //             else if (kelurusanTiang !== 'Rusak' ||
        //                 pengujianVisual !== 'Rusak' ||
        //                 kualitasPenyambung !== 'Rusak') {
        //                 kesimpulan = 'Bekas bisa diperbaiki (K7)';
        //             }
        //         }

        //         // Update nilai kesimpulan dengan handling Select2
        //         kesimpulanDropdown.val(kesimpulan).trigger('change');

        //         document.getElementById('kesimpulan').value = kesimpulan;
        //         console.log('Kesimpulan di-set ke: ', kesimpulan);


        //         // Jika role user adalah Petugas, kunci dropdown
        //         if ({{ auth()->user()->hasRole('Petugas') ? 'true' : 'false' }}) {
        //             kesimpulanDropdown.prop('disabled', true);

        //             // Alternatif penguncian yang lebih kuat
        //             kesimpulanDropdown.on('select2:opening', function(e) {
        //                 e.preventDefault();
        //             });

        //             kesimpulanDropdown.next('.select2-container').css({
        //                 'pointer-events': 'none',
        //                 'background-color': '#f8f9fa',
        //                 'opacity': 1
        //             });
        //         }

        //     } catch (error) {
        //         console.error("Error dalam updateKesimpulan:", error);
        //     }
        // }




<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css"><!-- DataTables CSS -->
	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Feather Icons -->
	<script src="https://unpkg.com/feather-icons"></script>

	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../../assets/css/style.css">

	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.min.css">

	<!-- jQuery (wajib untuk Select2 dan DataTables) -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

	<!-- Select2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Select2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<!-- DataTables JS -->
	<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

	<style>
		.pcoded-header {
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 1030;
		}

		.pcoded-navbar {
			position: fixed;
			top: 0;
			left: 0;
			width: 250px;
			height: 100vh;
			overflow-y: auto;
			z-index: 1030;
		}

		.main-content {
			margin-left: 250px;
			margin-top: 56px;
			height: calc(100vh - 56px);
			overflow-y: auto;
			padding: 20px;
			background: #f4f4f4;
		}
	</style>
</head>

<body class="pt-16">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar">
		<div class="navbar-wrapper">
			<div class="navbar-content scroll-div">
				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
						<div class="user-details">
							<span>Mita</span>
							<div>Admin</div>
						</div>
					</div>
				</div>

				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li>
					<li class="nav-item">
						<a href="index.php" class="nav-link "><span class="pcoded-micon"><i
									class="bi bi-house"></i></span><span class="pcoded-mtext">Home</span></a>
					</li>
					<li class="nav-item pcoded-menu-caption">
						<label>Material Retur</label>
					</li>
					<li class="nav-item">
						<a href="unapproved.php" class="nav-link "><span class="pcoded-micon"><i
									class="bi bi-file-earmark-x"></i></span><span
								class="pcoded-mtext">Unapproved</span></a>
					</li>
					<li class="nav-item">
						<a href="material-retur.php" class="nav-link "><span class="pcoded-micon"><i
									class="bi bi-box-seam"></i></span><span class="pcoded-mtext">Form Material
								Retur</span></a>
					</li>
					<li class="nav-item">
						<a href="laporan.php" class="nav-link "><span class="pcoded-micon"><i
									class="bi bi-file-earmark-text"></i></span><span
								class="pcoded-mtext">Laporan</span></a>
					</li>
					<li class="nav-item pcoded-menu-caption">
						<label>Administration</label>
					</li>
					<li class="nav-item">
						<a href="user.php" class="nav-link "><span class="pcoded-micon"><i
									class="bi bi-people"></i></span><span class="pcoded-mtext">Manajemen
								User</span></a>
					</li>
					<li class="nav-item">
						<a href="user.php" class="nav-link "><span class="pcoded-micon"><i
									class="bi bi-box-arrow-right"></i></span><span class="pcoded-mtext">Logout
							</span></a>
					</li>
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
			<a href="#!" class="mob-toggler">
				<i class="feather icon-more-vertical"></i>
			</a>
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