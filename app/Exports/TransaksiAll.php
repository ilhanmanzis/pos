<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiAll implements FromView
{
    protected $transaksis;
    protected $profile;

    public function __construct($transaksis, $profile)
    {
        $this->transaksis = $transaksis;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'transaksis' =>  $this->transaksis,
            'logo' => public_path('storage/logo/' . $this->profile['logo']),
            'profile' => $this->profile,
        ];
        return view('exports/transaksiall', $data);
    }
}
