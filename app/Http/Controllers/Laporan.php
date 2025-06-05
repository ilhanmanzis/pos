<?php

namespace App\Http\Controllers;

use App\Exports\Pengeluaran;
use App\Exports\PengeluaranAll;
use App\Exports\Piutang;
use App\Exports\PiutangAll;
use App\Exports\Transaksi;
use App\Exports\TransaksiAll;
use App\Models\Pelanggans;
use App\Models\Pengeluarans;
use App\Models\Profile;
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
            return $pdf->stream('laporan piutang ' . $pelanggan->name . ' -- ' . $pelanggan->kode_pelanggan . ' -- ' . $this->waktu . '' . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Piutang($transaksis, $pelanggan, $profile),
                'laporan_piutang_' . $pelanggan->name . '_' . $pelanggan->kode_pelanggan . ' -- ' . $this->waktu .  '' . ' -- ' . $this->waktu . '.xlsx'
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
            return $pdf->stream('laporan transaksi  ' . $bulanTahun .  ' -- ' . $this->waktu . '' . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Transaksi($transaksis, $bulanTahun, $profile),
                'laporan_transaksi ' . $bulanTahun . ' -- ' . $this->waktu .  '' . ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }

    public function transaksiPdf()
    {
        $transaksis = Transaksis::with(['pelanggan'])
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
            return $pdf->stream('laporan pengeluaran  ' . $bulanTahun .  ' -- ' . $this->waktu . '' . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new Pengeluaran($pengeluarans, $bulanTahun, $profile),
                'laporan_pengeluaran ' . $bulanTahun . ' -- ' . $this->waktu .  '' . ' -- ' . $this->waktu . '.xlsx'
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













    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

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
