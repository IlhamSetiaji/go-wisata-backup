<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cair;
use App\Models\Tempat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class DanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role->name == 'wisata') {

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
            $danamasuk = array($duit);
            //Dana Keluar
            $duit2 = $grandcair;
            $danakeluar = array($duit2);
            //Dana menunggu
            $duit3 = $grandcair2;
            //Dana Tempat
            $oto = Tempat::where('id', $id_tempat)->first();

            $danaa = $duit - $duit2;

            $oto->update([
                'dana' => $danaa,
            ]);
            // dd($oto->dana);
            $uangutama = $tempat->dana;
            $uangutamaa = array($uangutama);

            $pencairan = Cair::select(DB::raw("COUNT(*) as count"))
                ->where('tempat_id', $id_tempat)
                // ->whereYear('created_at', date('Y'))
                ->take(5, 'DESC')
                ->groupBy(DB::raw("jumlah"))
                ->pluck('count');

            // return $pencairan;
            $nominal = DB::table('tb_pencairan')->select('jumlah')
                ->where('user_id',  Auth::user()->id)
                // ->where('status', 1)
                // ->whereYear('tgl_pengajuan', date('Y'))
                // ->orderby('tgl_pengajuan', 'DESC')
                ->groupBy('jumlah')
                ->take(7, 'DESC')
                ->pluck('jumlah');

            // return $nominal;


            $ditolak = DB::table('tb_pencairan')->select('tgl_pengajuan')
                ->where('user_id',  Auth::user()->id)
                ->where('status', 2)
                ->whereYear('tgl_pengajuan', date('Y'))
                ->orderby('tgl_pengajuan', 'ASC')
                // ->groupBy('tgl_pengajuan')
                ->take(7)
                ->pluck('tgl_pengajuan');

            $nominal_ditolak = DB::table('tb_pencairan')->select('jumlah')
                ->where('user_id',  Auth::user()->id)
                ->where('status', 2)
                ->whereYear('tgl_pengajuan', date('Y'))
                ->orderby('jumlah', 'ASC')
                // ->groupBy('jumlah')
                ->take(7, 'DESC')
                ->pluck('jumlah');

            $disetujui = DB::table('tb_pencairan')->select('tgl_pengajuan')
                ->where('user_id',  Auth::user()->id)
                ->where('status', 1)
                ->whereYear('tgl_pengajuan', date('Y'))
                ->orderby('tgl_pengajuan', 'ASC')
                // ->groupBy('tgl_pengajuan')
                ->take(7)
                ->pluck('tgl_pengajuan');
            // return $disetujui;

            $nominal_disetujui = DB::table('tb_pencairan')->select('jumlah')
                ->where('user_id',  Auth::user()->id)
                ->where('status', 1)
                ->whereYear('tgl_pengajuan', date('Y'))
                ->orderby('jumlah', 'ASC')
                // ->groupBy('jumlah')
                ->take(5, 'DESC')
                ->pluck('jumlah');
            // return $nominal_disetujui;

            $menunggu = DB::table('tb_pencairan')->select('tgl_pengajuan')
                ->where('user_id',  Auth::user()->id)
                ->where('status', 0)
                ->whereYear('tgl_pengajuan', date('Y'))
                ->orderby('tgl_pengajuan', 'ASC')
                // ->groupBy('tgl_pengajuan')
                ->take(7)
                ->pluck('tgl_pengajuan');

            // return $menunggu;

            $nominal_menunggu = DB::table('tb_pencairan')->select('jumlah')
                ->where('user_id',  Auth::user()->id)
                ->where('status', 0)
                ->whereYear('tgl_pengajuan', date('Y'))
                ->orderby('jumlah', 'ASC')
                // ->groupBy('jumlah')
                ->take(7, 'DESC')
                ->pluck('jumlah');

            // return $nominal_menunggu;

            $array = $nominal->toArray();
            $pecah = "Rp." . implode(" Rp.", $array);
            $nominal_gabung = explode(" ", $pecah);


            return view('wisata.dana.index', compact('data', 'duit', 'id_tempat', 'cair', 'uangutama', 'duit2', 'duit3', 'nominal_gabung', 'pencairan', 'ditolak', 'nominal_ditolak', 'disetujui', 'nominal_disetujui', 'menunggu', 'nominal_menunggu', 'uangutamaa', 'danamasuk', 'danakeluar'));
        }
        // if (Auth::user()->role->name == 'kuliner') {
        // }
    }

    public function store(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id = $tempat->id;
        $default = $request->daterange;
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        // $a =    $startDate->date('d-m-Y');

        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        // dd($tgl_b);

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
        $danamasuk = array($duit);
        //Dana Keluar
        $duit2 = $grandcair;
        $danakeluar = array($duit2);
        //Dana menunggu
        $duit3 = $grandcair2;
        //Dana Tempat
        $oto = Tempat::where('id', $id_tempat)->first();

        $danaa = $duit - $duit2;

        $oto->update([
            'dana' => $danaa,
        ]);
        // dd($oto->dana);
        $uangutama = $tempat->dana;
        $uangutamaa = array($uangutama);

        switch ($request->submit) {
            case 'table':

                $data = Cair::get()
                    ->where('tempat_id', $id)
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate]);
                // return $data;

                $pencairan = Cair::select(DB::raw("COUNT(*) as count"))
                    ->where('tempat_id', $id)
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    ->take(5, 'DESC')
                    ->groupBy(DB::raw("jumlah"))
                    ->pluck('count');

                $nominal = DB::table('tb_pencairan')->select('jumlah')
                    ->where('user_id',  Auth::user()->id)
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    ->groupBy('jumlah')
                    ->take(7, 'DESC')
                    ->pluck('jumlah');

                // return $nominal;

                $array = $nominal->toArray();
                $pecah = "Rp." . implode(" Rp.", $array);
                $nominal_gabung = explode(" ", $pecah);

                // return $nominal_gabung;


                // $ditolak = Cair::select(DB::raw("COUNT(*) as count"))
                //     ->where('tempat_id', $id_tempat)
                //     ->where('status', 2)
                //     ->whereYear('created_at', date('Y'))
                //     ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                //     ->take(7)
                //     ->orderBy('tgl_pengajuan', 'DESC')
                //     ->groupBy(DB::raw("tgl_pengajuan"))
                //     ->pluck('count');
                // // return $ditolak;

                $ditolak = DB::table('tb_pencairan')->select('tgl_pengajuan')
                    ->where('user_id',  Auth::user()->id)
                    ->where('status', 2)
                    ->whereYear('tgl_pengajuan', date('Y'))
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    ->orderby('tgl_pengajuan', 'ASC')
                    // ->groupBy('tgl_pengajuan')
                    ->take(7)
                    ->pluck('tgl_pengajuan');
                // return $nominal_ditolak;

                $nominal_ditolak = DB::table('tb_pencairan')->select('jumlah')
                    ->where('user_id',  Auth::user()->id)
                    ->where('status', 2)
                    ->whereYear('tgl_pengajuan', date('Y'))
                    ->orderby('jumlah', 'ASC')
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    // ->groupBy('jumlah')
                    ->take(7, 'DESC')
                    ->pluck('jumlah');
                // return $nominal_ditolak;

                $disetujui = DB::table('tb_pencairan')->select('tgl_pengajuan')
                    ->where('user_id',  Auth::user()->id)
                    ->where('status', 1)
                    ->whereYear('tgl_pengajuan', date('Y'))
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    ->orderby('tgl_pengajuan', 'ASC')
                    // ->groupBy('tgl_pengajuan')
                    ->take(7)
                    ->pluck('tgl_pengajuan');
                // return $disetujui;

                $nominal_disetujui = DB::table('tb_pencairan')->select('jumlah')
                    ->where('user_id',  Auth::user()->id)
                    ->where('status', 1)
                    ->whereYear('tgl_pengajuan', date('Y'))
                    ->orderby('jumlah', 'ASC')
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    // ->groupBy('jumlah')
                    ->take(5, 'DESC')
                    ->pluck('jumlah');
                // return $nominal_disetujui;

                $menunggu = DB::table('tb_pencairan')->select('tgl_pengajuan')
                    ->where('user_id',  Auth::user()->id)
                    ->where('status', 0)
                    ->whereYear('tgl_pengajuan', date('Y'))
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    ->orderby('tgl_pengajuan', 'ASC')
                    // ->groupBy('tgl_pengajuan')
                    ->take(7)
                    ->pluck('tgl_pengajuan');

                // return $menunggu .  $disetujui . $ditolak;

                $nominal_menunggu = DB::table('tb_pencairan')->select('jumlah')
                    ->where('user_id',  Auth::user()->id)
                    ->where('status', 0)
                    ->whereYear('tgl_pengajuan', date('Y'))
                    ->orderby('jumlah', 'ASC')
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate])
                    // ->groupBy('jumlah')
                    ->take(7, 'DESC')
                    ->pluck('jumlah');

                // return $nominal_menunggu;

                $bb = Detail_transaksi::get()
                    ->where('tempat_id', $id)
                    ->where('status', null)
                    ->whereBetween('tanggal_a', [$startDate, $endDate]);
                $belum_bayar = 0;
                foreach ($bb as $ct => $tot) {
                    $belum_bayar += $tot->harga;
                }
                // return $belum_bayar;
                $sb = Detail_transaksi::get()
                    ->where('tempat_id', $id)
                    ->where('status', 1)
                    ->whereBetween('tanggal_a', [$startDate, $endDate]);

                $bayar = 0;
                foreach ($sb as $ct => $tot) {
                    $bayar += $tot->harga;
                }
                // return $bayar;
                $kon = Detail_transaksi::get()
                    ->where('tempat_id', $id)
                    ->where('status', 1)
                    ->where('kedatangan', 1)
                    ->whereBetween('tanggal_a', [$startDate, $endDate]);

                $konfirm = 0;
                foreach ($kon as $ct => $tot) {
                    $konfirm += $tot->harga;
                }
                // return $konfirm;

                $total = 0;
                $count = 0;
                foreach ($data as $ct => $val) {
                    $count += 1;
                    $total += $val->harga;
                }

                return view('wisata.dana.index', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'nominal_gabung', 'data', 'duit', 'id_tempat', 'cair', 'uangutama', 'duit2', 'duit3', 'pencairan', 'ditolak', 'nominal_ditolak', 'disetujui', 'nominal_disetujui', 'menunggu', 'nominal_menunggu', 'uangutamaa', 'danamasuk', 'danakeluar'));
                break;
        }
    }

    public function cair(Request $request)
    {
        //
        // dd($request);
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $data = $request->all();
        // $email = Auth::user()->email;

        $clean = (int) preg_replace('/\D/', '', $request->jumlah);
        $tgl_ajuan = Carbon::now()->format('Y-m-d');

        Cair::create([

            'user_id' => $request->user_id,
            'tempat_id' => $request->tempat_id,
            'jumlah' => $clean,
            'status' => 0,
            'tgl_pengajuan' => $tgl_ajuan,

        ]);

        Mail::to('admin@gmail.com')->send(new \App\Mail\EmailPencairan);
        return redirect('awisata/dana');
    }
    public function acair()
    {
        //
        $cair = Cair::with(['tempat', 'petugas'])->orderby('id', 'desc')->where('status', 0)->get();
        $cair2 = Cair::with(['tempat', 'petugas'])->orderby('id', 'desc')->where('status', '!=', 0)->get();
        return view('admin.dana.index', compact('cair', 'cair2'));
    }
    public function konfirmasi($id)
    {
        //
        $dana = Cair::find($id);
        $email = $dana->petugas->email;
        $dana->status = 1;
        $tempat_id = $dana->tempat_id;
        $nominal = $dana->jumlah;
        $dana->save();
        //kurang di dana
        $tempat  = Tempat::where('status', '1')->where('id', $tempat_id)->first();
        // dd($tempat);
        $tempat->dana -= $nominal;
        $a = $tempat->dana;
        // $tempat->dana = $duit;
        $tempat['dana'] = $a;
        $tempat->update([
            'dana' => $a,
        ]);
        Mail::to($email)->send(new \App\Mail\EmailKonfirmasi);
        Toastr::info('Berhasil Disetujui', 'Success');
        return redirect()->back();
    }
    public function tolak($id)
    {
        //
        $dana = Cair::find($id);
        $email = $dana->petugas->email;
        $dana->status = 2;
        $dana->save();

        Mail::to($email)->send(new \App\Mail\EmailKonfirmasi);
        Toastr::info('Berhasil Ditolak', 'Success');
        return redirect()->back();
    }
}
