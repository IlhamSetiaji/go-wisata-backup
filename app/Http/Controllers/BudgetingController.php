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
use App\Models\Villa;
use App\Models\Wahana;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BudgetingController extends Controller
{
    public function index()
    {
        $dataPaket = tb_paket::all();
        return view('admin.budgeting.index', [
            'pakets' => $dataPaket
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
            'kategoriPakets' => $kategoriPakets
        ]);
    }

    public function getMenu(Request $request)
    {
        // $data = Kuliner::where('tempat_id', $request->resto_id)->get();
        $datas = DataPaketKuliner::where('tempat_id', $request->resto_id)->get();
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
        if ($request->data_wisata[0] != null) {
            for ($i = 0; $i < count($request->data_wisata); $i++) {
                if ($request->data_wisata[$i] != '') {
                    array_push($arrDataWisata, Tempat::where('id', $request->data_wisata[$i])->first());
                }
            }
        }

        // $arrDataPenginapanHotel = [];
        // if ($request->data_penginapanhotel[0] != null) {
        //     for ($i = 0; $i < count($request->data_penginapanhotel); $i++) {
        //         if ($request->data_penginapanhotel[$i] != '') {
        //             array_push($arrDataPenginapanHotel, Hotel::where('id', $request->data_penginapanhotel[$i])->first());
        //         }
        //     }
        // }

        // $arrKamarHotel = [];
        // for ($i = 0; $i < count($arrDataPenginapanHotel); $i++) {
        //     array_push($arrKamarHotel, Kamar::where('hotel_id', $arrDataPenginapanHotel[$i]->id)->get());
        // }
        $hotel = '';
        $kamar = '';

        if ($request->data_penginapan != null && $request->kamar != null) {
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

        $kuliners = DataPaketKuliner::where('id', $request->paketresto)->where('status', 1)->first();

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

        if ($kuliners != null) {

            $totalHarga += $kuliners->harga;
        }

        return view('admin.budgeting.detail', [
            'paket' => $validateDataPaket,
            'wisatas' => $arrDataWisata,
            'hotels' => $hotel,
            'villas' => $arrDataPenginapanVilla,
            // 'kamars' => $arrKamarHotel,
            'kuliners' => $kuliners,
            'kamars' => $kamar,
            'total' => $totalHarga
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->data_kamar);

        //validate form
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required',
            'jml_hari' => 'required|integer',
            'jml_orang' => 'required|integer',
            'harga' => 'required|integer'
        ]);
        $validateDataPaket['id_desa'] = Auth::user()->tempat_id;
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
        // $dataPenginapan = Tempat::where('kategori', 'penginapan')->where('status', 1)->where('induk_id', $idTempat)->get();

        //get spesific data paket from database 
        $paket = tb_paket::where('id', $id)->first();
        $paketWisata = tb_paketwisata::where('paket_id', $id)->get();
        $paketKategori = tb_paketkategoriwisata::where('paket_id', $id)->get();
        $paketMenu = DB::table('data_paket_kuliners')->join('tb_datakuliners', 'data_paket_kuliners.id', 'tb_datakuliners.data_paket_kuliner_id')->where('tb_datakuliners.paket_id', $id)->first();
        $paketResto = tb_datakuliner::where('paket_id', $id)->first();
        $idTempatResto = DB::table('tb_pakets')->join('tb_datakuliners', 'tb_pakets.id', 'tb_datakuliners.paket_id')->join('data_paket_kuliners', 'tb_datakuliners.data_paket_kuliner_id', 'data_paket_kuliners.id')->select('data_paket_kuliners.tempat_id')->first();
        $dataMenu = DataPaketKuliner::where('tempat_id', $idTempatResto->tempat_id)->get();

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


        // dd($hotel);
        // dd($kamar);
        // dd($dataIdPenginapan);
        return view('admin.budgeting.edit', [
            'dataDesa' => $dataDesa,
            'dataWisatas' => $dataWisata,
            'dataHotels' => $dataHotel,
            'dataVilla' => $dataVilla,
            'dataKamar' => $dataKamarHotel,
            'dataKuliners' => $dataKuliner,
            'paket' => $paket,
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
        $tampilKategori = [];
        if ($request->data_penginapanhotel != null) {
            $tampilHotel = Hotel::where('id', $request->data_penginapanhotel)->first();
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
            'id' => $request->id,
            'dataWisata' => $dataWisata,
            'dataIdWisata' => $dataIdWisata,
            'dataKategori' => $dataUtamaPaket['kategori'],
            'dataKamar' => $request->kamar,
            'dataHotel' => $request->data_penginapanhotel,
            'dataVilla' => $request->data_penginapanvilla,
            'dataKuliner' => $request->paketresto,
            'dataIdKuliner' => $request->id_paketkuliner,
            'dataIdPenginapan' => $request->idPenginapan
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

        //update data tb_paket
        tb_paket::where('id', $request->id)->update($validateDataPaket);


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
        if ($request->kuliner != null) {
            tb_datakuliner::where('id', $request->idKuliner)->update([
                'paket_id' => $request->id,
                'data_paket_kuliner_id' => $request->kuliner
            ]);
        }
        if ($request->idKuliner == null && $request->kuliner != null) {
            tb_datakuliner::create([
                'paket_id' => $request->id,
                'data_paket_kuliner_id' => $request->kuliner
            ]);
        }

        if ($request->kuliner == null) {
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

        // dd($dataPenginapan[0]->hotel_id);


        //update data paket wisata
        // $dataPaketWisata = [];
        // $dataPaketWisataBaru = [];
        // if ($request->data_wisata[0] != '') {
        //     $dataIdPaketWisata = $request->id_paketWisata;
        //     for ($i = 0; $i < count($dataIdPaketWisata); $i++) {
        //         if ($request->data_wisata[$i] != '') {
        //             array_push($dataPaketWisata, $request->data_wisata[$i]);
        //         }
        //     }

        //     if (count($request->data_wisata) > count($dataIdPaketWisata)) {
        //         for ($i = count($dataIdPaketWisata); $i < count($request->data_wisata); $i++) {
        //             if ($request->data_wisata[$i] != '') {
        //                 array_push($dataPaketWisataBaru, $request->data_wisata[$i]);
        //             }
        //         }

        //         //update new data
        //         for ($i = 0; $i < count($dataPaketWisataBaru); $i++) {
        //             tb_paketwisata::create(
        //                 [
        //                     'tempat_id' => $dataPaketWisataBaru[$i],
        //                     'paket_id' => $request->id
        //                 ]
        //             );
        //         }
        //     }

        //     //update old data paket wisata
        //     for ($i = 0; $i < count($dataPaketWisata); $i++) {
        //         tb_paketwisata::where('id', $dataIdPaketWisata[$i])->update(['tempat_id' => $dataPaketWisata[$i]]);
        //     }
        // }

        // //update data penginapan
        // $dataPaketPenginapan = [];
        // $dataPaketPenginapanBaru = [];
        // if ($request->data_penginapan[0] != '') {
        //     $dataIdPenginapan = $request->id_paketPenginapan;
        //     for ($i = 0; $i < count($dataIdPenginapan); $i++) {
        //         if ($request->data_penginapan[$i] != '') {
        //             array_push($dataPaketPenginapan, $request->data_penginapan[$i]);
        //         }
        //     }

        //     if (count($request->data_penginapan) > count($dataIdPenginapan)) {
        //         for ($i = count($dataIdPenginapan); $i < count($request->data_penginapan); $i++) {
        //             if ($request->data_penginapan[$i] != '') {
        //                 array_push($dataPaketPenginapanBaru, $request->data_penginapan[$i]);
        //             }
        //         }

        //         //update new data
        //         for ($i = 0; $i < count($dataPaketPenginapanBaru); $i++) {
        //             tb_paketpenginapan::create(
        //                 [
        //                     'tempat_id' => $dataPaketPenginapanBaru[$i],
        //                     'paket_id' => $request->id
        //                 ]
        //             );
        //         }
        //     }

        //     //update old data paket penginapan
        //     for ($i = 0; $i < count($dataPaketPenginapan); $i++) {
        //         tb_paketpenginapan::where('id', $dataIdPenginapan[$i])->update(['tempat_id' => $dataPaketPenginapan[$i]]);
        //     }
        // }

        return redirect(route('budget.index'));
    }
}