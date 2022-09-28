<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriEvent extends Model
{
    use HasFactory;
    protected $table = "tb_kategorievent";
    protected $fillable = ['nama_kategori'];

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
