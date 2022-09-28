<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cair extends Model
{
    use HasFactory;
    protected $table = "tb_pencairan";
    protected $guarded = [];

    public function petugas()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function tempat()
    {
        return $this->hasOne(Tempat::class, 'id', 'tempat_id');
    }
}
