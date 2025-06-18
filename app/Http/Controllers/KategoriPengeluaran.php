<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran as ModelsKategoriPengeluaran;
use Illuminate\Http\Request;

class KategoriPengeluaran extends Controller
{
    public function index()
    {
        $data = [
            'selected' =>  'Kategori Pengeluaran',
            'page' => 'Kategori Pengeluaran',
            'title' => 'Kategori Pengeluaran',
            'kategoris' => ModelsKategoriPengeluaran::orderBy('updated_at', 'desc')->paginate(10)->withQueryString()
        ];

        return view('finance/kategori/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' =>  'Kategori Pengeluaran',
            'page' => 'Kategori Pengeluaran',
            'title' => 'Tambah Kategori Pengeluaran',
        ];

        return view('finance/kategori/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong'
        ]);

        ModelsKategoriPengeluaran::create([
            'name' => $request->input('name')
        ]);

        return redirect(route('finance.kategori'))->with('success', 'Kategori berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' =>  'Kategori Pengeluaran',
            'page' => 'Kategori Pengeluaran',
            'title' => 'Edit Kategori Pengeluaran',
            'kategori' => ModelsKategoriPengeluaran::find($id)
        ];

        return view('finance/kategori/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong'
        ]);

        ModelsKategoriPengeluaran::where('id_kategori_pengeluaran', $id)->update([
            'name' => $request->input('name')
        ]);

        return redirect(route('finance.kategori'))->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ModelsKategoriPengeluaran::where('id_kategori_pengeluaran', $id)->delete();
        return redirect(route('finance.kategori'))->with('success', 'Kategori berhasil dihapus');
    }
}
