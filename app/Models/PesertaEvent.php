<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaEvent extends Model
{
    use HasFactory;
    protected $table = "tb_pesertaevent";
    protected $guarded = [];

    public function bookingevent()
    {
        return $this->belongsTo(BookingEvent::class);
    }
}
