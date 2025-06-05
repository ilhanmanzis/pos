<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class Transaksi implements FromView
{
    protected $transaksis;
    protected $bulanTahun;
    protected $profile;


    public function __construct($transaksis, $bulanTahun, $profile)
    {
        $this->transaksis = $transaksis;
        $this->bulanTahun = $bulanTahun;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'transaksis' =>  $this->transaksis,
            'bulanTahun' =>  $this->bulanTahun,
            'logo' => public_path('storage/logo/' . $this->profile['logo']),
            'profile' => $this->profile,
        ];
        return view('exports/transaksi', $data);
    }
}
