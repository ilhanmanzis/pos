<?php

namespace App\Http\Controllers;

use App\Models\Pengeluarans;
use App\Models\Transaksis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil tahun yang dipilih, jika tidak ada, gunakan tahun sekarang
        $tahun = $request->input('tahun', date('Y'));
        $pemasukanHariIni = Transaksis::where('status', 'lunas')->whereDate('created_at', Carbon::today())->sum('total_harga');
        $pemasukanBulanIni = Transaksis::where('status', 'lunas')->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');
        $pengeluaranHariIni = Pengeluarans::whereDate('created_at', Carbon::today())->sum('harga');
        $pengeluaranBulanIni = Pengeluarans::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('harga');

        // Mengambil tahun yang ada di data transaksi
        $tahunList = Transaksis::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc') // urutkan tahun dari yang terbaru
            ->pluck('tahun');
        // Data pemasukan dan pengeluaran berdasarkan bulan untuk tahun yang dipilih
        $pemasukan = Transaksis::selectRaw('DATE_FORMAT(updated_at, "%Y-%m") as bulan, SUM(total_harga) as total_pemasukan')
            ->whereYear('created_at', $tahun)->where('status', 'lunas')
            ->groupBy('bulan')
            ->get();

        $pengeluaran = Pengeluarans::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, SUM(harga) as total_pengeluaran')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->get();

        // Buat list semua bulan dalam setahun
        $allMonths = [];
        for ($m = 1; $m <= 12; $m++) {
            $bulan = $m < 10 ? "0$m" : $m;
            $allMonths[] = "$tahun-$bulan";
        }

        $chartData = [];
        foreach ($allMonths as $bulan) {
            $chartData[] = [
                'bulan' => $bulan,
                'pemasukan' => (float) ($pemasukan->firstWhere('bulan', $bulan)->total_pemasukan ?? 0),
                'pengeluaran' => (float) ($pengeluaran->firstWhere('bulan', $bulan)->total_pengeluaran ?? 0),
            ];
        }


        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
            'pemasukanHariIni' => $pemasukanHariIni,
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'pengeluaranHariIni' => $pengeluaranHariIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'chartData' => $chartData,
            'tahunList' => $tahunList,
            'tahun' => $tahun
        ];

        return view('admin/dashboard', $data);
    }

    public function finance(Request $request)
    {
        // Ambil tahun yang dipilih, jika tidak ada, gunakan tahun sekarang
        $tahun = $request->input('tahun', date('Y'));
        $pemasukanHariIni = Transaksis::where('status', 'lunas')->whereDate('created_at', Carbon::today())->sum('total_harga');
        $pemasukanBulanIni = Transaksis::where('status', 'lunas')->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');
        $pengeluaranHariIni = Pengeluarans::whereDate('created_at', Carbon::today())->sum('harga');
        $pengeluaranBulanIni = Pengeluarans::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('harga');

        // Mengambil tahun yang ada di data transaksi
        $tahunList = Transaksis::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc') // urutkan tahun dari yang terbaru
            ->pluck('tahun');
        // Data pemasukan dan pengeluaran berdasarkan bulan untuk tahun yang dipilih
        $pemasukan = Transaksis::selectRaw('DATE_FORMAT(updated_at, "%Y-%m") as bulan, SUM(total_harga) as total_pemasukan')
            ->whereYear('created_at', $tahun)->where('status', 'lunas')
            ->groupBy('bulan')
            ->get();

        $pengeluaran = Pengeluarans::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, SUM(harga) as total_pengeluaran')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->get();

        // Buat list semua bulan dalam setahun
        $allMonths = [];
        for ($m = 1; $m <= 12; $m++) {
            $bulan = $m < 10 ? "0$m" : $m;
            $allMonths[] = "$tahun-$bulan";
        }

        $chartData = [];
        foreach ($allMonths as $bulan) {
            $chartData[] = [
                'bulan' => $bulan,
                'pemasukan' => (float) ($pemasukan->firstWhere('bulan', $bulan)->total_pemasukan ?? 0),
                'pengeluaran' => (float) ($pengeluaran->firstWhere('bulan', $bulan)->total_pengeluaran ?? 0),
            ];
        }


        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
            'pemasukanHariIni' => $pemasukanHariIni,
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'pengeluaranHariIni' => $pengeluaranHariIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'chartData' => $chartData,
            'tahunList' => $tahunList,
            'tahun' => $tahun
        ];


        return view('finance/dashboard', $data);
    }

    public function gudang(Request $request)
    {
        // Ambil tahun yang dipilih, jika tidak ada, gunakan tahun sekarang
        $tahun = $request->input('tahun', date('Y'));
        $pemasukanHariIni = Transaksis::where('status', 'lunas')->whereDate('created_at', Carbon::today())->sum('total_harga');
        $pemasukanBulanIni = Transaksis::where('status', 'lunas')->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');
        $pengeluaranHariIni = Pengeluarans::whereDate('created_at', Carbon::today())->sum('harga');
        $pengeluaranBulanIni = Pengeluarans::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('harga');

        // Mengambil tahun yang ada di data transaksi
        $tahunList = Transaksis::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc') // urutkan tahun dari yang terbaru
            ->pluck('tahun');
        // Data pemasukan dan pengeluaran berdasarkan bulan untuk tahun yang dipilih
        $pemasukan = Transaksis::selectRaw('DATE_FORMAT(updated_at, "%Y-%m") as bulan, SUM(total_harga) as total_pemasukan')
            ->whereYear('created_at', $tahun)->where('status', 'lunas')
            ->groupBy('bulan')
            ->get();

        $pengeluaran = Pengeluarans::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, SUM(harga) as total_pengeluaran')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->get();

        // Buat list semua bulan dalam setahun
        $allMonths = [];
        for ($m = 1; $m <= 12; $m++) {
            $bulan = $m < 10 ? "0$m" : $m;
            $allMonths[] = "$tahun-$bulan";
        }

        $chartData = [];
        foreach ($allMonths as $bulan) {
            $chartData[] = [
                'bulan' => $bulan,
                'pemasukan' => (float) ($pemasukan->firstWhere('bulan', $bulan)->total_pemasukan ?? 0),
                'pengeluaran' => (float) ($pengeluaran->firstWhere('bulan', $bulan)->total_pengeluaran ?? 0),
            ];
        }


        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
            'pemasukanHariIni' => $pemasukanHariIni,
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'pengeluaranHariIni' => $pengeluaranHariIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'chartData' => $chartData,
            'tahunList' => $tahunList,
            'tahun' => $tahun
        ];


        return view('gudang/dashboard', $data);
    }

    public function home()
    {
        $user = Auth::user();


        if (!$user) {
            return redirect('login')->with('message', 'Silakan login terlebih dahulu');
        }
        if ($user->role == 'admin') {
            return redirect(route('admin.dashboard'));
        } elseif ($user->role == 'finance') {
            return redirect(route('finance.dashboard'));
        } elseif ($user->role == 'gudang') {
            return redirect(route('gudang.dashboard'));
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
