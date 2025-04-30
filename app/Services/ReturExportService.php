<?php

namespace App\Services;

use App\Exports\KWHMeterExport; // ... Tambahkan model lainnya
use App\Exports\MultipleSheetExport;
use App\Http\Controllers\PDFController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class ReturExportService
{
    private $typeMap = [
        'App\Models\KWHMeter' => KWHMeterExport::class,
        // ... Tambahkan mapping lainnya
    ];

    public function exportExcel($ids, $types)
    {
        try {
            $exports = [];
            
            foreach ($ids as $index => $id) {
                if (!isset($types[$index])) {
                    throw new \Exception("Type not provided for item ID: {$id}");
                }
                
                $modelClass = $types[$index];
                $item = app($modelClass)->with([
                    'up3s',
                    'ulp',
                    'gudang',
                    'pabrikan',
                    'kelasPengujian',
                    'user',
                    'approvedBy'
                ])->find($id);
                
                if (!$item) {
                    throw new \Exception("Item not found: {$modelClass} with ID {$id}");
                    continue;
                }
                
                // Modifikasi data khusus (seperti di exportPDFkwh)
                if ($item->up3s) {
                    $item->up3s->unit = substr($item->up3s->unit, 4);
                }
                if ($item->ulp) {
                    $item->ulp->daerah = substr($item->ulp->daerah, 4);
                }
                
                $exportClass = $this->typeMap[$modelClass] ?? null;
                if (!$exportClass) {
                    throw new \Exception("No export class defined for type: {$modelClass}");
                }
                
                $exports[] = new $exportClass($item);
            }

            if (empty($exports)) {
                throw new \Exception("No valid items to export");
            }

            return Excel::download(
                new MultipleSheetExport($exports),
                'retur_export_'.now()->format('Ymd_His').'.xlsx'
            );

        } catch (\Exception $e) {
            Log::error('Export failed: ' . $e->getMessage());
            throw $e;
        }
    }

        // try {
        //     $exports = [];
        //     foreach ($items as $index => $item) {
        //         if (!isset($types[$index])) {
        //             Log::error("Type not provided for item ID: {$item->id}");
        //         }

        //         $exportClass = $this->typeMap[$types[$index]] ?? null;
        //         if (!$exportClass) {
        //             Log::error("No export class defined for type: {$types[$index]}");
        //         }
        //         $exports[] = new $exportClass($item);
        //     }

        //     if (empty($exports)) {
        //         Log::error("No valid items to export");
        //     }

        //     return Excel::download(
        //         new \App\Exports\MultipleSheetExport($exports),
        //         'retur_export' . now()->format('YmdHis') . '.xlsx'
        //     );
        // } catch (\Throwable $th) {
        //     Log::error('Export failed: ' . $th->getMessage());
        //     throw $th; // Rethrow untuk ditangkap controller
        // }

        // $exports = [];

        // foreach ($items as $index => $item) {
        //     $exportClass = $this->typeMap[$types[$index]] ?? null;
        //     if ($exportClass) {
        //         $exports[] = new $exportClass($item);
        //     }
        // }

        // return Excel::download(
        //     new \App\Exports\MultipleSheetExport($exports),
        //     'retur_export'.now()->format('YmdHis').'.xlsx'
        // );

    public function exportPdfZip($items, $types)
    {
        try {
            $pdfController = new PDFController();
            return $pdfController->generateBulkPdf($items, $types);
        } catch (\Throwable $th) {
            Log::error('PDF Export failed: ' . $th->getMessage());
            throw $th;
        }
    }
}

    // private function generatePdf($type, $item)
    // {
    //     $view = $this->getPdfView($type);
    //     return PDF::loadView($view, ['data' => $item]);
    // }

    // private function getPdfView($type)
    // {
    //     $views = [
    //         'App\Models\KWHMeter' => 'exports.kwh_pdf',
    //         // ... tambahkan mapping view lainnya
    //     ];

    //     return $views[$type] ?? 'exports.default_pdf';
    // }

    // private function generatePdfFilename($type, $item)
    // {
    //     $prefix = strtolower(class_basename($type));
    //     return "{$prefix}_{$item->no_surat}.pdf";
    // }
