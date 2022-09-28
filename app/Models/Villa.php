<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;
    protected $table = "tb_villa";
    protected $guarded = [];

    public function userAvatar($request)
    {
        $foto = $request->file('foto');
        $name = $foto->hashName();
        $destination = public_path('/images');
        $foto->move($destination, $name);
        return $name;
    }
    public function BookingVilla()
    {
        return $this->hasMany(BookingVilla::class);
    }
}
