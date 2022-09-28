<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Detail_transaksi;
use App\Models\Bookingvilla;
use App\Models\Kamar;
use App\Models\Reviewvilla;
use App\Models\Tiket;
use App\Models\User;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel = Hotel::orderby('id', 'desc')->where('user_id', Auth::user()->id)->get();
        return view('admin.hotel.halaman_hotel', [
            'hotel' => $hotel,
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
        $this->validateStore($request);
        $foto = (new Hotel())->userAvatar($request);
        $tempat = Tempat::where('user_id', Auth::user()->petugas_id)->first();
        $data['tempat_id'] = $tempat->id;
        $data['user_id'] = Auth::user()->id;
        $data['kode_hotel'] = $request->kode_hotel;
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['lokasi'] = $request->lokasi;
        $data['telp'] = $request->telp;
        $data['foto'] = $foto;
        $slug = Str::slug($request->nama, '-');
        $data['slug'] = $slug;

        if (Hotel::create($data)) {
            Toastr::success('Berhasil menambahkan data hotel :)', 'Success');
        }
        return redirect()->back();
    }
    public function validateStore($request)
    {
        return  $this->validate($request, [
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Hotel::find($id);
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->pluck('id')->first();
        $kamar  = Kamar::where('tempat_id', $tempat)->where('hotel_id', $id)->orderby('id', 'desc')->get();
        return view('penginapan.kamar.halaman_kamar', compact('kamar', 'hotel', 'tempat'));
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
        $this->validateUpdate($request);
        $data = $request->all();
        $hotel = Hotel::find($id);
        $imageName = $hotel->foto;
        if ($request->hasFile('foto')) {
            $imageName = (new Hotel())->userAvatar($request);
            if ($hotel->foto == null) {
            } else {
                unlink(public_path('images/' . $hotel->foto));
            }
        }
        $data['foto'] = $imageName;
        $slug = Str::slug($request->nama, '-');
        $data['slug'] = $slug;
        $hotel->update($data);
        Toastr::success(' Berhasil mengubah data:)', 'Success');
        return redirect()->back();
    }
    public function validateUpdate($request)
    {
        return  $this->validate($request, [
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($id)
    {
        $sesii = Hotel::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::success(' Berhasil mengubah status :)', 'Success');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        $hotel->delete($hotel);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
}
