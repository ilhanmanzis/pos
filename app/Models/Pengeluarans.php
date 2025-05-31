<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluarans extends Model
{
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = ['id_user', 'id_kategori_pengeluaran', 'keterangan', 'harga', 'tanggal'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriPengeluaran::class, 'id_kategori_pengeluaran');
    }

    public function scopeFilter($query, $filters)
    {

        if (isset($filters['pengeluaran']) && $filters['pengeluaran']) {
            $query->where(function ($subQ) use ($filters) {
                $subQ->where('keterangan', 'like', '%' . $filters['pengeluaran'] . '%');
            });
        }
    }
}
