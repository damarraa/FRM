<?php

namespace App\Http\Controllers;

use App\Models\CablePower;
use App\Models\Conductor;
use App\Models\Cubicle;
use App\Models\FuseCutOut;
use App\Models\Gudang;
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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $perPage = 10;

        // Query untuk total form per bulan
        $formsQuery = KWHMeter::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
            ->where('user_id', $user->id)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->unionAll(
                MCB::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                Trafo::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                CablePower::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                Conductor::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                TrafoArus::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                TrafoTegangan::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                TiangListrik::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                LBS::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                Isolator::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                LightningArrester::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                FuseCutOut::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                PHBTR::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                Cubicle::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            )
            ->unionAll(
                KotakAPP::select(DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as total"))
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw("MONTH(created_at)"))
            );

        $monthlyData = DB::table(DB::raw("({$formsQuery->toSql()}) as monthly"))
            ->mergeBindings($formsQuery->getQuery())
            ->select("month", DB::raw("SUM(total) as total"))
            ->groupBy("month")
            ->orderBy("month")
            ->get();

        // Ambil semua unapproved forms dari setiap tabel
        $unapprovedForms = KWHMeter::selectRaw('no_surat, jenis_forms.nama_form')
            ->join('jenis_forms', 'kwh_meters.jenis_form_id', '=', 'jenis_forms.id')
            ->where('kwh_meters.user_id', $user->id)
            ->where('kwh_meters.status', 'Unapproved')
            ->union(
                MCB::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'mcbs.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('mcbs.user_id', $user->id)
                    ->where('mcbs.status', 'Unapproved')
            )
            ->union(
                Trafo::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'trafos.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('trafos.user_id', $user->id)
                    ->where('trafos.status', 'Unapproved')
            )
            ->union(
                CablePower::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'cable_powers.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('cable_powers.user_id', $user->id)
                    ->where('cable_powers.status', 'Unapproved')
            )
            ->union(
                Conductor::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'conductors.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('conductors.user_id', $user->id)
                    ->where('conductors.status', 'Unapproved')
            )
            ->union(
                TrafoArus::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'trafo_aruses.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('trafo_aruses.user_id', $user->id)
                    ->where('trafo_aruses.status', 'Unapproved')
            )
            ->union(
                TrafoTegangan::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'trafo_tegangans.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('trafo_tegangans.user_id', $user->id)
                    ->where('trafo_tegangans.status', 'Unapproved')
            )
            ->union(
                TiangListrik::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'tiang_listriks.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('tiang_listriks.user_id', $user->id)
                    ->where('tiang_listriks.status', 'Unapproved')
            )
            ->union(
                LBS::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'l_b_s.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('l_b_s.user_id', $user->id)
                    ->where('l_b_s.status', 'Unapproved')
            )
            ->union(
                Isolator::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'isolators.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('isolators.user_id', $user->id)
                    ->where('isolators.status', 'Unapproved')
            )
            ->union(
                LightningArrester::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'lightning_arresters.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('lightning_arresters.user_id', $user->id)
                    ->where('lightning_arresters.status', 'Unapproved')
            )
            ->union(
                FuseCutOut::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'fuse_cut_outs.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('fuse_cut_outs.user_id', $user->id)
                    ->where('fuse_cut_outs.status', 'Unapproved')
            )
            ->union(
                PHBTR::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'p_h_b_t_r_s.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('p_h_b_t_r_s.user_id', $user->id)
                    ->where('p_h_b_t_r_s.status', 'Unapproved')
            )
            ->union(
                Cubicle::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'cubicles.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('cubicles.user_id', $user->id)
                    ->where('cubicles.status', 'Unapproved')
            )
            ->union(
                KotakAPP::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'kotak_a_p_p_s.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('kotak_a_p_p_s.user_id', $user->id)
                    ->where('kotak_a_p_p_s.status', 'Unapproved')
            )
            ->orderBy('no_surat', 'desc') // Urutkan berdasarkan no_surat terbaru
            ->get();

        // Ambil semua approved forms dari setiap tabel
        $approvedForms = KWHMeter::selectRaw('no_surat, jenis_forms.nama_form')
            ->join('jenis_forms', 'kwh_meters.jenis_form_id', '=', 'jenis_forms.id')
            ->where('kwh_meters.user_id', $user->id)
            ->whereNotNull('kwh_meters.approved_by') // Form yang sudah diapprove
            ->union(
                MCB::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'mcbs.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('mcbs.user_id', $user->id)
                    ->whereNotNull('mcbs.approved_by')
            )
            ->union(
                Trafo::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'trafos.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('trafos.user_id', $user->id)
                    ->whereNotNull('trafos.approved_by')
            )
            ->union(
                CablePower::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'cable_powers.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('cable_powers.user_id', $user->id)
                    ->whereNotNull('cable_powers.approved_by')
            )
            ->union(
                Conductor::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'conductors.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('conductors.user_id', $user->id)
                    ->whereNotNull('conductors.approved_by')
            )
            ->union(
                TrafoArus::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'trafo_aruses.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('trafo_aruses.user_id', $user->id)
                    ->whereNotNull('trafo_aruses.approved_by')
            )
            ->union(
                TrafoTegangan::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'trafo_tegangans.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('trafo_tegangans.user_id', $user->id)
                    ->whereNotNull('trafo_tegangans.approved_by')
            )
            ->union(
                LBS::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'l_b_s.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('l_b_s.user_id', $user->id)
                    ->whereNotNull('l_b_s.approved_by')
            )
            ->union(
                Isolator::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'isolators.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('isolators.user_id', $user->id)
                    ->whereNotNull('isolators.approved_by')
            )
            ->union(
                LightningArrester::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'lightning_arresters.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('lightning_arresters.user_id', $user->id)
                    ->whereNotNull('lightning_arresters.approved_by')
            )
            ->union(
                FuseCutOut::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'fuse_cut_outs.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('fuse_cut_outs.user_id', $user->id)
                    ->whereNotNull('fuse_cut_outs.approved_by')
            )
            ->union(
                PHBTR::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'p_h_b_t_r_s.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('p_h_b_t_r_s.user_id', $user->id)
                    ->whereNotNull('p_h_b_t_r_s.approved_by')
            )
            ->union(
                Cubicle::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'cubicles.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('cubicles.user_id', $user->id)
                    ->whereNotNull('cubicles.approved_by')
            )
            ->union(
                KotakAPP::selectRaw('no_surat, jenis_forms.nama_form')
                    ->join('jenis_forms', 'kotak_a_p_p_s.jenis_form_id', '=', 'jenis_forms.id')
                    ->where('kotak_a_p_p_s.user_id', $user->id)
                    ->whereNotNull('kotak_a_p_p_s.approved_by')
            )
            ->orderBy('no_surat', 'desc') // Urutkan berdasarkan no_surat terbaru
            ->get();

        // Format data untuk Chart.js
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $formSubmissionData = array_fill(0, 12, 0);

        foreach ($monthlyData as $data) {
            $formSubmissionData[$data->month - 1] = $data->total;
        }

        // Query untuk total form berdasarkan status
        $statusCounts = KWHMeter::select(
            DB::raw("COUNT(*) as total"),
            DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
            DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
        )
            ->where('user_id', $user->id)
            ->unionAll(
                MCB::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                Trafo::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                CablePower::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                Conductor::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                TrafoArus::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                TrafoTegangan::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                TiangListrik::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                LBS::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                Isolator::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                LightningArrester::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                FuseCutOut::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                PHBTR::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                Cubicle::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            )
            ->unionAll(
                KotakAPP::select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved"),
                    DB::raw("SUM(CASE WHEN status = 'Unapproved' THEN 1 ELSE 0 END) as unapproved")
                )
                    ->where('user_id', $user->id)
            );

        $statusData = DB::table(DB::raw("({$statusCounts->toSql()}) as status"))
            ->mergeBindings($statusCounts->getQuery())
            ->select(
                DB::raw("SUM(total) as totalForms"),
                DB::raw("SUM(approved) as totalApproved"),
                DB::raw("SUM(unapproved) as totalUnapproved")
            )
            ->first();

        // Query jumlah total unapproved forms dengan gudang_id yang sama
        $totalUnapprovedByGudang = KWHMeter::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            MCB::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Trafo::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            CablePower::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Conductor::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            TrafoArus::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            TrafoTegangan::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            TiangListrik::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            LBS::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Isolator::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            LightningArrester::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            FuseCutOut::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            PHBTR::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Cubicle::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            KotakAPP::where('status', 'Unapproved')
            ->where('gudang_id', $user->gudang_id)
            ->count();

        // Query jumlah total approved forms dengan gudang_id yang sama
        $totalApprovedByGudang = KWHMeter::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            MCB::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Trafo::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            CablePower::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Conductor::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            TrafoArus::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            TrafoTegangan::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            TiangListrik::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            LBS::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Isolator::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            LightningArrester::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            FuseCutOut::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            PHBTR::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            Cubicle::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count()
            +
            KotakAPP::where('status', 'Approved')
            ->where('gudang_id', $user->gudang_id)
            ->count();

        // Menghitung total semua form (Approved + Unapproved)
        $totalFormsByGudang = $totalApprovedByGudang + $totalUnapprovedByGudang;

        // Table Daftar Material
        $user = auth()->user();

        // Daftar model yang perlu diproses dengan nama route yang sesuai
        $models = [
            'KWHMeter' => [
                'class' => KWHMeter::class,
                'route' => 'form-retur-kwh-meter.edit'
            ],
            'MCB' => [
                'class' => MCB::class,
                'route' => 'form-retur-mcb.edit'
            ],
            'Trafo' => [
                'class' => Trafo::class,
                'route' => 'form-retur-trafo.edit'
            ],
            'CablePower' => [
                'class' => CablePower::class,
                'route' => 'form-retur-cable-power.edit'
            ],
            'Conductor' => [
                'class' => Conductor::class,
                'route' => 'form-retur-conductor.edit'
            ],
            'TrafoArus' => [
                'class' => TrafoArus::class,
                'route' => 'form-retur-ct.edit'
            ],
            'TrafoTegangan' => [
                'class' => TrafoTegangan::class,
                'route' => 'form-retur-pt.edit'
            ],
            'TiangListrik' => [
                'class' => TiangListrik::class,
                'route' => 'form-retur-tiang-listrik.edit'
            ],
            'LBS' => [
                'class' => LBS::class,
                'route' => 'form-retur-lbs.edit'
            ],
            'Isolator' => [
                'class' => Isolator::class,
                'route' => 'form-retur-isolator.edit'
            ],
            'LightningArrester' => [
                'class' => LightningArrester::class,
                'route' => 'form-retur-lightning-arrester.edit'
            ],
            'FuseCutOut' => [
                'class' => FuseCutOut::class,
                'route' => 'form-retur-fco.edit'
            ],
            'PHBTR' => [
                'class' => PHBTR::class,
                'route' => 'form-retur-phbtr.edit'
            ],
            'Cubicle' => [
                'class' => Cubicle::class,
                'route' => 'form-retur-cubicle.edit'
            ],
            'KotakAPP' => [
                'class' => KotakAPP::class,
                'route' => 'form-retur-kotak-app.edit'
            ],
        ];

        $unapprovedData = [];
        $gudangIds = collect();

        foreach ($models as $key => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $query = $modelClass::where('status', 'Unapproved')
                ->with(['gudang', 'jenisForm']);

            // Jika bukan Admin, tambahkan filter
            if (!$user->hasRole('Admin')) {
                if ($user->hasRole('PIC_Gudang') && $user->gudang_id) {
                    // Filter berdasarkan gudang_id untuk PIC_Gudang
                    $query->where('gudang_id', $user->gudang_id);
                } else {
                    // Filter berdasarkan user_id untuk user biasa
                    $query->where('user_id', $user->id);
                }
            }

            $results = $query->get();
            $unapprovedData[$key] = [
                'data' => $results,
                'route' => $modelInfo['route']
            ];
            $gudangIds = $gudangIds->merge($results->pluck('gudang_id'));
        }

        // Gabungkan semua data dan urutkan
        $allUnapproved = collect();

        foreach ($unapprovedData as $key => $data) {
            $allUnapproved = $allUnapproved->merge(
                $data['data']->map(function ($item) use ($data) {
                    $item->route_name = $data['route'];
                    return $item;
                })
            );
        }

        $allUnapproved = $allUnapproved->sortByDesc('created_at')->values();

        // Ambil daftar gudang yang unik
        $gudang_retur = $gudangIds->unique()->values();

        // Paginasi
        $page = request()->get('page', 1);
        $perPage = 2; // Anda bisa sesuaikan ini
        $currentPageItems = $allUnapproved->slice(($page - 1) * $perPage, $perPage)->values();

        $allUnapproved = new LengthAwarePaginator(
            $currentPageItems,
            $allUnapproved->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Ambil data gudang yang sesuai dengan gudang_retur
        $gudangs = Gudang::whereIn('id', $gudang_retur)->get();

        // Ambil nama gudang berdasarkan gudang_id user (jika role-nya PIC_Gudang)
        $gudang_user = null;
        if ($user->hasRole('PIC_Gudang') && $user->gudang_id) {
            $gudang_user = Gudang::where('id', $user->gudang_id)->first();
        }

        // Pie chart
        $totalCategoriesByGudang = [
            'K6' => KWHMeter::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + MCB::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + Trafo::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + TrafoArus::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + TrafoTegangan::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + TiangListrik::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + LBS::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + Isolator::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + LightningArrester::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + FuseCutOut::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + PHBTR::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + Cubicle::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count()
                + KotakAPP::where('kesimpulan', 'Bekas layak pakai (K6)')->where('gudang_id', $user->gudang_id)->count(),
            'K7' => KWHMeter::where('kesimpulan', 'Masih garansi (K7)')->where('gudang_id', $user->gudang_id)->count()
                + MCB::where('kesimpulan', 'Masih garansi (K7)')->where('gudang_id', $user->gudang_id)->count()
                + Trafo::where('kesimpulan', 'Masih garansi (K7)')->where('gudang_id', $user->gudang_id)->count()
                + TrafoArus::where('kesimpulan', 'Masih garansi (K7)')->where('gudang_id', $user->gudang_id)->count()
                + TrafoTegangan::where('kesimpulan', 'Masih garansi (K7)')->where('gudang_id', $user->gudang_id)->count()
                + TiangListrik::where('kesimpulan', 'Masih garansi (K7)')->where('gudang_id', $user->gudang_id)->count()
                + LBS::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->where('gudang_id', $user->gudang_id)->count()
                + Isolator::where('kesimpulan', 'Masih garansi (K7)')->where('gudang_id', $user->gudang_id)->count()
                + LightningArrester::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->where('gudang_id', $user->gudang_id)->count()
                + FuseCutOut::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->where('gudang_id', $user->gudang_id)->count()
                + PHBTR::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->where('gudang_id', $user->gudang_id)->count()
                + Cubicle::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->where('gudang_id', $user->gudang_id)->count()
                + KotakAPP::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->where('gudang_id', $user->gudang_id)->count(),
            'K8' => KWHMeter::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + MCB::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + Trafo::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + TrafoArus::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + TrafoTegangan::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + TiangListrik::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + LBS::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + Isolator::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + LightningArrester::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + FuseCutOut::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + PHBTR::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + Cubicle::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count()
                + KotakAPP::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->where('gudang_id', $user->gudang_id)->count(),
        ];

        // Inisialisasi array bulan dengan nilai default 0
        $defaultMonths = array_fill(1, 12, 0);

        // Query data per bulan
        $returData = [
            'KWH Meter' => array_replace(
                $defaultMonths,
                KWHMeter::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'MCB' => array_replace(
                $defaultMonths,
                MCB::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Trafo' => array_replace(
                $defaultMonths,
                Trafo::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Cable Power' => array_replace(
                $defaultMonths,
                CablePower::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Conductor' => array_replace(
                $defaultMonths,
                Conductor::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Trafo Arus' => array_replace(
                $defaultMonths,
                TrafoArus::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Trafo Tegangan' => array_replace(
                $defaultMonths,
                TrafoTegangan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Tiang Listrik' => array_replace(
                $defaultMonths,
                TiangListrik::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'LBS' => array_replace(
                $defaultMonths,
                LBS::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Isolator' => array_replace(
                $defaultMonths,
                Isolator::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Lightning Arrester' => array_replace(
                $defaultMonths,
                LightningArrester::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Fuse Cut Out' => array_replace(
                $defaultMonths,
                FuseCutOut::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'PHBTR' => array_replace(
                $defaultMonths,
                PHBTR::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Cubicle' => array_replace(
                $defaultMonths,
                Cubicle::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Kotak APP' => array_replace(
                $defaultMonths,
                KotakAPP::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->where('gudang_id', $user->gudang_id)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),
        ];

        // Dashboard Admin
        // Query untuk menghitung jumlah total users berdasarkan role
        $totalAdmin = User::role('Admin')->count();
        $totalPICGudang = User::role('PIC_Gudang')->count();
        $totalPetugas = User::role('Petugas')->count();

        // Query pie chart
        $totalCategories = [
            'K6' => KWHMeter::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + MCB::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + Trafo::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + TrafoArus::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + TrafoTegangan::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + TiangListrik::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + LBS::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + Isolator::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + LightningArrester::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + FuseCutOut::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + PHBTR::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + Cubicle::where('kesimpulan', 'Bekas layak pakai (K6)')->count()
                + KotakAPP::where('kesimpulan', 'Bekas layak pakai (K6)')->count(),
            'K7' => KWHMeter::where('kesimpulan', 'Masih garansi (K7)')->count()
                + MCB::where('kesimpulan', 'Masih garansi (K7)')->count()
                + Trafo::where('kesimpulan', 'Masih garansi (K7)')->count()
                + TrafoArus::where('kesimpulan', 'Masih garansi (K7)')->count()
                + TrafoTegangan::where('kesimpulan', 'Masih garansi (K7)')->count()
                + TiangListrik::where('kesimpulan', 'Masih garansi (K7)')->count()
                + LBS::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->count()
                + Isolator::where('kesimpulan', 'Masih garansi (K7)')->count()
                + LightningArrester::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->count()
                + FuseCutOut::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->count()
                + PHBTR::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->count(),
                + Cubicle::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->count(),
                + KotakAPP::where('kesimpulan', 'Bekas bisa diperbaiki (K7)')->count(),
            'K8' => KWHMeter::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + MCB::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + Trafo::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + TrafoArus::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + TrafoTegangan::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + TiangListrik::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + LBS::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + Isolator::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + LightningArrester::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + FuseCutOut::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + PHBTR::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + Cubicle::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count()
                + KotakAPP::where('kesimpulan', 'Bekas tidak layak pakai (K8)')->count(),
        ];

        // Total semua form
        $totalFormAdmin = DB::table(DB::raw("(SELECT COUNT(*) as total FROM kwh_meters
            UNION ALL
            SELECT COUNT(*) as total FROM mcbs
            UNION ALL
            SELECT COUNT(*) as total FROM trafos
            UNION ALL
            SELECT COUNT(*) as total FROM cable_powers
            UNION ALL
            SELECT COUNT(*) as total FROM conductors
            UNION ALL
            SELECT COUNT(*) as total FROM trafo_aruses
            UNION ALL
            SELECT COUNT(*) as total FROM trafo_tegangans
            UNION ALL
            SELECT COUNT(*) as total FROM tiang_listriks
            UNION ALL
            SELECT COUNT(*) as total FROM l_b_s
            UNION ALL
            SELECT COUNT(*) as total FROM lightning_arresters
            UNION ALL
            SELECT COUNT(*) as total FROM isolators
            UNION ALL
            SELECT COUNT(*) as total FROM fuse_cut_outs
            UNION ALL
            SELECT COUNT(*) as total FROM p_h_b_t_r_s
            UNION ALL
            SELECT COUNT(*) as total FROM kotak_a_p_p_s
            UNION ALL
            SELECT COUNT(*) as total FROM cubicles
            ) as forms"))
            ->selectRaw('SUM(total) as total')
            ->value('total') ?? 0;

        // Line chart admin
        // Query data per bulan tanpa gudang_id
        $returDataAdmin = [
            'KWH Meter' => array_replace(
                $defaultMonths,
                KWHMeter::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'MCB' => array_replace(
                $defaultMonths,
                MCB::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Trafo' => array_replace(
                $defaultMonths,
                Trafo::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Cable Power' => array_replace(
                $defaultMonths,
                CablePower::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Conductor' => array_replace(
                $defaultMonths,
                Conductor::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Trafo Arus' => array_replace(
                $defaultMonths,
                TrafoArus::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Trafo Tegangan' => array_replace(
                $defaultMonths,
                TrafoTegangan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Tiang Listrik' => array_replace(
                $defaultMonths,
                TiangListrik::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'LBS' => array_replace(
                $defaultMonths,
                LBS::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Isolator' => array_replace(
                $defaultMonths,
                Isolator::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Lightning Arrester' => array_replace(
                $defaultMonths,
                LightningArrester::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Fuse Cut Out' => array_replace(
                $defaultMonths,
                FuseCutOut::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'PHBTR' => array_replace(
                $defaultMonths,
                PHBTR::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Cubicle' => array_replace(
                $defaultMonths,
                Cubicle::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),

            'Kotak APP' => array_replace(
                $defaultMonths,
                KotakAPP::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray()
            ),
        ];

        // Query untuk stacked bar
        // Ambil 7 hari terakhir
        $days = [];
        for ($i = 6; $i >= 0; $i--) {
            $days[] = Carbon::now()->subDays($i)->format('Y-m-d');
        }

        // Inisialisasi array default dengan nilai 0
        $defaultDays = array_fill_keys($days, 0);

        // Query data status Approved dan Unapproved dengan UNION ALL
        $dailyStatusQuery = KWHMeter::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
            ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('day', 'status')
            ->unionAll(
                MCB::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                Trafo::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                CablePower::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                Conductor::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                TrafoArus::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                TrafoTegangan::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                TiangListrik::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                LBS::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                Isolator::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                LightningArrester::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                FuseCutOut::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                PHBTR::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                Cubicle::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            )
            ->unionAll(
                KotakAPP::selectRaw("DATE(created_at) as day, status, COUNT(*) as total")
                    ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
                    ->groupBy('day', 'status')
            );

        $dailyStatusData = DB::table(DB::raw("({$dailyStatusQuery->toSql()}) as daily"))
            ->mergeBindings($dailyStatusQuery->getQuery())
            ->select("day", "status", DB::raw("SUM(total) as total"))
            ->groupBy("day", "status")
            ->get();

        // Format hasil ke dalam array structured
        $dailyData = [
            'Approved' => $defaultDays,
            'Unapproved' => $defaultDays,
        ];

        foreach ($dailyStatusData as $data) {
            $dailyData[$data->status][$data->day] = $data->total;
        }

        // **Ubah tanggal ke nama hari dalam Bahasa Indonesia**
        Carbon::setLocale('id');

        $labels = array_map(function ($date) {
            return Carbon::parse($date)->translatedFormat('l'); // Senin, Selasa, Rabu, dst.
        }, array_keys($defaultDays));

        // Siapkan data untuk dikirim ke view
        $stackedBarData = [
            'labels' => $labels, // Nama hari sebagai label sumbu X
            'approved' => array_values($dailyData['Approved']),
            'unapproved' => array_values($dailyData['Unapproved']),
        ];

        // Notifikasi Admin
        // Ambil user yang baru registrasi atau memiliki status is_active = 0
        $newUsers = User::where('is_active', 0)->count();

        return view('dashboard', [
            'user' => $user,
            'formSubmissionData' => $formSubmissionData,
            'totalForms' => $statusData->totalForms,
            'totalApproved' => $statusData->totalApproved,
            'totalUnapproved' => $statusData->totalUnapproved,
            'unapprovedForms' => $unapprovedForms,
            'approvedForms' => $approvedForms,
            'totalUnapprovedByGudang' => $totalUnapprovedByGudang,
            'totalApprovedByGudang' => $totalApprovedByGudang,
            'totalFormsByGudang' => $totalFormsByGudang,
            'allUnapproved' => $allUnapproved,
            'gudangs' => $gudangs,
            'gudang_user' => $gudang_user,
            'gudang_retur' => $gudang_retur,
            'totalCategoriesByGudang' => $totalCategoriesByGudang,
            'returData' => $returData,
            'totalAdmin' => $totalAdmin,
            'totalPICGudang' => $totalPICGudang,
            'totalPetugas' => $totalPetugas,
            'totalCategories' => $totalCategories,
            'totalFormAdmin' => $totalFormAdmin,
            'returDataAdmin' => $returDataAdmin,
            'stackedBarData' => $stackedBarData,
            'newUsers' => $newUsers
        ]);
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

    /**
     * Display the specified chart.
     */
    // public function chart()
    // {
    //     $user = auth()->user();
    //     $perPage = 10;

    //     // Ambil semua status (Approved dan Unapproved)
    //     $kwh_meters = KWHMeter::where('user_id', $user->id)->latest()->get();
    //     $mcbs = MCB::where('user_id', $user->id)->latest()->get();
    //     $trafos = Trafo::where('user_id', $user->id)->latest()->get();

    //     // Jika user adalah PIC_Gudang, filter berdasarkan gudang_id
    //     if ($user->hasRole('PIC_Gudang') && $user->gudang_id) {
    //         $kwh_meters = $kwh_meters->where('gudang_id', $user->gudang_id);
    //         $mcbs = $mcbs->where('gudang_id', $user->gudang_id);
    //         $trafos = $trafos->where('gudang_id', $user->gudang_id);
    //     }

    //     // Gabungkan Approved & Unapproved
    //     $allForms = collect()
    //         ->merge($kwh_meters)
    //         ->merge($mcbs)
    //         ->merge($trafos)
    //         ->sortByDesc('created_at') // Urutkan dari terbaru ke terlama
    //         ->values();

    //     // Total data
    //     $totalForms = $allForms->count();

    //     return view('dashboard', compact('allForms', 'totalForms'));
    // }
}
