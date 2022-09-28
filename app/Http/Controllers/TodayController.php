<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Carbon;

use Brian2694\Toastr\Facades\Toastr;

class TodayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function todaykuliner()
    {
        date_default_timezone_set('Asia/Jakarta');

        $today = Carbon\Carbon::now()->format('Y-m-d');

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data = Detail_transaksi::where('tanggal_b', $today)->where('kategori', 'kuliner')->where('tempat_id', $tempat->id)->orderBy('created_at', 'ASC')->get();
        $data2 = Detail_transaksi::where('tanggal_b', $today)->where('kategori', 'kuliner')->where('tempat_id', $tempat->id)->where('status', 2)->get();
        $todayuang = 0;
        foreach ($data2 as $dt => $detail) {
            $uang = $detail->harga;
            $todayuang += $uang;
        }
        return view('kuliner.livekuliner', compact('data', 'today', 'todayuang'));
    }
    public function updatekulinerselesai($id)
    {
        $item = Detail_transaksi::find($id);
        $item->status = 2;
        $item->save();
        Toastr::info('Selesai Diantarkan', 'Success');
        return redirect()->back();
    }
    public function printkulinertoday($today)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data2 = Detail_transaksi::where('tanggal_b', $today)->where('kategori', 'kuliner')->where('status', 2)->where('tempat_id', $tempat->id)->get();
        $todayuang = 0;
        foreach ($data2 as $dt => $detail) {
            $uang = $detail->harga;
            $todayuang += $uang;
        }

        // dd($data);
        return view('kuliner.printtodayk', compact('data2', 'todayuang', 'today', 'tempat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function todaypesanevent()
    {
        date_default_timezone_set('Asia/Jakarta');

        $today = Carbon\Carbon::now()->format('Y-m-d');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data = Detail_transaksi::where('tanggal_a', $today)->where('kategori', 'events')->where('tempat_id', $tempat->id)->orderBy('created_at', 'ASC')->get();
        $data2 = Detail_transaksi::where('tanggal_a', $today)->where('kategori', 'events')->where('tempat_id', $tempat->id)->where('status', 3)->get();
        $todayuang = 0;
        foreach ($data2 as $dt => $detail) {
            $uang = $detail->harga;
            $todayuang += $uang;
        }

        return view('admin.booking.todays', compact('data', 'today', 'todayuang'));
    }
    public function print_event($today)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data2 = Detail_transaksi::where('tanggal_a', $today)->where('kategori', 'events')->where('tempat_id', $tempat->id)->get();
        $todayuang = 0;
        foreach ($data2 as $dt => $detail) {
            $uang = $detail->harga;
            $todayuang += $uang;
        }
        return view('admin.booking.todayprint_event', compact('data2', 'todayuang', 'today', 'tempat'));
    }

    public function todaypesanvilla()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = Carbon\Carbon::now()->format('Y-m-d');

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data = Detail_transaksi::where('tanggal_a', $today)->where('kategori', 'villa')->where('tempat_id', $tempat->id)->orderBy('created_at', 'ASC')->get();
        $data2 = Detail_transaksi::where('tanggal_a', $today)->where('kategori', 'villa')->where('tempat_id', $tempat->id)->where('status', 3)->get();
        $todayuang = 0;
        foreach ($data2 as $dt => $detail) {
            $uang = $detail->harga;
            $todayuang += $uang;
        }

        return view('admin.booking.todays_villa', compact('data', 'today', 'todayuang'));
    }
    public function print_Villa($today)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data2 = Detail_transaksi::where('tanggal_a', $today)->where('kategori', 'villa')->where('tempat_id', $tempat->id)->get();
        $todayuang = 0;
        foreach ($data2 as $dt => $detail) {
            $uang = $detail->harga;
            $todayuang += $uang;
        }
        return view('admin.booking.todayprint_villa', compact('data2', 'todayuang', 'today', 'tempat'));
    }
}
