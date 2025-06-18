<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\SuratJalanDetails;
use App\Models\Transaksis;
use Illuminate\Http\Request;

class BarangDiterima extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksis::with('pelanggan', 'detail', 'suratJalanDetails')->filter(request()->only(['transaksi'])) // pastikan relasi 'suratJalanDetails' ada di model Transaksis
            ->whereHas('suratJalanDetails', function ($query) {
                // Cari yang statusnya bukan 'diambil'
                $query->where('status', '!=', 'diambil');
            })
            ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        $data = [
            'selected' =>  'Produk Diterima',
            'page' => 'Produk Diterima',
            'title' => 'Produk Diterima',
            'transaksis' => $transaksis
        ];
        //dd($transaksis);

        return view('gudang/diterima/index', $data);
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
        $transaksi = Transaksis::find($id);
        SuratJalanDetails::where('kode_faktur', $transaksi['kode_faktur'])->update([
            'status' => 'diambil'
        ]);
        return redirect()->back()->with('success', 'Produk Berhasil Diterima');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
