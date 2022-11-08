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

    public function paketwisata()
    {
        return $this->hasMany(tb_paketwisata::class);
    }
    public function paketwahana()
    {
        return $this->hasMany(tb_paketwahana::class);
    }
    public function paketpenginapan()
    {
        return $this->hasMany(tb_paketpenginapan::class);
    }
}