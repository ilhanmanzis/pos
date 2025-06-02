<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id_detail';
    protected $fillable = ['id_transaksi', 'id_stok', 'satuan', 'status', 'qty', 'harga_jual', 'sub_total'];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksis::class, 'id_transaksi');
    }

    public function stok(): BelongsTo
    {
        return $this->belongsTo(ProdukStok::class, 'id_stok');
    }
}
