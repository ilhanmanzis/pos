<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggans extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $primaryKey = 'kode_pelanggan';
    protected $fillable = ['kode_pelanggan', 'name', 'no_hp', 'email', 'alamat', 'desa', 'kecamatan', 'kabupaten', 'provinsi'];
    public $incrementing = false; // karena primary key-nya berupa string

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksis::class, 'kode_pelanggan', 'kode_pelanggan');
    }
    public function scopeFilter($query, $filters)
    {

        if (isset($filters['pelanggan']) && $filters['pelanggan']) {
            $query->where(function ($subQ) use ($filters) {
                $subQ->where('name', 'like', '%' . $filters['pelanggan'] . '%')
                    ->orWhere('kode_pelanggan', 'like', '%' . $filters['pelanggan'] . '%');
            });
        }
    }
}
