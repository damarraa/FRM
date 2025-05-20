<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CablePowerController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\CTController;
use App\Http\Controllers\CubicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FCOController;
use App\Http\Controllers\IsolatorController;
use App\Http\Controllers\KotakAPPController;
use App\Http\Controllers\KWHController;
use App\Http\Controllers\KWHMeterController;
use App\Http\Controllers\LAController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LBSController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\MCBController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PHBTRController;
use App\Http\Controllers\PicGudangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PTController;
use App\Http\Controllers\TiangListrikController;
use App\Http\Controllers\TrafoController;
use App\Http\Controllers\UnapprovedController;
use App\Models\Isolator;
use App\Models\KelasPengujian;
use App\Models\MCB;
use App\Models\ULP;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('login');
});

Route::get('/test-401', function() {
    abort(401);
});

Route::get('/test-403', function() {
    abort(403);
});

Route::get('/test-404', function() {
    abort(404);
});

Route::get('/test-419', function() {
    abort(419);
});

Route::get('/test-500', function() {
    abort(500);
});

Route::get('/test-503', function() {
    abort(503);
});

// Route::get('/offline', function () {
//     return view('offline');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk Admin
Route::middleware('auth', 'is_active', 'role:Admin')->group(function () {
    // Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    // -- Profile
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('edit-profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // -- Laporan
    Route::get('/manajemen-laporan', [LaporanController::class, 'index'])->name('manajemen-laporan')->middleware('permission:index_laporan');
    Route::get('/export-pdf-kwh/{id}', [PDFController::class, 'exportPDFkWh'])->name('exportPDF.kwh');
    Route::get('/export-pdf-mcb/{id}', [PDFController::class, 'exportPDFmcb'])->name('exportPDF.mcb');
    Route::get('/export-pdf-trafo/{id}', [PDFController::class, 'exportPDFtrafo'])->name('exportPDF.trafo');
    Route::get('/export-pdf-cable/{id}', [PDFController::class, 'exportPDFcable'])->name('exportPDF.cable');
    Route::get('/export-pdf-conductor/{id}', [PDFController::class, 'exportPDFconductor'])->name('exportPDF.conductor');
    Route::get('/export-pdf-ct/{id}', [PDFController::class, 'exportPDFct'])->name('exportPDF.ct');
    Route::get('/export-pdf-pt/{id}', [PDFController::class, 'exportPDFpt'])->name('exportPDF.pt');
    Route::get('/export-pdf-tiang-listrik/{id}', [PDFController::class, 'exportPDFtiangListrik'])->name('exportPDF.tiangListrik');
    Route::get('/export-pdf-lbs/{id}', [PDFController::class, 'exportPDFlbs'])->name('exportPDF.lbs');
    Route::get('/export-pdf-lightning-arrester/{id}', [PDFController::class, 'exportPDFlightningarrester'])->name('exportPDF.lightningArrester');
    Route::get('/export-pdf-isolator/{id}', [PDFController::class, 'exportPDFisolator'])->name('exportPDF.isolator');
    Route::get('/export-pdf-fco/{id}', [PDFController::class, 'exportPDFfco'])->name('exportPDF.fco');
    Route::get('/export-pdf-phbtr/{id}', [PDFController::class, 'exportPDFphbtr'])->name('exportPDF.phbtr');
    Route::get('/export-pdf-cubicle/{id}', [PDFController::class, 'exportPDFcubicle'])->name('exportPDF.cubicle');
    Route::get('/export-pdf-kotak-app/{id}', [PDFController::class, 'exportPDFkotakApp'])->name('exportPDF.kotakApp');

    // Export all data in excel
    Route::post('/export/bulk', [ExportController::class, 'handleBulkExport'])->name('export.bulk');
    Route::get('/export-excel-kwh/{id}', [ExportController::class, 'exportKWHById'])->name('exports.exkwh');
    Route::get('/export-excel-mcb/{id}', [ExportController::class, 'exportMCBById'])->name('exports.exmcb');
    Route::get('/export-excel-trafo/{id}', [ExportController::class, 'exportTRAFOById'])->name('exports.extrafo');
    Route::get('/export-excel-cable-power/{id}', [ExportController::class, 'exportCABLEById'])->name('exports.excable');
    Route::get('/export-excel-conductor/{id}', [ExportController::class, 'exportCONDUCTORById'])->name('exports.exconductor');
    Route::get('/export-excel-ct/{id}', [ExportController::class, 'exportCTById'])->name('exports.exct');
    Route::get('/export-excel-pt/{id}', [ExportController::class, 'exportPTById'])->name('exports.expt');
    Route::get('/export-excel-tiang-listrik/{id}', [ExportController::class, 'exportTIANGById'])->name('exports.extiang');
    Route::get('/export-excel-lbs/{id}', [ExportController::class, 'exportLBSById'])->name('exports.exlbs');
    Route::get('/export-excel-isolator/{id}', [ExportController::class, 'exportISOLATORById'])->name('exports.exisolator');
    Route::get('/export-excel-lightning-arrester/{id}', [ExportController::class, 'exportLAById'])->name('exports.exla');
    Route::get('/export-excel-fco/{id}', [ExportController::class, 'exportFCOById'])->name('exports.exfco');
    Route::get('/export-excel-phbtr/{id}', [ExportController::class, 'exportPHBTRById'])->name('exports.exphbtr');
    Route::get('/export-excel-cubicle/{id}', [ExportController::class, 'exportCUBICLEById'])->name('exports.excubicle');
    Route::get('/export-excel-kotak-app/{id}', [ExportController::class, 'exportKAPPById'])->name('exports.exkotakapp');

    Route::get('/preview-kwh/{id}', [PDFController::class, 'previewKWH'])->name('previewPDF.kwh');
    Route::get('/preview-mcb/{id}', [PDFController::class, 'previewMCB'])->name('previewPDF.mcb');
    Route::get('/preview-trafo/{id}', [PDFController::class, 'previewTrafo'])->name('previewPDF.trafo');
    Route::get('/preview-cable/{id}', [PDFController::class, 'previewCable'])->name('previewPDF.cable');
    Route::get('/preview-conductor/{id}', [PDFController::class, 'previewConductor'])->name('previewPDF.conductor');
    Route::get('/preview-ct/{id}', [PDFController::class, 'previewCT'])->name('previewPDF.ct');
    Route::get('/preview-pt/{id}', [PDFController::class, 'previewPT'])->name('previewPDF.pt');
    Route::get('/preview-tiang-listrik/{id}', [PDFController::class, 'previewTiangListrik'])->name('previewPDF.tiangListrik');
    Route::get('/preview-lbs/{id}', [PDFController::class, 'previewLBS'])->name('previewPDF.lbs');
    Route::get('/preview-lightning-arrester/{id}', [PDFController::class, 'previewLightningArrester'])->name('previewPDF.lightningArrester');
    Route::get('/preview-isolator/{id}', [PDFController::class, 'previewIsolator'])->name('previewPDF.isolator');
    Route::get('/preview-fco/{id}', [PDFController::class, 'previewFCO'])->name('previewPDF.fco');
    Route::get('/preview-phbtr/{id}', [PDFController::class, 'previewPHBTR'])->name('previewPDF.phbtr');
    Route::get('/preview-cubicle/{id}', [PDFController::class, 'previewCubicle'])->name('previewPDF.cubicle');
    Route::get('/preview-kotak-app/{id}', [PDFController::class, 'previewKotakAPP'])->name('previewPDF.kotakApp');

    // -- Manajemen User
    Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('manajemen-user.index')->middleware('permission:index_manajemen-user');
    Route::get('/manajemen-user/create', [ManajemenUserController::class, 'create'])->name('manajemen-user.create')->middleware('permission:store_manajemen-user');
    Route::post('/manajemen-user', [ManajemenUserController::class, 'store'])->name('manajemen-user.store')->middleware('permission:store_manajemen-user');
    Route::get('/manajemen-user/{id}/edit', [ManajemenUserController::class, 'edit'])->name('manajemen-user.edit')->middleware('permission:update_manajemen-user');
    Route::put('/manajemen-user/{id}', [ManajemenUserController::class, 'update'])->name('manajemen-user.update')->middleware('permission:update_manajemen-user');
    Route::delete('/manajemen-user/{id}', [ManajemenUserController::class, 'destroy'])->name('manajemen-user.destroy')->middleware('permission:update_manajemen-user');
    Route::get('/manajemen-user/fetch', [ManajemenUserController::class, 'fetch'])->name('manajemen-user.fetch');
    Route::post('/manajemen-user/{userId}/update-role', [ManajemenUserController::class, 'updateRole'])->name('user.update-role');
    Route::post('/manajemen-user/{userId}/update-gudang', [ManajemenUserController::class, 'updateGudang'])->name('user.update-gudang');
    Route::post('/manajemen-user/{userId}/update-status', [ManajemenUserController::class, 'updateStatus'])->name('user.update-status');
});

// Route untuk PIC_Gudang
Route::middleware('auth', 'is_active', 'role:PIC_Gudang')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // -- Profile
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('edit-profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // -- Unapproved
    Route::get('/unapproved', [UnapprovedController::class, 'index'])->name('form-unapproved');

    // -- Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan')->middleware('permission:index_laporan');
    Route::get('/export-kwh/{id}', [PDFController::class, 'exportPDFkWh'])->name('export.kwh');
    Route::get('/export-mcb/{id}', [PDFController::class, 'exportPDFmcb'])->name('export.mcb');
    Route::get('/export-trafo/{id}', [PDFController::class, 'exportPDFtrafo'])->name('export.trafo');
    Route::get('/export-cable/{id}', [PDFController::class, 'exportPDFcable'])->name('export.cable');
    Route::get('/export-conductor/{id}', [PDFController::class, 'exportPDFconductor'])->name('export.conductor');
    Route::get('/export-ct/{id}', [PDFController::class, 'exportPDFct'])->name('export.ct');
    Route::get('/export-pt/{id}', [PDFController::class, 'exportPDFpt'])->name('export.pt');
    Route::get('/export-tiang-listrik/{id}', [PDFController::class, 'exportPDFtiangListrik'])->name('export.tiangListrik');
    Route::get('/export-lbs/{id}', [PDFController::class, 'exportPDFlbs'])->name('export.lbs');
    Route::get('/export-isolator/{id}', [PDFController::class, 'exportPDFisolator'])->name('export.isolator');
    Route::get('/export-lightning-arrester/{id}', [PDFController::class, 'exportPDFlightningarrester'])->name('export.lightningArrester');
    Route::get('/export-fco/{id}', [PDFController::class, 'exportPDFfco'])->name('export.fco');
    Route::get('/export-phbtr/{id}', [PDFController::class, 'exportPDFphbtr'])->name('export.phbtr');
    Route::get('/export-cubicle/{id}', [PDFController::class, 'exportPDFcubicle'])->name('export.cubicle');
    Route::get('/export-kotak-app/{id}', [PDFController::class, 'exportPDFkotakApp'])->name('export.kotakApp');

    // Bulk export
    Route::post('/export/bulk-excel', [ExportController::class, 'bulkExportExcel'])->name('export.bulkExcel');
    Route::post('/export/bulk-pdf', [PDFController::class, 'bulkExportPDF'])->name('export.bulkPDF');
    // Export excel all
    Route::post('/export-bulk-excel', [ExportController::class, 'handleBulkExport'])->name('exports.bulk');
    Route::get('/export-kwh-excel/{id}', [ExportController::class, 'exportKWHById'])->name('export.exkwhs');
    Route::get('/export-mcb-excel/{id}', [ExportController::class, 'exportMCBById'])->name('export.exmcbs');
    Route::get('/export-trafo-excel/{id}', [ExportController::class, 'exportTRAFOById'])->name('export.extrafos');
    Route::get('/export-cable-power-excel/{id}', [ExportController::class, 'exportCABLEById'])->name('export.excables');
    Route::get('/export-conductor-excel/{id}', [ExportController::class, 'exportCONDUCTORById'])->name('export.exconductors');
    Route::get('/export-ct-excel/{id}', [ExportController::class, 'exportCTById'])->name('export.excts');
    Route::get('/export-pt-excel/{id}', [ExportController::class, 'exportPTById'])->name('export.expts');
    Route::get('/export-tiang-listrik-excel/{id}', [ExportController::class, 'exportTIANGById'])->name('export.extiangs');
    Route::get('/export-lbs-excel/{id}', [ExportController::class, 'exportLBSById'])->name('export.exlbss');
    Route::get('/export-isolator-excel/{id}', [ExportController::class, 'exportISOLATORById'])->name('export.exisolators');
    Route::get('/export-lightning-arrester-excel/{id}', [ExportController::class, 'exportLAById'])->name('export.exlas');
    Route::get('/export-fco-excel/{id}', [ExportController::class, 'exportFCOById'])->name('export.exfcos');
    Route::get('/export-phbtr-excel/{id}', [ExportController::class, 'exportPHBTRById'])->name('export.exphbtrs');
    Route::get('/export-cubicle-excel/{id}', [ExportController::class, 'exportCUBICLEById'])->name('export.excubicles');
    Route::get('/export-kotak-app-excel/{id}', [ExportController::class, 'exportKAPPById'])->name('export.exkotakapps');

    Route::get('/preview-pdf-kwh/{id}', [PDFController::class, 'previewKWH'])->name('preview.kwh');
    Route::get('/preview-pdf-mcb/{id}', [PDFController::class, 'previewMCB'])->name('preview.mcb');
    Route::get('/preview-pdf-trafo/{id}', [PDFController::class, 'previewTrafo'])->name('preview.trafo');
    Route::get('/preview-pdf-cable/{id}', [PDFController::class, 'previewCable'])->name('preview.cable');
    Route::get('/preview-pdf-conductor/{id}', [PDFController::class, 'previewConductor'])->name('preview.conductor');
    Route::get('/preview-pdf-ct/{id}', [PDFController::class, 'previewCT'])->name('preview.ct');
    Route::get('/preview-pdf-pt/{id}', [PDFController::class, 'previewPT'])->name('preview.pt');
    Route::get('/preview-pdf-tiang-listrik/{id}', [PDFController::class, 'previewTiangListrik'])->name('preview.tiangListrik');
    Route::get('/preview-pdf-lbs/{id}', [PDFController::class, 'previewLBS'])->name('preview.lbs');
    Route::get('/preview-pdf-isolator/{id}', [PDFController::class, 'previewIsolator'])->name('preview.isolator');
    Route::get('/preview-pdf-lightning-arrester/{id}', [PDFController::class, 'previewLightningArrester'])->name('preview.lightningArrester');
    Route::get('/preview-pdf-fco/{id}', [PDFController::class, 'previewFCO'])->name('preview.fco');
    Route::get('/preview-pdf-phbtr/{id}', [PDFController::class, 'previewPHBTR'])->name('preview.phbtr');
    Route::get('/preview-pdf-cubicle/{id}', [PDFController::class, 'previewCubicle'])->name('preview.cubicle');
    Route::get('/preview-pdf-kotak-app/{id}', [PDFController::class, 'previewKotakAPP'])->name('preview.kotakApp');

    // -- Form KWH
    Route::get('/form-retur-kwh-meter/create', [KWHController::class, 'create'])->name('form-retur-kwh-meter.create')->middleware('permission:index_kwh_meter'); // Form tambah
    Route::post('/form-retur-kwh-meter', [KWHController::class, 'store'])->name('form-retur-kwh-meter.store')->middleware('permission:store_kwh_meter'); // Simpan data baru

    Route::get('/form-retur-kwh-meter/{id}/edit', [KWHController::class, 'edit'])->name('form-retur-kwh-meter.edit')->middleware('permission:show_kwh_meter'); // Form edit
    Route::patch('/form-retur-kwh-meter/{id}', [KWHController::class, 'update'])->name('form-retur-kwh-meter.update'); //->middleware('permission:update_kwh_meter'); // Update data

    // Additional Routes
    Route::get('/get-ulps', [KWHController::class, 'getUlps']);
    Route::get('/get-gudangs', [KWHController::class, 'getGudangs']);

    Route::get('/kelas-pengujians', function () {
        return response()->json(KelasPengujian::all());
    });

    // -- Form MCB
    Route::get('/form-retur-mcb/create', [MCBController::class, 'create'])->name('form-retur-mcb.create')->middleware('permission:index_mcb');
    Route::post('/form-retur-mcb', [MCBController::class, 'store'])->name('form-retur-mcb.store')->middleware('permission:store_mcb');
    Route::get('/form-retur-mcb/{id}/edit', [MCBController::class, 'edit'])->name('form-retur-mcb.edit')->middleware('permission:update_mcb');
    Route::patch('/form-retur-mcb/{id}', [MCBController::class, 'update'])->name('form-retur-mcb.update');
    Route::get('/get-ulps', [MCBController::class, 'getUlps']);
    Route::get('/get-gudangs', [MCBController::class, 'getGudangs']);

    // -- Form Trafo
    Route::get('/form-retur-trafo/create', [TrafoController::class, 'create'])->name('form-retur-trafo.create')->middleware('permission:index_trafo_distribusi');
    Route::post('/form-retur-trafo', [TrafoController::class, 'store'])->name('form-retur-trafo.store')->middleware('permission:store_trafo_distribusi');
    Route::get('/form-retur-trafo/{id}/edit', [TrafoController::class, 'edit'])->name('form-retur-trafo.edit');
    Route::patch('/form-retur-trafo/{id}', [TrafoController::class, 'update'])->name('form-retur-trafo.update');
    Route::delete('/form-retur-trafo/{id}', [TrafoController::class, 'destroy'])->name('form-retur-trafo.destroy');
});

