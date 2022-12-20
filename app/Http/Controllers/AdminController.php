<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Role;
use App\Models\tb_kategoriwisata;
use App\Models\tb_paket;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Tempat;
use App\Models\Tour;
use App\Models\Villa;
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
        // $users  = User::where('role_id', '!=', 5)->where('desa_id', $tempat->id)->get();
        $users  = DB::table("users")
            ->leftJoin("tb_role", function ($join) {
                $join->on("users.role_id", "=", "tb_role.id");
            })
            ->leftJoin("tb_tempat", function ($join) {
                $join->on("users.tempat_id", "=", "tb_tempat.id");
            })
            ->select("tb_role.name as role", "users.*", "tb_tempat.name as tempat")
            ->where("users.role_id", "!=", 5)
            ->where("users.desa_id", "=", $tempat->id)
            ->orderBy('id', 'asc')
            ->get();
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
        $role = DB::table("tb_role")
            ->where("tb_role.id", "!=", 1)
            ->get();
        // dd($petugas_id);


        return view('desa.admin.create', compact('petugas_id', 'role'));
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

        $this->validateStore($request);
        $data = $request->all();

        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();

        $name = (new User)->userAvatar($request);
        $data['image'] = $name;
        $data['email_verified_at'] = now();
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

    public function adminDesaDestroy($id)
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

        return redirect()->back();
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

    //TOUR GUIDE
    public function tourIndex()
    {
        // $tour  = Tour::all();
        $tour = DB::table("tour_guide")
            ->Join("tb_tempat", function ($join) {
                $join->on("tour_guide.desa_id", "=", "tb_tempat.id");
            })
            ->select("tb_tempat.name as nama_desa", "tour_guide.*")
            ->get();
        return view('desa.tour.index', [
            'tour' => $tour
        ]);
    }
    public function tourStatus(Request $request)
    {
        Tour::where('id', $request->id)->update(['status' => $request->status]);
        return redirect()->route('tourd.index');
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
        $desa  = Tempat::where('kategori', 'desa')->get();
        return view('desa.tour.create', [
            'desa' => $desa
        ]);
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
    }
}