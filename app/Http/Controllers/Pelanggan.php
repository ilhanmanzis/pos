<?php

namespace App\Http\Controllers;

use App\Models\Pelanggans;
use Illuminate\Http\Request;

class Pelanggan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Data Pelanggan',
            'page' => 'Data Pelanggan',
            'title' => 'Data Pelanggan',
            'pelanggans' => Pelanggans::orderBy('updated_at', 'desc')->filter(request()->only(['pelanggan']))->paginate(10)->withQueryString()
        ];

        return view('admin/pelanggan/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' =>  'Data Pelanggan',
            'page' => 'Data Pelanggan',
            'title' => 'Tambah Data Pelanggan',
        ];

        return view('admin/pelanggan/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'no_hp.required' => 'no_hp tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
            'desa.required' => 'desa tidak boleh kosong',
            'kecamatan.required' => 'kecamatan tidak boleh kosong',
            'kabupaten.required' => 'kabupaten tidak boleh kosong',
            'provinsi.required' => 'provinsi tidak boleh kosong',
        ]);


        // Hitung jumlah pelanggan
        $lastPelanggan = Pelanggans::orderBy('kode_pelanggan', 'desc')->first();

        // Tentukan kode pelanggan berikutnya
        $nextNumber = $lastPelanggan ? intval($lastPelanggan->kode_pelanggan) + 1 : 1;

        // Format jadi 5 digit
        $kodePelanggan = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Simpan data pelanggan baru
        Pelanggans::create([
            'kode_pelanggan' => $kodePelanggan,
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
        ]);

        return redirect(route('admin.pelanggan'))->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' =>  'Data Pelanggan',
            'page' => 'Data Pelanggan',
            'title' => 'Data Pelanggan',
            'pelanggan' => Pelanggans::find($id)
        ];

        return view('admin/pelanggan/show', $data);
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
            'name' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'no_hp.required' => 'no_hp tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
            'desa.required' => 'desa tidak boleh kosong',
            'kecamatan.required' => 'kecamatan tidak boleh kosong',
            'kabupaten.required' => 'kabupaten tidak boleh kosong',
            'provinsi.required' => 'provinsi tidak boleh kosong',
        ]);

        // Simpan data pelanggan baru
        Pelanggans::where('kode_pelanggan', $id)->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
        ]);

        return redirect(route('admin.pelanggan'))->with('success', 'Pelanggan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pelanggans::where('kode_pelanggan', $id)->delete();
        return redirect(route('admin.pelanggan'))->with('success', 'Pelanggan berhasil dihapus!');
    }
}
