<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\tb_kategoriwisata;
use App\Models\tb_paket;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Tempat;
<<<<<<< HEAD
use App\Models\Tour;
=======
use App\Models\Villa;
>>>>>>> 540f644c87c6de8bc1d90c78cbe90f50e48da9a1
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users  = User::with(['role'])->where('role_id', '!=', 5)->get();
        // dd($users);
        return view('admin.admin.index', compact('users'));
    }
    public function indexd()
    {

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $users  = User::where('role_id', '!=', 5)->where('desa_id', $tempat->id)->get();
        // dd($users);
        return view('desa.admin.index', compact('users'));
    }
    public function create()
    {
        $data = User::max('petugas_id');
        // dd($data);
        $huruf = "D";
        $urutan = (int)substr($data, 2, 3);
        $urutan++;
        $petugas_id = $huruf . sprintf("%03s", $urutan);
        // dd($petugas_id);


        return view('admin.admin.create', compact('petugas_id'));
    }
    public function created()
    {

        $data = User::max('petugas_id');
        // dd($data);
        $huruf = "D";
        $urutan = (int)substr($data, 2, 3);
        $urutan++;
        $petugas_id = $huruf . sprintf("%03s", $urutan);
        // dd($petugas_id);


        return view('desa.admin.create', compact('petugas_id'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validateStore($request);
        $data = $request->all();
        // dd($data);


        $name = (new User)->userAvatar($request);
        $data['image'] = $name;
        $data['email_verified_at'] = now();
        $data['password'] = bcrypt($request->password);

        User::create($data);


        Toastr::success('Membuat akun admin berhasil :)', 'Success');
        return redirect()->route('admin.index');
    }

    public function stored(Request $request)
    {
        // dd($request);
        $this->validateStore($request);
        $data = $request->all();
        // dd($data);
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $name = (new User)->userAvatar($request);
        $data['image'] = $name;

        $data['password'] = bcrypt($request->password);
        $data['desa_id'] = $tempat->id;

        User::create($data);


        Toastr::success('Membuat akun admin berhasil :)', 'Success');
        return redirect()->route('admind.index');
    }


    public function edit($id)
    {
        $users = User::find($id);

        return view('admin.admin.edit',  compact('users'));
    }
    public function editd($id)
    {
        $users = User::find($id);

        return view('desa.admin.edit',  compact('users'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('id', $id)->first();
        // dd($admin);
        // $checkgambar = $admin->image;

        $this->validateUpdate($request, $id);
        $data = $request->all();
        // dd($data);


        $user = User::find($id);
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            if ($admin->image == null) {
            } else {
                // unlink(public_path('images/' . $user->image));
                if (file_exists($imageName))
                    unlink(public_path('images/' . $user->image));
            }
        }
        $data['image'] = $imageName;

        $userPassword = $user->password;

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {

            $data['password'] = $userPassword;
        }

        $user->update($data);
        Toastr::success(' Berhasil mengubah status :)', 'Success');
        return redirect()->route('admin.index');
    }
    public function updated(Request $request, $id)
    {
        $admin = User::where('id', $id)->first();
        // dd($admin);
        // $checkgambar = $admin->image;

        $this->validateUpdate($request, $id);
        $data = $request->all();
        // dd($data);


        $user = User::find($id);
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

        $userPassword = $user->password;

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {

            $data['password'] = $userPassword;
        }

        $user->update($data);
        Toastr::success(' Berhasil mengubah status :)', 'Success');
        return redirect()->route('admind.index');
    }


    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            abort(401);
        }

        $user = User::find($id);
        $userDelete = $user->delete();

        if ($userDelete) {
            if ($user->image == null) {
            } else {
                if (file_exists($user->image))
                    unlink(public_path('images/' . $user->image));
            }
        }
        Toastr::success('User deleted successfully :)', 'Success');

        return redirect()->route('admin.index')->with('message', 'Data deleted successfully');
    }



    public function validateStore($request)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:25',
            'image' => 'required|mimes:png,jpg,jpeg|max:5000',
        ]);
    }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,


        ]);
    }
    public function toggleStatus($id)
    {
        $sesii = User::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::info('User Status Updated :)', 'Success');
        return redirect()->back();
    }
    public function info()
    {


        $users  = User::where('role_id', 1)->get();
        // dd($users);
        return view('admin.admin.index', compact('users'));
    }

