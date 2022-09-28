<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "tb_event";
    protected $guarded = [];

    public function userAvatar($request)
    {
        $foto = $request->file('foto');
        $name = $foto->hashName();
        $destination = public_path('/images');
        $foto->move($destination, $name);
        return $name;
    }
    public function kategorievent()
    {
        return $this->belongsTo(KategoriEvent::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function bookingevent()
    {
        return $this->hasMany(BookingEvent::class);
    }
    public function pesertaevent()
    {
        return $this->hasManyThrough(PesertaEvent::class, BookingEvent::class);
    }
}
