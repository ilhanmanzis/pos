<?php

namespace App\Http\Controllers;

use App\Models\Pelanggans;
use App\Models\Produks;
use App\Models\Profile;
use App\Models\TransaksiDetail;
use App\Models\Transaksis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Ambil data stok per size
        $stokDetail = $produk->stoks->map(function ($stok) use ($produk) {
            return [
                'id_stok' => $stok->id_stok,
                'size' => $stok->size,
                'jumlah_satuan' => $stok->jumlah_satuan,
                'pcs' => $stok->pcs,
                'display' => $stok->jumlah_satuan . ' ' . $produk->satuan .
                    ($stok->pcs > 0 ? ' (' . $stok->pcs . ' pcs)' : ''),
            ];
        });

        return response()->json([
            'id_produk' => $produk->id_produk,
            'nama_produk' => $produk->name,
            'sizes' => $sizes,
            'satuan' => $produk->satuan, // array ["box", "pack"] dsb
            'harga_jual' => $produk->harga_jual,
            'stok_per_size' => $stokDetail,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd(json_decode($request->keranjang, true));
        $request->validate([
            'pelanggan' => 'required',
            'keranjang' => ['required', function ($attribute, $value, $fail) {
                // Pastikan keranjang tidak kosong dan bukan array kosong dalam string JSON
                $decoded = json_decode($value, true);
                if (!is_array($decoded) || empty($decoded)) {
                    $fail('Keranjang produk tidak boleh kosong.');
                }
            }],
        ], [
            'pelanggan.required' => 'Data pelanggan tidak boleh kosong',
        ]);

        $tanggal = Carbon::parse($request->tanggal);
        $bulan = $tanggal->format('m');
        $tahun = $tanggal->format('Y');

        // Cari transaksi dengan kode_faktur terbesar di bulan & tahun ini
        $lastTransaksi = Transaksis::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('kode_faktur', 'desc')
            ->first();

        if ($lastTransaksi) {
            // Ambil nomor urut dari kode_faktur yang terakhir
            // Format kode_faktur: "00001/06/2025.nsfp"
            preg_match('/^(\d+)\/' . $bulan . '\/' . $tahun . '\./', $lastTransaksi->kode_faktur, $matches);
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $nomorUrut = $lastNumber + 1;
        } else {
            $nomorUrut = 1;
        }

        $nomorUrut = str_pad($nomorUrut, 5, '0', STR_PAD_LEFT);

        // Ambil nsfp dari profile
        $profile = Profile::first();
        $nsfp = $profile->nsfp ?? '';

        $nsfp === '' ? $kodeFaktur = "{$nomorUrut}/{$bulan}/{$tahun}" : $kodeFaktur = "{$nomorUrut}/{$bulan}/{$tahun}.{$nsfp}";


        $keranjang = json_decode($request->keranjang, true);
        // Hitung total harga

        //dd($keranjang);
        $totalHarga = collect($keranjang)->sum(function ($item) {
            return $item['jumlah'] * $item['harga_jual'];
        });
        // Simpan transaksi
        $transaksi = Transaksis::create([
            'kode_pelanggan' => $request->pelanggan,
            'kode_faktur'    => $kodeFaktur,
            'id_user'        => Auth::id(),
            'tanggal'        => $tanggal,
            'jenis'          => 'biasa',
            'total_harga'    => $totalHarga,
            'status'         => 'belum bayar',
        ]);

        // Simpan detail transaksi
        foreach ($keranjang as $item) {
            TransaksiDetail::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_stok' => $item['id_stok'],
                'satuan' => $item['selectedSatuan'],
                'qty' => $item['jumlah'],
                'harga_jual' => $item['harga_jual'],
                'sub_total' => $item['jumlah'] * $item['harga_jual'],
            ]);
        }
        return redirect(route('finance.transaksi'))->with([
            'success' => 'Transaksi berhasil disimpan',
            'open_invoice_url' => url('/finance/transaksi/invoice/' . $transaksi['id_transaksi'])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' =>  'Transaksi',
            'page' => 'Transaksi',
            'title' => 'Tambah Data Transaksi',
            'pelanggans' => Pelanggans::all(),
            'produks' => Produks::all(),
            'transaksi' => Transaksis::with(['detail', 'pelanggan', 'detail.stok', 'detail.stok.produk'])->find($id)
        ];

        //dd($data);

        return view('finance/transaksi/show', $data);
    }

    public function detail(string $id)
    {
        $data = [
            'selected' =>  'Transaksi',
            'page' => 'Transaksi',
            'title' => 'Data Transaksi',
            'transaksi' =>  Transaksis::with(['detail', 'pelanggan', 'detail.stok', 'detail.stok.produk'])->find($id)
        ];

        //dd($data);

        return view('finance/transaksi/detail', $data);
    }

    public function invoice(string $id)
    {
        $data = [
            'selected' =>  'Transaksi',
            'page' => 'Transaksi',
            'title' => 'Data Transaksi',
            'transaksi' =>  Transaksis::with(['detail', 'pelanggan', 'detail.stok', 'detail.stok.produk'])->find($id),
            'profile' => Profile::first()
        ];

        //dd($data);

        return view('finance/transaksi/invoice', $data);
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
        Transaksis::where('id_transaksi', $id)->delete();
        return redirect(route('finance.transaksi'))->with('success', 'transaksi berhasil dihapus');
    }
}
