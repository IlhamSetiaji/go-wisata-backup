<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class ATFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function kuliner()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        return view('kuliner.setting', compact('tempat'));
    }
    public function penginapan()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        return view('penginapan.setting', compact('tempat'));
    }
    public function event_tempatsewa()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        return view('admin.tempat.setting', compact('tempat'));
    }
    public function updatekuliner(Request $request, $id)
    {
        $user = Tempat::find($id);
        $admin = Tempat::where('id', $id)->first();
        // $this->validateUpdate($request, $id);

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
        $user->update($data);
        Toastr::success(' Berhasil mengupdate :)', 'Success');

        return redirect()->back();
    }

    public function updatepenginapan(Request $request, $id)
    {
        $user = Tempat::find($id);
        $admin = Tempat::where('id', $id)->first();
        // $this->validateUpdate($request, $id);
        $request->validate([
            'file' => 'mimes:png,jpg,jpeg|max:5000'
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
        // dd($imageName2);

        $user->update($data);
        Toastr::success(' Berhasil mengupdate :)', 'Success');

        return redirect()->back();
    }
    public function updateevent(Request $request, $id)
    {
        $user = Tempat::find($id);
        $admin = Tempat::where('id', $id)->first();
        $request->validate([
            'file' => 'mimes:png,jpg,jpeg|max:5000'
        ]);

        $data = $request->all();
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new Tempat)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                unlink(public_path('images/' . $user->image));
            }
        }
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
        $user->update($data);
        Toastr::success(' Berhasil mengupdate :)', 'Success');

        return redirect()->back();
    }
    public function toggleStatus($id)
    {
        $sesii = Tempat::find($id);
        $sesii->open = !$sesii->open;
        $sesii->save();
        Toastr::info('Data Updated :)', 'Success');
        return redirect()->back();
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
