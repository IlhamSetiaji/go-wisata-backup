<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatSewa extends Model
{
    use HasFactory;
    protected $table = "tb_tempatsewa";
    protected $guarded = [];

    public function userAvatar($request)
    {
        $foto = $request->file('foto');
        $name = $foto->hashName();
        $destination = public_path('/images');
        $foto->move($destination, $name);
        return $name;
    }
    public function ruang()
    {
        return $this->hasMany(Ruang::class);
    }
    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'tempat_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
