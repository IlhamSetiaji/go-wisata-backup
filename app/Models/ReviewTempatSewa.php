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
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tempatsewa()
    {
        return $this->belongsTo(TempatSewa::class, 'tempatsewa_id');
    }
}
