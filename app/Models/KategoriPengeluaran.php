<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPengeluaran extends Model
{
    use HasFactory;
    protected $table = 'kategori_pengeluaran';
    protected $primaryKey = 'id_kategori_pengeluaran';
    protected $fillable = ['name'];

    public function pengeluarans(): HasMany
    {
        return $this->hasMany(Pengeluarans::class, 'id_kategori_pengeluaran');
    }
}
