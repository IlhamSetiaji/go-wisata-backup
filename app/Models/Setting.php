<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = "table_setting";
    protected $guarded = [];
    public function userAvatar($request)
    {
        $home1 = $request->file('home1');
        $name = $home1->hashName();
        $destination = public_path('/images/setting');
        $home1->move($destination, $name);
        return $name;
    }

    public function userAvatar2($request)
    {
        $home1 = $request->file('sponsor1');
        $name = $home1->hashName();
        $destination = public_path('/images/setting');
        $home1->move($destination, $name);
        return $name;
    }

    public function userAvatar3($request)
    {
        $home1 = $request->file('sponsor2');
        $name = $home1->hashName();
        $destination = public_path('/images/setting');
        $home1->move($destination, $name);
        return $name;
    }

    public function userAvatar4($request)
    {
        $home1 = $request->file('sponsor3');
        $name = $home1->hashName();
        $destination = public_path('/images/setting');
        $home1->move($destination, $name);
        return $name;
    }
    public function userAvatar5($request)
    {
        $home1 = $request->file('sponsor4');
        $name = $home1->hashName();
        $destination = public_path('/images/setting');
        $home1->move($destination, $name);
        return $name;
    }
    public function userAvatar6($request)
    {
        $home1 = $request->file('experience1');
        $name = $home1->hashName();
        $destination = public_path('/images/setting');
        $home1->move($destination, $name);
        return $name;
    }
    public function userAvatar7($request)
    {
        $home1 = $request->file('experience2');
        $name = $home1->hashName();
        $destination = public_path('/images/setting');
        $home1->move($destination, $name);
        return $name;
    }
    public function tempatAvatar8($request)
    {
        $video = $request->file('video');
        $name = $video->hashName();
        $destination = public_path('/videos');

        $video->move($destination, $name);

        return $name;
    }
}
