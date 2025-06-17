<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class Pengeluaran implements FromView
{
    protected $pengeluarans;
    protected $bulanTahun;
    protected $profile;

    public function __construct($pengeluarans, $bulanTahun, $profile)
    {
        $this->pengeluarans = $pengeluarans;
        $this->bulanTahun = $bulanTahun;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'pengeluarans' =>  $this->pengeluarans,
            'bulanTahun' =>  $this->bulanTahun,
            'profile' => $this->profile,
            'logo' => public_path('storage/logo/' . $this->profile['logo'])
        ];
        return view('exports/pengeluaran', $data);
    }
}
