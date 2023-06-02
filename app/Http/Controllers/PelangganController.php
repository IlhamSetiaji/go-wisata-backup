<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class PelangganController extends Controller
{
    //
    public function index()
    {
        if (request()->user()->role->name == 'kota') {
            $users  = User::where('role_id', 5)->where('parent_id', request()->user()->id)->get();
        } else {
            $users  = User::where('role_id', 5)->get();
        }
        return view('admin.pelanggan.index', compact('users'));
    }
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();


        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect()->route('pelanggan.index')->with('message', 'Data Berhasil ditambahkan !');
    }


    public function edit($id)
    {
        $users = User::find($id);

        return view('admin.pelanggan.edit',  compact('users'));
    }
    public function update(Request $request, $id)
    {

        $this->validateUpdate($request, $id);
        $data = $request->all();
        // dd($data);

        $user = User::find($id);

        $userPassword = $user->password;

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {

            $data['password'] = $userPassword;
        }

        $user->update($data);
        return redirect()->route('pelanggan.index')->with('message', 'Data Berhasil diupdate !');
    }

    // public function destroy($id)
    // {

    //     if (auth()->user()->id == $id) {
    //         abort(401);
    //     }
    //     $user = User::find($id);
    //     $userDelete = $user->delete();

    //     return redirect()->route('pelanggan.index')->with('message', 'Data deleted successfully');
    // }
    public function destroy($id)
    {


        if (auth()->user()->id == $id) {
            abort(401);
        }
        // $user = User::find($id);
        // $userDelete = $user->delete();
        // $delete = User::find($id);
        // $delete->delete();



        $user = User::find($id);
        $userDelete = $user->delete();
        if ($userDelete) {
            if ($user->image == null) {
            } else {
                // unlink(public_path('images/' . $user->image));
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
        return redirect()->back();
    }
    public function show($id)
    {
        $useri = User::find($id);
        return redirect()->route('admin.index', compact('useri'));
    }
}
