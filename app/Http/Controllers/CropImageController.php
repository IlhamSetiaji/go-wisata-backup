<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;
use Auth;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CropImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function editgambar()
    {
        if (!Auth::guest()) {
            if (Auth::user()->role->name == "pelanggan") {
                return view('error');
            }
            return view('cropimage');
        }
        return view('error');
    }
    public function about1()
    {
        return view('admin.setting.cropabout1');
    }
    public function about2()
    {
        return view('admin.setting.cropabout2');
    }

    public function editgambar2()
    {

        if (!Auth::guest()) {
            if (Auth::user()->role->name == "pelanggan") {
                return view('error');
            }
            return view('cropimage2');
        }
        return view('error');
    }
    public function uploadCropImage2(Request $request)
    {
        // dd($request);
        // $this->validate($request, [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $image = $request->image;

        list($type, $image) = explode(';', $image);

        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time() . '.png';
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        if ($tempat->image == null) {
        } else {
            unlink(public_path('images/' . $tempat->image));
        }
        $data['image'] = $image_name;
        $tempat->update($data);
        $path2 = public_path('images/' . $image_name);
        file_put_contents($path2, $image);
        return response()->json(['status' => true]);
    }

    public function cropabout1(Request $request)
    {
        // dd($request);
        // $this->validate($request, [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $image = $request->image;

        list($type, $image) = explode(';', $image);

        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time() . '.png';
        $setting  = Setting::first();

        if ($setting->about1 == null) {
        } else {
            unlink(public_path('images/setting/' . $setting->about1));
        }
        $data['about1'] = $image_name;
        $setting->update($data);
        $path2 = public_path('images/setting/' . $image_name);
        file_put_contents($path2, $image);
        return response()->json(['status' => true]);
    }
    public function cropabout2(Request $request)
    {
        // dd($request);
        // $this->validate($request, [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $image = $request->image;

        list($type, $image) = explode(';', $image);

        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time() . '.png';
        $setting  = Setting::first();

        if ($setting->about2 == null) {
        } else {
            unlink(public_path('images/setting/' . $setting->about2));
        }
        $data['about2'] = $image_name;
        $setting->update($data);
        $path2 = public_path('images/setting/' . $image_name);
        file_put_contents($path2, $image);
        return response()->json(['status' => true]);
    }

    public function uploadCropImage(Request $request)
    {
        dd($request);
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        $saveFile = new Tempat;
        $saveFile->image = $imageName;
        dd($saveFile);
        $saveFile->save();

        return response()->json(['success' => 'Crop Image Uploaded Successfully']);
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
}
