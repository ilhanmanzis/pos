<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratJalan extends Model
{
    use HasFactory;
    protected $table = 'surat_jalan';
    protected $primaryKey = 'id_surat_jalan';
    protected $fillable = ['kode_faktur', 'id_user', 'tanggal_pengiriman', 'status', 'jam', 'nomor'];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksis::class, 'kode_faktur', 'kode_faktur');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function suratJalanDetails()
    {
        return $this->hasMany(SuratJalanDetails::class, 'id_surat_jalan', 'id_surat_jalan');
    }
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['sj']) && $filters['sj']) {
            $query->where(function ($subQ) use ($filters) {
                $subQ->where('nomor', 'like', '%' . $filters['sj'] . '%');
            });
        }
    }
}
