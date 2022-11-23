<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketkuliner extends Model
{
    use HasFactory;
    protected $table = "tb_paketkuliners";
    protected $guarded = ['id'];
}