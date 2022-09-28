<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCamping extends Model
{

    use HasFactory;
    protected $table = "event_campings";
    protected $fillable = ['title', 'tempat_id', 'date', 'camp_id', 'kode'];
}
