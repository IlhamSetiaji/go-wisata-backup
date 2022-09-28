<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    use HasFactory;
    protected $table = "event_bookings";
    protected $fillable = ['title', 'start_date', 'end_date', 'tempat_id', 'date', 'kamar_id', 'kode_tiket'];
}
