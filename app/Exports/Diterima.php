<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class Diterima implements FromView
{
    protected $suratJalans;
    protected $profile;

    public function __construct($suratJalans, $profile)
    {
        $this->suratJalans = $suratJalans;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'suratJalans' =>  $this->suratJalans,
            'logo' => public_path('storage/logo/' . $this->profile['logo']),
            'profile' => $this->profile,
        ];
        return view('exports/diterima', $data);
    }
}
