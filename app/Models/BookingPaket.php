<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPaket extends Model
{
    use HasFactory;
    protected $table = "booking_paket";
    protected $guarded = ['id'];

    public function paket()
    {
        return $this->belongsTo(tb_paket::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pesertapaket()
    {
        return $this->hasMany(PesertaPaket::class);
    }
}