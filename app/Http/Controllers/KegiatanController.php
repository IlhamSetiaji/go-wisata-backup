<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tempat;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\User;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //

        if (Auth::user()->status == '1') {
            if (Auth::user()->role->name == 'admin') {

                return redirect()->back();
            }
            if (Auth::user()->role->name == 'wisata') {

                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                $kegiatans = Kegiatan::where('tempat_id', $tempat->id)->orderby('date_a', 'desc')->get();
                return view('admin.kegiatan.index', compact('kegiatans'));
            }
            if (Auth::user()->role->name == 'kuliner') {

                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                if ($tempat == null) {
                    return view('error');
                }
                $kegiatans = Kegiatan::where('tempat_id', $tempat->id)->orderby('date_a', 'desc')->get();
                return view('admin.kegiatan.index', compact('kegiatans'));
            }
            if (Auth::user()->role->name == 'penginapan') {

                $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
                if ($tempat == null) {
                    return view('error');
                }

                $kegiatans = Kegiatan::where('tempat_id', $tempat->id)->orderby('date_a', 'desc')->get();
                return view('admin.kegiatan.index', compact('kegiatans'));
            }


            if (Auth::user()->role->name == 'pelanggan') {
                return redirect('/');
            }
        }
        return view('error');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        if ($tempat == null) {
            return view('error');
        }
        $data = Kegiatan::max('kode_kegiatan');
        $huruf = "EK";
        $urutan = (int)substr($data, 3, 3);
        $urutan++;
        $kode_kegiatan = $huruf . sprintf("%04s", $urutan);

        return view('admin.kegiatan.create', compact('tempat', 'kode_kegiatan'));
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
        // dd($request);
        $this->validateStore($request);
        date_default_timezone_set('Asia/Jakarta');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $default = $request->daterange;
        // dd($default);
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        // $a =    $startDate->date('d-m-Y');
        $formatted_dt1 = Carbon::parse($startDate);
        $formatted_dt2 = Carbon::parse($endDate);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        // dd($durasi);
        if ($durasi < 0) {
            return redirect()->back();
        }
        $formatted_jam1 = Carbon::parse($request->jambuka);
        $formatted_jam2 = Carbon::parse($request->jamtutup);
        // dd($formatted_jam1, $formatted_jam2, $request->jamtutup);
        $durasi2 = $formatted_jam1->diffInHours($formatted_jam2);
        // dd($durasi2);

        // $tgl_a = date('d F Y',  strtotime($startDate));
        // $tgl_b = date('d F Y',  strtotime($endDate));
        // $data = $request->all();
        $image = (new Kegiatan)->userAvatar($request);
        $data['tempat_id'] = $tempat->id;
        $data['user_id'] = Auth::user()->id;
        $data['kode_kegiatan'] = $request->kode_kegiatan;
        $data['name'] = $request->name;
        $data['deskripsi'] = $request->deskripsi;
        $data['harga'] =   (int) preg_replace('/\D/', '', $request->jumlah);
        $data['image'] = $image;
        $data['jambuka'] = $request->jambuka;
        $data['jamtutup'] = $request->jamtutup;
        $data['kapasitas'] = $request->kapasitas;
        $data['date_a'] = $startDate;
        $data['date_b'] = $endDate;

        if (Kegiatan::create($data)) {
            Toastr::success('Membuat event berhasil :)', 'Success');
        }
        return redirect()->route('kegiatan.index');
    }
    public function validateStore($request)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'deskripsi' => 'required',
            'daterange' => 'required',
            // 'image' => 'mimes:png,jpg,jpeg|max:5000',
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
        $kegiatan = Kegiatan::find($id);
        $tempat = Tempat::where('id', $kegiatan->tempat_id)->first();
        $user = User::where('id', $kegiatan->user_id)->first();
        return view('admin.kegiatan.detail',  compact('kegiatan', 'tempat', 'user'));
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

        $this->validateUpdate($request, $id);
        $kegiatan = Kegiatan::where('id', $id)->first();
        $data = $request->all();
        $keg = Kegiatan::find($id);
        $imageName = $keg->image;
        if ($request->hasFile('image')) {
            $imageName = (new Kegiatan)->userAvatar($request);
            if ($kegiatan->image == null) {
            } else {
                // unlink(public_path('images/' . $keg->image));
                if (file_exists($imageName))
                    unlink(public_path('images/' . $keg->image));
            }
        }
        $data['image'] = $imageName;
        $data['harga'] =   (int) preg_replace('/\D/', '', $request->harga);
        // dd($data['harga']);
        $keg->update($data);
        Toastr::success(' Berhasil mengubah data:)', 'Success');
        return redirect()->back();
    }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:5000',
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
    public function toggleStatus($id)
    {
        $sesii = Kegiatan::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        return redirect()->back();
    }
}
