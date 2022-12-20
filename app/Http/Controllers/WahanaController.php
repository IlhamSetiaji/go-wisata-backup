<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wahana;
use Illuminate\Support\Facades\Auth;
use App\Models\Tempat;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class WahanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->pluck('id')->first();
        // return $tempat;
        // $wahana = Wahana::where('tempat_id','$tempat)->get();
        if (Auth::user()->role->name == 'wisata') {

            // $wahana  = Wahana::all();
            $wahana = DB::table('tb_wahana')->where('tb_wahana.tempat_id', Auth::user()->tempat_id)->get();

            // dd($wahana);
            // dd(Auth::user());

            // return $wahana;
            return view('wisata.wahana.index', compact('wahana'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Wahana::max('kode_wahana');
        $huruf = "W";
        $urutan = (int)substr($data, 2, 3);
        $urutan++;
        $wahana_id = $huruf . sprintf("%03s", $urutan);
        // dd($wahana_id);
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->get();
        // dd($tempat);
        return view('wisata.wahana.create', compact('wahana_id', 'tempat'));
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
        $data = $request->all();
        $name = (new Wahana)->userAvatar($request);
        $data['image'] = $name;
        Wahana::create($data);

        Toastr::success('Menambahkan wahana berhasil :)', 'Success');

        return redirect()->route('wahana.index');
    }

    public function update(Request $request, $id)
    {
        //
        $admin = Wahana::where('id', $id)->first();
        $user = Wahana::find($id);
        $data = $request->all();
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new Wahana)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                if (file_exists($imageName))
                    unlink(public_path('images/' . $user->image));
            }
        }
        $data['image'] = $imageName;
        // dd($data);
        $user->update($data);
        // Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
        Toastr::success(' Berhasil mengupdate data :)', 'Success');
        return redirect()->route('wahana.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            abort(401);
        }

        $user = Wahana::find($id);
        $userDelete = $user->delete();
        if ($userDelete) {
            if (file_exists($user->image)) {
                unlink(public_path('images/' . $user->image));
            }
        }
        Toastr::success('Data deleted successfully :)', 'Success');

        return redirect()->route('wahana.index');
    }
    public function validateStore($request)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'kode_wahana' => 'required|unique:tb_wahana'

        ]);
    }
    public function toggleStatus($id)
    {
        $sesii = Wahana::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::info('User Status Updated :)', 'Success');
        return redirect()->back();
    }
}