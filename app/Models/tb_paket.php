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
        return $this->belongsTo(Tempat::class, 'id_desa', 'id');
    }

    public function guide()
    {
        return $this->hasMany(Tour::class, 'id', 'tour_guide_id');
    }

    public function kategori()
    {
        return $this->hasOne(tb_kategoriwisata::class, 'id', 'id_kategori');
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function bookingpaket()
    {
        return $this->hasMany(BookingPaket::class);
    }
    public function pesertapaket()
    {
        return $this->hasManyThrough(PesertaPaket::class, BookingPaket::class);
    }
}