<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_camp extends Model
{
    use HasFactory;
    protected $table = "tb_detailcamp";
    protected $guarded = [];

    public function dcamp()
    {
        return $this->hasOne(Camp::class, 'kode_camp', 'alat_id');
    }
}
