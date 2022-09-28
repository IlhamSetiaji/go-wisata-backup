<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use App\Models\Cair;
use Brian2694\Toastr\Facades\Toastr;

class DanaKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $data = Detail_transaksi::where('kedatangan', '1')->orderby('id', 'desc')->where('tempat_id', $id_tempat)->take(5)->get();
        $data4 = Detail_transaksi::where('kedatangan', '1')->orderby('id', 'desc')->where('tempat_id', $id_tempat)->get();
        $cair = Cair::where('tempat_id', $id_tempat)->orderby('id', 'desc')->get();
        $cair2 = Cair::where('tempat_id', $id_tempat)->where('status', 1)->get();
        $cair3 = Cair::where('tempat_id', $id_tempat)->where('status', 0)->get();
        $grandtotal = 0;
        $grandcair = 0;
        $grandcair2 = 0;

        foreach ($data4 as $dt => $detail) {
            $uang = $detail->harga;
            $grandtotal += $uang;
        }
        foreach ($cair2 as $dt => $cair2) {
            $uang = $cair2->jumlah;
            $grandcair += $uang;
        }
        foreach ($cair3 as $dt => $cair3) {
            $uang = $cair3->jumlah;
            $grandcair2 += $uang;
        }

        //Dana Masuk
        $duit = $grandtotal;
        // $tempat->dana = $duit;
        // $tempat->save();
        //Dana Keluar
        $duit2 = $grandcair;
        //Dana menunggu
        $duit3 = $grandcair2;
        //Dana Tempat
        $uangutama = $tempat->dana;
        // dd($grandcair);
        return view('kuliner.dana.index', compact('data', 'duit', 'id_tempat', 'cair', 'uangutama', 'duit2', 'duit3'));
    }
    public function kuliner_cair(Request $request)
    {
        //
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $data = $request->all();
        Cair::create([

            'user_id' => $request->user_id,
            'tempat_id' => $request->tempat_id,
            'jumlah' =>  (int) preg_replace('/\D/', '', $request->jumlah),
            'status' => 0,

        ]);

        //kurang di dana
        // $tempat->dana -= $request->jumlah;
        // $a = $tempat->dana;
        // // $tempat->dana = $duit;
        // $tempat['dana'] = $a;
        // $tempat->update([
        //     'dana' => $a,
        // ]);
        return redirect("/kuliner/danak");
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
}
