<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketkuliner extends Model
{
    use HasFactory;
    protected $table = "tb_paketkuliners";
    protected $guarded = ['id'];


    public function kuliner(){
        return $this->belongsTo(Kuliner::class, 'tb_kuliner_id','id');
    }
}