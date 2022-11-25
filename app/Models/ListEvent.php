<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListEvent extends Model
{
    use HasFactory;
    protected $table = "tb_event";
    protected $guarded = [];
}
