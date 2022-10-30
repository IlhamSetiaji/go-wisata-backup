<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use App\Models\Wahana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetingController extends Controller
{
    public function index()
    {
        return view('admin.budgeting.index');
    }
    public function createPaket()
    {
        $dataDesa = Auth::user();
        $dataWisata = Tempat::where('kategori', 'wisata')->get();
        $dataWahana = Wahana::all();
        $dataPenginapan = Tempat::where('kategori', 'penginapan')->get();

        // dd($dataWahana);
        return view('admin.budgeting.create', [
            'dataDesa' => $dataDesa,
            'dataWisatas' => $dataWisata,
            'dataWahanas' => $dataWahana,
            'dataPenginapans' => $dataPenginapan
        ]);
    }
}