<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'tempat_id');
    }
    public function bookingevent()
    {
        return $this->hasMany(BookingEvent::class);
    }
    public function review()
    {
        return $this->hasMany(ReviewEvent::class);
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
    public function userAvatar3($request)
    {
        $video = $request->file('video');
        $name = $video->hashName();
        $destination = public_path('/videos');

        $video->move($destination, $name);

        return $name;
    }
}
