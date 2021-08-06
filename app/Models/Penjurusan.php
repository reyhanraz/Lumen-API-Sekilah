<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Penjurusan extends Model 
{
    use Authorizable, HasFactory;

  
    protected $fillable = [
        'nama_penjurusan', 'kuota_maks'
    ];


}
