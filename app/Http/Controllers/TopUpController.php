<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\TopUp;
use App\Models\Wahana;
use App\Mail\TestEmail;
use App\Models\MutasiBank;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role->name == 'pelanggan') {

            $saldo = TopUp::where('user_id', Auth::user()->id)->where('status', 'Terbayar')->sum('nominal');
            return view('topup.topup', compact('saldo'));
        }
    }

    public function topup_list()
    {
        if (Auth::user()->role->name == 'wisata') {

            $historis = TopUp::latest()->get();
            return view('wisata.topup.index', compact('historis'));
        }
    }

    public function inputNominal(Request $request)
    {
        $request->validate(
            [
                'nominal' => 'required',
            ]

        );

        // $result = TopUp::where('kode_unik', 999)->exists();
        $nominal = (int) preg_replace('/\D/', '', $request->nominal);
        $email = Auth::user()->email;
        $data = TopUp::max('id');
        $urutan = (int)($data);
        $urutan++;
        $kode_unik = str_pad($urutan, 3, "0", STR_PAD_LEFT);
        $data_kode = (int) ($kode_unik);
        $nominal_tf = $nominal + $data_kode;

        $keterangan = "Pembayaran Sedang Diproses, Silahkan Menunggu Email Sukses Pembayaran";
        TopUp::insert([
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'bank' => $request->bank,
            'nominal' => $nominal,
            'nominal_ditransfer' => $nominal_tf,
            'kode_unik' => $data_kode,
            'keterangan' => $keterangan,
            'created_at' => Carbon::now(),
        ]);
        Mail::to($email)->send(new \App\Mail\EmailPembayaran);
        $id = TopUp::where('user_id', Auth::user()->id)->latest()->first('id');
        return redirect('pending/' . $id->id);
    }

    public function pendingPay($id)
    {
        $topup = TopUp::latest()->find($id);
        if ($topup->status == NULL) {
            return view('topup.pending', compact('topup'));
        }
        if ($topup->status == 'Terbayar') {
            return redirect('success/' . $id);
        }
    }

    public function statusPay(Request $request, $id)
    {
        $topup = TopUp::where('user_id', Auth::user()->id)->latest()->find($id);
        $email = Auth::user()->email;
        $result = MutasiBank::where('kredit', $topup->nominal_ditransfer)->exists();
        // return $result;
        if ($result == 1) {
            $topup->update([
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);

            $balance_user = User::find(Auth::user()->id);
            $saldo = TopUp::where('user_id', Auth::user()->id)->where('status', 'Terbayar')->sum('nominal');
            $balance_user->update([
                'balance' => $saldo,
            ]);

            Mail::to($email)->send(new \App\Mail\EmailSukses);
            return redirect('/');
        } else {
            Toastr::error('Pengisian Saldo Anda Sedang Diproses, Silahkan Menunggu', 'Danger');
            return redirect()->back();
        }
    }

    public function successPay($id)
    {

        if (Auth::user()->role->name == 'pelanggan') {

            $topup = TopUp::Where('user_id', Auth::user()->id)->latest()->find($id);
            // return $topup;
            return view('topup.success', compact('topup'));
        }
    }
}
