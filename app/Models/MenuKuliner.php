<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuKuliner extends Model
{
    use HasFactory;
    protected $table = "tb_kuliner";
    protected $guarded = [];
}
