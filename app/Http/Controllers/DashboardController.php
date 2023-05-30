<?php

namespace App\Http\Controllers;


use App\Models\BookingTempatSewa;
use App\Models\Detail_transaksi;
use App\Models\Event;
use App\Models\Tempat;
use App\Models\TempatSewa;
use App\Models\Villa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->status == '1') {
            if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'kota') {

                // $users = Detail_transaksi::select(DB::raw("COUNT(*) as count"))
                //     ->whereYear('tanggal_a', date('Y'))
                //     ->groupBy(DB::raw("Day(tanggal_a)"))
                //     ->orderby('tanggal_a', 'ASC')
                //     ->take(5)
                //     ->pluck('count');
                // $datee = Detail_transaksi::select('tanggal_a')
                //     ->whereYear('tanggal_a', date('Y'))
                //     ->groupBy('tanggal_a')
                //     ->orderby('tanggal_a', 'ASC')
                //     ->take(5)
                //     ->pluck('tanggal_a');
                $users = Detail_transaksi::select(DB::raw("COUNT(*) as count"))
                    ->whereYear('tanggal_a', date('Y'))
                    ->take(5)
                    ->groupBy(DB::raw("Day(tanggal_a)"))

                    ->pluck('count');
                $datee = Detail_transaksi::select('tanggal_a')
                    // ->where('tempat_id',  $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy('tanggal_a')
                    ->orderby('tanggal_a', 'ASC')
                    ->take(5)
                    ->pluck('tanggal_a');
                // dd($datee);
                return view('admin.dashboard.admin', compact('users', 'datee'));
            }
            // if(Auth::user()->role->name == 'kota') {
            //     return view('kota.index');
            // }
            if (Auth::user()->role->name == 'wisata') {

                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                if ($tempat == null) {
                    return view('error');
                }
                $tempatt  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                // dd($tempatt);
                $users = Detail_transaksi::select(DB::raw("COUNT(*) as count"))
                    ->where('tempat_id', $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->take(5)
                    ->groupBy(DB::raw("Day(tanggal_a)"))
                    ->pluck('count');
                // $isi = [];
                // foreach ($users as $atas) {
                //     $isi[] = $atas;
                // }
                // dd($users);
                $categories2 = Detail_transaksi::all()->groupBy('tanggal_a');
                // dd($categories);
                // return $categories2;
                $datee = Detail_transaksi::select('tanggal_a')
                    ->where('tempat_id',  $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy('tanggal_a')
                    ->orderby('tanggal_a', 'DESC')
                    ->take(5)
                    ->pluck('tanggal_a');



                return view('admin.dashboard.wisata', compact('tempatt', 'tempat', 'users', 'datee'));
            }
            if (Auth::user()->role->name == 'kuliner') {

                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                if ($tempat == null) {
                    return view('error');
                }
                $tempatt  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                $induk_id = $tempatt->induk_id;
                $tempattt  = Tempat::where('id', $induk_id)->where('status', '1')->first();
                // dd($tempattt);
                // dd($tempatt);
                $users = Detail_transaksi::select(DB::raw("COUNT(*) as count"))
                    ->where('tempat_id', $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy(DB::raw("Day(tanggal_a)"))
                    ->pluck('count');
                $isi = [];
                foreach ($users as $atas) {
                    $isi[] = $atas;
                }
                // dd($users);
                $categories2 = Detail_transaksi::all()->groupBy('tanggal_a');
                // dd($categories);
                $datee = Detail_transaksi::select('tanggal_a')
                    ->where('tempat_id',  $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy('tanggal_a')
                    ->pluck('tanggal_a');
                // dd($tempat);
                return view('admin.dashboard.kuliner', compact('tempattt', 'tempatt', 'tempat', 'users', 'datee'));
            }
            if (Auth::user()->role->name == 'penginapan') {

                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                if ($tempat == null) {
                    return view('error');
                }
                $tempatt  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                $induk_id = $tempatt->induk_id;
                $tempattt  = Tempat::where('id', $induk_id)->where('status', '1')->first();
                $users = Detail_transaksi::select(DB::raw("COUNT(*) as count"))
                    ->where('tempat_id', $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy(DB::raw("Day(tanggal_a)"))
                    ->pluck('count');
                $isi = [];
                foreach ($users as $atas) {
                    $isi[] = $atas;
                }
                $categories2 = Detail_transaksi::all()->groupBy('tanggal_a');
                $datee = Detail_transaksi::select('tanggal_a')
                    ->where('tempat_id',  $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy('tanggal_a')
                    ->pluck('tanggal_a');
                return view('admin.dashboard.penginapan', compact('tempattt', 'tempatt', 'tempat', 'users', 'datee'));
            }
            if (Auth::user()->role->name == 'desa') {
                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                // dd($tempat);
                if ($tempat == null) {
                    return view('error');
                }
                $tempatt  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                $induk_id = $tempatt->induk_id;
                $tempattt  = Tempat::where('id', $induk_id)->where('status', '1')->first();
                // dd($tempattt);
                // dd($tempatt);
                $users = Detail_transaksi::select(DB::raw("COUNT(*) as count"))
                    ->where('tempat_id', $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy(DB::raw("Day(tanggal_a)"))
                    ->pluck('count');
                $isi = [];
                foreach ($users as $atas) {
                    $isi[] = $atas;
                }
                // dd($users);
                $categories2 = Detail_transaksi::all()->groupBy('tanggal_a');
                // dd($categories);
                $datee = Detail_transaksi::select('tanggal_a')
                    ->where('tempat_id',  $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy('tanggal_a')
                    ->pluck('tanggal_a');
                // dd($tempat);
                return view('admin.dashboard.desa', compact('tempattt', 'tempatt', 'tempat', 'users', 'datee'));
            }
            if (Auth::user()->role->name == 'event & sewa tempat') {
                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                if ($tempat == null) {
                    return view('error');
                }
                $tempatt  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                $induk_id = $tempatt->induk_id;
                $tempattt  = Tempat::where('id', $induk_id)->where('status', '1')->first();
                $event = Event::where('user_id', Auth::user()->id)->count();
                $ts = TempatSewa::where('user_id', Auth::user()->id)->count();
                $tempat_sewa = Villa::where('user_id', Auth::user()->id)->count();

                $users = Detail_transaksi::select(DB::raw("COUNT(*) as count"))
                    ->where('tempat_id', $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy(DB::raw("Day(tanggal_a)"))
                    ->pluck('count');
                $isi = [];
                foreach ($users as $atas) {
                    $isi[] = $atas;
                }
                $datee = Detail_transaksi::select('tanggal_a')
                    ->where('tempat_id',  $tempatt->id)
                    ->whereYear('tanggal_a', date('Y'))
                    ->groupBy('tanggal_a')
                    ->pluck('tanggal_a');

                //count grafik chart pertahun
                $thn_sekarang = Carbon::now()->isoFormat('YYYY');
                $total_jan = 0;
                $total_feb = 0;
                $total_mar = 0;
                $total_apr = 0;
                $total_mei = 0;
                $total_jun = 0;
                $total_juli = 0;
                $total_agus = 0;
                $total_sept = 0;
                $total_okto = 0;
                $total_nove = 0;
                $total_dese = 0;
                foreach (Detail_transaksi::where('tempat_id',  $tempatt->id)->get() as $ff) {
                    $k = date('m', strtotime($ff->tanggal_a));
                    $y = date('Y', strtotime($ff->tanggal_a));

                    if ($y == $thn_sekarang) {
                        if ($k == '07') {
                            $total_juli += 1;
                        } elseif ($k == '01') {
                            $total_jan += 1;
                        } elseif ($k == '02') {
                            $total_feb += 1;
                        } elseif ($k == '03') {
                            $total_mar += 1;
                        } elseif ($k == '04') {
                            $total_apr += 1;
                        } elseif ($k == '05') {
                            $total_mei += 1;
                        } elseif ($k == '06') {
                            $total_jun += 1;
                        } elseif ($k == '08') {
                            $total_agus += 1;
                        } elseif ($k == '09') {
                            $total_sept += 1;
                        } elseif ($k == '10') {
                            $total_okto += 1;
                        } elseif ($k == '11') {
                            $total_nove += 1;
                        } elseif ($k == '12') {
                            $total_dese += 1;
                        }
                    }
                }

                return view('admin.dashboard.event_sewatempat', compact('ts', 'tempattt', 'tempatt', 'tempat', 'event', 'tempat_sewa', 'users', 'datee', 'thn_sekarang', 'total_juli', 'total_agus', 'total_sept', 'total_okto', 'total_nove', 'total_dese', 'total_jan', 'total_feb', 'total_mar', 'total_apr', 'total_mei', 'total_jun'));
            }
            if (Auth::user()->role->name == 'pelanggan') {
                return redirect('/');
            }
        }
        return view('error');
    }
}
