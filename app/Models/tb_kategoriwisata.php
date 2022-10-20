<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_kategoriwisata extends Model
{
    use HasFactory;
    protected $table = "tb_kategoriwisata";
    protected $fillable = ['nama_kategori'];

    public function wisata()
    {
        return $this->hasMany(Wisata::class);
    }
}
