<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paket extends Model
{
    use HasFactory;
    protected $table = "tb_paket";
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsToMany(Kuliner::class);
    }

    public function wahana()
    {
        return $this->belongsToMany(Wahana::class);
    }
}