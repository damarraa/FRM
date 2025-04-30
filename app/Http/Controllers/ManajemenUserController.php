<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua roles yang tersedia
        $roles = Role::all();

        // Ambil semua data gudang
        $gudangList = Gudang::all();

        // Ambil semua data user dengan role-nya, terlepas dari is_active
        $allUsers = User::with('roles') // Eager load roles
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->orderByRaw("
            CASE
                WHEN roles.name = 'Admin' THEN 1
                WHEN roles.name = 'PIC_Gudang' THEN 2
                WHEN roles.name = 'Petugas' THEN 3
                ELSE 4
            END
        ")
            ->select('users.*', 'roles.name as role_name') // Ambil kolom dari users dan nama role
            ->paginate(10); // Sesuaikan jumlah pagination sesuai kebutuhan

        // Kirim data ke view
        return view('manajemen-user.manajemen-user', compact('roles', 'allUsers', 'gudangList'));
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
        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        }

        $user->delete();
        return response()->json(['success' => true, 'message' => 'User berhasil dihapus!']);
    }

    /**
     * Update Role Users.
     */
    public function updateRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findByName($request->role);

        // Assign role ke user menggunakan Spatie
        $user->syncRoles([$role->name]);

        return response()->json(['success' => true]);
    }

    /**
     * Update Gudang.
     */
    public function updateGudang(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->gudang_id = $request->gudang_id;
        $user->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update Status User.
     */
    public function updateStatus(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->is_active = $request->status;
        $user->save();

        return response()->json(['success' => true]);
    }

    /**
     * Server-side processing untuk filter AJAX.
     */
    /**
     * Server-side processing untuk filter AJAX.
     */
    public function fetch(Request $request)
    {
        // Query dasar untuk mengambil semua user terlepas dari is_active
        $query = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('gudangs', 'users.gudang_id', '=', 'gudangs.id')
            ->select(
                'users.id',
                'users.name',
                'users.no_hp',
                'users.email',
                'users.gudang_id',
                'users.is_active',
                'roles.name as role_name',
                'gudangs.nama_gudang'
            );

        // Filter berdasarkan gudang_id (jika ada)
        if ($request->filled('gudang_id')) {
            $query->where('users.gudang_id', $request->gudang_id);
        }

        // Fitur pencarian (search) berdasarkan name atau email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            });
        }

        // Pengurutan berdasarkan role
        $query->orderByRaw("
        CASE
            WHEN roles.name = 'Admin' THEN 1
            WHEN roles.name = 'PIC_Gudang' THEN 2
            WHEN roles.name = 'Petugas' THEN 3
            ELSE 4
        END");

        // Hitung total records tanpa filter
        $totalRecords = DB::table('users')->count();

        // Pagination untuk DataTables
        $filteredQuery = clone $query;
        $filteredCount = $filteredQuery->count();

        $users = $query->paginate($request->length ?? 10);

        // Format data untuk DataTables
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredCount,
            'data' => array_map(function ($user) {
                return [
                    'DT_RowId' => 'row_' . $user->id,
                    'id' => $user->id,
                    'name' => $user->name,
                    'no_hp' => $user->no_hp,
                    'email' => $user->email,
                    'role_name' => $user->role_name,
                    'gudang_id' => $user->gudang_id,
                    'nama_gudang' => $user->nama_gudang ?? null,
                    'is_active' => $user->is_active,
                    'is_petugas' => $user->role_name === 'Petugas'
                ];
            }, $users->items())
        ]);
    }
    // public function fetch(Request $request)
    // {
    //     // Query dasar untuk mengambil semua user terlepas dari is_active
    //     $query = DB::table('users')
    //         ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    //         ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    //         ->leftJoin('gudangs', 'users.gudang_id', '=', 'gudangs.id') // Join untuk mendapatkan nama gudang
    //         ->select('users.*', 'roles.name as role_name'); // Ambil kolom dari users dan nama role

    //     // Filter berdasarkan gudang_id (jika ada)
    //     if ($request->has('gudang_id') && $request->gudang_id != '') {
    //         $query->where('users.gudang_id', $request->gudang_id);
    //     }

    //     // Fitur pencarian (search) berdasarkan name atau email
    //     if ($request->has('search') && $request->search != '') {
    //         $search = $request->search;
    //         $query->where(function ($q) use ($search) {
    //             $q->where('users.name', 'like', '%' . $search . '%')
    //                 ->orWhere('users.email', 'like', '%' . $search . '%');
    //         });
    //     }

    //     // Pengurutan berdasarkan role
    //     $query->orderByRaw(" 
    //     CASE
    //         WHEN roles.name = 'Admin' THEN 1
    //         WHEN roles.name = 'PIC_Gudang' THEN 2
    //         WHEN roles.name = 'Petugas' THEN 3
    //         ELSE 4
    //     END");

    //     // Pagination untuk DataTables
    //     $users = $query->paginate($request->length ?? 10); // Default 10 item per halaman

    //     // Format data untuk DataTables
    //     return response()->json([
    //         'draw' => $request->draw, // Parameter draw dari DataTables
    //         'recordsTotal' => $users->total(), // Total records tanpa filter
    //         'recordsFiltered' => $users->total(), // Total records setelah filter
    //         'data' => $users->items(), // Data yang akan ditampilkan
    //     ]);
    // }
}
