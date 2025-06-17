<?php

namespace App\Http\Controllers;

use App\Models\ProdukStok;
use App\Models\Profile;
use App\Models\Sj;
use App\Models\SjDetail;
use App\Models\SuratJalan as ModelsSuratJalan;
use App\Models\TransaksiDetail;
use App\Models\Transaksis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratJalan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksis::with('pelanggan', 'detail', 'suratJalan') // pastikan relasi 'suratJalan' ada di model Transaksis
            ->whereHas('suratJalan', function ($query) {
                // Cari yang statusnya bukan 'diambil'
                $query->where('status', '!=', 'diambil');
            })
            ->orWhereDoesntHave('suratJalan') // atau yang belum punya surat_jalan
            ->get();
        $data = [
            'selected' =>  'Surat Jalan',
            'page' => 'Surat Jalan',
            'title' => 'Surat Jalan',
            'transaksis' => $transaksis
        ];
        return view('gudang/suratjalan/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getTransaksi($id)
    {
        // Ambil transaksi berdasarkan id_transaksi beserta relasi pelanggan
        $transaksi = Transaksis::with('pelanggan')
            ->find($id);

        if (!$transaksi) {
            return response()->json(null, 404);
        }

        return response()->json([
            'id_transaksi' => $transaksi->id_transaksi,
            'kode_faktur' => $transaksi->kode_faktur,
            'pelanggan_name' => $transaksi->pelanggan ? $transaksi->pelanggan->name : null,
            // Tambahkan field lain jika perlu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keranjang' => 'required|json',
        ]);

        $keranjang = json_decode($request->keranjang, true);

        if (!$keranjang || count($keranjang) == 0) {
            return back()->withErrors(['keranjang' => 'Data invoice kosong']);
        }

        $tanggal = Carbon::parse($request->tanggal);
        $bulan = $tanggal->format('m');
        $tahun = $tanggal->format('Y');

        // Cari transaksi dengan kode_faktur terbesar di bulan & tahun ini
        $lastSj = Sj::whereMonth('tanggal_pengiriman', $bulan)
            ->whereYear('tanggal_pengiriman', $tahun)
            ->orderBy('nomor', 'desc')
            ->first();

        // Jika transaksi terakhir ditemukan
        if ($lastSj) {
            // Regex untuk format kode_faktur: "00001/06/2025" atau "00001/06/2025.01.1234.22.0000001"
            preg_match('/^(\d+)\/' . $bulan . '\/' . $tahun . '(\.\d+.*)?$/', $lastSj->nomor, $matches);

            // Ambil nomor urut dari kode_faktur yang terakhir
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $nomorUrut = $lastNumber + 1;
        } else {
            $nomorUrut = 1;
        }

        // Formatkan nomor urut menjadi 5 digit
        $nomorUrut = str_pad($nomorUrut, 5, '0', STR_PAD_LEFT);
        $nomorJalan = "{$nomorUrut}/{$bulan}/{$tahun}";
        // Tambahkan entri ke tabel sj (many-to-many relationship)
        $sj = Sj::create([
            'id_user' => Auth::id(),
            'tanggal_pengiriman' => now(),
            'status' => 'pending',
            'nomor' => $nomorJalan
        ]);
        $suratJalanIds = [];
        foreach ($keranjang as $item) {
            $idTransaksi = $item['id_transaksi'];

            // Cek apakah surat jalan sudah ada untuk kode faktur ini
            $existingSuratJalan = ModelsSuratJalan::where('kode_faktur', $item['kode_faktur'])->first();

            SjDetail::create([
                'kode_faktur' => $item['kode_faktur'],
                'id_sj' => $sj->id_sj,
            ]);
            if ($existingSuratJalan) {
                // Surat jalan sudah ada, simpan id untuk cetak nanti
                $suratJalanIds[] = $existingSuratJalan->id_surat_jalan;

                continue; // Lewatkan pembuatan ulang surat jalan
            }

            // Cek stok cukup
            $transaksiDetails = TransaksiDetail::where('id_transaksi', $idTransaksi)->get();

            //foreach ($transaksiDetails as $detail) {
            //    $produkStok = ProdukStok::with('produk')->find($detail->id_stok);

            //    if ($produkStok->jumlah_satuan < $detail->qty) {
            //         return back()->withErrors(['error' => "Stok barang " . $produkStok->produk->name . " tidak //mencukupi, sisa stok: " . $produkStok->jumlah_satuan . " " . $produkStok->satuan . //($produkStok->pcs === 0 ? "" : ", " . $produkStok->pcs . " pcs")]);
            //    }
            // }

            // Buat surat jalan baru
            $suratJalan = ModelsSuratJalan::create([
                'kode_faktur' => $item['kode_faktur'],
                'id_user' => Auth::id(),
                'tanggal_pengiriman' => now(),
                'jam' => now(),
                'status' => 'pending',
            ]);



            // Attach sj to the transaction (many-to-many relationship)

            // Kurangi stok
            //foreach ($transaksiDetails as $detail) {
            //  $produkStok = ProdukStok::find($detail->id_stok);
            //$produkStok->jumlah_satuan -= $detail->qty;
            //$produkStok->save();
            //}

            // Kurangi stok
            foreach ($transaksiDetails as $detail) {
                $produkStok = ProdukStok::with('produk')->find($detail->id_stok);
                $qty = $detail->qty;
                $satuan = $detail->satuan; // bisa 'pcs' atau satuan besar (box, pack, dll)
                $isiPerSatuan = $produkStok->isi_persatuan;

                if ($satuan === 'pcs') {
                    if ($produkStok->pcs >= $qty) {
                        $produkStok->pcs -= $qty;
                    } else {
                        $sisaPcs = $qty - $produkStok->pcs;
                        $produkStok->pcs = 0;

                        $jumlahSatuanTerpakai = (int) ceil($sisaPcs / $isiPerSatuan);

                        if ($produkStok->jumlah_satuan < $jumlahSatuanTerpakai) {
                            return back()->withErrors([
                                'error' => "Stok produk '{$produkStok->produk->name}' tidak cukup. Butuh tambahan $jumlahSatuanTerpakai {$produkStok->satuan}"
                            ]);
                        }

                        $produkStok->jumlah_satuan -= $jumlahSatuanTerpakai;
                        $produkStok->pcs = ($jumlahSatuanTerpakai * $isiPerSatuan) - $sisaPcs;
                    }

                    $produkStok->jumlah_pcs -= $qty;
                } else {
                    // Satuan besar: box, pack, dll
                    if ($produkStok->jumlah_satuan < $qty) {
                        return back()->withErrors([
                            'error' => "Stok produk '{$produkStok->produk->name}' tidak cukup untuk {$qty} {$satuan}"
                        ]);
                    }

                    $produkStok->jumlah_satuan -= $qty;
                    $produkStok->jumlah_pcs -= $qty * $isiPerSatuan;
                }

                $produkStok->save();

                // Create sj_detail entry to link product and surat jalan

            }

            // Simpan id surat jalan yang baru dibuat untuk cetak nanti
            $suratJalanIds[] = $suratJalan->id_surat_jalan;
        }

        // Gabungkan semua id surat jalan menjadi string pemisah koma
        $allIds = implode(',', $suratJalanIds);


        return redirect(route('gudang.jalan'))->with([
            'success' => 'Surat jalan berhasil dibuat dan stok diperbarui.',
            'open_invoice_url' => url(route('gudang.jalan.printGabungan', ['ids' => $sj->id_sj]))
        ]);
    }

    public function printGabungan($ids)
    {
        // Ambil data Surat Jalan berdasarkan ID yang diberikan
        $sj = Sj::with(['sjDetails.transaksi.detail.stok.produk'])->find($ids);
        $profile = Profile::first();

        // Array untuk menyimpan data produk total
        $produkData = [];
        $invoiceCodes = [];

        // Proses untuk mengumpulkan data produk dari sjDetails
        foreach ($sj->sjDetails as $sjd) {
            foreach ($sjd->transaksi->detail as $detail) {
                // Ambil produk stok dari transaksi detail
                $produkStok = $detail->stok;
                $produk = $produkStok->produk;
                $satuan = $detail->satuan;
                $qty = $detail->qty;

                // Tentukan key pengelompokan berdasarkan nama produk, size, dan satuan
                $key = $produk->name . '|' . $produkStok->size . '|' . $satuan;

                // Tambahkan produk ke dalam array $produkData berdasarkan produk_id dan size
                if (isset($produkData[$key])) {
                    // Menambahkan kuantitas produk yang sama
                    $produkData[$key]['qty'] += $qty;
                } else {
                    $produkData[$key] = [
                        'kode' => $produk->kode,
                        'produk_name' => $produk->name,
                        'qty' => $qty,
                        'satuan' => $satuan,
                        'size' => $produkStok->size,
                        'merk' => $produk->merk,
                    ];
                }

                // Menambahkan kode faktur untuk surat jalan

            }
            $invoiceCodes[] = $sjd->transaksi->kode_faktur;
        }

        // Menghilangkan duplikasi kode faktur
        $invoiceCodes = array_unique($invoiceCodes);
        //dd($produkData);

        //dd($sj);


        //dd($invoiceCodes);

        // Kirim data ke view
        return view('gudang/suratjalan/print', compact('sj', 'produkData', 'invoiceCodes', 'profile'));
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
