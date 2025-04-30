<?php

namespace App\Http\Controllers;

use App\Models\CablePower;
use App\Models\Conductor;
use App\Models\FuseCutOut;
use App\Models\Isolator;
use App\Models\KWHMeter;
use App\Models\LBS;
use App\Models\LightningArrester;
use App\Models\MCB;
use App\Models\PHBTR;
use App\Models\TiangListrik;
use App\Models\Trafo;
use App\Models\TrafoArus;
use App\Models\TrafoTegangan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = auth()->user();

        // Daftar model yang akan diproses
        $models = [
            KWHMeter::class,
            MCB::class,
            Trafo::class,
            CablePower::class,
            Conductor::class,
            TrafoArus::class,
            TrafoTegangan::class,
            TiangListrik::class,
            LBS::class,
            Isolator::class,
            LightningArrester::class,
            FuseCutOut::class,
            PHBTR::class
        ];

        $allApproved = collect();

        foreach ($models as $model) {
            $query = $model::where('status', 'Approved')->latest()->with('ulp');

            if (!$user->hasRole('Admin')) {
                if ($user->hasRole('PIC_Gudang') && $user->gudang_id) {
                    $query->where('gudang_id', $user->gudang_id);
                } elseif ($user->hasRole('Petugas')) {
                    $query->where('user_id', $user->id);
                }
            }

            $allApproved = $allApproved->merge($query->get());
        }

        // Urutkan dan paginasi
        $allApproved = $allApproved->sortByDesc('created_at');

        $page = request()->get('page', 1);
        $perPage = 10;
        $currentPageItems = $allApproved->slice(($page - 1) * $perPage, $perPage)->values();

        $paginatedApproved = new LengthAwarePaginator(
            $currentPageItems,
            $allApproved->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Ambil ULP unik dari semua data yang sudah difilter
        $uniqueUlps = $allApproved->filter(function ($item) {
            return !is_null($item->ulp);
        })->unique(function ($item) {
            return $item->ulp->id;
        })->pluck('ulp');

        return view('form.laporan', [
            'allApproved' => $paginatedApproved,
            'ulp_Approveds' => $uniqueUlps
        ]);

        // $user = auth()->user();

        // // Inisialisasi query untuk KWHMeter, MCB, dan Trafo
        // $approved_kwh_meters = KWHMeter::where('status', 'Approved')->latest();
        // $approved_mcbs = MCB::where('status', 'Approved')->latest();
        // $approved_trafos = Trafo::where('status', 'Approved')->latest();

        // $approved_cable_powers = CablePower::where('status', 'Approved')->latest();
        // $approved_conductors = Conductor::where('status', 'Approved')->latest();
        // $approved_trafo_arus = TrafoArus::where('status', 'Approved')->latest();
        // $approved_trafo_tegangan = TrafoTegangan::where('status', 'Approved')->latest();
        // $approved_tiang_listrik = TiangListrik::where('status', 'Approved')->latest();

        // $approved_lbs = LBS::where('status', 'Approved')->latest();
        // $approved_isolator = Isolator::where('status', 'Approved')->latest();

        // // Jika user adalah Admin, tampilkan semua data tanpa filter
        // if (!$user->hasRole('Admin')) {
        //     // Jika user memiliki role PIC_Gudang, filter berdasarkan gudang_id
        //     if ($user->hasRole('PIC_Gudang') && $user->gudang_id) {
        //         $approved_kwh_meters->where('gudang_id', $user->gudang_id);
        //         $approved_mcbs->where('gudang_id', $user->gudang_id);
        //         $approved_trafos->where('gudang_id', $user->gudang_id);

        //         $approved_cable_powers->where('gudang_id', $user->gudang_id);
        //         $approved_conductors->where('gudang_id', $user->gudang_id);
        //         $approved_trafo_arus->where('gudang_id', $user->gudang_id);
        //         $approved_trafo_tegangan->where('gudang_id', $user->gudang_id);
        //         $approved_tiang_listrik->where('gudang_id', $user->gudang_id);

        //         $approved_lbs->where('gudang_id', $user->gudang_id);
        //         $approved_isolator->where('gudang_id', $user->gudang_id);
        //     } else {
        //         // Jika user memiliki role Petugas, filter berdasarkan user_id mereka
        //         if ($user->hasRole('Petugas')) {
        //             $approved_kwh_meters->where('user_id', $user->id);
        //             $approved_mcbs->where('user_id', $user->id);
        //             $approved_trafos->where('user_id', $user->id);

        //             $approved_cable_powers->where('user_id', $user->id);
        //             $approved_conductors->where('user_id', $user->id);
        //             $approved_trafo_arus->where('user_id', $user->id);
        //             $approved_trafo_tegangan->where('user_id', $user->id);
        //             $approved_tiang_listrik->where('user_id', $user->id);

        //             $approved_lbs->where('user_id', $user->id);
        //             $approved_isolator->where('user_id', $user->id);
        //         }
        //     }
        // }

        // // Ambil data hasil query
        // $approved_kwh_meters = $approved_kwh_meters->get();
        // $approved_mcbs = $approved_mcbs->get();
        // $approved_trafos = $approved_trafos->get();

        // $approved_cable_powers = $approved_cable_powers->get();
        // $approved_conductors = $approved_conductors->get();
        // $approved_trafo_arus = $approved_trafo_arus->get();
        // $approved_trafo_tegangan = $approved_trafo_tegangan->get();
        // $approved_tiang_listrik = $approved_tiang_listrik->get();

        // $approved_lbs = $approved_lbs->get();
        // $approved_isolator = $approved_isolator->get();

        // // Gabungkan dan urutkan berdasarkan created_at
        // $allApproved = collect()
        //     ->merge($approved_kwh_meters)
        //     ->merge($approved_mcbs)
        //     ->merge($approved_trafos)
        //     ->merge($approved_cable_powers)
        //     ->merge($approved_conductors)
        //     ->merge($approved_trafo_arus)
        //     ->merge($approved_trafo_tegangan)
        //     ->merge($approved_tiang_listrik)
        //     ->merge($approved_lbs)
        //     ->merge($approved_isolator)
        //     ->sortByDesc('created_at')
        //     ->values();

        // // Paginasi manual
        // $page = request()->get('page', 1);
        // $perPage = 10;
        // $currentPageItems = $allApproved->slice(($page - 1) * $perPage, $perPage)->values();

        // $allApproved = new LengthAwarePaginator(
        //     $currentPageItems,
        //     $allApproved->count(),
        //     $perPage,
        //     $page,
        //     ['path' => request()->url()]
        // );

        // // Mengambil data ULP yang terkait dengan laporan
        // $ulp_Approveds = KWHMeter::with('ulp')->get();

        // return view('form.laporan', compact('allApproved', 'ulp_Approveds'));
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

    // public function fetch(Request $request)
    // {
    //     $query = Laporan::query();

    //     if ($request->ulp) {
    //         $query->whereHas('ulp', function ($q) use ($request) {
    //             $q->where('daerah', $request->ulp);
    //         });
    //     }

    //     if ($request->material) {
    //         $query->where('material_retur', $request->material);
    //     }

    //     return DataTables::of($query)
    //         ->addColumn('aksi', function ($row) {
    //             return '<a href="' . route('export.laporan', $row->id) . '" class="btn btn-success btn-sm">Download</a>';
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }
}
