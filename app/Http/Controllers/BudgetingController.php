<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataPaketKuliner;
use App\Models\Hotel;
use App\Models\Kamar;
use App\Models\Kuliner;
use App\Models\tb_datakuliner;
use App\Models\tb_kategoriwisata;
use App\Models\tb_paket;
use App\Models\tb_paketkategoriwisata;
use App\Models\tb_paketkuliner;
use App\Models\tb_paketpenginapan;
use App\Models\tb_paketwahana;
use App\Models\tb_paketwisata;
use App\Models\Tempat;
use App\Models\Tour;
use App\Models\Villa;
use App\Models\BookingPaket;
use App\Models\PesertaPaket;
use App\Models\Detail_transaksi;
use App\Models\Pay;
use App\Models\Tiket;
use App\Models\User;
use App\Models\Wahana;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TourGuide;

class BudgetingController extends Controller
{
    public function index()
    {
        $dataDesa = Auth::user();
        $dataPaket = tb_paket::where('id_desa', $dataDesa->tempat_id)->orderBy('id', 'desc')->get();
        // dd($dataPaket);
        $transaksiPaket = BookingPaket::join('tb_pakets', 'booking_paket.paket_id', 'tb_pakets.id')->where('tb_pakets.id_desa', $dataDesa->tempat_id)->select('booking_paket.*')->orderBy('id', 'desc')->get();
        return view('admin.budgeting.index', [
            'pakets' => $dataPaket,
            'transaksi' => $transaksiPaket
        ]);
    }
    public function createPaket()
    {
        $dataDesa = Auth::user();
        $idTempat = $dataDesa->tempat_id;
        $dataWisata = Tempat::where('kategori', 'wisata')->where('status', 1)->where('induk_id', $idTempat)->get();
        $dataPenginapanHotel = DB::table('tb_hotel')->select('tb_hotel.*')->join('tb_tempat', 'tb_hotel.tempat_id', '=', 'tb_tempat.id')->where('tb_tempat.induk_id', $idTempat)->where('tb_tempat.status', 1)
            ->get();
        $dataPenginapanVilla = DB::table('tb_villa')->select('tb_villa.*')->join('users', 'tb_villa.user_id', '=', 'users.id')->where('users.desa_id', $idTempat)->get();
        $kategoriPakets = tb_kategoriwisata::all();
        // $dataKuliner = Tempat::where('kategori', 'kuliner')->where('status', 1)->where('induk_id', $idTempat)->get();
        $dataKuliner = DB::table('tb_tempat')->join('tb_kuliner', 'tb_tempat.id', 'tb_kuliner.tempat_id')->join('tb_paketkuliners',  'tb_paketkuliners.tb_kuliner_id', 'tb_kuliner.id')->where('tb_tempat.status', 1)->where('tb_tempat.induk_id', $idTempat)->select('tb_tempat.name', 'tb_tempat.id')->distinct()->get();
        // dd($dataKuliner);
        $arrPenginapan = [];
        $tourGuide = DB::table('tour_guide')->where('desa_id', $idTempat)->where('status', 1)->get();
        // dd( count($tourGuide));
        foreach ($dataPenginapanHotel as $hotel) {
            if (Kamar::where('hotel_id', $hotel->id)->first() != '') {
                array_push($arrPenginapan, $hotel);
            }
        }


        return view('admin.budgeting.create', [
            'dataDesa' => $dataDesa,
            'dataWisatas' => $dataWisata,
            'dataPenginapanHotel' => $arrPenginapan,
            'dataPenginapanVilla' => $dataPenginapanVilla,
            'dataKuliners' => $dataKuliner,
            'kategoriPakets' => $kategoriPakets,
            'dataTourGuide' => $tourGuide
        ]);
    }

    public function getMenu(Request $request)
    {
        // $data = Kuliner::where('tempat_id', $request->resto_id)->get();
        $datas = DataPaketKuliner::where('tempat_id', $request->resto_id)->where('status', 1)->get();
        foreach ($datas as $data) {
            echo "<option value='$data->id'> $data->nama_paket - $data->harga</option>";
        }
        // echo $data;
    }
    public function getKamar(Request $request)
    {
        // return $request->hotel_id;
        $datas = Kamar::where('hotel_id', $request->hotel_id)->get();
        foreach ($datas as $data) {
            echo "<option value='$data->id'> $data->name - $data->harga</option>";
        }
    }

