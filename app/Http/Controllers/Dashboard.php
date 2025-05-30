<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
        ];

        return view('admin/dashboard', $data);
    }

    public function finance()
    {
        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
        ];

        return view('finance/dashboard', $data);
    }

    public function gudang()
    {
        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
        ];

        return view('gudang/dashboard', $data);
    }

    public function home()
    {
        $user = Auth::user();


        if (!$user) {
            return redirect('login')->with('message', 'Silakan login terlebih dahulu');
        }
        if ($user->role == 'admin') {
            return redirect(route('admin.dashboard'));
        } elseif ($user->role == 'finance') {
            return redirect(route('finance.dashboard'));
        } elseif ($user->role == 'gudang') {
            return redirect(route('gudang.dashboard'));
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
