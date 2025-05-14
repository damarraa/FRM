<?php

namespace App\Http\Controllers;

use App\Exports\BulkDataExport;
use App\Exports\CablePowerExport;
use App\Exports\CablePowerSingleExport;
use App\Exports\ConductorExport;
use App\Exports\ConductorSingleExport;
use App\Exports\CubicleExport;
use App\Exports\CubicleSingleExport;
use App\Exports\FCOExport;
use App\Exports\FCOSingleExport;
use App\Exports\IsolatorExport;
use App\Exports\IsolatorSingleExport;
use App\Exports\KotakAPPExport;
use App\Exports\KotakAPPSingleExport;
use App\Exports\KWHMeterExport;
use App\Exports\KWHMeterSingleExport;
use App\Exports\LBSExport;
use App\Exports\LBSSingleExport;
use App\Exports\LightningArresterExport;
use App\Exports\LightningArresterSingleExport;
use App\Exports\MCBExport;
use App\Exports\MCBSingleExport;
use App\Exports\PHBTRExport;
use App\Exports\PHBTRSingleExport;
use App\Exports\TiangListrikExport;
use App\Exports\TiangListrikSingleExport;
use App\Exports\TrafoArusExport;
use App\Exports\TrafoArusSingleExport;
use App\Exports\TrafoExport;
use App\Exports\TrafoSingleExport;
use App\Exports\TrafoTeganganExport;
use App\Exports\TrafoTeganganSingleExport;
use App\Models\CablePower;
use App\Models\Conductor;
use App\Models\Cubicle;
use App\Models\FuseCutOut;
use App\Models\Isolator;
use App\Models\KotakAPP;
use App\Models\KWHMeter;
use App\Models\LBS;
use App\Models\LightningArrester;
use App\Models\MCB;
use App\Models\PHBTR;
use App\Models\TiangListrik;
use App\Models\Trafo;
use App\Models\TrafoArus;
use App\Models\TrafoTegangan;
use App\Services\ReturExportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\BinaryOp;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class ExportController extends Controller
{
    public function handleBulkExport(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'types' => 'required|array|size:' . count($request->ids),
            'format' => 'required|in:pdf,excel',
            '_token' => 'required|string'
        ]);

        try {
            $service = new ReturExportService();

            if ($request->format === 'excel') {
                return $service->exportExcel($request->ids, $request->types);
            }

            $zipPath = $service->exportPdfZip($request->ids, $request->types);
            return response()->download($zipPath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Bulk Export Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Export failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Export all data
    public function exportKWH(): BinaryFileResponse
    {
        return Excel::download(new KWHMeterExport, 'kWhMeters.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportKWHById($id): BinaryFileResponse
    {
        $kWh_Meter = KWHMeter::findOrFail($id);
        $filename = $kWh_Meter->no_surat . '.xlsx';

        return Excel::download(new KWHMeterSingleExport($id), $filename);
    }

    // Export all data
    public function exportMCB(): BinaryFileResponse
    {
        return Excel::download(new MCBExport, 'MCBs.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportMCBById($id): BinaryFileResponse
    {
        $mcb = MCB::findOrFail($id);
        $filename = $mcb->no_surat . '.xlsx';

        return Excel::download(new MCBSingleExport($id), $filename);
    }

    // Export all data
    public function exportTRAFO(): BinaryFileResponse
    {
        return Excel::download(new TrafoExport, 'TrafoDistribusis.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportTRAFOById($id): BinaryFileResponse
    {
        $trafo = Trafo::findOrFail($id);
        $filename = $trafo->no_surat . '.xlsx';

        return Excel::download(new TrafoSingleExport($id), $filename);
    }

    // Export all data
    public function exportCABLE(): BinaryFileResponse
    {
        return Excel::download(new CablePowerExport, 'CablePowers.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportCABLEById($id): BinaryFileResponse
    {
        $cable_power = CablePower::findOrFail($id);
        $filename = $cable_power->no_surat . '.xlsx';

        return Excel::download(new CablePowerSingleExport($id), $filename);
    }

    // Export all data
    public function exportCONDUCTOR(): BinaryFileResponse
    {
        return Excel::download(new ConductorExport, 'Conductors.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportCONDUCTORById($id): BinaryFileResponse
    {
        $conductor = Conductor::findOrFail($id);
        $filename = $conductor->no_surat . '.xlsx';

        return Excel::download(new ConductorSingleExport($id), $filename);
    }

    // Export all data
    public function exportCT(): BinaryFileResponse
    {
        return Excel::download(new TrafoArusExport, 'CTs.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportCTById($id): BinaryFileResponse
    {
        $trafo_arus = TrafoArus::findOrFail($id);
        $filename = $trafo_arus->no_surat . '.xlsx';

        return Excel::download(new TrafoArusSingleExport($id), $filename);
    }

    // Export all data
    public function exportPT(): BinaryFileResponse
    {
        return Excel::download(new TrafoTeganganExport, 'PTs.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportPTById($id): BinaryFileResponse
    {
        $trafo_tegangan = TrafoTegangan::findOrFail($id);
        $filename = $trafo_tegangan->no_surat . '.xlsx';

        return Excel::download(new TrafoTeganganSingleExport($id), $filename);
    }

    // Export all data
    public function exportTIANG(): BinaryFileResponse
    {
        return Excel::download(new TiangListrikExport, 'TiangListriks.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportTIANGById($id): BinaryFileResponse
    {
        $tiang_listrik = TiangListrik::findOrFail($id);
        $filename = $tiang_listrik->no_surat . '.xlsx';

        return Excel::download(new TiangListrikSingleExport($id), $filename);
    }

    // Export all data
    public function exportLBS(): BinaryFileResponse
    {
        return Excel::download(new LBSExport, 'LBSs.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportLBSById($id): BinaryFileResponse
    {
        $lbs = LBS::findOrFail($id);
        $filename = $lbs->no_surat . '.xlsx';

        return Excel::download(new LBSSingleExport($id), $filename);
    }

    // Export all data
    public function exportISOLATOR(): BinaryFileResponse
    {
        return Excel::download(new IsolatorExport, 'Isolators.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportISOLATORById($id): BinaryFileResponse
    {
        $isolator = Isolator::findOrFail($id);
        $filename = $isolator->no_surat . '.xlsx';

        return Excel::download(new IsolatorSingleExport($id), $filename);
    }

    // Export all data
    public function exportLA(): BinaryFileResponse
    {
        return Excel::download(new LightningArresterExport, 'LightningArresters.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportLAById($id): BinaryFileResponse
    {
        $la = LightningArrester::findOrFail($id);
        $filename = $la->no_surat . '.xlsx';

        return Excel::download(new LightningArresterSingleExport($id), $filename);
    }

    // Export all data
    public function exportFCO(): BinaryFileResponse
    {
        return Excel::download(new FCOExport, 'FCOs.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportFCOById($id): BinaryFileResponse
    {
        $fco = FuseCutOut::findOrFail($id);
        $filename = $fco->no_surat . '.xlsx';

        return Excel::download(new FCOSingleExport($id), $filename);
    }

    // Export all data
    public function exportPHBTR(): BinaryFileResponse
    {
        return Excel::download(new PHBTRExport, 'PHBTRs.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportPHBTRById($id): BinaryFileResponse
    {
        $phbtr = PHBTR::findOrFail($id);
        $filename = $phbtr->no_surat . '.xlsx';

        return Excel::download(new PHBTRSingleExport($id), $filename);
    }

    // Export all data
    public function exportCUBICLE(): BinaryFileResponse
    {
        return Excel::download(new CubicleExport, 'Cubicles.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportCUBICLEById($id): BinaryFileResponse
    {
        $cubicle = Cubicle::findOrFail($id);
        $filename = $cubicle->no_surat . '.xlsx';

        return Excel::download(new CubicleSingleExport($id), $filename);
    }

    // Export all data
    public function exportKAPP(): BinaryFileResponse
    {
        return Excel::download(new KotakAPPExport, 'KotakAPPs.xlsx');
    }

    // Export single data by ID -- Admin/PIC
    public function exportKAPPById($id): BinaryFileResponse
    {
        $kotak = KotakAPP::findOrFail($id);
        $filename = $kotak->no_surat . '.xlsx';

        return Excel::download(new KotakAPPSingleExport($id), $filename);
    }

    public function bulkExportExcel(Request $request)
    {
        $request->validate([
            'ids' => 'required|json',
            'types' => 'required|json'
        ]);

        $ids = json_decode($request->ids, true);
        $types = json_decode($request->types, true);

        // Kelompokkan ID berdasarkan tipe
        $grouped = [];
        foreach ($ids as $index => $id) {
            $type = $types[$index];
            if (!isset($grouped[$type])) {
                $grouped[$type] = [];
            }
            $grouped[$type][] = $id;
        }

        // Buat nama file berdasarkan timestamp
        $filename = 'multi_export_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new BulkDataExport($grouped), $filename);
    }

    public function bulkExportPDF(Request $request)
    {
        $request->validate([
            'ids' => 'required|json',
            'types' => 'required|json'
        ]);

        $ids = json_decode($request->ids, true);
        $types = json_decode($request->types, true);

        // Buat file ZIP sementara
        $zipFileName = 'pdf_export_' . now()->format('Ymd_His') . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            foreach ($ids as $index => $id) {
                $type = $types[$index];
                $model = $type::find($id);

                if ($model) {
                    // Generate PDF (gunakan logic yang sudah ada)
                    $pdf = Pdf::loadView('pdf.template', ['data' => $model]);
                    $pdfContent = $pdf->output();

                    // Tambahkan ke ZIP
                    $zip->addFromString($model->no_surat . '.pdf', $pdfContent);
                }
            }

            $zip->close();

            // Download dan hapus file ZIP setelah didownload
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Gagal membuat file ZIP');
    }
}
