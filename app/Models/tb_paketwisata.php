<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketwisata extends Model
{
    use HasFactory;
    protected $table = "tb_paketwisata";
    protected $guarded = ['id'];


    public function paket()
    {
        return $this->belongsTo(tb_paket::class);
    }
}