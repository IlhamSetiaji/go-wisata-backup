<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camp;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon;
use App\Models\Detail_camp;

class CampingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->pluck('id')->first();

        $camp  = Camp::where('tempat_id', $tempat)->get();
        // dd($tempat);
        return view('wisata.camping.index', compact('camp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Camp::max('kode_camp');
        $huruf = "C";
        $urutan = (int)substr($data, 2, 3);
        $urutan++;
        $camp_id = $huruf . sprintf("%03s", $urutan);
        // dd($wahana_id);
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->get();
        // dd($tempat);
        return view('wisata.camping.create', compact('camp_id', 'tempat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // $this->validateStore($request);
        $data = $request->all();
        // dd($data);
        $name = (new Camp)->userAvatar($request);
        $data['image'] = $name;
        Camp::create($data);
        Toastr::success('Berhasil menambahkan alat camp :)', 'Success');
        return redirect()->route('camping.index');
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
        $admin = Camp::where('id', $id)->first();
        $user = Camp::find($id);
        $data = $request->all();
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new Camp)->userAvatar($request);
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
        return redirect()->route('camping.index');
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

        $user = Camp::find($id);
        $userDelete = $user->delete();
        if ($userDelete) {
            if (file_exists($user->image))
                unlink(public_path('images/' . $user->image));
        }
        Toastr::success('Data berhasil dihapus :)', 'Success');

        return redirect()->route('camping.index');
    }
    public function toggleStatus($id)
    {
        $sesii = Camp::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::info('Camp Status Updated :)', 'Success');
        return redirect()->back();
    }
    public function backcamp($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');

        $back = Detail_camp::where('kode_tiket', $id)->first();
        $back->status = 1;
        $back->tgl_kembaliin = $date;
        $back->save();
        return redirect()->back();
    }
}