// --------------------
// Route untuk Petugas
// --------------------
Route::middleware(['auth', 'is_active'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chart', [DashboardController::class, 'chart'])->name('chart');
    // -- Profile
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('edit-profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('permission:view_profile');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('permission:update_profile');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // -- Unapproved
    Route::get('/unapproved', [UnapprovedController::class, 'index'])->name('form-unapproved');
    // -- Formulir
    Route::get('/forms', function () {
        return view('form.forms', [
            'user' => auth()->user() // Mengirim data user yang sedang login ke view
        ]);
    })->name('forms');

    // -- Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan')->middleware('permission:index_laporan');
    Route::get('/export-kwh/{id}', [PDFController::class, 'exportPDFkWh'])->name('export.kwh');
    Route::get('/export-mcb/{id}', [PDFController::class, 'exportPDFmcb'])->name('export.mcb');
    Route::get('/export-trafo/{id}', [PDFController::class, 'exportPDFtrafo'])->name('export.trafo');
    Route::get('/export-cable/{id}', [PDFController::class, 'exportPDFcable'])->name('export.cable');
    Route::get('/export-conductor/{id}', [PDFController::class, 'exportPDFconductor'])->name('export.conductor');
    Route::get('/export-ct/{id}', [PDFController::class, 'exportPDFct'])->name('export.ct');
    Route::get('/export-pt/{id}', [PDFController::class, 'exportPDFpt'])->name('export.pt');
    Route::get('/export-tiang-listrik/{id}', [PDFController::class, 'exportPDFtiangListrik'])->name('export.tiangListrik');
    Route::get('/export-lbs/{id}', [PDFController::class, 'exportPDFlbs'])->name('export.lbs');
    Route::get('/export-isolator/{id}', [PDFController::class, 'exportPDFisolator'])->name('export.isolator');
    Route::get('/export-lightning-arrester/{id}', [PDFController::class, 'exportPDFlightningarrester'])->name('export.lightningArrester');
    Route::get('/export-fco/{id}', [PDFController::class, 'exportPDFfco'])->name('export.fco');
    Route::get('/export-phbtr/{id}', [PDFController::class, 'exportPDFphbtr'])->name('export.phbtr');
    Route::get('/export-cubicle/{id}', [PDFController::class, 'exportPDFcubicle'])->name('export.cubicle');
    Route::get('/export-kotak-app/{id}', [PDFController::class, 'exportPDFkotakApp'])->name('export.kotakApp');

    // Bulk export
    Route::post('/export/bulk-excel', [ExportController::class, 'bulkExportExcel'])->name('export.bulkExcel');
    Route::post('/export/bulk-pdf', [PDFController::class, 'bulkExportPDF'])->name('export.bulkPDF');
    // Export excel all
    Route::post('/export-bulk-excel', [ExportController::class, 'handleBulkExport'])->name('exports.bulk');
    Route::get('/export-kwh-excel/{id}', [ExportController::class, 'exportKWHById'])->name('export.exkwhs');
    Route::get('/export-mcb-excel/{id}', [ExportController::class, 'exportMCBById'])->name('export.exmcbs');
    Route::get('/export-trafo-excel/{id}', [ExportController::class, 'exportTRAFOById'])->name('export.extrafos');
    Route::get('/export-cable-power-excel/{id}', [ExportController::class, 'exportCABLEById'])->name('export.excables');
    Route::get('/export-conductor-excel/{id}', [ExportController::class, 'exportCONDUCTORById'])->name('export.exconductors');
    Route::get('/export-ct-excel/{id}', [ExportController::class, 'exportCTById'])->name('export.excts');
    Route::get('/export-pt-excel/{id}', [ExportController::class, 'exportPTById'])->name('export.expts');
    Route::get('/export-tiang-listrik-excel/{id}', [ExportController::class, 'exportTIANGById'])->name('export.extiangs');
    Route::get('/export-lbs-excel/{id}', [ExportController::class, 'exportLBSById'])->name('export.exlbss');
    Route::get('/export-isolator-excel/{id}', [ExportController::class, 'exportISOLATORById'])->name('export.exisolators');
    Route::get('/export-lightning-arrester-excel/{id}', [ExportController::class, 'exportLAById'])->name('export.exlas');
    Route::get('/export-fco-excel/{id}', [ExportController::class, 'exportFCOById'])->name('export.exfcos');
    Route::get('/export-phbtr-excel/{id}', [ExportController::class, 'exportPHBTRById'])->name('export.exphbtrs');
    Route::get('/export-cubicle-excel/{id}', [ExportController::class, 'exportCUBICLEById'])->name('export.excubicles');
    Route::get('/export-kotak-app-excel/{id}', [ExportController::class, 'exportKAPPById'])->name('export.exkotakapps');

    Route::get('/preview-pdf-kwh/{id}', [PDFController::class, 'previewKWH'])->name('preview.kwh');
    Route::get('/preview-pdf-mcb/{id}', [PDFController::class, 'previewMCB'])->name('preview.mcb');
    Route::get('/preview-pdf-trafo/{id}', [PDFController::class, 'previewTrafo'])->name('preview.trafo');
    Route::get('/preview-pdf-cable/{id}', [PDFController::class, 'previewCable'])->name('preview.cable');
    Route::get('/preview-pdf-conductor/{id}', [PDFController::class, 'previewConductor'])->name('preview.conductor');
    Route::get('/preview-pdf-ct/{id}', [PDFController::class, 'previewCT'])->name('preview.ct');
    Route::get('/preview-pdf-pt/{id}', [PDFController::class, 'previewPT'])->name('preview.pt');
    Route::get('/preview-pdf-tiang-listrik/{id}', [PDFController::class, 'previewTiangListrik'])->name('preview.tiangListrik');
    Route::get('/preview-pdf-lbs/{id}', [PDFController::class, 'previewLBS'])->name('preview.lbs');
    Route::get('/preview-pdf-isolator/{id}', [PDFController::class, 'previewIsolator'])->name('preview.isolator');
    Route::get('/preview-pdf-lightning-arrester/{id}', [PDFController::class, 'previewLightningArrester'])->name('preview.lightningArrester');
    Route::get('/preview-pdf-fco/{id}', [PDFController::class, 'previewFCO'])->name('preview.fco');
    Route::get('/preview-pdf-phbtr/{id}', [PDFController::class, 'previewPHBTR'])->name('preview.phbtr');
    Route::get('/preview-pdf-cubicle/{id}', [PDFController::class, 'previewCubicle'])->name('preview.cubicle');
    Route::get('/preview-pdf-kotak-app/{id}', [PDFController::class, 'previewKotakAPP'])->name('preview.kotakApp');
    
    // -------------------------
    // Form Prioritas 1
    // -------------------------
    // -- Form kWh Meter
    Route::get('/form-retur-kwh-meter/create', [KWHController::class, 'create'])->name('form-retur-kwh-meter.create')->middleware('permission:index_kwh_meter'); // Form tambah
    Route::post('/form-retur-kwh-meter', [KWHController::class, 'store'])->name('form-retur-kwh-meter.store')->middleware('permission:store_kwh_meter'); // Simpan data baru
    Route::get('/form-retur-kwh-meter/{id}/edit', [KWHController::class, 'edit'])->name('form-retur-kwh-meter.edit')->middleware('permission:show_kwh_meter'); // Form edit
    Route::patch('/form-retur-kwh-meter/{id}', [KWHController::class, 'update'])->name('form-retur-kwh-meter.update'); //->middleware('permission:update_kwh_meter'); // Update data
    Route::delete('/form-retur-kwh/{id}', [KWHController::class, 'destroy'])->name('form-retur-kwh-meter.destroy');
    Route::get('/get-ulps', [KWHController::class, 'getUlps']);
    Route::get('/get-gudangs', [KWHController::class, 'getGudangs']);
    Route::get('/kelas-pengujians', function () {
        return response()->json(KelasPengujian::all());
    });
    // -------------------------
    // -- Form MCB
    Route::get('/form-retur-mcb/create', [MCBController::class, 'create'])->name('form-retur-mcb.create')->middleware('permission:index_mcb');
    Route::post('/form-retur-mcb', [MCBController::class, 'store'])->name('form-retur-mcb.store')->middleware('permission:store_mcb');
    Route::get('/form-retur-mcb/{id}/edit', [MCBController::class, 'edit'])->name('form-retur-mcb.edit')->middleware('permission:update_mcb');
    Route::patch('/form-retur-mcb/{id}', [MCBController::class, 'update'])->name('form-retur-mcb.update');
    Route::delete('/form-retur-mcb/{id}', [MCBController::class, 'destroy'])->name('form-retur-mcb.destroy');
    Route::get('/get-ulps', [MCBController::class, 'getUlps']);
    Route::get('/get-gudangs', [MCBController::class, 'getGudangs']);
    // -------------------------
    // -- Form Trafo
    Route::get('/form-retur-trafo/create', [TrafoController::class, 'create'])->name('form-retur-trafo.create')->middleware('permission:index_trafo_distribusi');
    Route::post('/form-retur-trafo', [TrafoController::class, 'store'])->name('form-retur-trafo.store')->middleware('permission:store_trafo_distribusi');
    Route::get('/form-retur-trafo/{id}/edit', [TrafoController::class, 'edit'])->name('form-retur-trafo.edit');
    Route::patch('/form-retur-trafo/{id}', [TrafoController::class, 'update'])->name('form-retur-trafo.update');
    Route::delete('/form-retur-trafo/{id}', [TrafoController::class, 'destroy'])->name('form-retur-trafo.destroy');
    // -------------------------

    // -------------------------
    // Form Prioritas 2
    // -------------------------
    // -- Form Cable Power
    Route::get('/form-retur-cable-power/create', [CablePowerController::class, 'create'])->name('form-retur-cable-power.create');
    Route::post('/form-retur-cable-power', [CablePowerController::class, 'store'])->name('form-retur-cable-power.store');
    Route::get('/form-retur-cable-power/{id}/edit', [CablePowerController::class, 'edit'])->name('form-retur-cable-power.edit');
    Route::patch('/form-retur-cable-power/{id}', [CablePowerController::class, 'update'])->name('form-retur-cable-power.update');
    Route::delete('/form-retur-cable-power/{id}', [CablePowerController::class, 'destroy'])->name('form-retur-cable-power.destroy');
    // -------------------------
    // -- Form Conductor
    Route::get('/form-retur-conductor/create', [ConductorController::class, 'create'])->name('form-retur-conductor.create');
    Route::post('/form-retur-conductor', [ConductorController::class, 'store'])->name('form-retur-conductor.store');
    Route::get('/form-retur-conductor/{id}/edit', [ConductorController::class, 'edit'])->name('form-retur-conductor.edit');
    Route::patch('/form-retur-conductor/{id}', [ConductorController::class, 'update'])->name('form-retur-conductor.update');
    Route::delete('/form-retur-conductor/{id}', [ConductorController::class, 'destroy'])->name('form-retur-conductor.destroy');
    // -------------------------
    // -- Form Trafo Arus (CT)
    Route::get('/form-retur-ct/create', [CTController::class, 'create'])->name('form-retur-ct.create');
    Route::post('/form-retur-ct', [CTController::class, 'store'])->name('form-retur-ct.store');
    Route::get('/form-retur-ct/{id}/edit', [CTController::class, 'edit'])->name('form-retur-ct.edit');
    Route::patch('/form-retur-ct/{id}', [CTController::class, 'update'])->name('form-retur-ct.update');
    Route::delete('/form-retur-ct/{id}', [CTController::class, 'destroy'])->name('form-retur-ct.destroy');
    // -------------------------
    // -- Form Trafo Tegangan (PT)
    Route::get('/form-retur-pt/create', [PTController::class, 'create'])->name('form-retur-pt.create');
    Route::post('/form-retur-pt', [PTController::class, 'store'])->name('form-retur-pt.store');
    Route::get('/form-retur-pt/{id}/edit', [PTController::class, 'edit'])->name('form-retur-pt.edit');
    Route::patch('/form-retur-pt/{id}', [PTController::class, 'update'])->name('form-retur-pt.update');
    Route::delete('/form-retur-pt/{id}', [PTController::class, 'destroy'])->name('form-retur-pt.destroy');
    // -------------------------
    // -- Form Tiang Listrik
    Route::get('/form-retur-tiang-listrik/create', [TiangListrikController::class, 'create'])->name('form-retur-tiang-listrik.create');
    Route::post('/form-retur-tiang-listrik', [TiangListrikController::class, 'store'])->name('form-retur-tiang-listrik.store');
    Route::get('/form-retur-tiang-listrik/{id}/edit', [TiangListrikController::class, 'edit'])->name('form-retur-tiang-listrik.edit');
    Route::patch('/form-retur-tiang-listrik/{id}', [TiangListrikController::class, 'update'])->name('form-retur-tiang-listrik.update');
    Route::delete('/form-retur-tiang-listrik/{id}', [TiangListrikController::class, 'destroy'])->name('form-retur-tiang-listrik.destroy');
    Route::get('/get-pabrikans', [TiangListrikController::class, 'getPabrikans']);
    // -------------------------

    // -------------------------
    // Form Prioritas 3
    // -------------------------
    // -- Form LBS
    Route::get('/form-retur-lbs/create', [LBSController::class, 'create'])->name('form-retur-lbs.create');
    Route::post('/form-retur-lbs', [LBSController::class, 'store'])->name('form-retur-lbs.store');
    Route::get('/form-retur-lbs/{id}/edit', [LBSController::class, 'edit'])->name('form-retur-lbs.edit');
    Route::patch('/form-retur-lbs/{id}', [LBSController::class, 'update'])->name('form-retur-lbs.update');
    Route::delete('/form-retur-lbs/{id}', [LBSController::class, 'destroy'])->name('form-retur-lbs.destroy');
    // -------------------------
    // -- Form Lightning Arrester
    Route::get('/form-retur-lightning-arrester/create', [LAController::class, 'create'])->name('form-retur-lightning_arrester.create');
    Route::post('/form-retur-lightning-arrester', [LAController::class, 'store'])->name('form-retur-lightning-arrester.store');
    Route::get('/form-retur-lightning-arrester/{id}/edit', [LAController::class, 'edit'])->name('form-retur-lightning-arrester.edit');
    Route::patch('/form-retur-lightning-arrester/{id}', [LAController::class, 'update'])->name('form-retur-lightning-arrester.update');
    Route::delete('/form-retur-lightning-arrester/{id}', [LAController::class, 'destroy'])->name('form-retur-lightning-arrester.destroy');
    // -------------------------
    // -- Form Isolator
    Route::get('/form-retur-isolator/create', [IsolatorController::class, 'create'])->name('form-retur-isolator.create');
    Route::post('/form-retur-isolator', [IsolatorController::class, 'store'])->name('form-retur-isolator.store');
    Route::get('/form-retur-isolator/{id}/edit', [IsolatorController::class, 'edit'])->name('form-retur-isolator.edit');
    Route::patch('/form-retur-isolator/{id}', [IsolatorController::class, 'update'])->name('form-retur-isolator.update');
    Route::delete('/form-retur-isolator/{id}', [IsolatorController::class, 'destroy'])->name('form-retur-isolator.destroy');
    // -------------------------
    // -- Form Fuse Cut Out
    Route::get('/form-retur-fco/create', [FCOController::class, 'create'])->name('form-retur-fco.create');
    Route::post('/form-retur-fco', [FCOController::class, 'store'])->name('form-retur-fco.store');
    Route::get('/form-retur-fco/{id}/edit', [FCOController::class, 'edit'])->name('form-retur-fco.edit');
    Route::patch('/form-retur-fco/{id}', [FCOController::class, 'update'])->name('form-retur-fco.update');
    Route::delete('/form-retur-fco/{id}', [FCOController::class, 'destroy'])->name('form-retur-fco.destroy');
    // -------------------------
    // -- Form PHBTR
    Route::get('/form-retur-phbtr/create', [PHBTRController::class, 'create'])->name('form-retur-phbtr.create');
    Route::post('/form-retur-phbtr', [PHBTRController::class, 'store'])->name('form-retur-phbtr.store');
    Route::get('/form-retur-phbtr/{id}/edit', [PHBTRController::class, 'edit'])->name('form-retur-phbtr.edit');
    Route::patch('/form-retur-phbtr/{id}', [PHBTRController::class, 'update'])->name('form-retur-phbtr.update');
    Route::delete('/form-retur-phbtr/{id}', [PHBTRController::class, 'destroy'])->name('form-retur-phbtr.destroy');
    // -------------------------
    // -- Form Cubicle
    Route::get('/form-retur-cubicle/create', [CubicleController::class, 'create'])->name('form-retur-cubicle.create');
    Route::post('/form-retur-cubicle', [CubicleController::class, 'store'])->name('form-retur-cubicle.store');
    Route::get('/form-retur-cubicle/{id}/edit', [CubicleController::class, 'edit'])->name('form-retur-cubicle.edit');
    Route::patch('/form-retur-cubicle/{id}', [CubicleController::class, 'update'])->name('form-retur-cubicle.update');
    Route::delete('/form-retur-cubcicle/{id}', [CubicleController::class, 'destroy'])->name('form-retur-cubicle.destroy');
    // -------------------------
    // -- Form Kotak APP
    Route::get('/form-retur-kotak-app/pabrikans', [KotakAPPController::class, 'getPabrikans'])->name('form-retur-kotak-app.pabrikans');
    Route::get('/form-retur-kotak-app/create', [KotakAPPController::class, 'create'])->name('form-retur-kotak-app.create');
    Route::post('/form-retur-kotak-app', [KotakAPPController::class, 'store'])->name('form-retur-kotak-app.store');
    Route::get('/form-retur-kotak-app/{id}/edit', [KotakAPPController::class, 'edit'])->name('form-retur-kotak-app.edit');
    Route::patch('/form-retur-kotak-app/{id}', [KotakAPPController::class, 'update'])->name('form-retur-kotak-app.update');
    Route::delete('/form-retur-kotak-app/{id}', [KotakAPPController::class, 'destroy'])->name('form-retur-kotak-app.destroy');
    // -------------------------
});

// Route::middleware(['auth', 'is_active'])->group(function () {
//     // Global route
//     Route::get('/get-ulps', [KWHController::class, 'getUlps']);
//     Route::get('/get-gudangs', [KWHController::class, 'getGudangs']);
//     Route::get('/kelas-pengujians', function () {
//         return response()->json(KelasPengujian::all());
//     });
//     Route::get('/get-ulps', [MCBController::class, 'getUlps']);
//     Route::get('/get-gudangs', [MCBController::class, 'getGudangs']);
//     Route::get('/forms', function () {
//         return view('form.forms');
//     })->name('forms');

//     // --------------------
//     // Route untuk Admin
//     // --------------------
//     Route::middleware('role:Admin')->name('admin.')->group(function () {
//         Route::prefix('profile')->name('profile.')->group(function () {
//             // -- Profile
//             Route::get('/', [ProfileController::class, 'edit'])->name('edit')->middleware('permission:view_profile');
//             Route::patch('/', [ProfileController::class, 'update'])->name('update')->middleware('permission:update_profile');
//             Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
//         });

//         Route::prefix('unapproved')->name('unapproved.')->group(function () {
//             // -- Unapproved
//             Route::get('/', [UnapprovedController::class, 'index'])->name('.index');
//         });

//         Route::prefix('manajemen-laporan')->name('manajemen-laporan.')->group(function () {
//             // -- Laporan
//             Route::get('/', [LaporanController::class, 'index'])->name('index')->middleware('permission:index_laporan');
//             Route::get('/{id}', [PDFController::class, 'exportPDFkWh'])->name('export_kwh')->middleware('permission:export_pdf_kwh_meter');
//             Route::get('/{id}', [PDFController::class, 'exportPDFmcb'])->name('export_mcb')->middleware('permission:export_pdf_mcb');
//         });

//         Route::prefix('manajemen-user')->name('manajemen-user.')->group(function () {
//             // -- Manajemen User
//             Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('manajemen-user.index')->middleware('permission:index_manajemen-user');
//             Route::get('/manajemen-user/create', [ManajemenUserController::class, 'create'])->name('manajemen-user.create')->middleware('permission:store_manajemen-user');
//             Route::post('/manajemen-user', [ManajemenUserController::class, 'store'])->name('manajemen-user.store')->middleware('permission:store_manajemen-user');
//             Route::get('/manajemen-user/{id}/edit', [ManajemenUserController::class, 'edit'])->name('manajemen-user.edit')->middleware('permission:update_manajemen-user');
//             Route::put('/manajemen-user/{id}', [ManajemenUserController::class, 'update'])->name('manajemen-user.update')->middleware('permission:update_manajemen-user');
//             Route::delete('/manajemen-user/{id}', [ManajemenUserController::class, 'destroy'])->name('manajemen-user.destroy')->middleware('permission:update_manajemen-user');
//             Route::get('/manajemen-user/fetch', [ManajemenUserController::class, 'fetch'])->name('manajemen-user.fetch');
//             Route::post('/manajemen-user/{userId}/update-role', [ManajemenUserController::class, 'updateRole'])->name('user.update-role');
//             Route::post('/manajemen-user/{userId}/update-gudang', [ManajemenUserController::class, 'updateGudang'])->name('user.update-gudang');
//             Route::post('/manajemen-user/{userId}/update-status', [ManajemenUserController::class, 'updateStatus'])->name('user.update-status');
//         });
//     });

//     // --------------------
//     // Route untuk PIC Gudang
//     // --------------------
//     Route::middleware('role:PIC_Gudang')->name('pic.')->group(function () {
//         Route::prefix('profile')->name('profile.')->group(function () {
//             // -- Profile
//             Route::get('/', [ProfileController::class, 'edit'])->name('edit')->middleware('permission:view_profile');
//             Route::patch('/', [ProfileController::class, 'update'])->name('update')->middleware('permission:update_profile');
//             Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
//         });

//         Route::prefix('unapproved')->name('unapproved.')->group(function () {
//             // -- Unapproved
//             Route::get('/', [UnapprovedController::class, 'index'])->name('index');
//         });

//         Route::prefix('manajemen-laporan')->name('manajemen-laporan.')->group(function () {
//             // -- Laporan
//             Route::get('/', [LaporanController::class, 'index'])->name('index')->middleware('permission:index_laporan');
//             Route::get('/{id}', [PDFController::class, 'exportPDFkWh'])->name('export_kwh'); //->middleware('permission:export_pdf_kwh_meter');
//             Route::get('/{id}', [PDFController::class, 'exportPDFmcb'])->name('export_mcb'); //->middleware('permission:export_pdf_mcb');
//         });

//         Route::prefix('form-retur-kwh-meter')->name('form-retur-kwh-meter.')->group(function () {
//             // -- Form KWH
//             Route::get('/', [KWHController::class, 'create'])->name('create')->middleware('permission:index_kwh_meter'); // Form tambah
//             Route::post('/', [KWHController::class, 'store'])->name('store')->middleware('permission:store_kwh_meter'); // Simpan data baru
//             Route::get('/{id}/edit', [KWHController::class, 'edit'])->name('edit')->middleware('permission:show_kwh_meter'); // Form edit
//             Route::patch('/{id}', [KWHController::class, 'update'])->name('update'); //->middleware('permission:update_kwh_meter'); // Update data
//         });

//         Route::prefix('form-retur-mcb')->name('form-retur-mcb.')->group(function () {
//             // -- Form MCB
//             Route::get('/{id}/edit', [MCBController::class, 'edit'])->name('edit'); //->middleware('permission:update_mcb');
//             Route::put('/{id}', [MCBController::class, 'update'])->name('update'); //->middleware('permission:update_mcb');
//         });
//     });

//     // --------------------
//     // Route untuk Petugas
//     // --------------------
//     Route::middleware('role:Petugas')->name('petugas.')->group(function () {
//         Route::prefix('profile')->name('profile.')->group(function () {
//             // -- Profile
//             Route::get('/', [ProfileController::class, 'edit'])->name('edit')->middleware('permission:view_profile');
//             Route::patch('/', [ProfileController::class, 'update'])->name('update')->middleware('permission:update_profile');
//             Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
//         });

//         Route::prefix('unapproved')->name('unapproved.')->group(function () {
//             // -- Unapproved
//             Route::get('/', [UnapprovedController::class, 'index'])->name('index');
//         });

//         Route::prefix('form-retur-kwh-meter')->name('form-retur-kwh-meter.')->group(function () {
//             // -- Form KWH
//             Route::get('/', [KWHController::class, 'create'])->name('create')->middleware('permission:index_kwh_meter'); // Form tambah
//             Route::post('/', [KWHController::class, 'store'])->name('store')->middleware('permission:store_kwh_meter'); // Simpan data baru
//             Route::get('/{id}/edit', [KWHController::class, 'edit'])->name('edit')->middleware('permission:show_kwh_meter'); // Form edit
//             Route::patch('/{id}', [KWHController::class, 'update'])->name('update'); //->middleware('permission:update_kwh_meter'); // Update data
//         });

//         Route::prefix('form-retur-mcb')->name('form-retur-mcb.')->group(function () {
//             // -- Form MCB
//             Route::get('/', [MCBController::class, 'create'])->name('create')->middleware('permission:store_mcb');
//             Route::post('/', [MCBController::class, 'store'])->name('store')->middleware('permission:store_mcb');
//             Route::put('/{id}/patch', [MCBController::class, 'update'])->name('update')->middleware('permission:update_mcb');
//             Route::get('/{id}/show', [MCBController::class, 'show'])->name('show')->middleware('permission:show_mcb');
//             Route::get('/{id}/edit', [MCBController::class, 'edit'])->name('edit')->middleware('permission:update_mcb');
//         });

//         Route::prefix('form-retur-trafo')->name('form-retur-trafo.')->group(function () {
//             // -- Form Trafo
//             Route::get('/', [TrafoController::class, 'create'])->name('create')->middleware('permission:store_trafo_distribusi');
//             Route::post('', [TrafoController::class, 'store'])->name('store')->middleware('permission:store_trafo_distribusi');
//             Route::get('/{id}', [TrafoController::class, 'edit'])->name('edit')->middleware('permission:update_trafo_fistribusi');
//         });
//     });
// });

require __DIR__ . '/auth.php';
