<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produks extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'kode',
        'name',
        'merk',
        'keterangan',
        'foto',
        'satuan'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategoris::class, 'id_kategori');
    }


    public function stoks(): HasMany
    {
        return $this->hasMany(ProdukStok::class, 'id_produk');
    }
    public function transaksiDetails(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'id_produk');
    }

    public function scopeFilter($query, $filters)
    {

        if (isset($filters['produk']) && $filters['produk']) {
            $query->where(function ($subQ) use ($filters) {
                $subQ->where('name', 'like', '%' . $filters['produk'] . '%')
                    ->orWhere('kode', 'like', '%' . $filters['produk'] . '%');
            });
        }
    }
}
