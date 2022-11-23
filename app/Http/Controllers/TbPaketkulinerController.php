<?php

namespace App\Http\Controllers;

use App\Models\tb_paketkuliner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storetb_paketkulinerRequest;
use App\Http\Requests\Updatetb_paketkulinerRequest;
use App\Models\DataPaketKuliner;
use Illuminate\Http\Request;

use App\Models\Kuliner;
// use Clockwork\Request\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tb_paketkuliner  $tb_paketkuliner
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_paketkuliner $tb_paketkuliner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetb_paketkulinerRequest  $request
     * @param  \App\Models\tb_paketkuliner  $tb_paketkuliner
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetb_paketkulinerRequest $request, tb_paketkuliner $tb_paketkuliner)
    {
        //
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