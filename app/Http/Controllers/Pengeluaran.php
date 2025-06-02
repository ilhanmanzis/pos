<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use App\Models\Pengeluarans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pengeluaran extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Pengeluaran',
            'page' => 'Pengeluaran',
            'title' => 'Pengeluaran',
            'pengeluarans' => Pengeluarans::with(['kategori'])->filter(request()->only(['pengeluaran']))->orderBy('updated_at', 'desc')->paginate(10)->withQueryString()
        ];

        return view('finance/pengeluaran/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' =>  'Pengeluaran',
            'page' => 'Pengeluaran',
            'title' => 'Tambah Data Pengeluaran',
            'kategoris' => KategoriPengeluaran::all()
        ];

        return view('finance/pengeluaran/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'harga' => 'required|integer'
        ], [
            'kategori.required' => 'kategori tidak boleh kosong',
            'harga.required' => 'harga tidak boleh kosong',
            'harga.integer' => 'harga harus berupa angka',
        ]);

        Pengeluarans::create([
            'id_kategori_pengeluaran' => $request->input('kategori'),
            'id_user' => Auth::id(),
            'harga' => $request->input('harga'),
            'keterangan' => $request->input('keterangan'),
            'tanggal' => now()
        ]);

        return redirect(route('finance.pengeluaran'))->with('success', 'pengeluaran berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' =>  'Pengeluaran',
            'page' => 'Pengeluaran',
            'title' => 'Edit Data Pengeluaran',
            'kategoris' => KategoriPengeluaran::all(),
            'pengeluaran' => Pengeluarans::with(['kategori'])->find($id)
        ];

        return view('finance/pengeluaran/show', $data);
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
        $request->validate([
            'kategori' => 'required',
            'harga' => 'required|integer'
        ], [
            'kategori.required' => 'kategori tidak boleh kosong',
            'harga.required' => 'harga tidak boleh kosong',
            'harga.integer' => 'harga harus berupa angka',
        ]);

        Pengeluarans::where('id_pengeluaran', $id)->update([
            'id_kategori_pengeluaran' => $request->input('kategori'),
            'harga' => $request->input('harga'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect(route('finance.pengeluaran'))->with('success', 'pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pengeluarans::where('id_pengeluaran', $id)->delete();
        return redirect(route('finance.pengeluaran'))->with('success', 'pengeluaran berhasil dihapus');
    }
}
