<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalanDetails extends Model
{
    use HasFactory;
    protected $table = 'surat_jalan_detail';
    protected $primaryKey = 'id_surat_jalan_detail';
    protected $guarded = [];

    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class, 'id_surat_jalan', 'id_surat_jalan');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksis::class, 'kode_faktur', 'kode_faktur');
    }
}
