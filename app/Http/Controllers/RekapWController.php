<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Tempat;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekapWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wisata.rekap');
    }
    public function rekapwisata()
    {
        return view('wisata.rekap');
    }


    public function sortw(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $default = $request->daterange;
        // dd($default);
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        // $a =    $startDate->date('d-m-Y');

        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));

        $tanggal_awal = date('Y-m-d', strtotime($startDate));
        $tanggal_akhir = date('Y-m-d', strtotime($endDate));
        // dd($tanggal_awal);
        

        switch ($request->submit) {
            case 'table':

                $data = Detail_transaksi::get()
        ->where('tempat_id', $id_tempat)
        ->whereBetween('tanggal_a', [$tanggal_awal, $tanggal_akhir]);
                $total = 0;
                $count = 0;
                foreach ($data as $ct => $val) {
                    $count += 1;
                    $total += $val->harga;
                }
                return view('wisata.rekap', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'total'));
                break;
            case 'download':
                $data = Tiket::get()
                    // ->where('poli_id', auth()->user()->id)
                    ->where('status', 1)
                    ->whereBetween('date', [$startDate, $endDate]);

                return Excel::download(new RekapExport(), 'rekap.xlsx');

                break;
        }
    }
    public function printwisata(Request $request, $date)
    {

        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->where('tempat_id', $tempat->id)
            // ->where('kedatangan', 1)
            // ->where('status', 1)
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        // dd($startDate);
        $total = 0;
        $count = 0;
        foreach ($data as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }

        return view('wisata.printrekap', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
    }

    public function rekappenginapan()
    {
        return view('penginapan.rekap');
    }

    public function sortp(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $default = $request->daterange;
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');

        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        switch ($request->submit) {
            case 'table':
                if ($request->kategori == "villa") {
                    $data = Detail_transaksi::get()
                        ->where('tempat_id', $id_tempat)
                        ->where('kategori', 'villa')
                        ->whereBetween('tanggal_a', [$startDate, $endDate]);
                    $total = 0;
                    $count = 0;
                    foreach ($data->where('status', 3) as $ct => $val) {
                        $count += 1;
                        $total += $val->harga;
                    }
                    foreach (Detail_transaksi::where('kategori', 'villa')->get() as $d)
                        return view('penginapan.rekap_penginapan', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'total', 'd'));
                }
                if ($request->kategori == "penginapan") {
                    $data = Detail_transaksi::get()
                        ->where('tempat_id', $id_tempat)
                        ->where('kategori', 'penginapan')
                        ->where('kedatangan', 1)
                        ->where('status', 1)
                        ->whereBetween('tanggal_a', [$startDate, $endDate]);
                    $total = 0;
                    $count = 0;
                    foreach ($data as $ct => $val) {
                        $count += 1;
                        $total += $val->harga;
                    }
                    foreach (Detail_transaksi::where('kategori', 'penginapan')->get() as $d)
                        return view('penginapan.rekap_penginapan', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'total', 'd'));
                    break;
                }
            case 'download':
                $data = Tiket::get()
                    ->where('status', 1)
                    ->whereBetween('date', [$startDate, $endDate]);
                return Excel::download(new RekapExport(), 'rekap.xlsx');
                break;
        }
    }
    public function printpenginapan(Request $request, $date)
    {
        // dd($request);

        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->where('tempat_id', $tempat->id)
            ->where('kedatangan', 1)
            ->where('status', 1)
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        // dd($startDate);
        $total = 0;
        $count = 0;
        foreach ($data as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }

        return view('penginapan.printrekap', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
    }

    public function rekapkuliner()
    {
        return view('kuliner.rekap');
    }
    public function rekapdesa()
    {
        return view('desa.rekap');
    }
    public function sortd(Request $request)
    {
        // dd($request);
        date_default_timezone_set('Asia/Jakarta');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $id_tempat = $tempat->id;
        // dd($id_tempat);

        $tempat3 = Tempat::where('induk_id', $id_tempat)->get()->pluck('id');
        $flattened = Arr::flatten($tempat3);
        // dd($flattened);
        $default = $request->daterange;
        // dd($default);
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        // $a =    $startDate->date('d-m-Y');

        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        // dd($tgl_a);
        switch ($request->submit) {
            case 'table':

                $data = Detail_transaksi::get()
                    // ->where('desa->induk_id', $id_tempat)
                    ->whereIn('tempat_id', $flattened)
                    ->where('kedatangan', 1)
                    ->where('status', '!=', 0)
                    ->whereBetween('tanggal_a', [$startDate, $endDate]);


                // dd($data);
                $total = 0;

                $count = 0;
                foreach ($data as $ct => $val) {
                    $count += 1;
                    $total += $val->harga;
                }

                // dd($total);

                // dd($startDate);


                return view('desa.rekap', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'total'));
                break;
            case 'download':
                $data = Tiket::get()
                    // ->where('poli_id', auth()->user()->id)
                    ->where('status', 1)
                    ->whereBetween('date', [$startDate, $endDate]);

                return Excel::download(new RekapExport(), 'rekap.xlsx');

                break;
        }
    }
    public function printdesa(Request $request, $date)
    {
        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tempat3 = Tempat::where('induk_id', $tempat->id)->get()->pluck('id');
        $flattened = Arr::flatten($tempat3);
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->whereIn('tempat_id', $flattened)
            ->where('kedatangan', 1)
            ->where('status', '!=', 0)
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        // dd($startDate);
        $total = 0;
        $count = 0;
        foreach ($data as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }

        return view('kuliner.printrekap', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
    }
// rekap
    public function sortk(Request $request)
    {
        // dd($request);
        date_default_timezone_set('Asia/Jakarta');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $id_tempat = $tempat->id;
        // dd($id_tempat);
        $default = $request->daterange;
        // dd($default);
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        // $a =    $startDate->date('d-m-Y');

        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        // dd($tgl_a);
        switch ($request->submit) {
            case 'table':

                $data = Detail_transaksi::get()
                    ->where('tempat_id', $id_tempat)
                    ->where('kedatangan', 1)
                    ->where('status', '!=', 0)
                    ->whereBetween('tanggal_a', [$startDate, $endDate]);
                $total = 0;
                $count = 0;
                foreach ($data as $ct => $val) {
                    $count += 1;
                    $total += $val->harga;
                }
                // dd($total);

                // dd($startDate);


                return view('kuliner.rekap', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'total'));
                break;
            case 'download':
                $data = Tiket::get()
                    // ->where('poli_id', auth()->user()->id)
                    ->where('status', 1)
                    ->whereBetween('date', [$startDate, $endDate]);

                return Excel::download(new RekapExport(), 'rekap.xlsx');

                break;
        }
    }
    public function printkuliner(Request $request, $date)
    {
        // dd($request);

        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->where('tempat_id', $tempat->id)
            ->where('kedatangan', 1)
            ->where('status', '!=', 0)
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        // dd($startDate);
        $total = 0;
        $count = 0;
        foreach ($data as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }

        return view('kuliner.printrekap', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
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

    public function sort_event(Request $request)
    {
        // dd($request->daterange);
        date_default_timezone_set('Asia/Jakarta');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $default = $request->daterange;
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        switch ($request->submit) {
            case 'table':
                if ($request->kategori == "events") {
                    $data = Detail_transaksi::get()
                        ->where('tempat_id', $id_tempat)
                        ->where('kategori', 'events')
                        ->whereBetween('tanggal_a', [$startDate, $endDate]);
                    $total = 0;
                    $count = 0;
                    foreach ($data as $ct => $val) {
                        $count += 1;
                        $total += $val->harga;
                    }
                    foreach (Detail_transaksi::where('kategori', 'events')->get() as $d)
                        return view('admin.booking.rekap', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'total', 'd'));
                }

                if ($request->kategori == "tempat sewa") {
                    $data = Detail_transaksi::get()
                        ->where('tempat_id', $id_tempat)
                        ->where('kategori', 'tempat sewa')
                        ->whereBetween('tanggal_a', [$startDate, $endDate]);
                    $total = 0;
                    $count = 0;
                    foreach ($data as $ct => $val) {
                        $count += 1;
                        $total += $val->harga;
                    }
                    foreach (Detail_transaksi::where('kategori', 'tempat sewa')->get() as $d)
                        return view('admin.booking.rekap', compact('tgl_a', 'tgl_b', 'data', 'count', 'default', 'total', 'd'));
                }
                break;
        }
    }
    public function print_event(Request $request, $date)
    {
        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->where('tempat_id', $tempat->id)
            ->where('kategori', 'events')
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        $total = 0;
        $count = 0;
        foreach ($data as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }
        return view('admin.booking.printrekap_event', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
    }
    public function rekap_villa(Request $request, $date)
    {
        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->where('tempat_id', $tempat->id)
            ->where('kategori', 'villa')
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        $total = 0;
        $count = 0;
        foreach ($data->where('status', 3) as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }
        return view('admin.booking.printrekap_tempat', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
    }
    public function rekap_hotel(Request $request, $date)
    {
        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->where('tempat_id', $tempat->id)
            ->where('kedatangan', 1)
            ->where('status', 1)
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        $total = 0;
        $count = 0;
        foreach ($data as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }
        return view('penginapan.printrekap', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
    }
    public function print_tempatsewa(Request $request, $date)
    {
        $startDate = Str::before($request->date, ' -');
        $endDate = Str::after($request->date, '- ');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tgl_a = date('d F Y',  strtotime($startDate));
        $tgl_b = date('d F Y',  strtotime($endDate));
        $data = Detail_transaksi::get()
            ->where('tempat_id', $tempat->id)
            ->where('kategori', 'tempat sewa')
            ->whereBetween('tanggal_a', [$startDate, $endDate]);
        $total = 0;
        $count = 0;
        foreach ($data as $ct => $val) {
            $count += 1;
            $total += $val->harga;
        }
        return view('admin.booking.printrekap_tempat', compact('tempat', 'tgl_a', 'tgl_b', 'data', 'count', 'total'));
    }
}
