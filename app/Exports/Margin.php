<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class Margin implements FromView
{
    protected $produkList;
    protected $bulanTahun;
    protected $profile;


    public function __construct($produkList, $bulanTahun, $profile)
    {
        $this->produkList = $produkList;
        $this->bulanTahun = $bulanTahun;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'data' =>  $this->produkList,
            'bulanTahun' =>  $this->bulanTahun,
            'logo' => public_path('storage/logo/' . $this->profile['logo']),
            'profile' => $this->profile,
        ];
        return view('exports/margin', $data);
    }
}
