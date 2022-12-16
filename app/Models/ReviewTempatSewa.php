<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewTempatSewa extends Model
{
    use HasFactory;
    protected $table = "tb_review_tempatsewa";
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function tempatsewa()
    {
        return $this->belongsTo(Tempat::class, 'tempatsewa_id', 'id');
    }
}
