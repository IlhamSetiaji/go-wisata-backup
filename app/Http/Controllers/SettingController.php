<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $setting = Setting::where('id', 1)->first();
        // dd($setting);
        return view('admin.setting.index', compact('setting'));
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
        $setting = Setting::find($id);
        return view('admin.setting.edit', compact('setting'));
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
        $this->validateStore($request);
        $data = $request->all();

        $admin = Setting::where('id', $id)->first();
        // dd($data);
        $user = Setting::find($id);

        $imageName = $user->home1;
        if ($request->hasFile('home1')) {
            $imageName = (new Setting)->userAvatar($request);
            if ($admin->home1 == null) {
            } else {
                if (file_exists($imageName))
                    unlink(public_path('images/' . $user->home1));
            }
        }
        $data['home1'] = $imageName;



        $imageName4 = $user->sponsor1;
        if ($request->hasFile('sponsor1')) {
            $imageName4 = (new Setting)->userAvatar2($request);
            if ($admin->sponsor1 == null) {
            } else {
                if (file_exists($imageName4))
                    unlink(public_path('images/' . $user->sponsor1));
            }
        }
        $data['sponsor1'] = $imageName4;

        $imageName5 = $user->sponsor2;
        if ($request->hasFile('sponsor2')) {
            $imageName5 = (new Setting)->userAvatar3($request);
            if ($admin->sponsor2 == null) {
            } else {
                if (file_exists($imageName5))
                    unlink(public_path('images/' . $user->sponsor2));
            }
        }
        $data['sponsor2'] = $imageName5;

        $imageName6 = $user->sponsor3;
        if ($request->hasFile('sponsor3')) {
            $imageName6 = (new Setting)->userAvatar4($request);
            if ($admin->sponsor3 == null) {
            } else {
                if (file_exists($imageName6))
                    unlink(public_path('images/' . $user->sponsor3));
            }
        }
        $data['sponsor3'] = $imageName6;

        $imageName7 = $user->sponsor4;
        if ($request->hasFile('sponsor4')) {
            $imageName7 = (new Setting)->userAvatar5($request);
            if ($admin->sponsor4 == null) {
            } else {
                if (file_exists($imageName7))
                    unlink(public_path('images/' . $user->sponsor4));
            }
        }
        $data['sponsor4'] = $imageName7;

        $imageName8 = $user->experience1;
        if ($request->hasFile('experience1')) {
            $imageName8 = (new Setting)->userAvatar6($request);
            if ($admin->experience1 == null) {
            } else {
                if (file_exists($imageName8))
                    unlink(public_path('images/' . $user->experience1));
            }
        }
        $data['experience1'] = $imageName8;

        $imageName9 = $user->experience2;
        if ($request->hasFile('experience2')) {
            $imageName9 = (new Setting)->userAvatar7($request);
            if ($admin->experience2 == null) {
            } else {
                if (file_exists($imageName9))
                    unlink(public_path('images/' . $user->experience2));
            }
        }
        $data['experience2'] = $imageName9;

        $video = $user->video;
        if ($request->hasFile('video')) {
            $video = (new Setting)->tempatAvatar8($request);
            if ($admin->video == null) {
            } else {
                if (file_exists($video))
                    unlink(public_path('images/' . $user->video));
            }
        }
        $data['video'] = $video;


        $user->update($data);
        Toastr::success(' Berhasil mengupdate', 'Success');
        return redirect()->back();
    }

    public function validateStore($request)
    {
        return  $this->validate($request, [
            'video' => 'mimes:mp4,m4v,webm|max:40000',
        ]);
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