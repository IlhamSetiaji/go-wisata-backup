<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paketmenu extends Model
{
    use HasFactory;
    protected $table = "tb_paketmenus";
    protected $guarded = ['id'];
}
