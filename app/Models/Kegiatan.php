<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = "tb_kegiatan";
    protected $guarded = [];

    public function userAvatar($request)
    {
        $image = $request->file('image');
        $name = $image->hashName();
        $destination = public_path('/images');
        $image->move($destination, $name);
        return $name;
    }
    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'tempat_id');
    }
}
