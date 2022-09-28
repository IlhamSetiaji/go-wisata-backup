<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->pluck('id')->first();
        $kamar  = Kamar::where('tempat_id', $tempat)->get();
        return view('penginapan.kamar.halaman_kamar', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $name = (new Kamar)->userAvatar($request);
        $data['image'] = $name;
        Kamar::create($data);

        Toastr::success('Meambah data kamar  berhasil :)', 'Success');
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
        $admin = Kamar::where('id', $id)->first();
        $user = Kamar::find($id);
        $data = $request->all();
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new Kamar)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                unlink(public_path('images/' . $user->image));
            }
        }
        $data['image'] = $imageName;
        $user->update($data);
        Toastr::success(' Berhasil mengupdate data :)', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kamar = Kamar::find($id);
        $kamar->delete($kamar);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function toggleStatus($id)
    {
        $sesii = Kamar::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::info('User Status Updated :)', 'Success');
        return redirect()->back();
    }
}
