<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketwahana extends Model
{
    use HasFactory;
    protected $table = "tb_paketwahanas";
    protected $guarded = ['id'];
    public function paket()
    {
        return $this->belongsTo(tb_paket::class);
    }
    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }
}