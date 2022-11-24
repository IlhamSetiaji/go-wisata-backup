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
        $dataWahana = Wahana::where('tempat_id', $idTempat)->where('status', 1)->get();
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
            'dataWahanas' => $dataWahana,
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

        // $arrKategoriPaket = [];
        // for ($i = 0; $i < count($validateDataPaket['kategori']); $i++) {
        //     array_push($arrKategoriPaket, tb_kategoriwisata::where('id', $validateDataPaket['kategori'][$i])->first());
        // }

        //get data wisata
        $arrDataWisata = [];
        if ($request->data_wisata[0] != null) {
            for ($i = 0; $i < count($request->data_wisata); $i++) {
                if ($request->data_wisata[$i] != '') {
                    array_push($arrDataWisata, Tempat::where('id', $request->data_wisata[$i])->first());
                }
            }
        }

        //get data wisata
        $arrDataWahana = [];
        if ($request->data_wahana[0] != null) {
            for ($i = 0; $i < count($request->data_wahana); $i++) {
                if ($request->data_wahana[$i] != '') {
                    array_push($arrDataWahana, Wahana::where('id', $request->data_wahana[$i])->first());
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
        $hotel = Hotel::where('id', $request->data_penginapanhotel)->first();
        $kamar = Kamar::where('id', $request->kamar)->first();
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


        // $kuliners = DataPaketKuliner::where('data_paket_kuliners.id', $request->paketresto)->join('tb_paketkuliners', 'data_paket_kuliners.id', 'tb_paketkuliners.data_paket_kuliner_id')->get();
        $kuliners = DataPaketKuliner::where('id', $request->paketresto)->first();
        // dd($kuliners);

        //get harga
        $totalHarga = 0;
        foreach ($arrDataWisata as $data) {
            if ($data->htm != null) {
                $totalHarga += $data->htm;
            }
        }
        foreach ($arrDataWahana as $data) {
            $totalHarga += $data->harga;
        }
        foreach ($arrDataPenginapanVilla as $data) {
            $totalHarga += $data->harga;
        }

        $totalHarga += $kamar->harga;
        $totalHarga += $kuliners->harga;
        // dd($totalHarga);

        // dd($totalHarga);

        return view('admin.budgeting.detail', [
            'paket' => $validateDataPaket,
            'wisatas' => $arrDataWisata,
            'wahanas' => $arrDataWahana,
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
        // dd($request->data_kategori[0]);

        //validate form
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required',
            // 'id_kategori' => 'required',
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
            // 'id_kategori' => $request->id_kategori,
            'jml_hari' =>  $request->jml_hari,
            'jml_orang' => $request->jml_orang,
            'id_desa' => Auth::user()->tempat_id,
            'harga' => $request->harga
        ])->pluck('id')->first();

        //insert data_wisata to tb_paketwisata
        if ($request->data_wisata == null) {
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

        //insert data_wahana to tb_paketwahanas
        if ($request->data_wahana != null) {
            $temp_array = array();
            for ($i = 0; $i < count($request->data_wahana); $i++) {
                if ($request->data_wahana[$i] != '') {
                    array_push($temp_array, $request->data_wahana[$i]);
                }
            }

            for ($i = 0; $i < count($temp_array); $i++) {
                tb_paketwahana::create(
                    [
                        'tempat_id' => $temp_array[$i],
                        'paket_id' => $idPaket
                    ]
                );
            }
        }
        //penginapan hotel
        if ($request->data_hotel != null && $request->data_kamar != null) {
            tb_paketpenginapan::create([
                'paket_id' => $idPaket,
                'hotel_id' => $request->data_hotel,
                'kamar_id' => $request->kamar
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

    public function getPaket(Request $request)
    {
        // $dataPaket = tb_paket::where('id', $request->paket_id)->pluck('id')->first();
        $paketWisata = tb_paketwisata::where('paket_id', $request->paket_id)->get();
        $paketWahana = tb_paketwisata::where('paket_id', $request->paket_id)->get();
        // $response = '<p>PPPPPPPPPPPPPPPP</p>';
        $response = '';
        $response .= '<p>' . $paketWisata . '<p>';
        // if (count($paketWisata) > 0) {
        //     foreach ($paketWisata as $paket) {
        //     }
        // }

        echo $request->paket_id;
    }

    public function edit($id)
    {
        //get data from database
        $dataDesa = Auth::user();
        $kategoriPakets = tb_kategoriwisata::all();
        $idTempat = $dataDesa->tempat_id;
        $dataWisata = Tempat::where('kategori', 'wisata')->where('status', 1)->where('induk_id', $idTempat)->get();
        $dataWahana = Wahana::where('tempat_id', $idTempat)->where('status', 1)->get();
        $dataPenginapan = Tempat::where('kategori', 'penginapan')->where('status', 1)->where('induk_id', $idTempat)->get();

        //get spesific data paket from database 
        $paket = tb_paket::where('id', $id)->first();
        $paketWisata = tb_paketwisata::where('paket_id', $id)->get();
        $paketWahana = tb_paketwahana::where('paket_id', $id)->get();
        $paketPenginapan = tb_paketpenginapan::where('paket_id', $id)->get();

        return view('admin.budgeting.edit', [
            'dataDesa' => $dataDesa,
            'dataWisatas' => $dataWisata,
            'dataWahanas' => $dataWahana,
            'dataPenginapans' => $dataPenginapan,
            'kategoriPakets' => $kategoriPakets,
            'paket' => $paket,
            'paketWisatas' => $paketWisata,
            'paketWahanas' => $paketWahana,
            'paketPenginapans' => $paketPenginapan,
        ]);
    }

    public function updatePaket(Request $request)
    {
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required|max:255',
            'id_desa' => 'required',
            'id_kategori' => 'required',
            'jml_hari' => 'required|integer',
            'jml_orang' => 'required|integer',
            'harga' => 'required|integer'
        ]);

        //update data tb_paket
        tb_paket::where('id', $request->id)->update($validateDataPaket);

        //update data paket wisata
        $dataPaketWisata = [];
        $dataPaketWisataBaru = [];
        if ($request->data_wisata[0] != '') {
            $dataIdPaketWisata = $request->id_paketWisata;
            for ($i = 0; $i < count($dataIdPaketWisata); $i++) {
                if ($request->data_wisata[$i] != '') {
                    array_push($dataPaketWisata, $request->data_wisata[$i]);
                }
            }

            if (count($request->data_wisata) > count($dataIdPaketWisata)) {
                for ($i = count($dataIdPaketWisata); $i < count($request->data_wisata); $i++) {
                    if ($request->data_wisata[$i] != '') {
                        array_push($dataPaketWisataBaru, $request->data_wisata[$i]);
                    }
                }

                //update new data
                for ($i = 0; $i < count($dataPaketWisataBaru); $i++) {
                    tb_paketwisata::create(
                        [
                            'tempat_id' => $dataPaketWisataBaru[$i],
                            'paket_id' => $request->id
                        ]
                    );
                }
            }

            //update old data paket wisata
            for ($i = 0; $i < count($dataPaketWisata); $i++) {
                tb_paketwisata::where('id', $dataIdPaketWisata[$i])->update(['tempat_id' => $dataPaketWisata[$i]]);
            }
        }


        //update data wahana
        $dataPaketWahana = [];
        $dataPaketWahanaBaru = [];
        if ($request->data_wahana[0] != '') {
            $dataIdWahana = $request->id_paketWahana;
            for ($i = 0; $i < count($dataIdWahana); $i++) {
                if ($request->data_wahana[$i] != '') {
                    array_push($dataPaketWahana, $request->data_wahana[$i]);
                }
            }

            if (count($request->data_wahana) > count($dataIdWahana)) {
                for ($i = count($dataIdWahana); $i < count($request->data_wahana); $i++) {
                    if ($request->data_wahana[$i] != '') {
                        array_push($dataPaketWahanaBaru, $request->data_wahana[$i]);
                    }
                }

                //update new data
                for ($i = 0; $i < count($dataPaketWahanaBaru); $i++) {
                    tb_paketwahana::create(
                        [
                            'tempat_id' => $dataPaketWahanaBaru[$i],
                            'paket_id' => $request->id
                        ]
                    );
                }
            }

            //update old data paket wahana
            for ($i = 0; $i < count($dataPaketWahana); $i++) {
                tb_paketwahana::where('id', $dataIdWahana[$i])->update(['tempat_id' => $dataPaketWahana[$i]]);
            }
        }

        //update data penginapan
        $dataPaketPenginapan = [];
        $dataPaketPenginapanBaru = [];
        if ($request->data_penginapan[0] != '') {
            $dataIdPenginapan = $request->id_paketPenginapan;
            for ($i = 0; $i < count($dataIdPenginapan); $i++) {
                if ($request->data_penginapan[$i] != '') {
                    array_push($dataPaketPenginapan, $request->data_penginapan[$i]);
                }
            }

            if (count($request->data_penginapan) > count($dataIdPenginapan)) {
                for ($i = count($dataIdPenginapan); $i < count($request->data_penginapan); $i++) {
                    if ($request->data_penginapan[$i] != '') {
                        array_push($dataPaketPenginapanBaru, $request->data_penginapan[$i]);
                    }
                }

                //update new data
                for ($i = 0; $i < count($dataPaketPenginapanBaru); $i++) {
                    tb_paketpenginapan::create(
                        [
                            'tempat_id' => $dataPaketPenginapanBaru[$i],
                            'paket_id' => $request->id
                        ]
                    );
                }
            }

            //update old data paket penginapan
            for ($i = 0; $i < count($dataPaketPenginapan); $i++) {
                tb_paketpenginapan::where('id', $dataIdPenginapan[$i])->update(['tempat_id' => $dataPaketPenginapan[$i]]);
            }
        }

        return redirect(route('budget.index'));
    }
}