<<<<<<< HEAD
    //TOUR GUIDE
    public function tourIndex(Request $request)
    {
        $tour  = Tour::all();
        return view('desa.tour.index', compact('tour'));
    }

    public function tourCreate(Request $request)
    {
        $data['desa_id'] = $request->desa_id;
        $data['name'] = $request->name;
        $data['foto'] = $request->foto;
        $data['email'] = $request->email;
        $data['telp'] = $request->telp;
        $data['harga'] = $request->harga;

        Tour::create($data);

        return redirect()->route('tourd.index');
    }

    public function tourShow()
    {

        return view('desa.tour.create');
    }

    public function tourEdit($id)
    {
        $users = Tour::find($id);

        return view('desa.tour.edit',  compact('users'));
    }

    public function tourUpdate(Request $request, $id)
    {
        
        $data = $request->all();
        
        $tour = Tour::where('id', $id)->first();
        $user = Tour::find($id);
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            if ($tour->image == null) {
            } else {
                // unlink(public_path('images/' . $user->image));
                if (file_exists($imageName))
                    unlink(public_path('images/' . $user->image));
            }
        }
        $data['image'] = $imageName;
        $user->update($data);
        Toastr::success(' Berhasil mengupdate data :)', 'Success');
        return redirect()->route('tourd.index');
    }

    public function tourDestroy($id)
    {
        if (auth()->user()->id == $id) {
            abort(401);
        }

        $user = Tour::find($id);
        $userDelete = $user->delete();

        if ($userDelete) {
            if ($user->image == null) {
            } else {
                if (file_exists($user->image))
                    unlink(public_path('images/' . $user->image));
            }
        }
        Toastr::success('User deleted successfully :)', 'Success');

        return redirect()->route('tourd.index')->with('message', 'Data deleted successfully');
=======
    //BUDGETING
    
    public function paketIndex(Request $request) {
        $data = DB::table("tb_pakets")
        ->Join("tb_tempat", function($join){
            $join->on("tb_pakets.id_desa", "=", "tb_tempat.id");
        })
        ->Join("tb_kategoriwisatas", function($join){
            $join->on("tb_pakets.id_kategori", "=", "tb_kategoriwisatas.id");
        })
        ->select("tb_pakets.*", "tb_tempat.name", "tb_kategoriwisatas.nama_kategori")
        ->get();

       return(view('/desa/paket/index', [
        "paket" => $data,
       ]));
    }

    public function paketCreate() {

        $desa = Tempat::where('kategori', 'desa')->get();
        $kategori_paket = tb_kategoriwisata::all();
        $villa = Villa::all();
        $kamar = Kamar::all();
       

        return(view('/desa/paket/create', [
            'desa' => $desa,
            'kategori' => $kategori_paket,
            'villa' => $villa,
            'kamar' => $kamar,
        ]));
    }

    public function paketCreated(Request $request) {

        $data['id_desa'] = $request->id_desa;
        $data['id_kategori'] = $request->id_kategori;
        $data['id_kamar'] = $request->id_kamar;
        $data['id_villa'] = $request->id_villa;
        $data['nama_paket'] = $request->nama_paket;
        $data['harga'] = $request->harga;
        $data['jml_hari'] = $request->jml_hari;
        $data['jml_orang'] = $request->jml_orang;
       

        tb_paket::create($data);

        return redirect()->route('paketd.index');
>>>>>>> 540f644c87c6de8bc1d90c78cbe90f50e48da9a1
    }
}
