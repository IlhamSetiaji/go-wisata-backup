<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketkategoriwisata extends Model
{
    use HasFactory;
    protected $table = "tb_paketkategoriwisatas";
    protected $guarded = ['id'];
}