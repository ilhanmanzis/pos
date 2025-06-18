<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategoris extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['name'];

    public function produks(): HasMany
    {
        return $this->hasMany(Produks::class, 'id_kategori');
    }
}
