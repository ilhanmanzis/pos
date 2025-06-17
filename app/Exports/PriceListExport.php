<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Kategoris;
use App\Models\Product;
use App\Models\Profile;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class PriceListExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        // Ambil kategori produk
        $categories = Kategoris::with(['produks.stoks'])->get();
        $profile = Profile::first();

        // Looping untuk setiap kategori
        foreach ($categories as $category) {
            $sheets[] = new CategorySheet($category, $profile);
        }

        return $sheets;
    }
}
