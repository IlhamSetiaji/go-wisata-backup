<?php

namespace App\Http\Controllers;

use App\Models\BookingPaket as ModelsBookingPaket;
use App\Models\BookingVilla;
use App\Models\Camp;
use App\Models\Detail_camp;
use App\Models\Detail_transaksi;
use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Models\Tempat;
use App\Models\Wahana;
use App\Models\Kuliner;
use App\Models\Hotel;
use App\Models\Tiket;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Detail_booking;
use App\Models\EventBooking;
use App\Models\Kegiatan;
use App\Models\Setting;
use App\Models\Event;
use App\Models\KategoriEvent;
use App\Models\Villa;
use App\Models\ReviewEvent;
use App\Models\ReviewTempatSewa;
use App\Models\ReviewVilla;
use App\Models\tb_datakuliner;
use App\Models\tb_kategoriwisata;
use App\Models\tb_paket;
use App\Models\tb_paketkategoriwisata;
use App\Models\tb_paketpenginapan;
use App\Models\tb_paketwahana;
use App\Models\tb_paketwisata;
use App\Models\TempatSewa;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use BookingPaket;
use Illuminate\Support\Facades\DB;
use Dompdf\Adapter\PDFLib;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade as PDF;
use PhpParser\Node\Stmt\Return_;



