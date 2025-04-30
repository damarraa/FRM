<?php

namespace App\Http\Controllers;

use App\Models\CablePower;
use App\Models\Conductor;
use App\Models\FuseCutOut;
use App\Models\Gudang;
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

class UnapprovedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Query dasar untuk mendapatkan data 'Unapproved'
        $unapproved_kwh_meters = KWHMeter::where('status', 'Unapproved')->with('gudang');
        $unapproved_mcbs = MCB::where('status', 'Unapproved')->with('gudang');
        $unapproved_trafo = Trafo::where('status', 'Unapproved')->with('gudang');

        $unapproved_cable_powers = CablePower::where('status', 'Unapproved')->with('gudang');
        $unapproved_conductors = Conductor::where('status', 'Unapproved')->with('gudang');
        $unapproved_trafo_arus = TrafoArus::where('status', 'Unapproved')->with('gudang');
        $unapproved_trafo_tegangan = TrafoTegangan::where('status', 'Unapproved')->with('gudang');
        $unapproved_tiang_listrik = TiangListrik::where('status', 'Unapproved')->with('gudang');

        $unapproved_lbs = LBS::where('status', 'Unapproved')->with('gudang');
        $unapproved_isolator = Isolator::where('status', 'Unapproved')->with('gudang');
        $unapproved_lightning_arrester = LightningArrester::where('status', 'Unapproved')->with('gudang');
        $unapproved_fco = FuseCutOut::where('status', 'Unapproved')->with('gudang');
        $unapproved_phbtr = PHBTR::where('status', 'Unapproved')->with('gudang');

        // Jika user adalah Admin, tampilkan semua data tanpa filter
        if (!$user->hasRole('Admin')) {
            if ($user->hasRole('PIC_Gudang') && $user->gudang_id) {
                // Filter data berdasarkan gudang_id jika user adalah PIC_Gudang
                $unapproved_kwh_meters->where('gudang_id', $user->gudang_id);
                $unapproved_mcbs->where('gudang_id', $user->gudang_id);
                $unapproved_trafo->where('gudang_id', $user->gudang_id);

                $unapproved_cable_powers->where('gudang_id', $user->gudang_id);
                $unapproved_conductors->where('gudang_id', $user->gudang_id);
                $unapproved_trafo_arus->where('gudang_id', $user->gudang_id);
                $unapproved_trafo_tegangan->where('gudang_id', $user->gudang_id);
                $unapproved_tiang_listrik->where('gudang_id', $user->gudang_id);

                $unapproved_lbs->where('gudang_id', $user->gudang_id);
                $unapproved_isolator->where('gudang_id', $user->gudang_id);
                $unapproved_lightning_arrester->where('gudang_id', $user->gudang_id);
                $unapproved_fco->where('gudang_id', $user->gudang_id);
                $unapproved_phbtr->where('gudang_id', $user->gudang_id);
            } else {
                // Jika bukan Admin atau PIC_Gudang, hanya tampilkan data yang diinput oleh user tersebut
                $unapproved_kwh_meters->where('user_id', $user->id);
                $unapproved_mcbs->where('user_id', $user->id);
                $unapproved_trafo->where('user_id', $user->id);

                $unapproved_cable_powers->where('user_id', $user->id);
                $unapproved_conductors->where('user_id', $user->id);
                $unapproved_trafo_arus->where('user_id', $user->id);
                $unapproved_trafo_tegangan->where('user_id', $user->id);
                $unapproved_tiang_listrik->where('user_id', $user->id);

                $unapproved_lbs->where('user_id', $user->id);
                $unapproved_isolator->where('user_id', $user->id);
                $unapproved_lightning_arrester->where('user_id', $user->id);
                $unapproved_fco->where('user_id', $user->id);
                $unapproved_phbtr->where('user_id', $user->id);
            }
        }

        // Ambil hasil query
        $unapproved_kwh_meters = $unapproved_kwh_meters->get();
        $unapproved_mcbs = $unapproved_mcbs->get();
        $unapproved_trafo = $unapproved_trafo->get();

        $unapproved_cable_powers = $unapproved_cable_powers->get();
        $unapproved_conductors = $unapproved_conductors->get();
        $unapproved_trafo_arus = $unapproved_trafo_arus->get();
        $unapproved_trafo_tegangan = $unapproved_trafo_tegangan->get();
        $unapproved_tiang_listrik = $unapproved_tiang_listrik->get();

        $unapproved_lbs = $unapproved_lbs->get();
        $unapproved_isolator = $unapproved_isolator->get();
        $unapproved_lightning_arrester = $unapproved_lightning_arrester->get();
        $unapproved_fco = $unapproved_fco->get();
        $unapproved_phbtr = $unapproved_phbtr->get();

        // Gabungkan dan urutkan berdasarkan created_at
        $allUnapproved = collect()
            ->merge($unapproved_kwh_meters)
            ->merge($unapproved_mcbs)
            ->merge($unapproved_trafo)
            ->merge($unapproved_cable_powers)
            ->merge($unapproved_conductors)
            ->merge($unapproved_trafo_arus)
            ->merge($unapproved_trafo_tegangan)
            ->merge($unapproved_tiang_listrik)
            ->merge($unapproved_lbs)
            ->merge($unapproved_isolator)
            ->merge($unapproved_lightning_arrester)
            ->merge($unapproved_fco)
            ->merge($unapproved_phbtr)
            ->sortByDesc('created_at')
            ->values();

        // Ambil daftar gudang yang terkait dengan form yang belum disetujui
        $gudang_retur = collect()
            ->merge($unapproved_kwh_meters->pluck('gudang_id'))
            ->merge($unapproved_mcbs->pluck('gudang_id'))
            ->merge($unapproved_trafo->pluck('gudang_id'))
            ->merge($unapproved_cable_powers->pluck('gudang_id'))
            ->merge($unapproved_conductors->pluck('gudang_id'))
            ->merge($unapproved_trafo_arus->pluck('gudang_id'))
            ->merge($unapproved_trafo_tegangan->pluck('gudang_id'))
            ->merge($unapproved_tiang_listrik->pluck('gudang_id'))
            ->merge($unapproved_lbs->pluck('gudang_id'))
            ->merge($unapproved_isolator->pluck('gudang_id'))
            ->merge($unapproved_lightning_arrester->pluck('gudang_id'))
            ->merge($unapproved_fco->pluck('gudang_id'))
            ->merge($unapproved_phbtr->pluck('gudang_id'))
            ->unique()
            ->values();

        // // Paginasi manual
        // $page = request()->get('page', 1);
        // $perPage = 10;
        // $currentPageItems = $allUnapproved->slice(($page - 1) * $perPage, $perPage)->values();

        // $allUnapproved = new LengthAwarePaginator(
        //     $currentPageItems,
        //     $allUnapproved->count(),
        //     $perPage,
        //     $page,
        //     ['path' => request()->url()]
        // );

        // Ambil data gudang yang sesuai dengan gudang_retur
        $gudangs = Gudang::whereIn('id', $gudang_retur)->get();

        // Ambil nama gudang berdasarkan gudang_id user (jika role-nya PIC_Gudang)
        $gudang_user = null;
        if ($user->hasRole('PIC_Gudang') && $user->gudang_id) {
            $gudang_user = Gudang::where('id', $user->gudang_id)->first();
        }

        return view('form.unapproved', compact('allUnapproved', 'gudangs', 'gudang_user', 'gudang_retur'));
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
