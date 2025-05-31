<?php

namespace App\Http\Controllers;

use App\Models\Pelanggans;
use App\Models\Produks;
use App\Models\Profile;
use App\Models\Transaksis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Transaksi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Transaksi',
            'page' => 'Transaksi',
            'title' => 'Transaksi',
            'transaksis' => Transaksis::with(['pelanggan'])->filter(request()->only(['transaksi']))->orderBy('updated_at', 'desc')->paginate(10)->withQueryString()
        ];

        return view('finance/transaksi/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' =>  'Transaksi',
            'page' => 'Transaksi',
            'title' => 'Tambah Data Transaksi',
            'pelanggans' => Pelanggans::all(),
            'produks' => Produks::all(),

        ];

        return view('finance/transaksi/create', $data);
    }

    public function getPelanggan($kode)
    {
        $pelanggan = Pelanggans::where('kode_pelanggan', $kode)->firstOrFail();
        return response()->json($pelanggan);
    }

    public function getDetail($id)
    {
        $produk = Produks::with('stoks')->findOrFail($id);

        $sizes = $produk->stoks->pluck('size')->unique()->values(); // ambil size unik

        return response()->json([
            'id_produk' => $produk->id_produk,
            'nama_produk' => $produk->name,
            'sizes' => $sizes,
            'satuan' => $produk->satuan, // array ["box", "pack"] dsb
            'harga_jual' => $produk->harga_jual,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'pelanggan' => 'required',
            'keranjang' => 'required'
        ], [
            'pelanggan.required' => 'Data pelanggan tidak boleh kosong',
            'keranjang.required' => 'Data Keranjang tidak boleh kosong',
        ]);

        $tanggal = Carbon::parse($request->tanggal);
        $bulan = $tanggal->format('m');
        $tahun = $tanggal->format('Y');

        // Hitung jumlah transaksi di bulan & tahun ini
        $jumlahTransaksi = Transaksis::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count() + 1;

        $nomorUrut = str_pad($jumlahTransaksi, 5, '0', STR_PAD_LEFT);

        // Ambil nsfp dari profile
        $profile = Profile::first(); // Asumsikan hanya 1 profil
        $nsfp = $profile->nsfp ?? 'nsfp';

        $kodeFaktur = "{$nomorUrut}/{$bulan}/{$tahun}.{$nsfp}";
        //dd($kodeFaktur);

        $keranjang = json_decode($request->keranjang, true);
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
