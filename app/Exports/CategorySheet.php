<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Kategoris;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class CategorySheet implements FromView, WithTitle
{
    protected $category;
    protected $profile;

    public function __construct(Kategoris $category, $profile)
    {
        $this->category = $category;
        $this->profile = $profile;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        // Mengambil data produk berdasarkan kategori

        $data = [
            'products' => $this->category->produks,
            'category' => $this->category,
            'profile' => $this->profile
        ];

        // Mengirim data ke view
        return view('exports/produk', $data);
    }

    public function title(): string
    {
        return $this->category->name;
    }
}
