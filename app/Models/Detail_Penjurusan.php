<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Detail_Penjurusan extends Model 
{
    use Authorizable, HasFactory;

    public $table = "detail_penjurusans";

  
    protected $fillable = [
        'id_penjurusan', 'id_user'
    ];


}
