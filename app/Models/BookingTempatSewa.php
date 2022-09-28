<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTempatSewa extends Model
{
    use HasFactory;
    protected $table = "tb_bookingtempatsewa";
    protected $guarded = [];
    public function userAvatar($request)
    {
        $kartu_identitas = $request->file('kartu_identitas');
        $name = $kartu_identitas->hashName();
        $destination = public_path('/images');
        $kartu_identitas->move($destination, $name);
        return $name;
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
