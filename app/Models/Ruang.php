<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;
    protected $table = "tb_ruang";
    protected $guarded = [];

    public function userAvatar($request)
    {
        $foto = $request->file('foto');
        $name = $foto->hashName();
        $destination = public_path('/images');
        $foto->move($destination, $name);
        return $name;
    }
    public function booking_tempatsewa()
    {
        return $this->hasMany(BookingTempatSewa::class);
    }
}
