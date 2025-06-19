<?php

namespace App\Http\Controllers;

use App\Models\Produks;
use App\Models\ProdukStok;
use App\Models\ReturDetail;
use App\Models\Returs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Retur extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Retur',
            'page' => 'Retur',
            'title' => 'Retur',
            'returs' => Returs::with(['details', 'details.produk'])
                ->filter([
                    'produk' => request('produk'),
                ])
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString()
        ];

        ($data);

        return view('gudang/retur/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' =>  'Retur',
            'page' => 'Retur',
            'title' => 'Tambah Retur',
            'produks' => Produks::all()
        ];

        return view('gudang/retur/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'kondisi' => 'required',
            'id_stok' => 'required|array|min:1',
            'jumlah_satuan' => 'required|array',
            'jumlah_satuan.*' => 'required|integer|min:0',
        ], [
            'kondisi.required' => 'kondisi tidak boleh kosong',

        ]);
        $kondisi = $request->kondisi;
        $jumlahSatuans = $request->jumlah_satuan;
        $stokIds = $request->id_stok;

        $produk = Produks::find($request->id_produk);

        $retur = Returs::create([
            'id_user' => Auth::id(),
            'tanggal' => now(),
            'jenis' => $kondisi,
            'catatan' => $request->catatan
        ]);

        if ($kondisi === 'bagus') {
            foreach ($stokIds as $index => $id) {
                $existingStok = ProdukStok::find($id);

                if ($existingStok) {
                    $stokBaru = $existingStok->jumlah_satuan + $jumlahSatuans[$index];

                    $existingStok->update([
                        'jumlah_satuan' => $stokBaru,
                    ]);
                }
            }
        }

        // 2. Simpan data retur detail
        foreach ($stokIds as $index => $item) {
            ReturDetail::create([
                'id_stok' => $item,
                'id_produk' => $request->id_produk,
                'id_retur' => $retur->id_retur,
                'satuan' => $produk['satuan'],
                'jumlah_satuan' => $jumlahSatuans[$index],
            ]);
        }



        return redirect()->route('gudang.retur')->with('success', 'Retur berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $retur = Returs::with(['details'])->find($id);
        // Controller
        $returDetails = $retur->details->map(function ($d) {
            return [
                'id_stok' => $d->id_stok,
                'size' => $d->stok->size,
                'satuan' => $d->satuan,
                'jumlah_satuan' => $d->jumlah_satuan,
            ];
        });

        $data = [
            'selected' =>  'Retur',
            'page' => 'Retur',
            'title' => 'Edit Retur',
            'produks' => Produks::all(),
            'retur' => $retur,
            'returDetails' => $returDetails
        ];


        return view('gudang/retur/show', $data);
    }

    public function detail(string $id)
    {
        $retur = Returs::with(['details', 'details.produk'])->find($id);
        $data = [
            'selected' =>  'Retur',
            'page' => 'Retur',
            'title' => $retur->details[0]->produk->name,
            'retur' => $retur
        ];

        return view('gudang/retur/detail', $data);
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
            'id_produk' => 'required|exists:produks,id_produk',
            'kondisi' => 'required',
            'id_stok' => 'required|array|min:1',
            'jumlah_satuan' => 'required|array',
            'jumlah_satuan.*' => 'required|integer|min:0',
        ], [
            'kondisi.required' => 'kondisi tidak boleh kosong',
        ]);

        $kondisi = $request->kondisi;
        $jumlahSatuans = $request->jumlah_satuan;
        $stokIds = $request->id_stok;

        // Cari data retur lama
        $retur = Returs::findOrFail($id);
        // Simpan kondisi sebelumnya
        $jenisLama = $retur->jenis;


        // Update data retur utama
        $retur->update([
            'jenis' => $kondisi,
            'catatan' => $request->catatan,
            //'tanggal' => now(), // Optional: update tanggal juga jika perlu
        ]);

        // Ambil produk terkait
        $produk = Produks::findOrFail($request->id_produk);

        // Ambil semua retur detail yang terkait dengan retur ini
        $returDetailsLama = ReturDetail::where('id_retur', $retur->id_retur)->get();

        // Jika kondisi sebelumnya adalah 'bagus', kurangi stok dulu
        if ($jenisLama === 'bagus') {
            foreach ($returDetailsLama as $detail) {
                $stok = ProdukStok::find($detail->id_stok);
                if ($stok) {
                    $stok->jumlah_satuan -= $detail->jumlah_satuan;
                    if ($stok->jumlah_satuan < 0) {
                        $stok->jumlah_satuan = 0;
                    }
                    $stok->save();
                }
            }
        }

        // Hapus data retur detail lama
        ReturDetail::where('id_retur', $retur->id_retur)->delete();

        // Jika kondisi baru adalah 'bagus', tambah stok
        if ($kondisi === 'bagus') {
            foreach ($stokIds as $index => $id) {
                $existingStok = ProdukStok::find($id);
                if ($existingStok) {
                    $existingStok->jumlah_satuan += $jumlahSatuans[$index];
                    $existingStok->save();
                }
            }
        }

        // Simpan data retur detail baru
        foreach ($stokIds as $index => $stokId) {
            ReturDetail::create([
                'id_stok' => $stokId,
                'id_produk' => $request->id_produk,
                'id_retur' => $retur->id_retur,
                'satuan' => $produk->satuan,
                'jumlah_satuan' => $jumlahSatuans[$index],
            ]);
        }

        return redirect()->route('gudang.retur')->with('success', 'Data retur berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ambil data retur
        $retur = Returs::findOrFail($id);

        // Ambil detail retur terkait
        $returDetails = ReturDetail::where('id_retur', $retur->id_retur)->get();

        // Jika jenis retur adalah "bagus", kurangi stok sesuai retur detail
        if ($retur->jenis === 'bagus') {
            foreach ($returDetails as $detail) {
                $stok = ProdukStok::find($detail->id_stok);
                if ($stok) {
                    $stok->jumlah_satuan -= $detail->jumlah_satuan;
                    if ($stok->jumlah_satuan < 0) {
                        $stok->jumlah_satuan = 0;
                    }
                    $stok->save();
                }
            }
        }

        // Hapus detail retur
        ReturDetail::where('id_retur', $retur->id_retur)->delete();

        // Hapus retur utama
        $retur->delete();

        return redirect()->route('gudang.retur')->with('success', 'Data retur berhasil dihapus.');
    }
}
