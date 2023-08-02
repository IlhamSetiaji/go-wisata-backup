<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TempatController extends Controller
{
    public function index()
    {
        // $users  = Tempat::all();
        if(request()->user()->role->name === 'kota') {
            $users = Tempat::where('city', request()->user()->city)->get();
        } else {
            $users = Tempat::all();
        }
        // $u = Tempat::first();
        // return $u->petugas()->petugas_id;
        // return $users
        return view('admin.tempat.index', compact('users'));
    }
    public function indexd()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        // $tempatk = Tempat::where('induk_id', $tempat->id)->get();
        $tempatk = DB::table("tb_tempat")
        ->leftJoin("users", function($join){
            $join->on("tb_tempat.user_id", "=", "users.petugas_id");
        })
        ->select("tb_tempat.*", "users.name as admin")
        ->where("tb_tempat.induk_id", "=", $tempat->id)
        ->get();
        // dd($tempat);
        return view('desa.kelola.index', compact('tempatk'));
    }

    public function indexvideo()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        return view('video-upload', compact('tempat'));
    }
    public function videoupload(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:mp4,m4v,webm',
        ]);

        $title = time() . '.' . request()->file->getClientOriginalExtension();

        $request->file->move(public_path('videos'), $title);

        // $storeFile = new Tempat;

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        if ($tempat->video == null) {
        } else {
            if (file_exists($tempat->video))
                unlink(public_path('images/' . $tempat->video));
        }
        // print_r($data);
        $data['video'] = $title;
        $tempat->update($data);


        // dd($title);
        return redirect()->back();
        // return response()->json(['success' => 'File Uploaded Successfully']);
    }
    public function create()
    {
        $petugas = User::where('role_id', '!=', 5)->get();

        return view('admin.tempat.create', compact('petugas'));
    }
    public function created()
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $petugas = User::where('role_id', '!=', 5)->where('desa_id', $tempat->id)->get();
        return view('desa.kelola.create', compact('petugas', 'tempat'));
    }
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        // dd($data);
        $this->validateStore($request);
        $user = User::where('petugas_id', $request->user_id)->first();
        $role = Role::where('id', $user->role_id)->first();

        if ($request->kategori != $role->name) {
            Toastr::error('Role admin dan kategori berbeda', 'Error');
            return redirect()->back();
        }
        $name = (new Tempat)->tempatAvatar($request);
        $data['image'] = $name;
        if(request()->user()->role->name = 'kota') {
            $data['city'] = request()->user()->city;
        } else if (request()->user()->role->name == 'admin') {
            $data['city'] = User::where('role_id', 9)->first()->city;
        }

        $name2 = (new Tempat)->tempatAvatar2($request);
        $data['image2'] = $name2;

        $video = (new Tempat)->tempatAvatar4($request);
        $data['video'] = $video;
        // $video = $tempat->video;
        // if ($request->hasFile('video')) {
        //     $video = (new Tempat)->tempatAvatar8($request);
        //     if ($admin->video == null) {
        //     } else {
        //         if (file_exists($video))
        //             unlink(public_path('images/' . $user->video));
        //     }
        // }
        // $data['video'] = $video;

        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;

        // dd($data);
        Tempat::create($data);

        Toastr::success('Membuat akun admin berhasil :)', 'Success');
        return redirect()->route('tempat.index')->with('message', 'Data Berhasil ditambahkan !');
    }
    public function stored(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        return $data;
        // dd($data);

        $this->validateStore($request);
        $user = User::where('petugas_id', $request->user_id)->first();
        $role = Role::where('id', $user->role_id)->first();

        if ($request->kategori != $role->name) {
            Toastr::error('Role admin dan kategori berbeda', 'Error');
            return redirect()->back();
        }

        $data['city'] = request()->user()->city;
        $name = (new Tempat)->tempatAvatar($request);
        $data['image'] = $name;
        $name2 = (new Tempat)->tempatAvatar2($request);
        $data['image2'] = $name2;
        $data['atraksi'] = $request->atraksi;
        $data['akses'] = $request->akses;
        $data['sejarah'] = $request->sejarah;
        $data['unggulan'] = $request->unggulan;
        $data['lokasi'] = $request->lokasi;

        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;



        $tempatdesa  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data['induk_id'] = $tempatdesa->id;


        Tempat::create($data);

        Toastr::success('Membuat akun admin berhasil :)', 'Success');
        return redirect()->route('tempat.index')->with('message', 'Data Berhasil ditambahkan !');
    }
    public function edit($id)
    {
        $users = Tempat::find($id);

        return view('admin.tempat.edit',  compact('users'));
    }
    public function editd($id)
    {
        $users = Tempat::find($id);
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        return view('desa.kelola.edit',  compact('users', 'tempat'));
    }

    public function toggleStatus($id)
    {
        $sesii = Tempat::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $admin = Tempat::where('id', $id)->first();
        // $this->validateUpdate($request, $id);
        $data = $request->all();
        $this->validateUpdate($request, $id);
        // dd($data);
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;

        $user = Tempat::find($id);
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                if (file_exists($imageName))
                    unlink(public_path('images/' . $user->image));
            }
        }
        $data['image'] = $imageName;

        $imageName2 = $user->image2;
        if ($request->hasFile('image2')) {
            $imageName2 = (new User)->userAvatar2($request);
            if ($admin->image2 == null) {
            } else {
                if (file_exists($imageName2))
                    unlink(public_path('images/' . $user->image2));
            }
        }
        $data['image2'] = $imageName2;

        $video = $user->video;
        if ($request->hasFile('video')) {
            $video = (new User)->userAvatar3($request);
            if ($admin->video == null) {
            } else {
                if (file_exists($video))
                    unlink(public_path('images/' . $user->video));
            }
        }
        $data['video'] = $video;

        $user->update($data);
        Toastr::success(' Berhasil mengubah :)', 'Success');
        return redirect()->route('tempat.index');
    }
    public function updated(Request $request, $id)
    {


        $admin = Tempat::where('id', $id)->first();
        // $this->validateUpdate($request, $id);
        $data = $request->all();
        // dd($data);
        $this->validateUpdate($request, $id);

        $user = Tempat::find($id);
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                if (file_exists($imageName))
                    unlink(public_path('images/' . $user->image));
            }
        }
        $data['image'] = $imageName;


        $imageName2 = $user->image2;
        if ($request->hasFile('image2')) {
            $imageName2 = (new User)->userAvatar2($request);
            if ($admin->image2 == null) {
            } else {
                if (file_exists($imageName2))
                    unlink(public_path('images/' . $user->image2));
            }
        }
        $data['image2'] = $imageName2;
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;
        $tempatdesa  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $data['induk_id'] = $tempatdesa->id;
        $data['deskripsi'] = $request->deskripsi;
        $data['akses'] = $request->akses;
        $data['sejarah'] = $request->sejarah;
        $data['lokasi'] = $request->lokasi;




        User::where('petugas_id', $request->user_id)

            ->update(['tempat_id' => $id]);

        // dd($adminn);
        $user->update($data);
        Toastr::success(' Berhasil mengubah :)', 'Success');
        return redirect()->route('tempat.indexd');
    }
    // public function checkSlug(Request $request)
    // {
    //     $slug = SlugService::createSlug(Tempat::class, 'slug' . $request->title);
    //     return response()->json(['slug' => $slug]);
    // }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'name' => 'required|unique:tb_tempat,name,' . $id,



        ]);
    }
    public function validateStore($request)
    {
        return  $this->validate($request, [

            'name' => 'required|unique:tb_tempat,name,',


        ]);
    }
}
