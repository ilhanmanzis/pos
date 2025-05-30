<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturDetail extends Model
{
    use HasFactory;
    protected $table = 'retur_detail';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_retur',
        'id_stok',
        'id_produk',
        'satuan',
        'jumlah_satuan',
        'isi_persatuan',
        'pcs',
        'keterangan'
    ];

    public function retur(): BelongsTo
    {
        return $this->belongsTo(Returs::class, 'id_retur');
    }


    public function stok(): BelongsTo
    {
        return $this->belongsTo(ProdukStok::class, 'id_stok');
    }

    public function produk()
    {
        return $this->belongsTo(Produks::class, 'id_produk');
    }
}
