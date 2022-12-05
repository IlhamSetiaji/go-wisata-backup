<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaPaket extends Model
{
    use HasFactory;
    protected $table = "peserta_paket";
    protected $guarded = ['id'];

    public function bookingpaket()
    {
        return $this->belongsTo(BookingPaket::class);
    }
}
