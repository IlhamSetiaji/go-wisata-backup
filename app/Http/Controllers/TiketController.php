<?php

namespace App\Http\Controllers;

// use Carbon;
use App\Models\Pay;
use App\Models\Camp;
use App\Models\User;
use App\Models\Tiket;
use App\Models\Tempat;
use App\Models\Wahana;
use App\Models\Kuliner;
use Illuminate\Support\Arr;
// use App\Models\EventBooking;
use App\Models\EventCamping;
use App\Models\Kamar;
use App\Models\Kegiatan;
use App\Models\Villa;
use App\Models\BookingVilla;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\BookingEvent;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\PesertaEvent;
use Illuminate\Http\Request;
use App\Models\Detail_booking;
use App\Models\Detail_transaksi;
use App\Models\Detail_camp;
use App\Models\tb_paket;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->orderby('id', 'desc')->first('id');

        // $petugas = $
        $tiket  = Tiket::where('tempat_id', $tempat->id)->orderby('id', 'desc')->get();

        return view('wisata.tiket.index', compact('tiket'));
    }
    function order(Request $request)
    {
        //

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $id = $tempat->id;
        $detail2 = Detail_transaksi::where('tempat_id', $id)->orderby('id', 'desc')->get();
        $total = Detail_transaksi::where('tempat_id', $id)->where('status', 1)->sum('harga');
        // return $detail2;
        // return view('wisata.tiket.order', compact('tiket'));
        return view('wisata.tiket.order', compact('detail2'));
    }

    public function sortOrder(Request $request)
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
        switch ($request->submit) {
            case 'table':

                $detail = Detail_transaksi::get()
                    ->where('tempat_id', $id)
                    ->whereBetween('tanggal_a', [$startDate, $endDate]);


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
                $kon = Detail_transaksi::get()
                    ->where('tempat_id', $id)
                    ->where('status', 1)
                    ->where('kedatangan', 1)
                    ->whereBetween('tanggal_a', [$startDate, $endDate]);

                $konfirm = 0;
                foreach ($kon as $ct => $tot) {
                    $konfirm += $tot->harga;
                }


                $total = 0;
                $count = 0;
                foreach ($detail as $ct => $val) {
                    $count += 1;
                    $total += $val->harga;
                }


                return view('wisata.tiket.order', compact('tgl_a', 'tgl_b', 'detail', 'count', 'default', 'total', 'id', 'detail', 'belum_bayar', 'bayar', 'konfirm'));
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

    function orderk(Request $request)
    {
        //

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $id = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id)->orderby('id', 'desc')->get();

        // dd($detail);


        // return view('wisata.tiket.order', compact('tiket'));
        return view('kuliner.tiket.order', compact('detail', 'id'));
    }
    function booking(Request $request)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $id = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id)->orderby('id', 'desc')->get();
        return view('penginapan.tiket.order_penginapan', compact('detail', 'id'));
    }

    function checkw(Request $request)
    {
        //


        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $id_tempat = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id_tempat)->get();
        // return var_dump($detail->jumlah);
        // $wahana = Wahana::where('tempat_id', $id_tempat)->first();
        // // return $wahana;
        // $kode_wahana = $wahana->kode_wahana;

        switch ($request->submit) {
            case 'todo':

                $id = $request->order_id;

                $data = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('id_produk', $id_tempat)->get();
                // $data = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('id_produk', $kode_wahana)->get();
                // return $data;
                $data2 = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', '!=', 'booking')->where('kategori', '!=', 'kuliner')->get();

                if (count($data) == 0) {
                    $kosong = 0;
                    Toastr::error('Kode ID ini Tidak Ditemukan !', 'Gagal !');
                    return redirect()->back();
                }

                if ($data2 == null) {
                    $kosong = 0;
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('kuliner.tiket.check', compact('kosong'));
                }
                $user = Tiket::where('kode', $id)->first();
                if ($user == null) {
                    $kosong = 0;
                    return view('wisata.tiket.check', compact('kosong'));
                }
                $detailcamp = Detail_camp::where('kode_tiket', $id)->first();
                $detailcamp2 = Detail_camp::where('kode_tiket', $id)->get();
                // dd($detailcamp);
                if ($detailcamp != null) {
                    $datacamp = $detailcamp;
                    $pay = Pay::where('kodeku', $id)->first();
                    $datades = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->first();
                    // dd($detailcamp2);

                    return view('wisata.tiket.check', compact('datacamp', 'detailcamp2', 'user', 'datades', 'pay', 'id'));
                }
                $pay = Pay::where('kodeku', $id)->first();
                // dd($pay);
                return view('wisata.tiket.check', compact('data', 'user', 'pay', 'id'));
                break;
        }
        $cek = "yo";

        // return view('wisata.tiket.order', compact('tiket'));
        return view('wisata.tiket.check', compact('detail', 'cek'));
    }

    function checkwahana(Request $request)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        // return $tempat;
        $id_tempat = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id_tempat)->get();

        $wahana = Wahana::where('tempat_id', $id_tempat)->first();
        // return $wahana;
        $kode_wahana = $wahana->kode_wahana;


        switch ($request->submit) {
            case 'todo':

                $id = $request->order_id;

                // $data = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->get();
                $datawahana = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('id_produk', $kode_wahana)->get();
                // return count($datawahana);
                $data2 = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', '!=', 'booking')->where('kategori', '!=', 'kuliner')->get();

                if (count($datawahana) == 0) {
                    $kosong = 0;
                    Toastr::error('Kode ID ini Tidak Ditemukan !', 'Gagal !');
                    return redirect()->back();
                }

                if ($data2 == null) {
                    $kosong = 0;
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('kuliner.tiket.checkwahana', compact('kosong'));
                }
                $user = Tiket::where('kode', $id)->first();
                if ($user == null) {
                    $kosong = 0;
                    return view('wisata.tiket.checkwahana', compact('kosong'));
                }
                $detailcamp = Detail_camp::where('kode_tiket', $id)->first();
                $detailcamp2 = Detail_camp::where('kode_tiket', $id)->get();
                // dd($detailcamp);
                if ($detailcamp != null) {
                    $datacamp = $detailcamp;
                    $pay = Pay::where('kodeku', $id)->first();
                    $datades = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->first();
                    // dd($detailcamp2);

                    return view('wisata.tiket.checkwahana', compact('datacamp', 'detailcamp2', 'user', 'datades', 'pay', 'id'));
                }
                $pay = Pay::where('kodeku', $id)->first();
                // dd($pay);
                return view('wisata.tiket.checkwahana', compact('datawahana', 'user', 'pay', 'id'));
                break;
        }
        $cek = "yo";

        // return view('wisata.tiket.order', compact('tiket'));
        return view('wisata.tiket.checkwahana', compact('detail', 'cek', 'wahana'));
    }

    function checkk(Request $request)
    {
        //

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $id_tempat = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id_tempat)->get();


        // dd($detail);

        switch ($request->submit) {
            case 'todo':

                $id = $request->order_id;

                $data = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', 'kuliner')->get();
                $data2 = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', 'kuliner')->first();

                $user = Tiket::where('kode', $id)->first();
                if ($user == null) {
                    $kosong = 0;
                    return view('kuliner.tiket.check', compact('kosong'));
                }
                if ($data2 == null) {
                    $kosong = 0;
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('kuliner.tiket.check', compact('kosong'));
                }


                $pay = Pay::where('kodeku', $id)->first();
                // dd($pay);
                return view('kuliner.tiket.check', compact('data', 'user', 'pay', 'id'));
                break;
        }

        $cek = "yo";
        // return view('wisata.tiket.order', compact('tiket'));
        return view('kuliner.tiket.check', compact('detail', 'cek'));
    }
    function checkp(Request $request)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id_tempat)->get();

        switch ($request->submit) {
            case 'todo':

                $id = $request->order_id;
                $user = Tiket::where('kode', $id)->first();
                if ($user == null) {
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('penginapan.tiket.check', compact('kosong'));
                }
                $data = Tiket::where('kode', $id)->first();
                $data2 = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', 'penginapan')->first();
                if ($data2 == null) {
                    $kosong = 0;
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('penginapan.tiket.check', compact('kosong'));
                }

                $pay = Pay::where('kodeku', $id)->first();
                $db = Detail_booking::where('kode_tiket', $id)->first();
                $db2 = Detail_booking::where('kode_tiket', $id)->get();
                $cek = Detail_booking::where('kode_tiket', $id)->first();
                $ck = (int)$cek->status;
                return view('penginapan.tiket.check', compact('db', 'db2', 'data', 'data2', 'user', 'pay', 'id', 'ck'));
                break;
        }
        $cek = "yo";
        return view('penginapan.tiket.check', compact('detail', 'cek'));
    }


    public function updatekedatangan(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');


        if (
            Detail_transaksi::orderby('id', 'desc')
            ->where('kode_tiket', $id)
            ->where('kedatangan', '1')
            ->where('count', 0)
            ->exists()
        ) {
            Toastr::warning('Kode ID ini sudah terpakai :)', 'Gagal !');
            return redirect()->back();
        }

        $detail2 = Detail_transaksi::where('kode_tiket', $id)->first();
        // return $detail;
        $jumlah_count = $detail2->count;
        $counting = $request->count;
        // return $counting;

        if ($jumlah_count > 0) {
            $finalCount = $jumlah_count - $counting;
            // return $finalCount;
            $detail2->update([
                'count' => $finalCount,
            ]);
        }

        // return $counting;
        $granddana = 0;
        $tanggal_b = Carbon::now()->format('Y-m-d H:i:s');
        $detail = Detail_transaksi::where('kode_tiket', $id)->get();
        // return $detail;

        foreach ($detail as $dt => $detail) {
            $uang = $detail->harga;
            $detail->kedatangan = 1;
            $detail->tanggal_b = $tanggal_b;
            $detail->save();
            $granddana += $uang;
            $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->where('id', $detail->tempat_id)->first();
            $tempat->update([
                'dana' => $tempat->dana += $granddana,
            ]);
        }


        Toastr::info('Thanks :)', 'Success');
        return redirect()->back();
    }
    public function updatekedatangank($id)
    {
        date_default_timezone_set('Asia/Jakarta');


        if (
            Detail_transaksi::orderby('id', 'desc')
            ->where('kode_tiket', $id)
            ->where('kedatangan', '1')
            ->exists()
        ) {
            Toastr::warning('Kode ID ini sudah terpakai :)', 'Gagal !');
            return redirect()->back();
        }
        $granddana = 0;
        $tanggal_b = Carbon::now()->format('Y-m-d');
        $detail = Detail_transaksi::where('kode_tiket', $id)->get();
        foreach ($detail as $dt => $detail) {
            $uang = $detail->harga;
            $detail->kedatangan = 1;
            $detail->tanggal_b = $tanggal_b;
            $detail->save();
            $granddana += $uang;
            $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->where('id', $detail->tempat_id)->first();
            $tempat->update([
                'dana' => $tempat->dana += $granddana,
            ]);
        }




        Toastr::info('Thanks :)', 'Success');
        return redirect()->back();
    }
    public function updatekedatanganp($id)
    {
        date_default_timezone_set('Asia/Jakarta');


        if (
            Detail_transaksi::orderby('id', 'desc')
            ->where('kode_tiket', $id)
            ->where('kedatangan', '1')
            ->exists()
        ) {
            Toastr::warning('Kode ID ini sudah terpakai :)', 'Gagal !');
            return redirect()->back();
        }
        $granddana = 0;

        $tanggal_b = Carbon::now()->format('Y-m-d H:i:s');
        $detail = Detail_transaksi::where('kode_tiket', $id)->get();

        foreach ($detail as $dt => $detail) {
            $uang = $detail->harga;
            $detail->kedatangan = 1;
            $detail->tanggal_b = $tanggal_b;
            $detail->save();
            $granddana += $uang;
            $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->where('id', $detail->tempat_id)->first();
            $tempat->update([
                'dana' => $tempat->dana += $granddana,
            ]);
        }
        $book = Detail_booking::where('kode_tiket', $id)->get();
        foreach ($book as $bk => $book) {

            $book->status = 1;
            $book->checkinn = $tanggal_b;
            $book->save();
            $granddana += $uang;
            $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->where('id', $detail->tempat_id)->first();
            $tempat->update([
                'dana' => $tempat->dana += $granddana,
            ]);
        }
        Toastr::info('Thanks :)', 'Success');
        return redirect()->back();
    }
    public function updatekedatanganp2($id)
    {
        date_default_timezone_set('Asia/Jakarta');


        if (
            Detail_transaksi::orderby('id', 'desc')
            ->where('kode_tiket', $id)
            ->where('kedatangan', '2')
            ->exists()
        ) {
            Toastr::warning('Kode ID ini sudah terpakai :)', 'Gagal !');
            return redirect()->back();
        }
        $granddana = 0;

        $tanggal_b = Carbon::now()->format('Y-m-d H:i:s');

        $book = Detail_booking::where('kode_tiket', $id)->get();
        foreach ($book as $bk => $book) {

            $book->status = 2;
            $book->checkoutt = $tanggal_b;
            $book->save();
        }
        if ($book->save()) {
            Toastr::info('Thanks :)', 'Success');
        }
        return redirect()->back();
    }

    function cart()
    {
        //

        $cart = session("cart");

        // $tikets = Tiket::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
        // return $tiket;
        // dd($cart);
        // session()->forget("cart");


        return view("cart")->with("cart", $cart);
    }


    function do_tambah_cart(Request $request, $kode)
    {
        //
        $cart = session("cart");
        // dd($request);
        $produk = Wahana::where('kode_wahana', $kode)->first();
        $cart[$kode] = [
            "kode_produk" => $produk->kode,
            "kategori" => $request->kategori,
            "durasi" => "1",
            "user_id" => $request->user_id,
            "nama_produk" =>  "Tiket Wahana " . $produk->name,
            "harga_produk" => $produk->harga,
            "jumlah" => $request->jumlah,
            "tanggal_a" => "0",
            "tanggal_b" => "0",
            "tempat_id" => $request->tempat_id,

        ];
        // dd($cart);
        session(["cart" => $cart]);
        Toastr::success(' Berhasil menambahkan ke cart :)', 'Success');
        // return redirect()->back();
        return redirect("/cart");
    }
    function cart_kuliner()
    {
        //
        $kuliner = session("kuliner");
        // dd($kuliner);
        // session()->forget("kuliner");
        return view("cart.kuliner", compact('kuliner'))->with("kuliner", $kuliner);
    }
    function cart_camping(Request $request)
    {
        // return redirect()->back();
        $cartc = session("cartc");
        $camping = session("camping");
        if ($cartc == null) {
            $i = 0;
            $kosong = 1;
        } else {
            $i = 1;
            $kosong = 0;
        }
        // dd($request);
        // session()->forget("cart");
        // session()->forget("camping");
        // session()->forget("cartcamping");
        // dd($request);
        // session()->forget("cart");
        return view("cart.camping", compact('camping', 'i', 'kosong'))->with("cartc", $cartc);
    }

    //CART BUDGETING
    function cart_budgeting() {
        $budgeting = session("budgeting");
        
        return view("cart.budgeting", compact('budgeting'))->with("budgeting", $budgeting);
        
    }

    //ADD BUDGETING
    function do_tambah_cart_budgeting($id)
    {
        $budgeting = session("budgeting");

        $paket = tb_paket::where('id', $id)->first();

        $budgeting[$id] = [
            "user_id" => Auth::user()->id,
            "durasi" => "1",
            "harga" => $paket->harga,
            "nama_paket" => $paket->nama_paket,
            "kategori" => $paket->id_kategori

        ];


        session(["budgeting" => $budgeting]);
        return redirect("/cart/budgeting");
    }


    function do_tambah_kuliner(Request $request, $kode)
    {
        //
        $kuliner = session("kuliner");
        // dd($request);
        $produk = Kuliner::where('kode_kuliner', $kode)->first();
        $kuliner[$kode] = [
            "kode_produk" => $produk->kode_kuliner,
            "user_id" => Auth::user()->id,
            "durasi" => "1",
            "kategori" => $request->kategori,
            "nama_produk" =>   $produk->name,
            "harga_produk" => $produk->harga,
            "jumlah" => $request->jumlah,
            "tanggal_a" => $request->tanggal_a,
            "tanggal_b" => "0",
            "tempat_id" => $request->tempat_id,
            "catatan" => $request->catatan,


        ];
        // dd($kuliner);
        session(["kuliner" => $kuliner]);
        return redirect("/cart/kuliner");
    }
    function do_tambah_cart_tiket(Request $request, $id)
    {
        $tanggal_a = Carbon::now();
        // dd($tanggal_a);
        //
        $cart = session("cart");
        // dd($request->jml_orang);
        $tiket = Tempat::where('id', $id)->first();

        $cart[$id] = [
            "kode_produk" => $tiket->id,
            "kategori" => $request->kategori,
            "user_id" => $request->user_id,
            "durasi" => "1",
            "tanggal_a" => "0",
            "tanggal_b" => "0",
            "nama_produk" => "Tiket " . $tiket->name,
            "harga_produk" => $tiket->htm,
            "tempat_id" => $request->tempat_id,
            "jumlah" => $request->jml_orang,
            "count" => $request->jml_orang,

        ];
        // dd($cart);
        session(["cart" => $cart]);
        return redirect("/cart");
    }
    function do_tambah_cart_camp(Request $request, $kode)
    {
        date_default_timezone_set('Asia/Jakarta');
        //
        $cartc = session("cartc");
        // dd($request->jml_orang);
        $camp = Camp::where('kode_camp', $kode)->first();
        // dd($request);
        $cartc[$kode] = [
            "kode_produk" => $camp->kode_camp,
            "kategori" => "camping",
            "user_id" => Auth::user()->id,
            "nama_produk" => $camp->name,
            "harga_produk" => $camp->harga,
            "jumlah" => 1,
            "durasi" => $request->durasi,
            "tanggal_a" => $request->tanggal_a,
            "tanggal_b" => $request->tanggal_b,
            "tempat_id" => $request->tempat_id,
        ];
        // dd($cart);
        session(["cartc" => $cartc]);
        // return redirect()->back()
        return redirect("/cart/camping");
    }
    function do_hapus_cart($kode)
    {
        $cart = session("cart");
        unset($cart[$kode]);
        session(["cart" => $cart]);
        return redirect("/cart");
    }
    function do_hapus_cart_camping($kode)
    {
        //
        $cartc = session("cartc");
        unset($cartc[$kode]);
        session(["cartc" => $cartc]);
        return redirect("/cart/camping");
    }
    function do_hapus_cart_kuliner($kode)
    {
        //
        $kuliner = session("kuliner");
        unset($kuliner[$kode]);
        session(["kuliner" => $kuliner]);
        return redirect("/cart/kuliner");
    }



    function do_hapus_cart_penginapan($kode)
    {
        //
        $penginapan = session("penginapan");
        unset($penginapan[$kode]);
        session(["penginapan" => $penginapan]);
        return redirect("/cart/booking");
    }


    /*function do_tambah_transaksi(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $cart = session("cart");
        // $kuliner = session("kuliner");
        // dd($cart);
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();
        // dd($request->date);

        // dd($cart);
        $tiket = Tiket::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
        $grandtotal = 0;
        // $tempatsesi = session("tempatsesi");

        foreach ($cart as $ct => $val) {

            $kode_tiket = $checkout_kode;
            $id_produk = $ct;
            $kategori = $val["kategori"];
            $name = $val["nama_produk"];
            $durasi = $val["durasi"];
            $user_id = Auth::user()->id;
            $tanggal_a = $request->date;
            $tanggal_b = $val["tanggal_b"];
            $jumlah = $val["jumlah"];
            $tempat_id = $val["tempat_id"];
            // $status;

            $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
            $grandtotal += $subtotal;
        }
        // dd($tempat);


        Tiket::create([
            // 'token' => $token,
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $grandtotal,

        ]);

        Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $subtotal, $tempat_id, $kategori);


        session()->forget("cart");
        return redirect("pesananku");
    }*/


    function do_tambah_transaksi(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');
        $cart = session("cart");
        // return ($cart);

        $all_produk = implode(',', array_column($cart, 'nama_produk'));
        $all_kategori = implode(',', array_column($cart, 'kategori'));
        $all_jumlah = array_sum(array_column($cart, 'jumlah'));
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();
        $tiket = Tiket::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
        $grandtotal = 0;

        switch ($request->input('action')) {
            case 'transfer':
                if (count($cart) > 1) {
                    foreach ($cart as $ct => $val) {
                        // return $new_arr;
                        $kode_tiket = $checkout_kode;
                        $id_produk = "Paket";
                        $kategori = $all_kategori;
                        $name = $all_produk;
                        $durasi = $val["durasi"];
                        $user_id = Auth::user()->id;
                        $tanggal_a = $request->date;
                        $tanggal_b = $val["tanggal_b"];
                        $jumlah = $all_jumlah;
                        $count = $all_jumlah;
                        $tempat_id = $val["tempat_id"];
                        $type_bayar = "Transfer";
                        $status = null;
                        // $status;

                        $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                        $grandtotal += $subtotal;
                    }
                } else {
                    foreach ($cart as $ct => $val) {
                        $kode_tiket = $checkout_kode;
                        $id_produk = $ct;
                        $kategori = $val["kategori"];
                        $name = $val["nama_produk"];
                        $durasi = $val["durasi"];
                        $user_id = Auth::user()->id;
                        $tanggal_a = $request->date;
                        $tanggal_b = $val["tanggal_b"];
                        $jumlah = $val["jumlah"];
                        $count = $val["jumlah"];
                        $tempat_id = $val["tempat_id"];
                        $type_bayar = "Transfer";
                        $status = null;
                        // $status;

                        $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                        $grandtotal += $subtotal;
                    }
                }



                Tiket::create([
                    // 'token' => $token,
                    'kode' => $checkout_kode,
                    'user_id' => Auth::user()->id,
                    // 'tempat_id' => Auth::user()->tempat_id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'telp' => Auth::user()->telp,
                    'harga' => $grandtotal,

                ]);



                Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $grandtotal, $tempat_id, $kategori, $type_bayar, $status, $count);


                session()->forget("cart");
                // return redirect("pesananku");
                $tiket_id = Tiket::latest()->first('id');
                return redirect('bayar/' . $tiket_id->id);
                break;


            case 'langsung':
                if (count($cart) > 1) {
                    foreach ($cart as $ct => $val) {
                        // return $p;
                        $kode_tiket = $checkout_kode;
                        $id_produk = "Paket";
                        $kategori = $all_kategori;
                        $name = $all_produk;
                        $durasi = $val["durasi"];
                        $user_id = Auth::user()->id;
                        $tanggal_a = $request->date;
                        $tanggal_b = $val["tanggal_b"];
                        $jumlah = $all_jumlah;
                        $count = $all_jumlah;
                        $tempat_id = $val["tempat_id"];
                        $type_bayar = "Bayar Langsung";
                        $status = 1;

                        $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                        $grandtotal += $subtotal;
                    }
                } else {
                    foreach ($cart as $ct => $val) {

                        $kode_tiket = $checkout_kode;
                        $id_produk = $ct;
                        $kategori = $val["kategori"];
                        $name = $val["nama_produk"];
                        $durasi = $val["durasi"];
                        $user_id = Auth::user()->id;
                        $tanggal_a = $request->date;
                        $tanggal_b = $val["tanggal_b"];
                        $jumlah = $val["jumlah"];
                        $count = $val["jumlah"];
                        $tempat_id = $val["tempat_id"];
                        $type_bayar = "Bayar Langsung";
                        $status = 1;


                        $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                        $grandtotal += $subtotal;
                    }
                }



                Tiket::create([
                    // 'token' => $token,
                    'kode' => $checkout_kode,
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'telp' => Auth::user()->telp,
                    'harga' => $grandtotal,
                    'type_bayar' => $type_bayar,

                ]);


                Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $grandtotal, $tempat_id, $kategori, $type_bayar, $status, $count);


                session()->forget("cart");
                return redirect("pesananku");
                break;

            case 'epay':
                $auth = Auth::user()->id;
                $balance = User::where('id', $auth)->pluck('balance')->sum();
                if (count($cart) > 1) {
                    foreach ($cart as $ct => $val) {
                        $kode_tiket = $checkout_kode;
                        $id_produk = $ct;
                        $kategori = $all_kategori;
                        $name = $all_produk;
                        $durasi = $val["durasi"];
                        $user_id = Auth::user()->id;
                        $tanggal_a = $request->date;
                        $tanggal_b = $val["tanggal_b"];
                        $jumlah = $all_jumlah;
                        $count = $all_jumlah;
                        $tempat_id = $val["tempat_id"];
                        $type_bayar = "Epay";
                        $status = 1;
                        // $status;

                        $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                        $grandtotal += $subtotal;
                    }
                } else {
                    foreach ($cart as $ct => $val) {

                        $kode_tiket = $checkout_kode;
                        $id_produk = $ct;
                        $kategori = $val["kategori"];
                        $name = $val["nama_produk"];
                        $durasi = $val["durasi"];
                        $user_id = Auth::user()->id;
                        $tanggal_a = $request->date;
                        $tanggal_b = $val["tanggal_b"];
                        $jumlah = $val["jumlah"];
                        $count = $val["jumlah"];
                        $tempat_id = $val["tempat_id"];
                        $type_bayar = "Epay";
                        $status = 1;

                        $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                        $grandtotal += $subtotal;
                    }
                }

                $current_balance = $balance - $grandtotal;

                if ($current_balance <= $grandtotal) {
                    return redirect()->route('top.up');
                    Toastr::Error('Saldo Anda Kurang, Silahkan Isi Saldo Anda', 'Danger');
                } else {
                    Tiket::create([
                        // 'token' => $token,
                        'kode' => $checkout_kode,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'telp' => Auth::user()->telp,
                        'harga' => $grandtotal,
                        'type_bayar' => $type_bayar,

                    ]);

                    $bal = User::find($auth);
                    $bal->update([
                        'balance' => $current_balance,
                    ]);
                    Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $subtotal, $tempat_id, $kategori, $type_bayar, $status, $count);

                    session()->forget("cart");

                    return redirect("pesananku");
                }
                break;
        }
    }
    function do_batal_transaksi(Request $request, $kode)
    {

        $tiket = Tiket::where('id', $kode)->first();
        $id = $tiket->kode;
        $tiketDelete = $tiket->delete();
        $dt = Detail_transaksi::where('kode_tiket', $id)->get();
        // dd($dt);
        if (!$dt == null) {
            foreach ($dt as $key => $dt) {
                // dd($dt);
                $dtdelete = $dt->delete();
            }
        }

        $db = Detail_booking::where('kode_tiket', $id)->get();
        // dd($db);
        if (!$db == null) {
            foreach ($db as $key => $db) {
                $dtdelete = $db->delete();
            }
        }
        // $dbdelete = $db->delete();

        $dc = Detail_camp::where('kode_tiket', $id)->get();
        if (!$dc == null) {
            foreach ($dc as $key => $dc) {
                $dcdelete = $dc->delete();
            }
        }
        $eb = EventBooking::where('kode_tiket', $id)->get();
        if (!$eb == null) {
            foreach ($eb as $key => $eb) {
                $ebdelete = $eb->delete();
            }
        }
        $be = BookingEvent::where('kode_tiket', $id)->get();
        if (!$be == null) {
            foreach ($be as $key => $be) {
                $bedelete = $be->delete();
            }
        }

        Toastr::success(' Berhasil menmbatalkan pesanan :)', 'Success');
        return redirect("pesananku");
    }
    function do_tambah_transaksi_kuliner(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $kuliner = session("kuliner");

        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();
        // dd($request->date);


        $tiket = Tiket::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
        $grandtotal = 0;
        // $tempatsesi = session("tempatsesi");
        switch ($request->input('action')) {
            case 'transfer':
                foreach ($kuliner as $ct => $val) {

                    $kode_tiket = $checkout_kode;
                    $id_produk = $ct;
                    $kategori = "kuliner";
                    $name = $val["nama_produk"];
                    $durasi = $val["durasi"];
                    $user_id = Auth::user()->id;
                    $tanggal_a = $request->date;
                    // dd($tanggal_a);
                    $tanggal_b = $val["tanggal_b"];
                    $jumlah = $val["jumlah"];
                    $tempat_id = $val["tempat_id"];
                    $catatan = $request->catatan;
                    $type_bayar = "Transfer";
                    $status = null;
                    // dd($tempa_id);
                    $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                    $grandtotal += $subtotal;
                }
                // dd($tempat);


                Tiket::create([
                    // 'token' => $token,
                    'kode' => $checkout_kode,
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'telp' => Auth::user()->telp,
                    'harga' => $grandtotal,
                    'catatan' => $catatan,
                    'type_bayar' => $type_bayar,
                ]);

                Detail_transaksi::tambah_detail_transaksi_kuliner($catatan, $name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $grandtotal, $tempat_id, $kategori, $type_bayar);


                session()->forget("kuliner");
                // return redirect("pesananku");
                $tiket_id = Tiket::latest()->first('id');
                return redirect('bayar/' . $tiket_id->id);
                break;


            case 'langsung':
                foreach ($kuliner as $ct => $val) {

                    $kode_tiket = $checkout_kode;
                    $id_produk = $ct;
                    $kategori = "kuliner";
                    $name = $val["nama_produk"];
                    $durasi = $val["durasi"];
                    $user_id = Auth::user()->id;
                    $tanggal_a = $request->date;
                    // dd($tanggal_a);
                    $tanggal_b = $val["tanggal_b"];
                    $jumlah = $val["jumlah"];
                    $tempat_id = $val["tempat_id"];
                    $type_bayar = "Bayar Langsung";
                    $status = 1;
                    // dd($tempa_id);
                    $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
                    $grandtotal += $subtotal;
                    $catatan = $request->catatan;
                }

                Tiket::create([
                    // 'token' => $token,
                    'kode' => $checkout_kode,
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'telp' => Auth::user()->telp,
                    'harga' => $grandtotal,
                    'catatan' => $catatan,
                    'type_bayar' => $type_bayar,

                ]);
                Detail_transaksi::tambah_detail_transaksi_kuliner($catatan, $name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $grandtotal, $tempat_id, $kategori, $type_bayar);
                session()->forget("kuliner");
                return redirect("pesananku");
        }


        foreach ($kuliner as $ct => $val) {

            $kode_tiket = $checkout_kode;
            $id_produk = $ct;
            $kategori = "kuliner";
            $name = $val["nama_produk"];
            $durasi = $val["durasi"];
            $user_id = Auth::user()->id;
            $tanggal_a = $request->date;
            // dd($tanggal_a);
            $tanggal_b = $val["tanggal_b"];
            $jumlah = $val["jumlah"];
            $tempat_id = $val["tempat_id"];
            // dd($tempa_id);
            $subtotal = $val["harga_produk"] * $val["jumlah"] * $val["durasi"];
            $grandtotal += $subtotal;
            $catatan = $request->catatan;
            // dd($catatan);
        }
        // dd($tempat);


        Tiket::create([
            // 'token' => $token,
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $grandtotal,
            'catatan' => $catatan,

        ]);

        Detail_transaksi::tambah_detail_transaksi_kuliner($catatan, $name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $grandtotal, $tempat_id, $kategori, $type_bayar, $count);
        session()->forget("kuliner");
        return redirect("pesananku");
    }


    function do_tambah_transaksi_camping(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $cartc = session("cartc");
        $camping = session("camping");
        // dd($request);

        $totalbayar = $request->total;
        foreach ($cartc as $ct => $val) {
            $durasii = (int)$val["durasi"];
            $coba = Camp::where('kode_camp', $ct)->where('kategori', 'makan')->exists();
        }



        foreach ($camping as $ct => $val) {
            // $durasii = (int)$val["durasi"];

            $tanggal_a = $val["date"];
            $tanggal_b = $val["date2"];
            $tempat_id = $val["tempat_id"];
            $tempat_name = $val["tempat_name"];
            $jumlah_orang = (int)$val["jumlah_orang"];
            $makan = $val["makan"];
            if ($makan == "include") {
                $inc = 1;
            } else {
                $inc = 0;
            }
        }

        if ($makan == "include" && $coba == false) {
            Toastr::error(' Belum memilih paket makanan', 'Danger');
            return redirect()->back();
        }



        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();
        // dd($request->date);

        if ($durasii >= 1) {
            for ($i = 0; $i <= $durasii; $i++) {
                $eventtgl = date('Y-m-d ', strtotime('+' . $i . 'day', strtotime($tanggal_a)));
                // dd($eventtgl);
                foreach ($cartc as $ct => $val) {
                    // dd($ct);
                    $kate = Camp::where('kode_camp', $ct)->first();
                    if ($kate->kategori == "alat") {
                        EventCamping::create([

                            'camp_id' => $val["kode_produk"],
                            'title' => "pending",
                            'tempat_id' => $tempat_id,
                            'date' => $eventtgl,
                            'kode' => $checkout_kode,
                        ]);
                    }
                }
            }
        }



        $grandtotal = 0;
        switch ($request->input('action')) {
            case 'transfer':
                foreach ($cartc as $ct => $val) {

                    $kode_tiket = $checkout_kode;
                    $id_produk = $ct;
                    $kategori = "camping";
                    $name = "Paket Camping";
                    $durasi = $val["durasi"];
                    $user_id = Auth::user()->id;
                    $tanggal_a = $val["tanggal_a"];
                    $type_bayar = null;
                    // dd($tanggal_a);
                    $tanggal_b = $val["tanggal_b"];
                    $jumlah = $val["jumlah"];
                    $count = $val["jumlah"];
                    $tempat_id = $val["tempat_id"];
                    $subtotal = (int)$val["harga_produk"] * $val["jumlah"] * (int)$val["durasi"];
                    // $subtotal = $totalbayar;
                    $status = null;

                    Tiket::create([
                        // 'token' => $token,
                        'kode' => $checkout_kode,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'telp' => Auth::user()->telp,
                        'harga' => $totalbayar,

                    ]);

                    Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $subtotal, $tempat_id, $kategori, $type_bayar, $status, $count);


                    $data = Detail_camp::max('kode_camping');
                    $huruf = "DC";
                    $urutan = (int)substr($data, 3, 3);
                    $urutan++;
                    $camp_id = $huruf . sprintf("%04s", $urutan);
                    Detail_camp::create([
                        // 'token' => $token,
                        'kode_tiket' => $checkout_kode,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'tempat_id' => $val["tempat_id"],
                        'tempat_name' => $tempat_name,
                        'date' => $tanggal_a,
                        'date2' => $tanggal_b,
                        'jumlah_orang' => $jumlah_orang,
                        'makan' => $makan,
                        'durasi' => $durasii,
                        'alat_id' => $id_produk,
                        'jumlah_tenda' => 1,
                        'makan_durasi' => $durasii,
                        'harga' => $subtotal,
                        'kode_camping' => $camp_id,

                    ]);
                }

                session()->forget("cartc");
                session()->forget("camping");
                // return redirect("pesananku");
                $tiket_id = Tiket::latest()->first('id');
                return redirect('bayar/' . $tiket_id->id);
                break;


            case 'langsung':

                foreach ($cartc as $ct => $val) {

                    $kode_tiket = $checkout_kode;
                    $id_produk = $ct;
                    $kategori = "camping";
                    $name = "Paket Camping";
                    $durasi = $val["durasi"];
                    $user_id = Auth::user()->id;
                    $tanggal_a = $val["tanggal_a"];
                    // dd($tanggal_a);
                    $tanggal_b = $val["tanggal_b"];
                    $jumlah = $val["jumlah"];
                    $count = $val["jumlah"];
                    $tempat_id = $val["tempat_id"];
                    $subtotal = (int)$val["harga_produk"] * $val["jumlah"] * (int)$val["durasi"];
                    $type_bayar = "Bayar Langsung";
                    $status = null;

                    Tiket::create([
                        // 'token' => $token,
                        'kode' => $checkout_kode,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'telp' => Auth::user()->telp,
                        'harga' => $totalbayar,
                        'type_bayar' => $type_bayar,

                    ]);

                    Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $subtotal, $tempat_id, $kategori, $type_bayar, $status, $count);


                    $data = Detail_camp::max('kode_camping');
                    $huruf = "DC";
                    $urutan = (int)substr($data, 3, 3);
                    $urutan++;
                    $camp_id = $huruf . sprintf("%04s", $urutan);
                    Detail_camp::create([
                        // 'token' => $token,
                        'kode_tiket' => $checkout_kode,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'tempat_id' => $val["tempat_id"],
                        'tempat_name' => $tempat_name,
                        'date' => $tanggal_a,
                        'date2' => $tanggal_b,
                        'jumlah_orang' => $jumlah_orang,
                        'makan' => $makan,
                        'durasi' => $durasii,
                        'alat_id' => $id_produk,
                        'jumlah_tenda' => 1,
                        'makan_durasi' => $durasii,
                        'harga' => $subtotal,
                        'kode_camping' => $camp_id,

                    ]);
                }

                session()->forget("cartc");
                session()->forget("camping");
                return redirect("pesananku");
                break;

            case 'epay':
                // $balance = array();
                // $balance = User::select('balance')->where('id', $auth)->get();
                // $balances = $balance->sum();
                // $saldo = TopUp::where('user_id', Auth::user()->id)->where('status', 'Terbayar')->sum('nominal');

                $auth = Auth::user()->id;
                $balance = User::where('id', $auth)->pluck('balance')->sum();
                foreach ($cartc as $ct => $val) {

                    $kode_tiket = $checkout_kode;
                    $id_produk = $ct;
                    $kategori = "camping";
                    $name = "Paket Camping";
                    $durasi = $val["durasi"];
                    $user_id = Auth::user()->id;
                    $tanggal_a = $val["tanggal_a"];
                    // dd($tanggal_a);
                    $tanggal_b = $val["tanggal_b"];
                    $jumlah = $val["jumlah"];
                    $count = $val["jumlah"];
                    $tempat_id = $val["tempat_id"];
                    $subtotal = (int)$val["harga_produk"] * $val["jumlah"] * (int)$val["durasi"];
                    $grandtotal += $subtotal;
                    $type_bayar = "Epay";
                    $status = null;

                    $data = Detail_camp::max('kode_camping');
                    $huruf = "DC";
                    $urutan = (int)substr($data, 3, 3);
                    $urutan++;
                    $camp_id = $huruf . sprintf("%04s", $urutan);
                }

                $current_balance = $balance - $grandtotal;

                if ($current_balance <= $grandtotal) {
                    return redirect()->route('top.up');
                    Toastr::Error('Saldo Anda Kurang, Silahkan Isi Saldo Anda', 'Danger');
                } else {
                    Tiket::create([
                        // 'token' => $token,
                        'kode' => $checkout_kode,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'telp' => Auth::user()->telp,
                        'harga' => $grandtotal,
                        'type_bayar' => $type_bayar,

                    ]);

                    $bal = User::find($auth);
                    $bal->update([
                        'balance' => $current_balance,
                    ]);
                    Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $subtotal, $tempat_id, $kategori, $type_bayar, $status, $count);

                    Detail_camp::create([
                        // 'token' => $token,
                        'kode_tiket' => $checkout_kode,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'tempat_id' => $val["tempat_id"],
                        'tempat_name' => $tempat_name,
                        'date' => $tanggal_a,
                        'date2' => $tanggal_b,
                        'jumlah_orang' => $jumlah_orang,
                        'makan' => $makan,
                        'durasi' => $durasii,
                        'alat_id' => $id_produk,
                        'jumlah_tenda' => 1,
                        'makan_durasi' => $durasii,
                        'harga' => $subtotal,
                        'kode_camping' => $camp_id,

                    ]);

                    session()->forget("cartc");
                    session()->forget("camping");
                    return redirect("pesananku");
                }
                break;
        }

        // dd($tempat);

    }

    function do_tambah_transaksi_booking(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $penginapan = session("penginapan");
        $penginapan2 = session("penginapan");
        // dd($request);
        $totalbayar = $request->total;
        $durasii = $request->durasi;
        $tempat_id = $request->tempat_id;
        $tanggal_a = $request->checkin;

        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();

        if ($durasii >= 1) {
            for ($i = 0; $i <= $durasii; $i++) {
                // dd($i);
                $eventtgl = date('Y-m-d ', strtotime('+' . $i . 'day', strtotime($tanggal_a)));
                // dd($eventtgl);
                foreach ($penginapan as $ct => $val) {
                    EventBooking::create([

                        'kamar_id' => $val["kode_kamar"],
                        'title' => "pending",
                        'tempat_id' => $tempat_id,
                        'date' => $eventtgl,
                        'kode_tiket' => $checkout_kode,
                    ]);
                }
            }
        }



        foreach ($penginapan2 as $ct => $val) {

            $kode_tiket = $checkout_kode;
            $id_produk = $ct;
            $kategori = "penginapan";
            $name = "Reservasi Penginapan";
            $durasi = $val["durasi"];
            $user_id = Auth::user()->id;
            $tanggal_a = $val["checkin"];
            // dd($tanggal_a);
            $tanggal_b = $val["checkout"];
            $jumlah = $val["jumlah_kamar"];
            $tempat_id = $val["tempat_id"];
            $tempat_name = $val["tempat_name"];
            $kamarr = Kamar::where('kode_kamar', $ct)->first();
            $hargakamar = $kamarr->harga;
            // dd($hargakamar);
            $subtotal = (int)$hargakamar * (int)$val["durasi"];
            // $subtotal = $totalbayar;


            $data = Detail_booking::max('kode_booking');
            $huruf = "DB";
            $urutan = (int)substr($data, 3, 3);
            $urutan++;
            $book_id = $huruf . sprintf("%04s", $urutan);
            Detail_booking::create([
                // 'token' => $token,
                'kode_tiket' => $checkout_kode,
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'nik' => $request->nik,
                'tempat_id' => $val["tempat_id"],
                'tempat_name' => $tempat_name,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
                'jumlah_orang' => $request->jumlah_orang,
                'kamar_id' => $ct,
                'jumlah_kamar' => 1,
                'durasi' => $request->durasi,
                'subtotal' =>  $subtotal,
                'kode_booking' => $book_id,
                'status' => 0,

            ]);
        }
        // dd($tempat);


        Tiket::create([
            // 'token' => $token,
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $totalbayar,

        ]);
        Detail_transaksi::create([
            "name" => "Penginapan",
            "user_id" => Auth::user()->id,
            'durasi' => $request->durasi,
            "tanggal_a" => $request->checkin,
            "tanggal_b" => $request->checkout,
            "kode_tiket" => $checkout_kode,
            "jumlah" => $request->jumlah_orang,
            "harga" => $totalbayar,
            "kategori" => "penginapan",
            "tempat_id" => $val["tempat_id"],

        ]);
        session()->forget("penginapan");
        Toastr::success('Berhasil menambahkan pesanan :)', 'Success');
        return redirect("pesananku");
    }

    public function beli(Request $request, $name)
    {

        $harga = ($request->htm) * ($request->jml_orang);
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        if (
            Tiket::where('token', $request->_token)

            ->exists()
        ) {
            $tiket = Tiket::where('user_id', Auth::user()->id)->get();
            return view('pesananku', compact('tiket'));
        } else {
            $token = $request->_token;
            $Buat = Tiket::create([
                'token' => $token,
                'kode' => $huruf . $urutan . uniqid(),
                'user_id' =>  $request->user_id,
                'tempat_id' =>  $request->tempat_id,
                'jml_orang' => $request->jml_orang,
                'name' => $request->name,
                'email' => $request->email,
                'telp' => $request->telp,
                'harga' => $harga,

            ]);
            $tiket = Tiket::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
            Toastr::success('Ditempatkan ke pesanan mu :> Segera bayar ya', 'Success');
            return redirect()->route('pesananku');
            // return view('pesananku', compact('tiket'));
        }
    }

    function do_tambah_transaksi_villa(Request $request)
    {
        $dt = Tempat::where('user_id', 'D007')->first();
        $tempat_id = $dt->id;

        $this->validateStore_Villa($request);
        date_default_timezone_set('Asia/Jakarta');
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        $formatted_dt1 = Carbon::parse($startDate);
        $formatted_dt2 = Carbon::parse($endDate);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        if ($durasi < 0) {
            return redirect()->back();
        }
        $dataVilla = DB::select(
            "SELECT  a.harga FROM `tb_villa` AS a
            LEFT JOIN tb_BookingVilla AS b ON b.villa_id = a.id
            WHERE a.id = $request->villa_id"
        );
        foreach ($dataVilla as $a) {
            $biaya = $a->harga * ($durasi + 1);
        }
        //kodetiket
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();

        //kodebooking
        $data = BookingVilla::max('kode_booking');
        $huruff = 'BV';
        $urutann = (int) substr($data, 3, 3);
        $urutann++;
        $kode_booking = $huruff . sprintf('%04s', $urutann);

        $kartu_identitas = (new BookingVilla)->userAvatar($request);
        $user_id = auth()->user()->id;
        $data = BookingVilla::create([
            'kode_tiket' => $checkout_kode,
            'kode_booking' => $kode_booking,
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'tgl_checkin' => $startDate,
            'tgl_checkout' => $endDate,
            'jml_orang' => $request->jml_orang,
            'durasi' => $durasi + 1,
            'biaya' => $biaya,
            'kartu_identitas' => $kartu_identitas,
            'user_id' =>  $user_id,
            'villa_id' => $request->villa_id,
        ]);
        Tiket::create([
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $biaya,
            "tempat_id" => $tempat_id,

        ]);
        Detail_transaksi::create([
            "name" => "Tempat Sewa",
            "user_id" => $request->user_id,
            "durasi" => $durasi + 1,
            "tanggal_a" => $startDate,
            "tanggal_b" => $endDate,
            "kode_tiket" => $checkout_kode,
            "id_produk" => $kode_booking,
            "jumlah" => $request->jml_orang,
            "harga" => $biaya,
            "kategori" => "villa",
            "tempat_id" => $tempat_id,

        ]);
        return redirect("pesananku");
    }
    public function validateStore_Villa($request)
    {
        return  $this->validate($request, [
            'nama' => 'required',
            'telp' => 'required',
        ]);
    }
    function booking_event_tempatsewa(Request $request)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id)->orderby('id', 'desc')->get();
        return view('admin.booking.order_all', compact('detail', 'id'));
    }
}
