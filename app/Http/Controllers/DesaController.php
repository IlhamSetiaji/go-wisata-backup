<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $tempatk = Tempat::where('induk_id', $tempat->id)->get();
        // dd($tempat);
        return view('desa.profil.index', compact('tempatk', 'tempat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        return view('desa.kelola.create');
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
        $user = Tempat::find($id);
        $admin = Tempat::where('id', $id)->first();
        // $this->validateUpdate($request, $id);
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,m4v,webm|max:41943040',
        ]);

        // dd($data);
        $data = $request->all();
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new Tempat)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                unlink(public_path('images/' . $user->image));
            }
        }
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;
        $data['image'] = $imageName;

        $imageName2 = $user->image2;
        if ($request->hasFile('image2')) {
            $imageName2 = (new Tempat)->userAvatar2($request);
            if ($admin->image2 == null) {
            } else {
                unlink(public_path('images/' . $user->image2));
            }
        }
        $data['image2'] = $imageName2;
        // dd($data);

        $video = $user->video;
        if ($request->hasFile('video')) {
            $video = (new Tempat)->tempatAvatar3($request);
            if ($admin->video == null) {
            } else {
                unlink(public_path('videos/' . $user->video));
            }
        }
        $data['video'] = $video;

        $user->update($data);
        Toastr::success(' Berhasil mengupdate :)', 'Success');

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
        //
    }
    public function toggleStatus($id)
    {
        $sesii = Tempat::find($id);
        $sesii->open = !$sesii->open;
        $sesii->save();
        Toastr::info('Data Updated :)', 'Success');
        return redirect()->back();
    }
}