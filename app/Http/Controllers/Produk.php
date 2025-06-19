<?php

namespace App\Http\Controllers;

use App\Models\Produks;
use App\Models\Kategoris;
use App\Models\ProdukSize;
use App\Models\ProdukStok;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Produk extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [
            'selected' =>  'Produk',
            'page' => 'Produk',
            'title' => 'Produk',
            'produks' => Produks::with(['kategori', 'stoks'])
                ->filter(request()->only(['produk']))
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString()
        ];

        //dd($data);

        return view('gudang/produk/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' =>  'Produk',
            'page' => 'Produk',
            'title' => 'Tambah Produk',
            'kategoris' => Kategoris::all()
        ];

        return view('gudang/produk/create', $data);
    }

    public function stok(string $id)
    {
        $produk = Produks::with(['stoks'])->find($id);

        if (!$produk) {
            return response()->json([], 404);
        }

        // return stok beserta satuan produk (anggap satuan di produk)
        $result = $produk->stoks->map(function ($stok) use ($produk) {
            return [
                'id_stok' => $stok->id_stok,
                'size' => $stok->size,
                'satuan' => $produk->satuan,
            ];
        });

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'merk' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'size' => 'required|array',
            'size.*' => 'required|string|max:50',
            'harga_beli' => 'required|array',
            'harga_beli.*' => 'required|numeric|min:0',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'merk.required' => 'merk tidak boleh kosong',
            'kategori.required' => 'kategori tidak boleh kosong',
            'satuan.required' => 'satuan tidak boleh kosong',

        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            // Simpan foto baru
            $extension = $request->file('foto')->extension();
            $uuidName = Str::uuid() . '.' . $extension;

            // Simpan ke storage/app/public/produk
            $request->file('foto')->storeAs('produk', time() . $uuidName, 'public');


            // Simpan nama file ke database
            $foto = time() . $uuidName;
        }
        
        //tambah data ke tabel produks
        $produk = Produks::create(
            [
                'id_kategori' => $request->input('kategori'),
                'kode' => $request->input('kode'),
                'name' => $request->input('name'),
                'merk' => $request->input('merk'),
                'keterangan' => $request->input('keterangan'),
                'foto' => $foto,
                'satuan' => $request->input('satuan'),
            ]
        );

        // tambah data ke tabel produk_stoks
        foreach ($request->input('size') as $i => $sizeName) {
            ProdukStok::create([
                'size' => $sizeName,
                'id_produk' => $produk->id_produk,
                'jumlah' => $request->input('jumlah')[$i],
                'harga_beli' => $request->input('harga_beli')[$i],
            ]);
        }
        return redirect()->route('gudang.produk')->with('success', 'Produk berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' =>  'Produk',
            'page' => 'Produk',
            'title' => 'Edit Produk',
            'kategoris' => Kategoris::all(),
            'produk' => Produks::with(['kategori', 'stoks'])->find($id)
        ];

        return view('gudang/produk/show', $data);
    }

    public function tambah(string $id)
    {
        $data = [
            'selected' =>  'Produk',
            'page' => 'Produk',
            'title' => 'Tambah Stok Produk',
            'kategoris' => Kategoris::all(),
            'produk' => Produks::with(['kategori', 'stoks'])->find($id)
        ];

        return view('gudang/produk/tambah', $data);
    }
    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        $produk = Produks::with(['kategori', 'stoks'])->find($id);
        $data = [
            'selected' =>  'Produk',
            'page' => 'Produk',
            'title' => $produk->name,
            'produk' => $produk
        ];



        return view('gudang/produk/detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editStok(Request $request, string $id)
    {
        $request->validate([
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:0',
        ]);


        $jumlah = $request->jumlah;
        $stokIds = $request->id_stok;

        foreach ($stokIds as $index => $id) {
            $existingStok = ProdukStok::find($id);

            if ($existingStok) {
                $stokBaru = $existingStok->jumlah + $jumlah[$index];

                $existingStok->update([
                    'jumlah' => $stokBaru,
                ]);
            }
        }
        return redirect()->route('gudang.produk')->with('success', 'Stok berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'merk' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'size' => 'required|array',
            'size.*' => 'required|string|max:50',
            'harga_beli' => 'required|array',
            'harga_beli.*' => 'required|numeric|min:0',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'merk.required' => 'merk tidak boleh kosong',
            'kategori.required' => 'kategori tidak boleh kosong',
            'satuan.required' => 'satuan tidak boleh kosong',

        ]);

        $produk = Produks::with(['stoks'])->find($id);

        $foto = null;
        if ($request->hasFile('foto')) {
            // Simpan foto baru
            $extension = $request->file('foto')->extension();
            $uuidName = Str::uuid() . '.' . $extension;

            // Simpan ke storage/app/public/produk
            $request->file('foto')->storeAs('produk', time() . $uuidName, 'public');


            // Simpan nama file ke database
            $foto = time() . $uuidName;
        } else {
            $foto = $produk['foto'];
        }
        $produk->update([
            'id_kategori' => $request->input('kategori'),
            'kode' => $request->input('kode'),
            'name' => $request->input('name'),
            'merk' => $request->input('merk'),
            'keterangan' => $request->input('keterangan'),
            'foto' => $foto,
            'satuan' => $request->input('satuan'),
        ]);

        // Ambil semua ID stok lama untuk produk ini
        $existingStokIds = $produk->stoks->pluck('id_stok')->toArray();

        // Ambil stok ID dari request (jika ada)
        $submittedStokIds = $request->input('id_stok') ?? [];

        // Cari stok yang dihapus (tidak ada di request)
        $deletedStokIds = array_diff($existingStokIds, $submittedStokIds);
        ProdukStok::destroy($deletedStokIds);


        // Update atau Tambah stok baru
        $sizes = $request->size;
        $hargaBelis = $request->harga_beli;
        $jumlah = $request->jumlah;
        $stokIds = $request->id_stok;

        foreach ($sizes as $index => $size) {
            $data = [
                'id_produk' => $produk->id_produk,
                'size' => $size,
                'harga_beli' => $hargaBelis[$index],
                'jumlah' => $jumlah[$index],
            ];

            // Jika stok ID disediakan, update; jika tidak, buat baru
            if (!empty($stokIds[$index])) {
                ProdukStok::where('id_stok', $stokIds[$index])->update($data);
            } else {
                ProdukStok::create($data);
            }
        }
        return redirect()->route('gudang.produk')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Produks::where('id_produk', $id)->delete();
        return redirect(route('gudang.produk'))->with('success', 'Data berhasil dihapus');
    }
}
