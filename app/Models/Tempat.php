<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image;

class Tempat extends Model
{

    use HasFactory;
    protected $table = "tb_tempat";
    protected $guarded = ['id'];


    public function tempatAvatar($request)
    {
        $image = $request->file('image');
        $name = $image->hashName();
        $destination = public_path('/images');
        $image->move($destination, $name);
        return $name;
    }
    public function tempatAvatar2($request)
    {
        $image = $request->file('image2');
        $name = $image->hashName();
        $destination = public_path('/images');

        $image->move($destination, $name);
        return $name;
    }
    public function tempatAvatar3($request)
    {
        $video = $request->file('video');
        $name = $video->hashName();
        $destination = public_path('/videos');

        $video->move($destination, $name);

        return $name;
    }
    public function tempatAvatar4($request)
    {
        $video = $request->file('video');
        $name = $video->hashName();
        $destination = public_path('/videos');

        $video->move($destination, $name);

        return $name;
    }
    public function galeri($request)
    {
        $files = $request->file('galeri[]');
        $name = $files->hashName();
        $jumlahFile = count($files['galeri']['name']);

        for ($i = 0; $i < $jumlahFile; $i++) {
            $name = $files->hashName();
            $destination = public_path('/images');
            $files->move($destination, $name);
            return $name;
            // $name = $image->hashName();
            // $destination = public_path('/images');
            // $image->move($destination, $name);
            // return $name;
        }
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id', 'desa_id');
    }

    public function userAvatar($request)
    {
        $image = $request->file('image');
        $name = $image->hashName();
        $destination = public_path('/images');
        $image->move($destination, $name);
        return $name;
    }
    public function userAvatar2($request)
    {
        $image = $request->file('image2');
        $name = $image->hashName();
        $destination = public_path('/images');
        $image->move($destination, $name);
        return $name;
    }
}