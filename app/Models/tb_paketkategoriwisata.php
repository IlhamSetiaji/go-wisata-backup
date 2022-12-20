<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketkategoriwisata extends Model
{
    use HasFactory;
    protected $table = "tb_paketkategoriwisatas";
    protected $guarded = ['id'];


    public function kategori()
    {
        return $this->belongsTo(tb_kategoriwisata::class, 'kategori_wisata_id', 'id');
    }
}