<?php

namespace App\Http\Controllers;

use App\Models\tb_paketkuliner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storetb_paketkulinerRequest;
use App\Http\Requests\Updatetb_paketkulinerRequest;
use App\Models\DataPaketKuliner;
use Illuminate\Http\Request;

use App\Models\Kuliner;
use App\Models\tb_paket;
// use Clockwork\Request\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TbPaketkulinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd();
        $makanan = Kuliner::where('tempat_id', Auth::user()->tempat_id)->where('status', 1)->where('kategori', 'makan')->get();
        $minum = Kuliner::where('tempat_id', Auth::user()->tempat_id)->where('status', 1)->where('kategori', 'minum')->get();
        $snack = Kuliner::where('tempat_id', Auth::user()->tempat_id)->where('status', 1)->where('kategori', 'snack')->get();
        return view('kuliner.kuliner.paket.create', [
            'makans' => $makanan,
            'minums' => $minum,
            'snacks' => $snack
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storetb_paketkulinerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get all data makanan minumaman snack
        $arrMakanan = [];
        if ($request->makan[0] != null) {
            for ($i = 0; $i < count($request->makan); $i++) {
                if ($request->makan[$i] != null) {
                    array_push($arrMakanan, $request->makan[$i]);
                }
            }
        }
        if ($request->minum[0] != null) {
            for ($i = 0; $i < count($request->minum); $i++) {
                if ($request->minum[$i] != null) {
                    array_push($arrMakanan, $request->minum[$i]);
                }
            }
        }
        if ($request->snack[0] != null) {
            for ($i = 0; $i < count($request->snack); $i++) {
                if ($request->snack[$i] != null) {
                    array_push($arrMakanan, $request->snack[$i]);
                }
            }
        }

        // dd($arrMakanan);
        //get data harga
        $harga = 0;
        foreach ($arrMakanan as $makan) {
            $harga += Kuliner::where('id', $makan)->pluck('harga')->first();
        }
        $validateDataPaket = $request->validate([
            'nama_paket' => 'required'
        ]);
        $validateDataPaket['harga'] = $harga;
        $validateDataPaket['status'] = 1;
        $validateDataPaket['tempat_id'] = Auth::user()->tempat_id;

        //insert data
        DataPaketKuliner::create($validateDataPaket);
        //get id
        // dd(Auth::user());
        $idPaket = DataPaketKuliner::where([
            'nama_paket' => $request->nama_paket,
            'harga' => $harga,
            'tempat_id' => Auth::user()->tempat_id
        ])->pluck('id')->first();

        // dd($arrMakanan);
        // insert data
        foreach ($arrMakanan as $makan) {
            tb_paketkuliner::create([
                'tb_kuliner_id' => $makan,
                'data_paket_kuliner_id' => $idPaket
            ]);
        }

        return redirect(route('kuliner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tb_paketkuliner  $tb_paketkuliner
     * @return \Illuminate\Http\Response
     */
    public function show(tb_paketkuliner $tb_paketkuliner)
    {
        //
    }


    public function edit($id)
    {
        //data paket
        $dataPaket = DataPaketKuliner::where('id', $id)->first();
        $detailPaketMakanan = DB::table('tb_paketkuliners')->join('tb_kuliner', 'tb_paketkuliners.tb_kuliner_id', 'tb_kuliner.id')->where('tb_kuliner.kategori', 'makan')->where('data_paket_kuliner_id', $dataPaket->id)->select('tb_paketkuliners.id', 'tb_paketkuliners.tb_kuliner_id', 'tb_paketkuliners.data_paket_kuliner_id', 'tb_kuliner.name', 'tb_kuliner.harga')->get();
        $detailPaketMinum = DB::table('tb_paketkuliners')->join('tb_kuliner', 'tb_paketkuliners.tb_kuliner_id', 'tb_kuliner.id')->where('tb_kuliner.kategori', 'minum')->where('data_paket_kuliner_id', $dataPaket->id)->select('tb_paketkuliners.id', 'tb_paketkuliners.tb_kuliner_id', 'tb_paketkuliners.data_paket_kuliner_id', 'tb_kuliner.name', 'tb_kuliner.harga')->get();
        $detailPaketSnack = DB::table('tb_paketkuliners')->join('tb_kuliner', 'tb_paketkuliners.tb_kuliner_id', 'tb_kuliner.id')->where('tb_kuliner.kategori', 'snack')->where('data_paket_kuliner_id', $dataPaket->id)->select('tb_paketkuliners.id', 'tb_paketkuliners.tb_kuliner_id', 'tb_paketkuliners.data_paket_kuliner_id', 'tb_kuliner.name', 'tb_kuliner.harga')->get();


        //all data
        $makanan = Kuliner::where('tempat_id', Auth::user()->tempat_id)->where('status', 1)->where('kategori', 'makan')->get();
        $minum = Kuliner::where('tempat_id', Auth::user()->tempat_id)->where('status', 1)->where('kategori', 'minum')->get();
        $snack = Kuliner::where('tempat_id', Auth::user()->tempat_id)->where('status', 1)->where('kategori', 'snack')->get();

        // dd($detailPaketMakanan);
        return view('kuliner.kuliner.paket.edit', [
            'paket' => $dataPaket,
            'paketMakanan' => $detailPaketMakanan,
            'paketMinum' => $detailPaketMinum,
            'paketSnack' => $detailPaketSnack,
            'makans' => $makanan,
            'minums' => $minum,
            'snacks' => $snack
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetb_paketkulinerRequest  $request
     * @param  \App\Models\tb_paketkuliner  $tb_paketkuliner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //update data makanan
        $dataMakananBaru = [];
        if ($request->makan != null) {
            $dataIdMakanan = $request->id_paketMakan;

            //update old data
            for ($i = 0; $i < count($dataIdMakanan); $i++) {
                //check makanan null or not if null data will deleted
                if ($dataIdMakanan[$i] != null && $request->makan[$i] == null) {
                    $data = tb_paketkuliner::find($dataIdMakanan[$i]);
                    $data->delete();
                }
                if ($dataIdMakanan[$i] != null && $request->makan[$i] != null) {
                    tb_paketkuliner::where('id', $dataIdMakanan[$i])->update([
                        'tb_kuliner_id' => $request->makan[$i]
                    ]);
                }
            }
            
            //update new data
            for ($i = count($dataIdMakanan); $i < count($request->makan); $i++) {
                if ($request->makan[$i] != null) {
                    array_push($dataMakananBaru, $request->makan[$i]);
                }
            }

            if (count($request->makan) > count($dataIdMakanan)) {
                foreach ($dataMakananBaru as $makan) {
                    tb_paketkuliner::create([
                        'tb_kuliner_id' => $makan,
                        'data_paket_kuliner_id' => $request->id_paket
                    ]);
                }
            }
        }
        
        //update data mainum
        $dataMinumanBaru = [];
        if ($request->minum != null) {
            $dataIdMinum = $request->id_paketMinum;

            //update old data
            for ($i = 0; $i < count($dataIdMinum); $i++) {
                //check makanan null or not if null data will deleted
                if ($dataIdMinum[$i] != null && $request->minum[$i] == null) {
                    $data = tb_paketkuliner::find($dataIdMinum[$i]);
                    $data->delete();
                }
                if ($dataIdMinum[$i] != null && $request->minum[$i] != null) {
                    tb_paketkuliner::where('id', $dataIdMinum[$i])->update([
                        'tb_kuliner_id' => $request->minum[$i]
                    ]);
                }
            }
            
            //update new data
            for ($i = count($dataIdMinum); $i < count($request->minum); $i++) {
                if ($request->minum[$i] != null) {
                    array_push($dataMinumanBaru, $request->minum[$i]);
                }
            }

            if (count($request->minum) > count($dataIdMinum)) {
                foreach ($dataMinumanBaru as $minum) {
                    tb_paketkuliner::create([
                        'tb_kuliner_id' => $minum,
                        'data_paket_kuliner_id' => $request->id_paket
                    ]);
                }
            }
        }
        
        //update snack
        $dataSnackBaru = [];
        if ($request->snack != null) {
            $dataIdSnack = $request->id_paketSnack;

            //update old data
            for ($i = 0; $i < count($dataIdSnack); $i++) {
                //check makanan null or not if null data will deleted
                if ($dataIdSnack[$i] != null && $request->snack[$i] == null) {
                    $data = tb_paketkuliner::find($dataIdSnack[$i]);
                    $data->delete();
                }
                if ($dataIdSnack[$i] != null && $request->snack[$i] != null) {
                    tb_paketkuliner::where('id', $dataIdSnack[$i])->update([
                        'tb_kuliner_id' => $request->snack[$i]
                    ]);
                }
            }
            
            //update new data
            for ($i = count($dataIdSnack); $i < count($request->snack); $i++) {
                if ($request->snack[$i] != null) {
                    array_push($dataSnackBaru, $request->snack[$i]);
                }
            }

            if (count($request->snack) > count($dataIdSnack)) {
                foreach ($dataSnackBaru as $snack) {
                    tb_paketkuliner::create([
                        'tb_kuliner_id' => $snack,
                        'data_paket_kuliner_id' => $request->id_paket
                    ]);
                }
            }
        }


        return redirect(route('kuliner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tb_paketkuliner  $tb_paketkuliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_paketkuliner $tb_paketkuliner)
    {
        //
    }
}