<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_kategoriwisata extends Model
{
    use HasFactory;
    protected $table = "tb_kategoriwisatas";
    protected $fillable = ['nama_kategori'];

    public function wisata()
    {
        return $this->hasMany(Wisata::class);
    }

    public function kategori()
    {
        return $this->hasOne(tb_paket::class);
    }
}