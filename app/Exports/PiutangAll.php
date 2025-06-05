<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PiutangAll implements FromView
{
    protected $transaksis;
    protected $profile;
    protected $logo;

    public function __construct($transaksis, $profile, $logo)
    {
        $this->transaksis = $transaksis;
        $this->profile = $profile;
        $this->logo = $logo;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'transaksis' =>  $this->transaksis,
            'profile' =>  $this->profile,
            'logo' =>  $this->logo,
        ];
        return view('exports/piutangall', $data);
    }
}
