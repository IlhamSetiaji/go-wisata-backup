<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingEvent extends Model
{
    use HasFactory;
    protected $table = "tb_bookingevent";
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pesertaevent()
    {
        return $this->hasMany(PesertaEvent::class);
    }
}
