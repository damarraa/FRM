<?php

namespace App\Http\Controllers;

use App\Services\ReturExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        // $service = new ReturExportService();

        // if ($request->format === 'excel') {
        //     return $service->exportExcel($request->ids, $request->types);
        // } else {
        //     $zipPath = $service->exportPdfZip($request->ids, $request->types);
        //     return response()->download($zipPath)->deleteFileAfterSend(true);
        // }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
