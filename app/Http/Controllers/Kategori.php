<?php

namespace App\Http\Controllers;

use App\Models\Kategoris;
use Illuminate\Http\Request;

class Kategori extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Kategori Produk',
            'page' => 'Kategori Produk',
            'title' => 'Kategori Produk',
            'kategoris' => Kategoris::orderBy('updated_at', 'desc')->paginate(10)->withQueryString()
        ];

        return view('gudang/kategori/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' =>  'Kategori Produk',
            'page' => 'Kategori Produk',
            'title' => 'Tambah Kategori Produk',
        ];

        return view('gudang/kategori/create', $data);
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

        Kategoris::create([
            'name' => $request->input('name')
        ]);

        return redirect(route('gudang.kategori'))->with('success', 'Kategori berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' =>  'Kategori Produk',
            'page' => 'Kategori Produk',
            'title' => 'Edit Kategori Produk',
            'kategori' => Kategoris::find($id)
        ];

        return view('gudang/kategori/show', $data);
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

        Kategoris::where('id_kategori', $id)->update([
            'name' => $request->input('name')
        ]);

        return redirect(route('gudang.kategori'))->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kategoris::where('id_kategori', $id)->delete();
        return redirect(route('gudang.kategori'))->with('success', 'Kategori berhasil dihapus');
    }
}