class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat  = Tempat::where('kategori', 'desa')->orderby('id', 'ASC')->where('status', '1')->get();
        $desa  = Tempat::where('kategori', 'desa')->orderby('id', 'ASC')->where('status', '1')->get();
        $unggulan  = Tempat::where('unggulan', '1')->where('status', '1')->get();
        $setting =  Setting::first();
        $kegiatan = Kegiatan::latest()->get();
        $jenis_wisata = tb_kategoriwisata::get();
        // return $kegiatan;
        return view('FrontEnd/welcome', [
            "title" => "Home",
            "tempat" => $tempat,
            "setting" => $setting,
            "kegiatan" => $kegiatan,
            "unggulan" => $unggulan,
            "desas" => $desa,
            'ctg_wisata' => $jenis_wisata,
        ]);
    }

    public function getPenginapan(Request $request)
    {
        $desa_id = $request->desa_id;
        $penginapans = count(Tempat::where('induk_id', $desa_id)->where('kategori', 'penginapan')->where('status', 1)->get());
        // dd($penginapans);
        if ($penginapans != null) {
            echo "<input type='number' class='form-control' name='jml_hari' id='jml_hari' required>";
        } else {
            echo "<input type='number' class='form-control' name='jml_hari' placeholder='Mohon maaf tidak ada penginapan disekitar sini' disabled id='jml_hari'>";
        }
    }
    public function explore()
    {
        $setting =  Setting::first();
        $jenis_wisata = tb_kategoriwisata::get();
        $desa  = Tempat::where('kategori', 'desa')->orderby('id', 'ASC')->where('status', '1')->get();
        return view('explore/halaman_explore', [
            "title" => "Explore",
            "setting" => $setting,
            "desas" => $desa,
            'ctg_wisata' => $jenis_wisata
        ]);
    }
    public function explore_event(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $setting =  Setting::first();
        $kategori =  KategoriEvent::all();
        if ($request->has('cari_by_name')) {
            $event = Event::where('nama', 'LIKE', '%' . $request->cari_by_name . '%')->where('status', 1)->orderby('tgl_buka', 'DESC')->paginate(5);
        } else {
            $event = Event::where('status', 1)->orderby('tgl_buka', 'DESC')->paginate(5);
        }
        if ($request->has('cari_by_category')) {
            $event = Event::where('kategorievent_id', 'LIKE', '%' . $request->cari_by_category . '%')->where('status', 1)->orderby('tgl_buka', 'DESC')->paginate(5);
        } else {
            $event = Event::where('status', 1)->orderby('tgl_buka', 'DESC')->paginate(5);
        }

        return view('explore/halaman_explore_event', [
            "title" => "Explore",
            "setting" => $setting,
            "event" => $event,
            "kategori" => $kategori,
        ]);
    }

    public function explore_kuliner(Request $request)
    {
        $tempat  = Tempat::where('kategori', 'kuliner')->orderby('id', 'DESC')->where('status', '1')->get();
        $setting =  Setting::first();
        return view('explore/halaman_explore_kuliner', [
            "title" => "Home",
            "tempat" => $tempat,
            "setting" => $setting
        ]);
    }

    // public function explore_Villa(Request $request)
    // {
    //     $setting =  Setting::first();
    //     if ($request->has('cari')) {
    //         $Villa = Villa::where('nama', 'LIKE', '%' . $request->cari . '%')->where('status', 1)->orderby('created_at', 'DESC')->paginate(5);
    //     } else {
    //         $Villa = Villa::where('status', 1)->orderby('created_at', 'DESC')->paginate(5);
    //     }

    //     return view('explore/halaman_explore_tempat', [
    //         "title" => "Explore",
    //         "setting" => $setting,
    //         "Villa" => $Villa,
    //     ]);
    // }
    public function explore_villa_detail(Request $request, $id)
    {
        $setting =  Setting::first();
        $villa = Villa::find($id);
        $user = User::where('id', $villa->user_id)->first();
        $review = ReviewVilla::where('villa_id', $id)->whereNotNull('rating')->orderby('created_at', 'DESC')->get();
        $avg = ReviewVilla::where('villa_id', $id)->whereNotNull('rating')->avg('rating');
        $tempat = Tempat::where('user_id', $user->petugas_id)->first();
        return view('explore.halaman_explore_villa_detail', [
            "title" => "Explore",
            "villa" => $villa,
            'setting' => $setting,
            'review' => $review,
            'avg' => $avg,
            'tempat' => $tempat,
        ]);
    }



    public function event()
    {
        // $kegiatan  = Kegiatan::where('kategori', 'wisata')->orderby('id', 'DESC')->where('status', '1')->get();

        $event = Kegiatan::with(['tempat'])->where('status', 1)->orderby('date_a', 'ASC')->paginate(3);


        return view('FrontEnd/event', compact('event'));
    }
    public function eventtempat(Request $request, $slug)
    {
        // dd($slug);
        $tempat  = Tempat::where('slug', $slug)->first();
        // dd($tempat);
        $event = Kegiatan::Where('tempat_id', $tempat->id)->where('status', 1)->paginate(3);
        // $kegiatan  = Kegiatan::where('kategori', 'wisata')->orderby('id', 'DESC')->where('status', '1')->get();
        return view('FrontEnd/eventtempat', compact('event', 'tempat'));
    }
    public function back()
    {
        return redirect()->back();
    }
    public function print($kode)
    {

        // date_default_timezone_set('Asia/Jakarta');

        $tiket = Tiket::where('user_id', Auth::user()->id)->where('kode', $kode)->first();
        $desc = Detail_transaksi::where('kode_tiket', $kode)->get();
        $dt = Detail_transaksi::where('kode_tiket', $kode)->first();

        // $des = Detail_transaksi::where('kode_tiket', $id)->first();

        // $tiket = Tiket::where('kode', $kode)->first();
        set_time_limit(300);
        // dd($nomer);
        // $pdf = PDF::loadview('pelanggan.tiket-pdf', compact('tiket', 'desc'));
        // return $pdf->download('tiket-pdf');
        if ($dt->kategori == 'villa') {
            return view('pelanggan.tiket-villa-pdf', compact('tiket', 'dt'));
        } elseif ($dt->kategori == 'events') {
            return view('pelanggan.tiket-events-pdf', compact('tiket', 'dt'));
        } elseif ($dt->kategori == 'tempat sewa') {
            return view('pelanggan.tiket-tempatsewa-pdf', compact('tiket', 'dt'));
        }
        if ($tiket->status == 0 && $tiket->type_bayar == 'bayar langsung') {

            return view('pelanggan.tiket-langsung-pdf', compact('tiket', 'desc'));
        } else {

            return view('pelanggan.tiket-pdf', compact('tiket', 'desc'));
        }
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

    public function budgeting(Request $request)
    {
        //validation request
        if ($request->jml_hari != '') {
            $request->validate([
                'jml_budget' => 'required|integer',
                'desa' => 'required',
                'jml_hari' => 'required|integer',
                'jml_orang' => 'required|integer',
                'kategori' => 'required',
            ]);
        } else {
            $request->validate([
                'kategori' => 'required',
                'jml_budget' => 'required|integer',
                'desa' => 'required',
                'jml_orang' => 'required|integer',
            ]);
        }

        $budget = intval($request->jml_budget);
        $kategori = $request->kategori;
        $hari = $request->jml_hari;
        $desa = $request->desa;
        $jumlahOrang = $request->jml_orang;
        $highestHarga = tb_paket::where('id_desa', '=', $desa)->where('status', 1)->max('harga');
        $filterKategori = [];

        if ($hari != null) {
            $budget = $budget / $hari / $jumlahOrang;
        } else {
            $budget = $budget / $jumlahOrang;
        }

        //get data from database
        if ($budget >= $highestHarga) {
            $pakets = tb_paket::where('id_desa', '=', $desa)
                ->orderBy('harga', 'desc')
                ->where('status', 1)
                ->get();
        } else {
            $pakets = tb_paket::where('id_desa', '=', $desa)
                ->where("harga", "<=", $budget)
                ->where('status', '=', 1)
                ->orderBy('harga', 'desc')
                ->get();
        }
        // dd($pakets);

        //filter kategori paket
        if (count($kategori) == 1) {
            foreach ($pakets as $paket) {
                $tempFilterKategori = tb_paketkategoriwisata::where('paket_id', $paket->id)->where('kategori_wisata_id', $kategori[0])->first();
                if ($tempFilterKategori != null) {
                    array_push($filterKategori, tb_paket::where('id', $tempFilterKategori->paket_id)->first());
                }
            }
        } else if (count($kategori) == 2) {
            $dataSetelahFilter = [];
            foreach ($pakets as $paket) {
                $tempFilterKategori1 = tb_paketkategoriwisata::where('paket_id', $paket->id)->get();
                $tempDataFilter = [];
                array_push($tempDataFilter, $tempFilterKategori1);

                for ($i = 0; $i < count($tempDataFilter); $i++) {
                    for ($j = 0; $j < count($tempDataFilter[$i]); $j++) {
                        if ($tempDataFilter[$i][$j]->kategori_wisata_id == $kategori[0] || $tempDataFilter[$i][$j]->kategori_wisata_id == $kategori[1]) {
                            array_push($dataSetelahFilter, tb_paket::where('id', $tempDataFilter[$i][$j]->paket_id)->pluck('id')->first());
                        }
                    }
                }
            }
            $dataUniqe = array_unique($dataSetelahFilter);
            foreach ($dataUniqe as $filter) {
                array_push($filterKategori, tb_paket::where('id', $filter)->first());
            }
        } else if (count($kategori) == 3) {
            $dataSetelahFilter = [];
            foreach ($pakets as $paket) {
                $tempFilterKategori1 = tb_paketkategoriwisata::where('paket_id', $paket->id)->get();
                $tempDataFilter = [];
                array_push($tempDataFilter, $tempFilterKategori1);

                for ($i = 0; $i < count($tempDataFilter); $i++) {
                    for ($j = 0; $j < count($tempDataFilter[$i]); $j++) {
                        if ($tempDataFilter[$i][$j]->kategori_wisata_id == $kategori[0] || $tempDataFilter[$i][$j]->kategori_wisata_id == $kategori[1] || $tempDataFilter[$i][$j]->kategori_wisata_id == $kategori[2]) {
                            array_push($dataSetelahFilter, tb_paket::where('id', $tempDataFilter[$i][$j]->paket_id)->pluck('id')->first());
                        }
                    }
                }
            }
            $dataUniqe = array_unique($dataSetelahFilter);
            foreach ($dataUniqe as $filter) {
                array_push($filterKategori, tb_paket::where('id', $filter)->first());
            }
        }

        //get id setiap paket
        $dataIdPaktes = [];
        foreach ($filterKategori as $paket) {
            array_push($dataIdPaktes, $paket->id);
        }

        //get kategori
        $kategoriPaket = [];
        foreach ($dataIdPaktes as $id) {
            array_push($kategoriPaket, tb_paketkategoriwisata::where('paket_id', $id)->get());
        }

        //get paket wisata setiap paket
        $dataPaketWisata = [];
        foreach ($dataIdPaktes as $id) {
            $cekIdPaketWisata = tb_paketwisata::where('paket_id', $id)->first();
            if ($cekIdPaketWisata != '') {
                $tempPaketWisata = tb_paketwisata::where('paket_id', $id)->get();
                array_push($dataPaketWisata, $tempPaketWisata);
            }
        }

        //get data kuliner
        $dataPaketKuliner  = [];
        foreach ($dataIdPaktes as $id) {
            $cekIdPaketKuliner = tb_datakuliner::where('paket_id', $id)->first();
            if ($cekIdPaketKuliner != '') {
                array_push($dataPaketKuliner, $cekIdPaketKuliner);
            }
        }

        //get data penginapan
        $dataPaketPenginapan  = [];
        foreach ($dataIdPaktes as $id) {
            $cekIdPaketPenginapan = tb_paketpenginapan::where('paket_id', $id)->first();
            if ($cekIdPaketPenginapan != '') {
                $tempPaketPenginapan = tb_paketpenginapan::where('paket_id', $id)->get();
                array_push($dataPaketPenginapan, $tempPaketPenginapan);
            }
        }

        // get random image for tb_tempat
        $arrGambar = [];
        for ($i = 0; $i < count($dataPaketWisata); $i++) {
            $temp_data = $dataPaketWisata[$i][rand(1, count($dataPaketWisata[$i]) - 1)];
            array_push($arrGambar, [
                'paket_id' => $temp_data->paket_id,
                'gambar' => $temp_data->tempat()->first()->image
            ]);
        }

        $dataInput = [];
        $dataInput['jml_orang'] = $jumlahOrang;
        $dataInput['jml_hari'] = $hari;

        return view('FrontEnd.budgeting', [
            'paket' => $filterKategori,
            'budget' => $budget,
            'wisatas' => $dataPaketWisata,
            'penginapans' => $dataPaketPenginapan,
            'gambar' => $arrGambar,
            'input' => $dataInput,
            'kuliners' => $dataPaketKuliner,
            'kategoris' => $kategoriPaket
        ]);
    }

    public function detail_budget($id, Request $request)
    {
        // dd($request->all());
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
        }
        // $setting =  Setting::first();
        $paket = tb_paket::find($id);
        $biaya = $paket->harga * $request->jml_orang * $request->jml_hari;
        // dd($paket);

        // $review = ReviewPaket::where('pakt_id', $id)->whereNotNull('rating')->orderby('created_at', 'DESC')->get();
        // $avg = ReviewPaket::where('paket_id', $id)->whereNotNull('rating')->avg('rating');
        return view('FrontEnd.detailbudget', [
            'paket' => $paket,
            'orang' => $request->jml_orang,
            'hari' => $request->jml_hari,
            'biaya' => $biaya
            // 'review' => $review,
            // 'avg' => $avg,
        ]);
    }

    public function pesanBudgeting(Request $request)
    {
        // dd($request->all());
        $dataPaket = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'telp' => 'required',
            'paket_id' => 'required',
            'telp' => 'required',
            'jml_hari' => 'required',
            'jml_orang' => 'required',
            'total_biaya' => 'required',
            'tanggal_perjalanan' => 'required',
        ]);
        $dataPaket['status'] = 1;

        //kode_booking
        $data = ModelsBookingPaket::max('kode_booking');
        $huruf = 'BP';
        $urutan = (int) substr($data, 3, 3);
        $urutan++;
        $kode_booking = $huruf . sprintf('%04s', $urutan);
        $dataPaket['kode_booking'] = $kode_booking;


        $dataPaket = ModelsBookingPaket::create($dataPaket);

        // dd($data);

        return view(
            'FrontEnd.chatAdmin',
            [

                'kodeBooking' => $kode_booking,
                'paket' => $dataPaket
            ]
        );
        // dd('done');
        // dd($dataPaket);
        // dd($kode_booking);
    }

    public function getInvoice($kode)
    {
        $data = [
            'title' => 'Invoice Pembelian dengan kode booking: ' . $kode,
            'datas' => ModelsBookingPaket::where('kode_booking', $kode)->first()
        ];
        // dd($data['datas']->kode_booking);

        $pdf = PDF::loadView('invoice', $data);

        return $pdf->download('Invoice ' . $kode . '.pdf');
    }


    public function tempatshow($slug)
    {
        // $data = 'ahahahaha';

        // dd($data);
        session()->forget("camping");
        $tempat  = DB::table('tb_tempat')->where('status', '1')->where('slug', $slug)->first();
        // dd($tempat);
        $setting =  Setting::first();

        if ($tempat->kategori == "wisata") {

            // $wisata = Tempat::where('induk_id', $tempatini)->where('kategori', 'wisata')->get();

            $tempat2  = Tempat::where('slug', $slug)->where('status', '1')->first();

            $tempatini = $tempat->id;

            $wahana  = Wahana::where('tempat_id', $tempatini)->where('status', '1')->get();

            $kuliner = Tempat::where('induk_id', $tempatini)->where('kategori', 'kuliner')->get();
            // dd($kuliner);
            $event = Tempat::where('induk_id', $tempatini)->where('kategori', 'event & sewa tempat')->get();

            $penginapan = Tempat::where([
                'induk_id' => $tempatini,
                'kategori' => 'penginapan'
            ])->get();

            $ez = Tempat::where('induk_id', $tempatini)->get();

            $camp = Camp::where('tempat_id', $tempatini)->where('status', 1)->where('kategori', 'alat')->get();

            $camp1 = Camp::where('tempat_id', $tempatini)->where('status', 1)->get();

            $makanan = Kuliner::where('tempat_id', $tempat->id)->where('status', 1)->get();

            // dd($tempat2->video);
            return view('FrontEnd/showtempat', compact('event', 'setting', 'ez', 'tempat',  'tempat2', 'wahana', 'kuliner', 'makanan', 'camp', 'camp1', 'penginapan'));
            // $penginapanSekitars = Tempat::where('induk_id', $tempatini)->where('kategori', 'penginapan')->get();
            // dd($penginapan);

            // return view('FrontEnd/showtempat', compact('setting', 'ez', 'tempat',  'tempat2', 'wahana', 'kuliner', 'makanan', 'camp', 'camp1', 'penginapan'));
        }

        if ($tempat->kategori == "desa") {
            $tempat2  = Tempat::where('slug', $slug)->where('status', '1')->first();
            $tempatini = $tempat->id;
            $wahana  = Wahana::where('tempat_id', $tempatini)->where('status', '1')->get();
            $penginapan = DB::table("tb_hotel")
                ->Join("tb_tempat", function ($join) {
                    $join->on("tb_hotel.tempat_id", "=", "tb_tempat.id");
                })
                ->select("tb_hotel.*")
                ->where("tb_tempat.induk_id", "=", $tempatini)
                ->where("tb_hotel.status", "=", 1)
                ->get();
            $kuliner = Tempat::where('induk_id', $tempatini)->where('kategori', 'kuliner')->where('status', 1)->get();

            // $penginapan = Tempat::where(['induk_id' => $tempatini, 'status' => 1])->where('kategori', 'penginapan')->get();
            $ez = Tempat::where('induk_id', $tempatini)->where('status', 1)->get();
            $camp = Camp::where('tempat_id', $tempatini)->where('status', 1)->where('kategori', 'alat')->get();

            $camp1 = Camp::where('tempat_id', $tempatini)->where('status', 1)->get();
            $nama = $tempat2['name'];

            $seni = Tempat::where('induk_id', $tempatini)->where('kategori', 'seni & budaya')->where('status', 1)->get();

            $paket = tb_paket::all();
            $jenis_wisata = tb_kategoriwisata::get();

            return view('FrontEnd/showtempatd', compact('paket', 'seni', 'setting', 'ez', 'tempat', 'tempat2', 'nama', 'wahana', 'kuliner',  'camp', 'camp1', 'penginapan', 'jenis_wisata'));
        }


        // dd($tempat);
        if ($tempat->kategori == "kuliner") {
            // dd($tempat);
            $makanan = Kuliner::where('tempat_id', $tempat->id)->where('kategori', 'makan')->where('status', 1)->get();
            $minuman = Kuliner::where('tempat_id', $tempat->id)->where('kategori', 'minum')->where('status', 1)->get();
            $snack = Kuliner::where('tempat_id', $tempat->id)->where('kategori', 'snack')->where('status', 1)->get();
            $kuliner = session("kuliner");
            return view('FrontEnd/showtempatk', compact('tempat', 'makanan', 'minuman', 'snack', 'kuliner', 'setting'));
        }
        if ($tempat->kategori == "penginapan") {
            $kamar = Kamar::where('tempat_id', $tempat->id)->where('status', 1)->get();
            $ht = Tempat::where('induk_id', $tempat->induk_id)
                ->where('kategori', 'penginapan')
                ->where('status', 1)
                ->first();
            $penginapan = Hotel::where('status', 1)->where('tempat_id', $ht->id)->get();
            return view('FrontEnd/showtempatp', compact('tempat', 'kamar', 'setting', 'penginapan'));
        }
        if ($tempat->kategori == "event & sewa tempat") {
            $tempat2  = Tempat::where('slug', $slug)->where('status', '1')->first();
            $user = User::where('tempat_id', $tempat->id)->where('status', 1)->first();
            $event = Event::where('user_id', $user->id)->where('status', 1)->orderby('tgl_buka', 'DESC')->paginate(5);
            $title = "Explore";
            return view('FrontEnd/showtempates', compact('tempat', 'event', 'tempat2', 'title', 'setting'));
        }

        if ($tempat->kategori == "seni & budaya") {

            // $wisata = Tempat::where('induk_id', $tempatini)->where('kategori', 'wisata')->get();

            $tempat2  = Tempat::where('slug', $slug)->where('status', '1')->first();

            $tempatini = $tempat->id;

            $wahana  = Wahana::where('tempat_id', $tempatini)->where('status', '1')->get();

            $kuliner = Tempat::where('induk_id', $tempatini)->where('kategori', 'kuliner')->get();
            // dd($kuliner);
            $event = Tempat::where('induk_id', $tempatini)->where('kategori', 'event & sewa tempat')->get();

            $penginapan = Tempat::where([
                'induk_id' => $tempatini,
                'kategori' => 'penginapan'
            ])->get();

            $ez = Tempat::where('induk_id', $tempatini)->get();

            $camp = Camp::where('tempat_id', $tempatini)->where('status', 1)->where('kategori', 'alat')->get();

            $camp1 = Camp::where('tempat_id', $tempatini)->where('status', 1)->get();

            $makanan = Kuliner::where('tempat_id', $tempat->id)->where('status', 1)->get();

            // dd($tempat2->video);
            return view('FrontEnd/showtempat', compact('event', 'setting', 'ez', 'tempat',  'tempat2', 'wahana', 'kuliner', 'makanan', 'camp', 'camp1', 'penginapan'));
            // $penginapanSekitars = Tempat::where('induk_id', $tempatini)->where('kategori', 'penginapan')->get();
            // dd($penginapan);

            // return view('FrontEnd/showtempat', compact('setting', 'ez', 'tempat',  'tempat2', 'wahana', 'kuliner', 'makanan', 'camp', 'camp1', 'penginapan'));
        }


        // dd($makanan);


    }
    public function wahanashow($name)
    {
        // $place = $name;


        $tempat  = Tempat::where('name', $name)->where('status', '1')->first();

        $tempat2  = Tempat::where('name', $name)->where('status', '1')->first();
        $wahana = Wahana::where('tempat_id', $tempat->id)->where('status', '1')->get();

        $nama = $tempat2['name'];
        // dd($tempat);

        return view('FrontEnd/showtempat', compact('tempat', 'wahana', 'nama'));
    }

    public function maucamping($id)
    {

        $camping = session("camping");

        $camp  = Camp::where('tempat_id', $id)->get();
        $tempat = Tempat::where('id', $id)->first();

        return view('FrontEnd/camping', compact('camp', 'id', 'tempat'))->with("camping", $camping);
    }
    public function pilihcamping(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = Carbon::now()->format('Y-m-d');
        $formatted_dt1 = Carbon::parse($request->date);
        $formatted_dt2 = Carbon::parse($request->date2);
        if ($formatted_dt1 >  $formatted_dt2) {
            $durasi = -1 * ($formatted_dt1->diffInDays($formatted_dt2));
        } else {
            $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        }

        // dd($durasi);
        if ($durasi < 0) {
            // dd($durasi);
            Toastr::warning('Durasi tidak Valid ', 'Warning');
            return redirect()->back();
        }
        $camping = session("camping");
        // dd($request);
        $camping[$id] = [
            // "kode_camping" => $kode,
            "name" => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'tempat_name' => $request->tempat_name,
            'tempat_id' => $request->tempat_id,
            'date' => $request->date,
            'date2' => $request->date2,
            // 'alat_id' => $request->alat_id,
            // 'jumlah_tenda' => $request->jumlah_tenda,
            // 'durasi' => $request->durasi,
            'jumlah_orang' => $request->jumlah_orang,
            'makan' => $request->makan,
            'makan_durasi' => $durasi,
        ];
        session(["camping" => $camping]);
        // dd($camping);
        $camping = session("camping");
        // dd($camping);

        // dd($request->tempat_id);
        $cekalat = Camp::where('tempat_id', $request->tempat_id)->where('kategori', 'alat')->where('status', 1)->get();
        $makan = null;
        if ($request->makan == "include") {
            $makan = Camp::where('tempat_id', $request->tempat_id)->where('kategori', 'makan')->where('status', 1)->get();
        }

        // dd($cekalat);
        $alat = Camp::where('tempat_id', $request->tempat_id)->where('kategori', 'alat')->where('status', 1)->get();
        $checkin = $request->date;
        $tempat_id = $request->tempat_id;
        $jumlah_orang = $request->jumlah_orang;
        // dd($cekkamar);
        session()->forget("cartc");
        $cartc = session("cartc");


        // dd($request);
        return view('FrontEnd/camping2', compact('makan', 'camping', 'id', 'durasi', 'tempat_id', 'checkin', 'alat', 'cekalat', 'formatted_dt1', 'formatted_dt2', 'jumlah_orang'))->with("camping", $camping);
    }
    public function pilihcamping2(Request $request,  $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        // $camping = session("camping");
        // dd($camping);
        // $data = Detail_camp::max('kode_camping');
        // $huruf = "DC";
        // $urutan = (int)substr($data, 3, 3);
        // $urutan++;
        // $camp_id = $huruf . sprintf("%04s", $urutan);
        // $kode = $camp_id;
        $camping[$id] = [
            // "kode_camping" => $kode,
            'name' => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'tempat_name' => $request->tempat_name,
            'tempat_id' => $request->tempat_id,
            'date' => $request->date,
            'date2' => $request->date2,
            'jumlah_orang' => $request->jumlah_orang,
            'makan' => $request->makan,
            'makan_durasi' => $request->makan_durasi,

            'alat_id' => $request->alat_id,
            'jumlah_tenda' => $request->jumlah_tenda,
            'durasi' => $request->durasi,

        ];
        session(["camping" => $camping]);
        // dd($camping);
        //=====================================================================
        // $tempat  = Tempat::where('id', $request->tempat_id)->where('status', '1')->first();
        // if ($tempat == null) {
        //     return redirect(route('pesan.kamar'));
        // }
        // $kate = $tempat->kategori;
        // dd($kate);

        // $camping = session("camping");

        // return view("cart.camping", compact('camping', 'durasi', 'tempat_id', 'checkin', 'tempat', 'alat', 'cekalat', 'formatted_dt1', 'formatted_dt2', 'jumlah_orang'))->with("camping", $camping);
        $cartcamping = session("cartcamping");
        $cartcamping[$id] = [
            'tempat_name' => $request->tempat_name,
            'tempat_id' => $request->tempat_id,
            'date' => $request->date,
            'date2' => $request->date2,
            'jumlah_orang' => $request->jumlah_orang,
            'makan' => $request->makan,
            'makan_durasi' => $request->makan_durasi,
            'alat_id' => $request->alat_id,
            'jumlah_tenda' => 1,
            'durasi' => $request->durasi,
        ];
        session(["cartcamping" => $cartcamping]);
        dd($cartcamping);
        // return view("cart.camping", compact('cartcamping'))->with("cartcamping", $cartcamping);
        return redirect("/cart/camping");
    }
    public function maukamar($id)
    {

        $camp  = Camp::where('tempat_id', $id)->get();
        $tempat = Tempat::where('id', $id)->first();
        return view('FrontEnd/camping', compact('camp', 'tempat'));
    }
    public function pesancamping(Request $request)
    {

        $this->validate($request, [

            'jumlah_tenda' => 'min:0',
            'jumlah_orang' => 'min:0',
            'makan_durasi' => 'min:0',
        ]);
        if ($request->alat_id == "0" && $request->makan == "exclude") {
            Toastr::warning('Maaf jika tidak memesan langsung saja datang :) ', 'Hai');
            return redirect()->back();
        }
        $makan_harga = 0;
        $subtotal = 0;
        // dd($request); ==================================
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();

        $data = Detail_camp::max('kode_camping');
        $huruf = "DC";
        $urutan = (int)substr($data, 3, 3);
        $urutan++;
        $camp_id = $huruf . sprintf("%04s", $urutan);
        // dd($camp_id);
        // =================================================

        //Pesan Makan , untuk tenda tidak=======================================================================
        if ($request->alat_id == 0 &&  $request->makan == "include") {
            if ($request->makan_durasi == null) {
                Toastr::success('Mau makan untuk berapa hari ya? :) ', 'Success');
                return redirect()->back();
            }
            if ($request->makan == "include") {
                $makan = Camp::where('tempat_id', $request->tempat_id)->where('kategori', 'makan')->first();
                $makan_harga = (int) $makan->harga;
                // dd($request->makan);
            }
            $hargamakan = $makan_harga * (int) $request->jumlah_orang * (int) $request->makan_durasi;
            $subtotal = $hargamakan;
            // dd($request->durasii);
        }
        if ($request->makan == "exclude" &&  !$request->makan_durasi == "0") {
            Toastr::success('exclude atau include ya? :) ', 'Success');
            return redirect()->back();
        }

        //Pesan Tenda, Tidak Makan===============================================================================
        if (!$request->alat_id == 0 &&  $request->makan == "exclude") {
            if ($request->jumlah_tenda == null) {
                Toastr::success('jumlah tenda? :) ', 'Success');
                return redirect()->back();
            }

            $camping = Camp::where('tempat_id', $request->tempat_id)->where('kategori', 'alat')->where('kode_camp', $request->alat_id)->first();
            $camping_harga = (int)$camping->harga;

            //ini nyewa tenda
            $jumlah_tendaa = (int) $request->jumlah_tenda;
            $durasii = (int)$request->durasi;
            $hargasewa = $camping_harga * $jumlah_tendaa * $durasii;
            $subtotal = $hargasewa;
            // dd($camping);
        }
        //Pesan Tenda Iya , Makan Iya =====================================================================
        if (!$request->alat_id == 0 &&  $request->makan == "include") {

            $makan = Camp::where('tempat_id', $request->tempat_id)->where('kategori', 'makan')->first();
            $makan_harga = (int) $makan->harga;
            // dd($request);
            // dd($makan_harga);
            if ($request->makan_durasi == null) {
                // dd($request->makan_durasi);
                Toastr::success('Mohon isi berapa hari makannya :) ', 'Success');
                return redirect()->back();
            }
            $camping = Camp::where('tempat_id', $request->tempat_id)->where('kategori', 'alat')->where('kode_camp', $request->alat_id)->first();
            $camping_harga = (int)$camping->harga;
            // dd($camping_harga);

            //ini nyewa tenda
            $jumlah_tendaa = (int) $request->jumlah_tenda;
            $durasii = (int)$request->durasi;
            $hargasewa = $camping_harga * $jumlah_tendaa * $durasii;

            //ini mesen makan

            $hargamakan = $makan_harga * (int) $request->jumlah_orang * (int) $request->makan_durasi;
            // dd($hargamakan);
            $subtotal = $hargasewa + $hargamakan;
        }
        if ($request->makan == "include") {
            if ($request->durasi == null) {
                Toastr::success('Mohon isi durasi sewanya :) ', 'Success');
                return redirect()->back();
            }
        }
        // dd($request);
        Detail_camp::create([
            'kode_camping' => $camp_id,
            'name' => $request->name,
            'user_id' => $request->user_id,
            'kode_tiket' => $checkout_kode,
            'tempat_name' => $request->tempat_name,
            'tempat_id' => $request->tempat_id,
            'date' => $request->date,
            'alat_id' => $request->alat_id,
            'jumlah_tenda' => $request->jumlah_tenda,
            'jumlah_orang' => $request->jumlah_orang,
            'makan' => $request->makan,
            'makan_durasi' => $request->makan_durasi,
            'durasi' => $request->durasi,
            'harga' => $subtotal,
        ]);

        Detail_transaksi::create([
            "name" => "Paket Camping",
            "user_id" => $request->user_id,
            "durasi" => $request->durasi,
            "tanggal_a" => $request->date,
            "tanggal_b" => "",
            "kode_tiket" => $checkout_kode,
            "id_produk" => $camp_id,
            "jumlah" => 1,
            "harga" => $subtotal,
            "tempat_id" => $request->tempat_id,
            "kategori" => "camping",
        ]);


        Tiket::create([
            // 'token' => $token,
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $subtotal,
        ]);






        // dd($request);
        // dd($subtotal);
        return redirect("pesananku");
    }
    public function pilihkamar(Request $request)
    {
        // dd($request);
        $tempat_id = $request->tempat_id;
        $tempat_name = $request->tempat_name;
        $kamar_id = $request->kamar_id;
        $jumlah_kamar = $request->jumlah_kamar;
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $jumlah_orang = $request->jumlah_orang;
        $durasi = $request->durasi;

        return view('FrontEnd/pilihkamar', compact('durasi', 'tempat_id', 'tempat_name', 'kamar_id', 'jumlah_kamar', 'checkin', 'checkout', 'jumlah_orang'));
    }
    public function pesankamar(Request $request)
    {
        // dd($request);
        date_default_timezone_set('Asia/Jakarta');
        $date = Carbon::now()->format('Y-m-d H:i:s');
        // dd($date);

        $formatted_dt1 = Carbon::parse($request->checkin);
        $formatted_dt2 = Carbon::parse($request->checkout);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        if ($durasi < 1) {

            return redirect()->back();
        }
        // $eventtgl = $request->checkin;

        $kamar = Kamar::where('tempat_id', $request->tempat_id)->where('kode_kamar', $request->kamar_id)->first();
        $subtotal = (int) $kamar->harga * $durasi;
        // dd($kamar_harga);

        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();
        Tiket::create([
            // 'token' => $token,
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'tempat_id' => $request->tempat_id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $subtotal,
        ]);

        if ($durasi >= 1) {
            for ($i = 0; $i < $durasi; $i++) {
                $eventtgl = date('Y-m-d ', strtotime('+' . $i . 'day', strtotime($request->checkin)));
                // dd($eventtgl);
                EventBooking::create([

                    'kamar_id' => $request->kamar_id,
                    'title' => "pending",
                    'tempat_id' => $request->tempat_id,
                    'date' => $eventtgl,
                    'kode_tiket' => $checkout_kode,
                ]);
            }
        }


        $data = Detail_booking::max('kode_booking');
        $huruf = "DB";
        $urutan = (int)substr($data, 3, 3);
        $urutan++;
        $booking_id = $huruf . sprintf("%04s", $urutan);

        Detail_booking::create([
            'kode_tiket' => $checkout_kode,
            'kode_booking' => $booking_id,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'tempat_id' => $request->tempat_id,
            'tempat_name' => $request->tempat_name,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'jumlah_orang' => $request->jumlah_orang,
            'kamar_id' => $request->kamar_id,
            'jumlah_kamar' => $request->jumlah_kamar,
            'durasi' => $durasi,
            'subtotal' => $subtotal,
            'status' => 0,
        ]);



        Detail_transaksi::create([
            "name" => "Reservasi" . $request->tempat_name,
            "user_id" => Auth::user()->id,
            "durasi" => $durasi,
            "tanggal_a" => $request->checkin,
            "tanggal_b" => "",
            "kode_tiket" => $checkout_kode,
            "id_produk" => $booking_id,
            "jumlah" => 1,
            "harga" => $subtotal,
            "tempat_id" => $request->tempat_id,
            "kategori" => "booking",
        ]);
        return redirect("pesananku");
    }
    function cart_booking(Request $request)
    {
        // $pe = session("penginapan");
        $penginapan2 = session("penginapan");
        // foreach ($pe as $ct => $val) {
        //     $tempat_id = $val["tempat_id"];
        //     $checkin = $val["checkin"];
        //     $checkout = $val["checkout"];
        //     $jumlah_orang = (int)$val["jumlah_orang"];
        //     $durasi = $val["durasi"];
        // }
        // dd($penginapan2);


        return view("cart.penginapan", compact('penginapan2'));
    }
    function cart_tambah_booking(Request $request, $kode)
    {
        $penginapan = session("penginapan");
        $penginapan[$kode] = [
            "kode_kamar" => $request->kode_kamar,
            "tempat_id" => $request->tempat_id,
            "tempat_name" => $request->tempat_name,
            "kamar_id" => $request->kamar_id,
            "jumlah_kamar" =>  1,
            "checkin" => $request->checkin,
            "checkout" => $request->checkout,
            "jumlah_orang" => $request->jumlah_orang,
            'durasi' => $request->durasi,

        ];
        // dd($penginapan);
        $tempat_id = $request->tempat_id;
        $tempat_name = $request->tempat_name;
        $kamar_id = $request->kamar_id;
        $jumlah_kamar = $request->jumlah_kamar;
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $jumlah_orang = $request->jumlah_orang;
        $durasi = $request->durasi;
        // dd($penginapan);
        session(["penginapan" => $penginapan]);
        return redirect("/cart/booking");
        // return view('FrontEnd/pilihkamar', compact('penginapan', 'durasi', 'tempat_id', 'tempat_name', 'kamar_id', 'jumlah_kamar', 'checkin', 'checkout', 'jumlah_orang'))->with("penginapan", $penginapan);
        // return view('FrontEnd/pilihkamar', compact('penginapan'));
    }
    function checkpenginapan(Request $request)
    {
        $penginapan = session("penginapan");
        session()->forget("penginapan");
        $tempat  = Tempat::where('id', $request->tempat_id)->where('status', '1')->first();
        if ($tempat == null) {
            return redirect(route('pesan.kamar'));
        }
        $kate = $tempat->kategori;
        date_default_timezone_set('Asia/Jakarta');
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $formatted_dt1 = Carbon::parse($request->checkin);
        $formatted_dt2 = Carbon::parse($request->checkout);
        if ($formatted_dt1 >  $formatted_dt2) {
            $durasi = -1 * ($formatted_dt1->diffInDays($formatted_dt2));
        } else {
            $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        }

        if ($durasi < 0) {
            Toastr::warning('Durasi tidak Valid ', 'Warning');
            return redirect()->back();
        }

        $cekkamar = Kamar::where('tempat_id', $tempat->id)->where('status', 1)->where('type', $request->kamar_type)->get();
        $kamar = Kamar::where('tempat_id', $tempat->id)->where('status', 1)->get();
        $checkin = $request->checkin;
        $tempat_id = $request->tempat_id;
        $jumlah_orang = $request->jumlah_orang;
        return view('FrontEnd/showtempatp', compact('durasi', 'tempat_id', 'checkin', 'tempat', 'kamar', 'cekkamar', 'formatted_dt1', 'formatted_dt2', 'jumlah_orang'));
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

    public function detail_explore_event($id)
    {
        $setting =  Setting::first();
        $event = Event::find($id);
        $review = ReviewEvent::where('event_id', $id)->whereNotNull('rating')->orderby('created_at', 'DESC')->get();
        $avg = ReviewEvent::where('event_id', $id)->whereNotNull('rating')->avg('rating');
        return view('explore.halaman_detailevent', [
            "title" => "Explore",
            'event' => $event,
            'setting' => $setting,
            'review' => $review,
            'avg' => $avg,
        ]);
    }

    // public function detailv_budget($id){
    //     $reqId = "id";
    //     return view('FrontEnd.detailbudget'. [
    //         'reqId' => $reqId,
    //     ]);
    // }



    public function explore_villa()
    {
        $setting =  Setting::first();
        $idmax = Villa::max('id');
        $tempat_baru = Villa::where('status', 1)->orderby('id', 'desc')->take(3)->get();
        $tempat_lama = Villa::where('status', 1)->orderby('id', 'asc')->take(3)->get();
        $tempat_murah = Villa::where('status', 1)->orderby('harga', 'asc')->take(3)->get();
        $penginapan = Hotel::where('status', 1)->get();
        // dd($penginapan);
        return view('explore/halaman_explore_penginapan', [
            "title" => "Explore",
            "setting" => $setting,
            "tempat_baru" => $tempat_baru,
            "tempat_lama" => $tempat_lama,
            "tempat_murah" => $tempat_murah,
            "penginapan" => $penginapan,
        ]);
    }
    // function available_place(Request $request, $checkin_date)
    // {
    // $tempat = DB::SELECT("SELECT * FROM tb_villa WHERE id NOT IN
    // (SELECT villa_id FROM tb_BookingVilla WHERE '$checkin_date' BETWEEN checkin AND checkout)");
    // return response()->json(['data' => $tempat]);
    // }
    public function booking_search(Request $request)
    {
        $setting =  Setting::first();
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $formatted_dt1 = Carbon::parse($request->checkin);
        $formatted_dt2 = Carbon::parse($request->checkout);
        if ($formatted_dt1 >=  $formatted_dt2) {
            $durasi = -1 - ($formatted_dt1->diffInDays($formatted_dt2));
        } else {
            $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        }
        if ($durasi < 0) {
            Toastr::warning('Tanggal checkout tidak boleh sama tanggal checkin', 'Warning');
            return redirect()->back();
        } else {
            $villa = DB::SELECT("SELECT * FROM tb_villa WHERE id NOT IN (SELECT villa_id FROM tb_bookingvilla
            WHERE ('$checkin' BETWEEN checkin AND checkout) OR ('$checkout' BETWEEN checkin AND checkout))");

            return view('explore/halaman_explore_penginapan', [
                "title" => "Explore",
                "setting" => $setting,
                // "tempat" => $tempat,
                "villa" => $villa,
                "checkin" => $checkin,
                "checkout" => $checkout,
                "durasi" => $durasi,
            ]);
        }
    }
    public function booking_tempat(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $request->validate([
            'checkin' => 'required|after_or_equal:' . $now,
            'checkout' => 'required|after:checkin'
        ]);
        $villa_id = $request->villa_id;
        $Villa = Villa::find($villa_id);
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $formatted_dt1 = Carbon::parse($request->checkin);
        $formatted_dt2 = Carbon::parse($request->checkout);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        return view('explore/halaman_Villa_formpesan', [
            "title" => "Explore",
            "Villa" => $Villa,
            "checkin" => $checkin,
            "checkout" => $checkout,
            "durasi" => $durasi,
        ]);
    }

    public function explore_hotel($id)
    {
        $setting =  Setting::first();
        $hotel = Hotel::where('id', $id)->first();
        $kamar = Kamar::where('hotel_id', $id)->where('status', 1)->get();
        return view('explore/halaman_explore_hotel', [
            "title" => "Explore",
            "hotel" => $hotel,
            "kamar" => $kamar,
            "setting" => $setting
        ]);
    }
    public function check_hotel(Request $request)
    {
        $setting =  Setting::first();
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $formatted_dt1 = Carbon::parse($request->checkin);
        $formatted_dt2 = Carbon::parse($request->checkout);
        $hotel_id = $request->hotel_id;
        $hotel = Hotel::where('id', $hotel_id)->first();
        $tempat = Tempat::where('id', $hotel->tempat_id)->first();
        $kamar = Kamar::where('hotel_id', $hotel->id)->where('status', 1)->get();
        if ($formatted_dt1 >=  $formatted_dt2) {
            $durasi = -1 - ($formatted_dt1->diffInDays($formatted_dt2));
        } else {
            $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        }
        if ($durasi < 0) {
            Toastr::warning('Tanggal checkout tidak boleh sama tanggal checkin', 'Warning');
            return redirect()->back();
        } else {
            $tempat_id = $tempat->id;
            $jumlah_orang = $request->jumlah_orang;
            $cekkamar = Kamar::where('tempat_id', $tempat->id)->where('hotel_id', $hotel->id)->where('status', 1)->where('type', $request->kamar_type)->get();
            return view('explore/halaman_explore_hotel', [
                "title" => "Explore",
                "setting" => $setting,
                "formatted_dt1" => $formatted_dt1,
                "formatted_dt2" => $formatted_dt2,
                "durasi" => $durasi,
                "cekkamar" => $cekkamar,
                "tempat" => $tempat,
                "hotel" => $hotel,
                "tempat_id" => $tempat_id,
                "jumlah_orang" => $jumlah_orang,
                "kamar" => $kamar,

            ]);
        }
    }
    public function explore_penyewaan_tempat(Request $request)
    {
        $setting =  Setting::first();
        $tempatsewa = TempatSewa::where('status', 1)->get();
        return view('explore/halaman_explore_penyewaan_tempat', [
            "title" => "Explore",
            "setting" => $setting,
            "tempatsewa" => $tempatsewa,

        ]);
    }
    public function explore_desa_wisata(Request $request)
    {
        $tempat  = Tempat::where('kategori', 'desa')->orderby('id', 'DESC')->where('status', '1')->get();
        $setting =  Setting::first();
        return view('explore/desa_wisata', [
            "title" => "Home",
            "tempat" => $tempat,
            "setting" => $setting
        ]);
    }
    public function explore_penyewaan_tempat_detail($id)
    {
        $setting =  Setting::first();
        $tempatsewa = TempatSewa::find($id);
        $review = ReviewTempatSewa::where('tempatsewa_id', $id)->whereNotNull('rating')->orderby('created_at', 'DESC')->get();
        $avg = ReviewTempatSewa::where('tempatsewa_id', $id)->whereNotNull('rating')->avg('rating');
        $tempat = Tempat::where('id', $tempatsewa->tempat_id)->first();
        return view('explore.halaman_explore_tempatsewa_detail', [
            "title" => "Explore",
            "tempatsewa" => $tempatsewa,
            'setting' => $setting,
            'review' => $review,
            'avg' => $avg,
            'tempat' => $tempat,
        ]);
    }
}