    public function detailPaket(Request $request)
    {
        // dd($request->all());
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required|max:255',
            'id_desa' => 'required',
            'kategori' => 'required',
            // 'id_kategori' => 'required',
            'jml_hari' => 'required|integer',
            'jml_orang' => 'required|integer',
        ]);

        //get data wisata
        $arrDataWisata = [];
        if ($request->data_wisata != null) {
            for ($i = 0; $i < count($request->data_wisata); $i++) {
                if ($request->data_wisata[$i] != '') {
                    array_push($arrDataWisata, Tempat::where('id', $request->data_wisata[$i])->first());
                }
            }
        }

        $hotel = '';
        $kamar = '';

        if ($request->data_penginapanhotel != null && $request->kamar != null) {
            $hotel = Hotel::where('id', $request->data_penginapanhotel)->first();
            $kamar = Kamar::where('id', $request->kamar)->first();
        }
        // dd($kamar);

        $arrDataPenginapanVilla = [];
        if ($request->data_penginapanvilla[0] != null) {
            for ($i = 0; $i < count($request->data_penginapanvilla); $i++) {
                if ($request->data_penginapanvilla[$i] != '') {
                    array_push($arrDataPenginapanVilla, Villa::where('id', $request->data_penginapanvilla[$i])->first());
                }
            }
        }

        $validateDataPaket['data_kategori'] = [];
        for ($i = 0; $i < count($validateDataPaket['kategori']); $i++) {
            array_push($validateDataPaket['data_kategori'], tb_kategoriwisata::where('id', $validateDataPaket['kategori'][$i])->first());
        }

        $kuliners = '';
        if ($request->paketresto != null) {
            $kuliners = DataPaketKuliner::where('id', $request->paketresto)->where('status', 1)->first();
        }

        $guide = '';
        if ($request->data_guide != null) {
            $guide = DB::table('tour_guide')->where('id', $request->data_guide)->first();
        }

        // dd($guide);

        //get harga
        $totalHarga = 0;
        foreach ($arrDataWisata as $data) {
            if ($data->htm != null) {
                $totalHarga += $data->htm;
            }
        }

        foreach ($arrDataPenginapanVilla as $data) {
            $totalHarga += $data->harga;
        }

        // dd($kuliners ==null);
        if ($kamar != null) {
            $totalHarga += $kamar->harga;
        }
        // dd($kamar);

        if ($kuliners != null) {
            $totalHarga += $kuliners->harga;
        }
        if ($request->data_guide != null) {
            $totalHarga += $guide->harga;
        }
        // dd($totalHarga);


        return view('admin.budgeting.detail', [
            'paket' => $validateDataPaket,
            'wisatas' => $arrDataWisata,
            'hotels' => $hotel,
            'villas' => $arrDataPenginapanVilla,
            // 'kamars' => $arrKamarHotel,
            'kuliners' => $kuliners,
            'kamars' => $kamar,
            'guide' => $guide,
            'total' => $totalHarga
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        //validate form
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required',
            'jml_hari' => 'required|integer',
            'jml_orang' => 'required|integer',
            'harga' => 'required|integer'
        ]);
        $validateDataPaket['id_desa'] = Auth::user()->tempat_id;
        if ($request->data_guide != null) {
            $validateDataPaket['tour_guide_id'] = $request->data_guide;
        }
        // $validateDataPaket['harga'] = $request->harga;

        //insert data to tb_paket 
        tb_paket::create($validateDataPaket);

        //get id paket 
        $idPaket = tb_paket::where([
            'nama_paket' => $request->nama_paket,
            'jml_hari' =>  $request->jml_hari,
            'jml_orang' => $request->jml_orang,
            'id_desa' => Auth::user()->tempat_id,
            'harga' => $request->harga
        ])->pluck('id')->first();

        //insert data_wisata to tb_paketwisata
        if ($request->data_wisata != null) {
            $temp_array = array();
            for ($i = 0; $i < count($request->data_wisata); $i++) {
                if ($request->data_wisata[$i] != '') {
                    array_push($temp_array, $request->data_wisata[$i]);
                }
            }

            for ($i = 0; $i < count($temp_array); $i++) {
                tb_paketwisata::create(
                    [
                        'tempat_id' => $temp_array[$i],
                        'paket_id' => $idPaket
                    ]
                );
            }
        }

        // dd($request->data_kategori != null);


        //penginapan hotel
        if ($request->data_hotel != null && $request->data_kamar != null) {
            tb_paketpenginapan::create([
                'paket_id' => $idPaket,
                'hotel_id' => $request->data_hotel,
                'kamar_id' => $request->data_kamar
            ]);
        }
        //penginapan villa
        if ($request->data_villa != null) {
            tb_paketpenginapan::create([
                'paket_id' => $idPaket,
                'villa_id' => $request->data_villa,
            ]);
        }

        //kuliner
        if ($request->kuliner != null) {
            tb_datakuliner::create([
                'paket_id' => $idPaket,
                'data_paket_kuliner_id' => $request->kuliner
            ]);
        }

        //kategori wisata
        if ($request->data_kategori != null) {
            foreach ($request->data_kategori as $data) {
                tb_paketkategoriwisata::create([
                    'paket_id' => $idPaket,
                    'kategori_wisata_id' => $data
                ]);
            }
        }

        // //insert data_penginapan to tb_paketpenginapan
        // if ($request->data_penginapan[0] != null) {
        //     $temp_array = array();
        //     for ($i = 0; $i < count($request->data_penginapan); $i++) {
        //         if ($request->data_penginapan[$i] != '') {
        //             array_push($temp_array, $request->data_penginapan[$i]);
        //         }
        //     }

        //     for ($i = 0; $i < count($temp_array); $i++) {
        //         tb_paketpenginapan::create(
        //             [
        //                 'tempat_id' => $temp_array[$i],
        //                 'paket_id' => $idPaket
        //             ]
        //         );
        //     }
        // }

        //redirect to index budgeting
        return redirect(route('budget.index'));
    }
    public function editStatus(Request $request)
    {
        tb_paket::where('id', $request->id)->update(['status' => $request->status]);
        return redirect(route('budget.index'));
    }

    public function edit($id)
    {
        //get data from database
        $dataDesa = Auth::user();
        $kategoriPakets = tb_kategoriwisata::all();
        $idTempat = $dataDesa->tempat_id;
        $dataWisata = Tempat::where('kategori', 'wisata')->where('status', 1)->where('induk_id', $idTempat)->get();
        $dataKuliner = DB::table('tb_tempat')->join('tb_kuliner', 'tb_tempat.id', 'tb_kuliner.tempat_id')->join('tb_paketkuliners',  'tb_paketkuliners.tb_kuliner_id', 'tb_kuliner.id')->where('tb_tempat.status', 1)->where('tb_tempat.induk_id', $idTempat)->select('tb_tempat.name', 'tb_tempat.id')->distinct()->get();
        $dataGuide = DB::table('tour_guide')->where('desa_id', $dataDesa->tempat_id)->where('status', 1)->get();

        //get spesific data paket from database 
        $paket = tb_paket::where('id', $id)->first();
        $paketWisata = tb_paketwisata::where('paket_id', $id)->get();
        $paketKategori = tb_paketkategoriwisata::where('paket_id', $id)->get();
        $paketMenu = DB::table('data_paket_kuliners')->join('tb_datakuliners', 'data_paket_kuliners.id', 'tb_datakuliners.data_paket_kuliner_id')->where('tb_datakuliners.paket_id', $id)->first();
        $paketResto = tb_datakuliner::where('paket_id', $id)->first();
        $idTempatResto = DB::table('tb_pakets')->join('tb_datakuliners', 'tb_pakets.id', 'tb_datakuliners.paket_id')->join('data_paket_kuliners', 'tb_datakuliners.data_paket_kuliner_id', 'data_paket_kuliners.id')->select('data_paket_kuliners.tempat_id')->first();
        $dataMenu = '';
        if ($idTempatResto != null) {
            $dataMenu = DataPaketKuliner::where('tempat_id', $idTempatResto->tempat_id)->get();
        }

        //spesic data penginapan
        $hotel  = '';
        $villa  = '';
        $kamar  = '';
        $paketPenginapan = tb_paketpenginapan::where('paket_id', $id)->get();
        foreach ($paketPenginapan as $penginapan) {
            if ($penginapan->hotel_id != null && $penginapan->kamar_id != null) {
                $hotel = Hotel::where('id', $penginapan->hotel_id)->first();
                $kamar = Kamar::where('id', $penginapan->kamar_id)->first();
            } else if ($penginapan->villa_id != null) {
                $villa = Villa::where('id', $penginapan->villa_id)->first();
            }
        }

        //all data penginapan
        $dataKamarHotel = '';
        $dataHotel = DB::table('tb_hotel')->select('tb_hotel.*')->join('tb_tempat', 'tb_hotel.tempat_id', '=', 'tb_tempat.id')->where('tb_tempat.induk_id', $idTempat)->where('tb_tempat.status', 1)->get();
        if ($hotel != null) {
            $dataKamarHotel = Kamar::where('hotel_id', $hotel->id)->get();
        }
        $dataVilla = DB::table('tb_villa')->select('tb_villa.*')->join('users', 'tb_villa.user_id', '=', 'users.id')->where('users.desa_id', $idTempat)->get();
        $dataIdPenginapan = tb_paketpenginapan::where('paket_id', $id)->get();

        //memishkan data kategori
        $arrayKateggoriCheklist = [];
        $arrayKateggoriNonCheklist = [];
        for ($i = 0; $i < count($kategoriPakets); $i++) {
            for ($j = 0; $j < count($paketKategori); $j++) {
                if ($kategoriPakets[$i]->id == $paketKategori[$j]->kategori_wisata_id) {
                    array_push($arrayKateggoriCheklist, $kategoriPakets[$i]->id);
                }
            }
        }

        for ($i = 0; $i < count($kategoriPakets); $i++) {
            if (in_array($kategoriPakets[$i]->id, $arrayKateggoriCheklist) == false) {
                array_push($arrayKateggoriNonCheklist, $kategoriPakets[$i]->id);
            }
        }

        for ($i = 0; $i < count($arrayKateggoriCheklist); $i++) {
            $arrayKateggoriCheklist[$i] = tb_kategoriwisata::where('id', $arrayKateggoriCheklist[$i])->first();
        }
        for ($i = 0; $i < count($arrayKateggoriNonCheklist); $i++) {
            $arrayKateggoriNonCheklist[$i] = tb_kategoriwisata::where('id', $arrayKateggoriNonCheklist[$i])->first();
        }

        return view('admin.budgeting.edit', [
            'dataDesa' => $dataDesa,
            'dataWisatas' => $dataWisata,
            'dataHotels' => $dataHotel,
            'dataVilla' => $dataVilla,
            'dataKamar' => $dataKamarHotel,
            'dataKuliners' => $dataKuliner,
            'dataGuide' => $dataGuide,
            'paket' => $paket,
            'guide' => $paket['tour_guide_id'],
            'paketWisatas' => $paketWisata,
            'paketPenginapans' => $paketPenginapan,
            'kategoriChecklist' => $arrayKateggoriCheklist,
            'kategoriNonChecklist' => $arrayKateggoriNonCheklist,
            'paketMenu' => $paketMenu,
            'hotel' => $hotel,
            'kamar' => $kamar,
            'villa' => $villa,
            'resto' => $paketResto,
            'idPenginapan' => $dataIdPenginapan,
            'menus' => $dataMenu
        ]);
    }


    public function detailUpdatePaket(Request $request)
    {
        // dd($request->all());
        $dataUtamaPaket = $request->validate([
            'nama_paket' => 'required|max:255',
            'kategori' => 'required',
            'id_desa' => 'required',
            'jml_orang' => 'required',
            'jml_hari' => 'required',
        ]);

        $harga = 0;

        //tampil wisata
        $tampilWisata = [];
        if ($request->data_wisata != null) {
            foreach ($request->data_wisata as $desa) {
                if ($desa != null) {
                    array_push($tampilWisata, Tempat::where('id', $desa)->first());
                }
            }

            foreach ($tampilWisata as $wisata) {
                if ($wisata != null) {
                    $harga += $wisata->htm;
                }
            }
        }

        $tampilHotel = '';
        $tampilKamar = '';
        $tampilVilla = '';
        $tampilResto = '';
        $tampilPaketKuliner = '';
        $tampilGuide = '';
        $tampilKategori = [];
        if ($request->data_penginapanhotel != null) {
            $tampilHotel = Hotel::where('id', $request->data_penginapanhotel)->first();
        }
        if ($request->guide != null) {
            $tampilGuide = DB::table('tour_guide')->where('id', $request->guide)->first();
            $harga += $tampilGuide->harga;
        }
        if ($request->kamar != null) {
            $tampilKamar = Kamar::where('id', $request->kamar)->first();
            $harga += $tampilKamar->harga;
        }

        if ($request->data_penginapanvilla != null) {
            $tampilVilla = Villa::where('id', $request->data_penginapanvilla)->first();
            $harga += $tampilVilla->harga;
        }

        if ($request->resto != null) {
            $tampilResto = Tempat::where('id', $request->resto)->first();
        }
        if ($request->paketresto != null) {
            $tampilPaketKuliner = DataPaketKuliner::where('id', $request->paketresto)->first();
            $harga += $tampilPaketKuliner->harga;
        }

        for ($i = 0; $i < count($dataUtamaPaket['kategori']); $i++) {
            array_push($tampilKategori, tb_kategoriwisata::where('id', $dataUtamaPaket['kategori'][$i])->first());
        }

        $dataWisata = $request->data_wisata;
        $dataIdWisata = $request->id_paketWisata;
        $paketKategori = tb_paketkategoriwisata::where('paket_id', $request->id)->get();
        for ($i = 0; $i < count($paketKategori); $i++) {
            $paketKategori[$i] = $paketKategori[$i]->id;
        }
        // dd($request->id_paketkuliner);

        return view('admin.budgeting.detail-edit', [
            'paket' => $dataUtamaPaket,
            'harga' => $harga,
            'tampilKategori' => $tampilKategori,
            'tampilWisata' => $tampilWisata,
            'tampilVilla' => $tampilVilla,
            'tampilHotel' => $tampilHotel,
            'tampilKamar' => $tampilKamar,
            'tampilResto' => $tampilResto,
            'tampilPaketKuliner' => $tampilPaketKuliner,
            'tampilGuide' => $tampilGuide,
            'id' => $request->id,
            'idKategori' => $paketKategori,
            'dataWisata' => $dataWisata,
            'dataIdWisata' => $dataIdWisata,
            'dataKategori' => $dataUtamaPaket['kategori'],
            'dataKamar' => $request->kamar,
            'dataHotel' => $request->data_penginapanhotel,
            'dataVilla' => $request->data_penginapanvilla,
            'dataKuliner' => $request->paketresto,
            'dataIdKuliner' => $request->id_paketkuliner,
            'dataIdPenginapan' => $request->idPenginapan,
            'dataKategori' => $request->kategori,
            'dataGuide' => $request->guide
        ]);
    }


    public function updatePaket(Request $request)
    {
        // dd($request->all());
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required|max:255',
            'id_desa' => 'required',
            'jml_hari' => 'required|integer',
            'jml_orang' => 'required|integer',
            'harga' => 'required|integer'
        ]);
        if ($request->guide != null) {
            $validateDataPaket['tour_guide_id'] = $request->guide;
        } else {
            $validateDataPaket['tour_guide_id'] = null;
        }

        //update data tb_paket
        tb_paket::where('id', $request->id)->update($validateDataPaket);

        //update kategoripaket
        if (count($request->idKategori) == count($request->idPaketKategori)) {
            for ($i = 0; $i < count($request->idPaketKategori); $i++) {
                tb_paketkategoriwisata::where('id', $request->idPaketKategori[$i])->update([
                    'paket_id' => $request->id,
                    'kategori_wisata_id' => $request->idKategori[$i]
                ]);
            }
        } else if (count($request->idKategori) < count($request->idPaketKategori)) {
            for ($i = 0; $i < count($request->idKategori); $i++) {
                tb_paketkategoriwisata::where('id', $request->idPaketKategori[$i])->update([
                    'paket_id' => $request->id,
                    'kategori_wisata_id' => $request->idKategori[$i]
                ]);
            }

            for ($i = count($request->idKategori); $i < count($request->idPaketKategori); $i++) {
                tb_paketkategoriwisata::where('id', $request->idPaketKategori[$i])->delete();
            }
        } else if (count($request->idKategori) > count($request->idPaketKategori)) {
            for ($i = 0; $i < count($request->idPaketKategori); $i++) {
                tb_paketkategoriwisata::where('id', $request->idPaketKategori[$i])->update([
                    'paket_id' => $request->id,
                    'kategori_wisata_id' => $request->idKategori[$i]
                ]);
            }

            for ($i = count($request->idPaketKategori); $i < count($request->idKategori); $i++) {
                tb_paketkategoriwisata::create([
                    'paket_id' => $request->id,
                    'kategori_wisata_id' => $request->idKategori[$i]
                ]);
            }
        }

        //update data paket wisata
        if ($request->dataWisata != null) {
            $daftarIdWisata = $request->idWisata;

            //update old data
            for ($i = 0; $i < count($daftarIdWisata); $i++) {
                if ($daftarIdWisata[$i] != null && $request->dataWisata[$i] == null) {
                    $data = tb_paketwisata::find($daftarIdWisata[$i]);
                    $data->delete();
                }
                if ($daftarIdWisata[$i] != null && $request->dataWisata[$i] == null) {
                    tb_paketwisata::where('id', $daftarIdWisata[$i])->update([
                        'tempat_id' => $request->dataWisata[$i]
                    ]);
                }
            }

            //update new data
            if (count($request->dataWisata) > count($daftarIdWisata)) {
                for ($i =  count($daftarIdWisata); $i < count($request->dataWisata); $i++) {
                    if ($request->dataWisata[$i] != null) {
                        tb_paketwisata::create([
                            'tempat_id' => $request->dataWisata[$i],
                            'paket_id' => $request->id
                        ]);
                    }
                }
            }
        }

        //update paket kuliner
        if ($request->kuliner != null && $request->idKuliner != null) {
            tb_datakuliner::where('id', $request->idKuliner)->update([
                'paket_id' => $request->id,
                'data_paket_kuliner_id' => $request->kuliner
            ]);
        }
        if ($request->idKuliner == null && $request->kuliner != null) {
            // dd($request->all());
            tb_datakuliner::create([
                'paket_id' => $request->id,
                'data_paket_kuliner_id' => $request->kuliner
            ]);
        }

        if ($request->kuliner == null && $request->idKuliner != null) {
            $data = tb_datakuliner::where('id', $request->idKuliner);
            $data->delete();
        }

        //update data penginapan
        $dataPenginapan = [];
        if ($request->idPenginapan != null && $request->kamar != null && $request->hotel != null && $request->villa != null) {
            foreach ($request->idPenginapan as $id) {
                array_push($dataPenginapan, tb_paketpenginapan::where('id', $id)->first());
            }

            if (count($request->idPenginapan) > 1) {
                for ($i = 0; $i < count($request->idPenginapan); $i++) {
                    if ($dataPenginapan[$i]->villa_id != null) {
                        tb_paketpenginapan::where('id', $request->idPenginapan[$i])->update([
                            'paket_id' =>  $request->id,
                            'villa_id' => $request->villa
                        ]);
                    } else if ($dataPenginapan[$i]->hotel_id != null) {
                        tb_paketpenginapan::where('id', $request->idPenginapan[$i])->update([
                            'paket_id' =>  $request->id,
                            'hotel_id' => $request->hotel,
                            'kamar_id' => $request->kamar
                        ]);
                    }
                }
            } else if (count($request->idPenginapan) == 1) {
                $cekHotelorVila = tb_paketpenginapan::where('id', $request->idPenginapan[0])->first();

                if ($cekHotelorVila->villa_id != null) {
                    $cekHotelorVila->update([
                        'paket_id' =>  $request->id,
                        'villa_id' => $request->villa
                    ]);
                    tb_paketpenginapan::create([
                        'paket_id' =>  $request->id,
                        'hotel_id' => $request->hotel,
                        'kamar_id' => $request->kamar
                    ]);
                } else if ($cekHotelorVila->hotel_id != null) {
                    $cekHotelorVila->update([
                        'paket_id' =>  $request->id,
                        'hotel_id' => $request->hotel,
                        'kamar_id' => $request->kamar
                    ]);
                    tb_paketpenginapan::create([
                        'paket_id' =>  $request->id,
                        'villa_id' => $request->villa
                    ]);
                }
            }
        } else if ($request->idPenginapan == null && $request->villa != null && $request->kamar != null && $request->hotel != null) {
            tb_paketpenginapan::create([
                'paket_id' =>  $request->id,
                'hotel_id' => $request->hotel,
                'kamar_id' => $request->kamar
            ]);
            tb_paketpenginapan::create([
                'paket_id' =>  $request->id,
                'villa_id' => $request->villa
            ]);
        } else if ($request->idPenginapan == null && $request->villa != null && $request->kamar == null && $request->hotel == null) {
            tb_paketpenginapan::create([
                'paket_id' =>  $request->id,
                'villa_id' => $request->villa
            ]);
        } else if ($request->idPenginapan == null &&  $request->villa == null && $request->kamar != null && $request->hotel != null) {
            tb_paketpenginapan::create([
                'paket_id' =>  $request->id,
                'hotel_id' => $request->hotel,
                'kamar_id' => $request->kamar
            ]);
        } else if ($request->idPenginapan != null && $request->kamar == null && $request->hotel == null) {

            $dataPenginapan = [];
            for ($i = 0; $i < count($request->idPenginapan); $i++) {
                array_push($dataPenginapan, tb_paketpenginapan::where('id', $request->idPenginapan[$i])->first());
            }

            foreach ($dataPenginapan as $data) {
                if ($data->kamar_id != null && $data->hotel_id != null) {
                    $data->delete();
                }
            }
        } else if ($request->idPenginapan != null && $request->villa == null) {
            $dataPenginapan = [];
            for ($i = 0; $i < count($request->idPenginapan); $i++) {
                array_push($dataPenginapan, tb_paketpenginapan::where('id', $request->idPenginapan[$i])->first());
            }

            foreach ($dataPenginapan as $data) {
                if ($data->villa_id != null) {
                    $data->delete();
                }
            }
        }

        return redirect(route('budget.index'));
    }

    public function updateStatusTransaksi(Request $request)
    {
        if ($request->status == 3) {
            BookingPaket::where('id', $request->id)->update([
                'status' => $request->status,
                'bayar' => Carbon::now()
            ]);
        } else if ($request->status == 4) {
            BookingPaket::where('id', $request->id)->update([
                'status' => $request->status,
                'checkin' => Carbon::now()
            ]);
        } else if ($request->status == 0) {
            BookingPaket::where('id', $request->id)->update([
                'status' => $request->status,
                'batal' => Carbon::now()
            ]);
        } else if ($request->status == 5) {
            BookingPaket::where('id', $request->id)->update([
                'status' => $request->status,
                'checkout' => Carbon::now()
            ]);
        } else {
            BookingPaket::where('id', $request->id)->update(['status' => $request->status]);
        }
        return redirect(route('budget.index'));
    }

    // public function pesanpaket(Request $request, $jml_orang, $id, $harga, $nama_paket, $jml_hari, $email,  $telp, $tgl_buka, $tgl_tutup)
    // {
    //     $jamsekarang = Carbon::now();
    //     $user_paket = tb_paket::where('id', $id)->first();
    //     $user_pakett = $user_paket->user_id;
    //     $users = User::where('id', $user_pakett)->first();
    //     $dt = Tempat::where('user_id', $users->petugas_id)->first();
    //     $tempat_id = $dt->id;
    //     // $harga = array();
    //     // foreach ($request->harga)
    //     $totalbiaya = $jml_orang * $jml_hari * $harga;

    //     $nama = auth()->user()->name;
    //     $now_tgl = Carbon::now()->format('d');

    //     $datatiket = BookingPaket::max('id');
    //     $urutantiket = (int)($datatiket);
    //     $urutantiket++;
    //     $huruftiket =  "LP-";
    //     // $kode_booking = $huruftiket . $urutantiket . uniqid();
    //     $kode_tiket = $huruftiket . $urutantiket . $now_tgl;
    //     $kode_booking = $request->kode_booking;
    //     // dd($totalbiaya);

    //     BookingPaket::create([
    //         'kode_tiket' => $kode_tiket,
    //         'kode_booking' => $kode_booking,
    //         'name' => $nama,
    //         'email' => $email,
    //         'telp' => $telp,
    //         'jml_orang' => $jml_orang,
    //         'jml_hari' => $jml_hari,
    //         'totalbiaya' => $totalbiaya,
    //         'paket_id' => $id,
    //         'status' => '1',
    //     ]);
    //     $kode_peserta = array();
    //     $nama_peserta = array();
    //     $email = array();
    //     $telp = array();
    //     foreach ($request->kode_peserta as $k) {
    //         array_push($kode_peserta, $k);
    //     }
    //     foreach ($request->nama_peserta as $n) {
    //         array_push($nama_peserta, $n);
    //     }
    //     foreach ($request->email as $e) {
    //         array_push($email, $e);
    //     }
    //     foreach ($request->telp as $t) {
    //         array_push($telp, $t);
    //     }

    //     for ($i = 0; $i < $jml_orang; $i++) {
    //         $peserta = new PesertaPaket();
    //         $peserta->kode_peserta = $kode_peserta[$i];
    //         $peserta->kode_booking = $kode_booking;
    //         $peserta->nama_peserta = $nama_peserta[$i];
    //         $peserta->email = $email[$i];
    //         $peserta->telp = $telp[$i];
    //         $peserta->paket_id = $id;
    //         $peserta->save();
    //     }

    //     $formatted_dt1 = Carbon::parse($tgl_buka);
    //     $formatted_dt2 = Carbon::parse($tgl_tutup);
    //     $durasi = $formatted_dt1->diffInDays($formatted_dt2);

    //     Detail_transaksi::create([
    //         "name" => "Paket $nama_paket",
    //         "durasi" => $durasi + 1,
    //         "tanggal_a" => $tgl_buka,
    //         "tanggal_b" => $tgl_tutup,
    //         "user_id" => Auth::user()->id,
    //         "kode_tiket" => $kode_tiket,
    //         "id_produk" => $id,
    //         "booking_id" => $kode_booking,
    //         "jumlah" => $jml_orang,
    //         "harga" => $totalbiaya,
    //         "kategori" => "events",
    //         "tempat_id" => $tempat_id,
    //     ]);

    //     if ($totalbiaya <= 0) {
    //         Tiket::create([
    //             'kode' => $kode_tiket,
    //             'check' => 'settlement',
    //             'name' => Auth::user()->name,
    //             'email' => Auth::user()->email,
    //             'telp' => Auth::user()->telp,
    //             'harga' => $totalbiaya,
    //             'status' => 1,
    //             "tempat_id" => $tempat_id,
    //         ]);
    //         Pay::create([
    //             'id' => $kode_tiket,
    //             'status_message' => 'settlement',
    //             'order_id' => $kode_tiket,
    //             'payment_type' => 'gratis',
    //             'transaction_time' => $jamsekarang,
    //             'transaction_status' => 'settlement',
    //             'va_bank' => null,
    //             'va_number' => null,
    //             'kodeku' => $kode_tiket,
    //         ]);
    //         $detail = Detail_transaksi::where('kode_tiket', $kode_booking)->get();
    //         foreach ($detail as $dt => $detail) {
    //             $detail->status = 1;
    //             $detail->save();
    //         }
    //         $paketkeg = tb_paket::where('id', $detail->id_produk)->first();
    //         $paketkeg->kapasitas_akhir += (int)$detail->jumlah;
    //         $paketkeg->save();

    //         $review = new ReviewPaket();
    //         $review->kode_tiket = $kode_tiket;
    //         $review->save();
    //         Toastr::success('Berhasil pesan, gratis bisa langsung cetak invoice :) ', 'Success');
    //     } elseif ($totalbiaya > 0) {
    //         Tiket::create([
    //             'kode' => $kode_tiket,
    //             'user_id' => Auth::user()->id,
    //             'name' => Auth::user()->name,
    //             'email' => Auth::user()->email,
    //             'telp' => Auth::user()->telp,
    //             'harga' => $totalbiaya,
    //             "tempat_id" => $tempat_id,
    //         ]);
    //         Toastr::success('Berhasil pesan, silahkan cek detail pesanan dan lakukan pembayaran :) ', 'Success');
    //     }
    //     return redirect("pesananku");
    // }
}