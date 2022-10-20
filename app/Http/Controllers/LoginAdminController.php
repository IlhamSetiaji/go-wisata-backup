<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $roleId = $this->checkIsAdmin($request->email);
        if ($roleId == 5) {
            Alert::error('Error', 'Use Customer Login Page');
            return back();
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        Alert::error('Error', 'Email and/or password invalid.');
        return back();
    }
    public function checkIsAdmin($param)
    {
        $data = User::where('email', $param)->pluck('role_id')->first();
        return $data;
    }
}
