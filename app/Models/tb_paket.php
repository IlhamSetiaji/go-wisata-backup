<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paket extends Model
{
    use HasFactory;

    protected $table = "tb_pakets";
    protected $guarded = ['id'];


    public function desa()
    {
        return $this->belongsTo(Tempat::class);
    }

    public function kategori()
    {
        return $this->hasOne(tb_kategoriwisata::class);
    }


    public function menu()
    {
        return $this->belongsToMany(Kuliner::class);
    }

    public function wahana()
    {
        return $this->belongsToMany(Wahana::class);
    }
}