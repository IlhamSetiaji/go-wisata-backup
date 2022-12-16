<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketpenginapan extends Model
{
    use HasFactory;
    protected $table = "tb_paketpenginapan";
    protected $guarded = ['id'];

    public function paket()
    {
        return $this->belongsTo(tb_paket::class);
    }
    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}