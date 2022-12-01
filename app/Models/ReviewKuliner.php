<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewKuliner extends Model
{
    use HasFactory;
    protected $table = "review_kuliners";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tempatkuliner()
    {
        return $this->belongsTo(Kuliner::class, 'kuliner_id');
    }
    public function detailtransaksi()
    {
        return $this->belongsTo(Detail_transaksi::class, 'kode_tiket');
    }
}
