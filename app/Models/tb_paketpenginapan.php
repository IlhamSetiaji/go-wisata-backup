<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketpenginapan extends Model
{
    use HasFactory;
    protected $table = "tb_paketpenginapan";
    protected $guarded = ['id'];
    
    public function paket()
    {
        return $this->belongsTo(tb_paket::class);
    }
}