<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{

    use HasFactory;
    protected $table = "tb_pay";
    protected $guarded = [];


    public function tiketnya()
    {
        return $this->HasOne(Tiket::class, 'kode', 'kodeku');
    }
}
