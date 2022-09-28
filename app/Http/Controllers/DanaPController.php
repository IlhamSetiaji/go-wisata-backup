<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use App\Models\Cair;
use Brian2694\Toastr\Facades\Toastr;

class DanaPController extends Controller
{
    public function index()
    {
        //
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $data = Detail_transaksi::where('kedatangan', '1')->orderby('id', 'desc')->where('tempat_id', $id_tempat)->take(5)->get();
        $data4 = Detail_transaksi::where('kedatangan', '1')->orderby('id', 'desc')->where('tempat_id', $id_tempat)->get();
        // dd($data4);
        $cair = Cair::where('tempat_id', $id_tempat)->orderby('id', 'desc')->get();
        $cair2 = Cair::where('tempat_id', $id_tempat)->where('status', 1)->get();
        $cair3 = Cair::where('tempat_id', $id_tempat)->where('status', 0)->get();
        $grandtotal = 0;
        $grandcair = 0;
        $grandcair2 = 0;

        foreach ($data4 as $dt => $detail) {
            $uang1 = $detail->harga;
            $grandtotal += $uang1;
        }
        // dd($grandtotal);
        foreach ($cair2 as $dt => $cair2) {
            $uang2 = $cair2->jumlah;
            $grandcair += $uang2;
        }
        foreach ($cair3 as $dt => $cair3) {
            $uang3 = $cair3->jumlah;
            $grandcair2 += $uang3;
        }

        //Dana Masuk
        $duit = $grandtotal;
        $tempat->dana = $duit;
        $tempat->save();
        //Dana Keluar
        $duit2 = $grandcair;
        //Dana menunggu
        $duit3 = $grandcair2;
        //Dana Tempat
        $uangutama = $tempat->dana;
        // dd($grandcair);
        return view('penginapan.dana.index', compact('data', 'duit', 'id_tempat', 'cair', 'uangutama', 'duit2', 'duit3'));
    }
    public function penginapan_cair(Request $request)
    {
        //
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $data = $request->all();
        // dd($data);
        // $Jumlah = $request->jumlah

        $clean = (int) preg_replace('/\D/', '', $request->jumlah);
        // dd($clean);

        Cair::create([

            'user_id' => $request->user_id,
            'tempat_id' => $request->tempat_id,
            'jumlah' => $clean,
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
}
