<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventBooking;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Carbon;

class JadwalKamarController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $today = Carbon\Carbon::now()->format('Y-m-d');

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $event  = EventBooking::where('tempat_id', $tempat->id)->orderby('date', 'Desc')->get();
        // dd($users);
        return view('penginapan.kamar.jadwal', compact('event'));
    }
}
