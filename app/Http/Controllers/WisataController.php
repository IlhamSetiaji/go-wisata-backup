<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    public function index()
    {

        // $cek = Auth::user()->petugas_id';
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->get();
        // dd($tempat);
        return view('wisata.tempat.index', compact('tempat'));

        // $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->get();

        // return view('admin.dashboard.wisata', compact('tempat'));
    }
    public function update(Request $request, $id)
    {
        // dd($request);
        $user = Tempat::find($id);
        $admin = Tempat::where('id', $id)->first();

        $coba =  Str::slug($user->name);
        // dd($coba);

        // $this->validateUpdate($request, $id);

        // dd($data);
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,m4v,webm|max:41943040',
        ]);


        if ($validator->fails()) {
            Toastr::error($validator->messages()->first(), 'Error');

            return redirect()->back()->withInput();
        }

        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new Tempat)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                if (file_exists($imageName))
                    unlink(public_path('images/' . $user->image));
            }
        }

        $imageName2 = $user->image2;
        if ($request->hasFile('image2')) {
            $imageName2 = (new Tempat)->userAvatar2($request);
            if ($admin->image2 == null) {
            } else {
                if (file_exists($imageName2))
                    unlink(public_path('images/' . $user->image2));
            }
        }
        $data['image'] = $imageName;
        $data['image2'] = $imageName2;

        $video = $user->video;
        if ($request->hasFile('video')) {
            $video = (new Tempat)->tempatAvatar3($request);
            if ($admin->video == null) {
            } else {
                // unlink(public_path('videos/' . $user->video));
                if (file_exists($video))
                    unlink(public_path('images/' . $user->video));
            }
        }
        $data['video'] = $video;

        $user->update($data);
        Toastr::success(' Berhasil mengupdate :)', 'Success');

        return redirect()->route('tempat.index');
    }
}