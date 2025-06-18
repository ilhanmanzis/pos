<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class Piutang implements FromView
{
    protected $transaksis;
    protected $pelanggan;
    protected $profile;


    public function __construct($transaksis, $pelanggan, $profile)
    {
        $this->transaksis = $transaksis;
        $this->pelanggan = $pelanggan;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'transaksis' =>  $this->transaksis,
            'pelanggan' => $this->pelanggan,
            'profile' => $this->profile,
            'logo' => public_path('storage/logo/' . $this->profile['logo'])
        ];
        return view('exports/piutang', $data);
    }
}
