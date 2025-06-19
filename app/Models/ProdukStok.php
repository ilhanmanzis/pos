<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukStok extends Model
{
    use HasFactory;
    protected $table = 'produk_stok';
    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'size',
        'id_produk',
        'jumlah',
        'harga_beli'
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produks::class, 'id_produk');
    }

    public function transaksiDetails(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'id_stok');
    }
}
