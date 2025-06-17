<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SjDetail extends Model
{
    use HasFactory;
    protected $table = 'sj_detail';
    protected $primaryKey = 'id_sj_detail';
    public $timestamps = false;  // assuming no automatic timestamps

    protected $fillable = [
        'kode_faktur',
        'id_sj',
    ];

    // Relationship: Each SJ Detail belongs to a Surat Jalan (SJ)
    public function sj()
    {
        return $this->belongsTo(Sj::class, 'id_sj', 'id_sj');
    }

    // Relationship: Each SJ Detail refers to a product
    public function transaksi()
    {
        return $this->belongsTo(Transaksis::class, 'kode_faktur', 'kode_faktur');
    }
}
