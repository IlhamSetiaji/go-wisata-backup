<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tb_kategoriwisata;
use App\Models\tb_paket;
use App\Models\tb_paketpenginapan;
use App\Models\tb_paketwahana;
use App\Models\tb_paketwisata;
use App\Models\Tempat;
use App\Models\Wahana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dataPenginapan = Tempat::where('kategori', 'penginapan')->where('status', 1)->where('induk_id', $idTempat)->get();
        $kategoriPakets = tb_kategoriwisata::all();

        // dd($dataWahana);
        return view('admin.budgeting.create', [
            'dataDesa' => $dataDesa,
            'dataWisatas' => $dataWisata,
            'dataWahanas' => $dataWahana,
            'dataPenginapans' => $dataPenginapan,
            'kategoriPakets' => $kategoriPakets
        ]);
    }

    public function store(Request $request)
    {
        //validate form
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required|max:255',
            'id_desa' => 'required',
            'id_kategori' => 'required',
            'jml_hari' => 'required|integer',
            'jml_orang' => 'required|integer',
            'harga' => 'required|integer'
        ]);

        //insert data to tb_paket 
        tb_paket::create($validateDataPaket);

        //get id paket 
        $idPaket = tb_paket::where([
            'nama_paket' => $request->nama_paket,
            'id_kategori' => $request->id_kategori,
            'jml_hari' =>  $request->jml_hari,
            'jml_orang' => $request->jml_orang,
            'id_desa' => $request->id_desa,
            'harga' => $request->harga
        ])->pluck('id')->first();

        //insert data_wisata to tb_paketwisata
        if ($request->data_wisata[0] != null) {
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

        //insert data_wahana to tb_paketwahanas
        if ($request->data_wahana[0] != null) {
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

        //insert data_penginapan to tb_paketpenginapan
        if ($request->data_penginapan[0] != null) {
            $temp_array = array();
            for ($i = 0; $i < count($request->data_penginapan); $i++) {
                if ($request->data_penginapan[$i] != '') {
                    array_push($temp_array, $request->data_penginapan[$i]);
                }
            }

            for ($i = 0; $i < count($temp_array); $i++) {
                tb_paketpenginapan::create(
                    [
                        'tempat_id' => $temp_array[$i],
                        'paket_id' => $idPaket
                    ]
                );
            }
        }

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

        // dd($paketPenginapan);

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

            //update old data
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

            //update old data
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
            // dd($dataIdPenginapan);

            //update old data
            for ($i = 0; $i < count($dataPaketPenginapan); $i++) {
                tb_paketpenginapan::where('id', $dataIdPenginapan[$i])->update(['tempat_id' => $dataPaketPenginapan[$i]]);
            }
        }

        return redirect(route('budget.index'));
    }
}