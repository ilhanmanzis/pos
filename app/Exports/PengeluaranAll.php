<?php

namespace App\Exports;

use App\Models\Transaksis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PengeluaranAll implements FromView
{
    protected $pengeluarans;
    protected $profile;

    public function __construct($pengeluarans, $profile)
    {
        $this->pengeluarans = $pengeluarans;
        $this->profile = $profile;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'pengeluarans' =>  $this->pengeluarans,
            'logo' => public_path('storage/logo/' . $this->profile['logo']),
            'profile' => $this->profile,
        ];
        return view('exports/pengeluaranall', $data);
    }
}
