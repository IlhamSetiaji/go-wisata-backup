<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingEvent;
use App\Models\Event;
use App\Models\EventKegiatan;
use App\Models\PesertaEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use LDAP\Result;


class PesertaEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookingevent = BookingEvent::all();
        $pesertaevent = PesertaEvent::all();
        return view('admin.peserta_event.halaman_peserta', [
            'bookingevent' => $bookingevent,
            'pesertaevent' => $pesertaevent,
        ]);
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
        if (PesertaEvent::create($request->all())) {
            Toastr::success('Berhasil menambahkan data peserta :)', 'Success');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesertaevent = PesertaEvent::find($id);
        $bookingevent = BookingEvent::all();
        return view('admin.peserta_event.halaman_detailpesertaevent',  compact('bookingevent', 'pesertaevent'));
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
        $pesertaevent = PesertaEvent::find($id);
        $pesertaevent->delete($pesertaevent);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function tambah(Request $request)
    {
        //dd($request);
        // $this->validateStore($request);
        // $data['kode_peserta'] = $request->kode_peserta;
        // $data['nama_peserta'] = $request->nama_peserta;
        // $data['usia'] = $request->usia;
        // $data['jk'] = $request->jk;
        // $data['email'] =   $request->email;
        // $data['telp'] = $request->telp;
        // $data['user_id'] = $request->user_id;
        // $data['bookingevent_id'] = $request->bookingevent_id;
        // dd($data);
        if (PesertaEvent::create($request->all())) {
            Toastr::success('Berhasil menambahkan data peserta :)', 'Success');
        }
        return redirect()->back();
    }
}
