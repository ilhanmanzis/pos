<?php

namespace App\Http\Controllers;

use App\Models\Transaksis;
use Illuminate\Http\Request;

class Penagihan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Penagihan',
            'page' => 'Penagihan',
            'title' => 'Penagihan',
            'transaksis' => Transaksis::where('status', 'belum bayar')->with(['pelanggan'])->filter(request()->only(['transaksi']))->orderBy('updated_at', 'desc')->paginate(10)->withQueryString()
        ];

        return view('finance/penagihan/index', $data);
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
        Transaksis::where('id_transaksi', $id)->update([
            'status' => 'lunas'
        ]);
        return redirect(route('finance.penagihan'))->with('success', 'Pembayaran berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
