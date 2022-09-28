<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewVilla extends Model
{
    use HasFactory;
    protected $table = "tb_review_villa";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tempat()
    {
        return $this->belongsTo(Villa::class, 'villa_id');
    }
}
