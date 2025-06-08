<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class MarginAll implements FromView
{
    protected $produkList;
    protected $profile;


    public function __construct($produkList, $profile)
    {
        $this->produkList = $produkList;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'data' =>  $this->produkList,
            'logo' => public_path('storage/logo/' . $this->profile['logo']),
            'profile' => $this->profile,
        ];
        return view('exports/marginall', $data);
    }
}
