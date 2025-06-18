<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaksis extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['kode_pelanggan', 'kode_faktur', 'kode_invoice', 'id_user', 'tanggal', 'total_harga', 'jenis', 'status'];

    public function pelanggan(): BelongsTo
    {
        return $this->BelongsTo(Pelanggans::class, 'kode_pelanggan', 'kode_pelanggan');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi');
    }

    public function suratJalanDetails(): HasMany
    {
        return $this->hasMany(SuratJalanDetails::class, 'kode_faktur', 'kode_faktur');
    }

    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['transaksi'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('kode_faktur', 'like', '%' . $filters['transaksi'] . '%')
                    ->orWhereHas('pelanggan', function ($q2) use ($filters) {
                        $q2->where('name', 'like', '%' . $filters['transaksi'] . '%');
                    });
            });
        }
    }
}
