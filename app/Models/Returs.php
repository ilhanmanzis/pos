<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Returs extends Model
{
    use HasFactory;
    protected $table = 'returs';
    protected $primaryKey = 'id_retur';

    protected $fillable = [
        'id_user',
        'tanggal',
        'jenis',
        'catatan'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function details(): HasMany
    {
        return $this->hasMany(ReturDetail::class, 'id_retur');
    }
    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['produk'])) {
            $query->whereHas('details.produk', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['produk'] . '%');
            });
        }
    }
}
