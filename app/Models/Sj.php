<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sj extends Model
{
    use HasFactory;
    protected $table = 'sj';
    protected $primaryKey = 'id_sj';
    protected $fillable = ['id_user', 'tanggal_pengiriman', 'status', 'nomor'];

    // Relationship: A Surat Jalan (SJ) can have multiple SJ details
    public function sjDetails()
    {
        return $this->hasMany(SjDetail::class, 'id_sj', 'id_sj');
    }

    // Relationship: A Surat Jalan (SJ) belongs to a user (FK: id_user)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
