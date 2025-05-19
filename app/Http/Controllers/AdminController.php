<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function activeUsers()
    {
        // Hitung jumlah user aktif
        $activeUsersCount = User::where('is_active', true)->count();

        // Ambil data user aktif dengan pagination dan relasi roles
        $activeUsers = User::where('is_active', true)
            ->with('roles')
            ->orderBy('last_active_at', 'desc')
            ->paginate(10); // Sesuaikan jumlah per page sesuai kebutuhan

        return view('dashboard', [
            'activeUsersCount' => $activeUsersCount,
            'activeUsers' => $activeUsers
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
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
