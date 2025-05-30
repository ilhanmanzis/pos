<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $primaryKey = 'id_profile';
    protected $fillable = ['name', 'logo', 'alamat', 'email', 'no_hp', 'ppn', 'nsfp'];
}
