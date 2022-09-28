<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCamping;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Carbon;

class JadwalCampController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $today = Carbon\Carbon::now()->format('Y-m-d');

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $event  = EventCamping::where('tempat_id', $tempat->id)->get();
        // dd($users);
        return view('wisata.camping.jadwal', compact('event'));
    }
}
