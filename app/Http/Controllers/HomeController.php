<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Tempat;
use App\Models\Tiket;
use App\Models\Detail_transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('dashboard');
    }
    public function pesananku()
    {
        if (Auth::user()->status == '1') {
            if (Auth::user()->role->name == "pelanggan") {
                $tiket = Tiket::where('user_id', Auth::user()->id)->get();
                // $tiket = Tiket::where('kode', $kode)->first();
                // dd($tiket);

                return view('home2', compact('tiket'));
            }
        }
        if (Auth::user()->status == '1') {
            if (Auth::user()->role->name == "admin") {

                return view('admin.dashboard.admin');
            }
            if (Auth::user()->role->name == "wisata") {

                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->get();
                // dd($tempat);
                return view('admin.dashboard.wisata', compact('tempat'));
            }
        }

        return view('error');
        // return redirect('/dashboard');
    }
}
