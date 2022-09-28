<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tempat;
use App\Models\Kuliner;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class ATWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->get('id');

        return view('wisata.admin.wisata', compact('tempat'));
    }
    public function kuliner()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tempat1 = $tempat->id;
        // dd($tempat1);
        $kuliner = Tempat::where('induk_id', $tempat1)->get();
        // dd($kuliner);
        // $kuliner1 = $kuliner->name;

        return view('wisata.admin.wisata', compact('kuliner'));
    }

    public function desa()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tempat1 = $tempat->id;
        // dd($tempat1);
        $kuliner = Tempat::where('induk_id', $tempat1)->get();
        // dd($kuliner);
        // $kuliner1 = $kuliner->name;

        return view('wisata.admin.wisata', compact('kuliner'));
    }
    public function penginapan()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tempat1 = $tempat->id;
        // dd($tempat1);
        $penginapan = Tempat::where('induk_id', $tempat1)->where('kategori', 'penginapan')->get();
        // dd($kuliner);
        // $kuliner1 = $kuliner->name;

        return view('wisata.admin.penginapan', compact('kuliner'));
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
    public function toggleStatus($id)
    {
        $sesii = Tempat::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::info('Data Updated :)', 'Success');
        return redirect()->back();
    }
}
