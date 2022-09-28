<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewEvent extends Model
{
    use HasFactory;
    protected $table = "tb_review_event";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
