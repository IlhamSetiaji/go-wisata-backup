<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_datakuliner extends Model
{
    use HasFactory;
    protected $table = "tb_datakuliners";
    protected $guarded = ['id'];


    public function dataPaketKuliner() {
        return $this->belongsTo(DataPaketKuliner::class, 'data_paket_kuliner_id', 'id');
    }
}