<?php

namespace App\Http\Controllers;

use App\Exports\Margin;
use App\Exports\MarginAll;
use App\Exports\Pengeluaran;
use App\Exports\PengeluaranAll;
use App\Exports\Piutang;
use App\Exports\PiutangAll;
use App\Exports\PriceListExport;
use App\Exports\Retur;
use App\Exports\Transaksi;
use App\Exports\TransaksiAll;
use App\Models\Kategoris;
use App\Models\Pelanggans;
use App\Models\Pengeluarans;
use App\Models\Produks;
use App\Models\Profile;
use App\Models\Returs;
use App\Models\SuratJalan;
use App\Models\TransaksiDetail;
use App\Models\Transaksis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class Laporan extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $waktu;
    public function __construct()
    {
        $this->waktu = now();
    }
    public function index()
    {
        $data = [
            'selected' =>  'Export & Laporan',
            'page' => 'Export & Laporan',
            'title' => 'Export & Laporan',
            'pelanggans' => Pelanggans::all()
        ];

        return view('laporan/index', $data);
    }


    public function penagihan(Request $request)
    {
        $request->validate(['pelanggan' => 'required'], ['pelanggan.required' => 'pelanggan tidak boleh kosong']);
        $pelanggan = Pelanggans::where('kode_pelanggan', $request->input('pelanggan'))->first();
        $transaksis = Transaksis::where('kode_pelanggan', $request->input('pelanggan'))->where('status', 'belum bayar')->get();

        $profile = Profile::first();

        $action = $request->input('action');
        $data = [
            'transaksis' => $transaksis,
            'profile' => $profile,
            'pelanggan' => $pelanggan,
            'logo' => public_path('storage/logo/' . $profile['logo'])
        ];

        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan/piutang', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('laporan piutang ' . $pelanggan->name . ' -- ' . $pelanggan->kode_pelanggan  . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Piutang($transaksis, $pelanggan, $profile),
                'laporan_piutang_' . $pelanggan->name . '_' . $pelanggan->kode_pelanggan .  ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }

    public function penagihanPdf()
    {
        $transaksis = Transaksis::where('status', 'belum bayar')->with(['pelanggan'])->get();

        $profile = Profile::first();
        $data = [
            'transaksis' => $transaksis,
            'profile' => $profile,
            'logo' => public_path('storage/logo/' . $profile['logo'])
        ];
        $pdf = Pdf::loadView('laporan/piutangall', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('laporan piutang' . ' -- ' . $this->waktu . '.pdf');
    }

    public function penagihanExcel()
    {
        $profile = Profile::first();
        $logo = public_path('storage/logo/' . $profile['logo']);
        $transaksis = Transaksis::where('status', 'belum bayar')->with(['pelanggan'])->get();
        return Excel::download(
            new PiutangAll($transaksis, $profile, $logo),
            'laporan_piutang' . ' -- ' . $this->waktu . '.xlsx'
        );
    }

    public function transaksi(Request $request)
    {
        $request->validate(['transaksi' => 'required'], ['transaksi.required' => 'transaksi tidak boleh kosong']);
        // Ambil input bulan_tahun dalam format YYYY-MM
        $bulanTahun = $request->input('transaksi');

        // Pisahkan bulan dan tahun dari input
        $tahun = substr($bulanTahun, 0, 4); // Ambil 4 digit pertama sebagai tahun
        $bulan = substr($bulanTahun, 5, 2); // Ambil 2 digit setelahnya sebagai bulan

        // Query transaksi berdasarkan bulan, tahun, kode pelanggan, dan status
        $transaksis = Transaksis::with(['pelanggan'])->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();


        $profile = Profile::first();

        $action = $request->input('action');
        $data = [
            'transaksis' => $transaksis,
            'profile' => $profile,
            'bulanTahun' => $bulanTahun,
            'logo' => public_path('storage/logo/' . $profile['logo'])
        ];

        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan/transaksi', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('laporan transaksi  ' . $bulanTahun . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Transaksi($transaksis, $bulanTahun, $profile),
                'laporan_transaksi ' . $bulanTahun .  ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }

    public function transaksiPdf()
    {
        $transaksis = Transaksis::with(['pelanggan', 'suratJalan'])
            ->get();


        $profile = Profile::first();
        $data = [
            'transaksis' => $transaksis,
            'profile' => $profile,
            'logo' => public_path('storage/logo/' . $profile['logo'])
        ];
        $pdf = Pdf::loadView('laporan/transaksiall', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('laporan transaksi' . ' -- ' . $this->waktu . '.pdf');
    }

    public function transaksiExcel()
    {
        $transaksis = Transaksis::with(['pelanggan'])->get();
        $profile = Profile::first();
        return Excel::download(
            new TransaksiAll($transaksis, $profile),
            'laporan_transaksi' . ' -- ' . $this->waktu . '.xlsx'
        );
    }

    public function pengeluaran(Request $request)
    {
        $request->validate(['pengeluaran' => 'required'], ['pengeluaran.required' => 'pengeluaran tidak boleh kosong']);
        // Ambil input bulan_tahun dalam format YYYY-MM
        $bulanTahun = $request->input('pengeluaran');

        // Pisahkan bulan dan tahun dari input
        $tahun = substr($bulanTahun, 0, 4); // Ambil 4 digit pertama sebagai tahun
        $bulan = substr($bulanTahun, 5, 2); // Ambil 2 digit setelahnya sebagai bulan

        // Query transaksi berdasarkan bulan, tahun, kode pelanggan, dan status
        $pengeluarans = Pengeluarans::with(['kategori'])->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();


        $profile = Profile::first();

        $action = $request->input('action');
        $data = [
            'pengeluarans' => $pengeluarans,
            'profile' => $profile,
            'bulanTahun' => $bulanTahun,
            'logo' => public_path('storage/logo/' . $profile['logo'])
        ];

        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan/pengeluaran', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('laporan pengeluaran  ' . $bulanTahun . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Pengeluaran($pengeluarans, $bulanTahun, $profile),
                'laporan_pengeluaran ' . $bulanTahun . ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }

    public function pengeluaranPdf()
    {
        $pengeluarans = Pengeluarans::with(['kategori'])
            ->get();

        $profile = Profile::first();
        $data = [
            'pengeluarans' => $pengeluarans,
            'profile' => $profile,
            'logo' => public_path('storage/logo/' . $profile['logo'])
        ];
        $pdf = Pdf::loadView('laporan/pengeluaranall', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('laporan pengeluaran' . ' -- ' . $this->waktu . '.pdf');
    }

    public function pengeluaranExcel()
    {
        $pengeluarans = Pengeluarans::with(['kategori'])
            ->get();
        $profile = Profile::first();
        return Excel::download(
            new PengeluaranAll($pengeluarans, $profile),
            'laporan_pengeluaran' . ' -- ' . $this->waktu . '.xlsx'
        );
    }



    public function produkPdf()
    {

        // Ambil data profile (Nama, Alamat, Logo)
        $profile = Profile::first();

        // Ambil kategori beserta produk terkait
        $categories = Kategoris::with(['produks.stoks'])->get();

        // Siapkan data untuk view
        $data = [
            'profile' => $profile,
            'logo' => public_path('storage/logo/' . $profile['logo']),
            'kategoris' => $categories,
        ];

        // Render PDF dengan DOMPDF
        $pdf = PDF::loadView('laporan/produk', $data);


        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('List produk' . ' -- ' . $this->waktu . '.pdf');
        // Download PDF
        //return $pdf->download('price_list.pdf');
    }

    public function produkExcel()
    {
        return Excel::download(new PriceListExport, 'price_list' . ' -- ' . $this->waktu . '.xlsx');
    }


    public function retur(Request $request)
    {
        $request->validate(['kondisi' => 'required'], ['kondisi.required' => 'kondisi tidak boleh kosong']);

        $kondisi = $request->input('kondisi');
        $profile = Profile::first();

        if ($kondisi === 'all') {
            $returs = Returs::with(['details.produk', 'details.stok'])->get();
        } elseif ($kondisi === 'bagus') {
            $returs = Returs::with(['details.produk', 'details.stok'])->where('jenis', 'bagus')->get();
        } else {
            $returs = Returs::with(['details.produk', 'details.stok'])->where('jenis', 'rusak')->get();
        }

        $action = $request->input('action');

        $data = [
            'returs' => $returs,
            'profile' => $profile,
            'logo' => public_path('storage/logo/' . $profile['logo'])
        ];

        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan/retur', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('laporan retur ' .  ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Retur($returs, $profile),
                'laporan_pengeluaran ' . ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }


    public function margin(Request $request)
    {
        $request->validate(['margin' => 'required'], ['margin.required' => 'margin tidak boleh kosong']);
        // Ambil input bulan_tahun dalam format YYYY-MM
        $bulanTahun = $request->input('margin');

        // Pisahkan bulan dan tahun dari input
        $tahun = substr($bulanTahun, 0, 4); // Ambil 4 digit pertama sebagai tahun
        $bulan = substr($bulanTahun, 5, 2); // Ambil 2 digit setelahnya sebagai bulan

        $details = TransaksiDetail::with(['stok.produk', 'transaksi'])
            ->whereHas('transaksi', fn($q) => $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'lunas'))
            ->get();

        $produkList = [];
        //dd($details);

        foreach ($details as $detail) {
            $produkName = $detail->stok->produk->name;
            $satuan = $detail->satuan;
            $qty = $detail->qty;
            $hargaJualPerUnit = $detail->harga_jual; // Harga jual per unit
            $stok = $detail->stok;

            // Harga beli dari tabel produk_stok
            $hargaBeli = $stok->harga_beli;
            $isi = $stok->isi_persatuan ?? 1;

            // Konversi harga beli jika satuannya pcs
            $hargaBeliPerUnit = $satuan === 'pcs' ? ($hargaBeli / $isi) : $hargaBeli;



            // Menghitung total harga jual (total harga per produk, bukan per unit)
            $totalHargaJual = $hargaJualPerUnit * $qty;

            // Menghitung margin per unit dan total margin
            $marginPerUnit = $hargaJualPerUnit - $hargaBeliPerUnit;
            $totalMargin = $marginPerUnit * $qty;

            if (!isset($produkList[$produkName])) {
                $produkList[$produkName] = [
                    'nama' => $produkName,
                    'harga_beli_terakhir' => $hargaBeli, // dari stok terakhir yang dipakai
                    'jumlah' => [],
                    'total_harga_jual' => 0,
                    'total_margin' => 0
                ];
            }

            // Menambah jumlah berdasarkan satuan
            if (!isset($produkList[$produkName]['jumlah'][$satuan])) {
                $produkList[$produkName]['jumlah'][$satuan] = 0;
            }
            $produkList[$produkName]['jumlah'][$satuan] += $qty;

            // Menambahkan total harga jual dan total margin
            $produkList[$produkName]['total_harga_jual'] += $totalHargaJual;
            $produkList[$produkName]['total_margin'] += $totalMargin;

            // Update harga beli terakhir jika perlu (optional)
            $produkList[$produkName]['harga_beli_terakhir'] = $hargaBeli;
        }

        $profile = Profile::first();
        $action = $request->input('action');
        $data = [
            'data' => $produkList,
            'logo' => public_path('storage/logo/' . $profile['logo']),
            'profile' => $profile,
            'bulanTahun' => $bulanTahun,
        ];
        //dd($data);

        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan.margin', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('laporan margin  ' . $bulanTahun . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Margin($produkList, $bulanTahun, $profile),
                'laporan_margin ' . $bulanTahun .  ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }

    public function marginPdf()
    {
        $details = TransaksiDetail::with(['stok.produk', 'transaksi'])
            ->whereHas('transaksi', fn($q) => $q->where('status', 'lunas'))
            ->get();

        $produkList = [];
        //dd($details);

        foreach ($details as $detail) {
            $produkName = $detail->stok->produk->name;
            $satuan = $detail->satuan;
            $qty = $detail->qty;
            $hargaJualPerUnit = $detail->harga_jual; // Harga jual per unit
            $stok = $detail->stok;

            // Harga beli dari tabel produk_stok
            $hargaBeli = $stok->harga_beli;
            $isi = $stok->isi_persatuan ?? 1;

            // Konversi harga beli jika satuannya pcs
            $hargaBeliPerUnit = $satuan === 'pcs' ? ($hargaBeli / $isi) : $hargaBeli;



            // Menghitung total harga jual (total harga per produk, bukan per unit)
            $totalHargaJual = $hargaJualPerUnit * $qty;

            // Menghitung margin per unit dan total margin
            $marginPerUnit = $hargaJualPerUnit - $hargaBeliPerUnit;
            $totalMargin = $marginPerUnit * $qty;

            if (!isset($produkList[$produkName])) {
                $produkList[$produkName] = [
                    'nama' => $produkName,
                    'harga_beli_terakhir' => $hargaBeli, // dari stok terakhir yang dipakai
                    'jumlah' => [],
                    'total_harga_jual' => 0,
                    'total_margin' => 0
                ];
            }

            // Menambah jumlah berdasarkan satuan
            if (!isset($produkList[$produkName]['jumlah'][$satuan])) {
                $produkList[$produkName]['jumlah'][$satuan] = 0;
            }
            $produkList[$produkName]['jumlah'][$satuan] += $qty;

            // Menambahkan total harga jual dan total margin
            $produkList[$produkName]['total_harga_jual'] += $totalHargaJual;
            $produkList[$produkName]['total_margin'] += $totalMargin;

            // Update harga beli terakhir jika perlu (optional)
            $produkList[$produkName]['harga_beli_terakhir'] = $hargaBeli;
        }

        $profile = Profile::first();
        $data = [
            'data' => $produkList,
            'logo' => public_path('storage/logo/' . $profile['logo']),
            'profile' => $profile,
        ];
        //dd($data);


        $pdf = Pdf::loadView('laporan/marginall', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('laporan margin' . ' -- ' . $this->waktu . '.pdf');
    }

    public function marginExcel()
    {
        $details = TransaksiDetail::with(['stok.produk', 'transaksi'])
            ->whereHas('transaksi', fn($q) => $q->where('status', 'lunas'))
            ->get();

        $produkList = [];
        //dd($details);

        foreach ($details as $detail) {
            $produkName = $detail->stok->produk->name;
            $satuan = $detail->satuan;
            $qty = $detail->qty;
            $hargaJualPerUnit = $detail->harga_jual; // Harga jual per unit
            $stok = $detail->stok;

            // Harga beli dari tabel produk_stok
            $hargaBeli = $stok->harga_beli;
            $isi = $stok->isi_persatuan ?? 1;

            // Konversi harga beli jika satuannya pcs
            $hargaBeliPerUnit = $satuan === 'pcs' ? ($hargaBeli / $isi) : $hargaBeli;



            // Menghitung total harga jual (total harga per produk, bukan per unit)
            $totalHargaJual = $hargaJualPerUnit * $qty;

            // Menghitung margin per unit dan total margin
            $marginPerUnit = $hargaJualPerUnit - $hargaBeliPerUnit;
            $totalMargin = $marginPerUnit * $qty;

            if (!isset($produkList[$produkName])) {
                $produkList[$produkName] = [
                    'nama' => $produkName,
                    'harga_beli_terakhir' => $hargaBeli, // dari stok terakhir yang dipakai
                    'jumlah' => [],
                    'total_harga_jual' => 0,
                    'total_margin' => 0
                ];
            }

            // Menambah jumlah berdasarkan satuan
            if (!isset($produkList[$produkName]['jumlah'][$satuan])) {
                $produkList[$produkName]['jumlah'][$satuan] = 0;
            }
            $produkList[$produkName]['jumlah'][$satuan] += $qty;

            // Menambahkan total harga jual dan total margin
            $produkList[$produkName]['total_harga_jual'] += $totalHargaJual;
            $produkList[$produkName]['total_margin'] += $totalMargin;

            // Update harga beli terakhir jika perlu (optional)
            $produkList[$produkName]['harga_beli_terakhir'] = $hargaBeli;
        }

        $profile = Profile::first();
        return Excel::download(
            new MarginAll($produkList, $profile),
            'laporan_margin' . ' -- ' . $this->waktu . '.xlsx'
        );
    }
}
