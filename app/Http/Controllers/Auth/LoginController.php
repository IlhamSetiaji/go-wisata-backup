<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email    = $request->email;
        $password = $request->password;

        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $email,
            'email'       => $email,
            'description' => 'has log in',
            'date_time'   => $todayDate,
        ];
        // if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 'Active'])) {
        //     DB::table('activity_logs')->insert($activityLog);
        //     Toastr::success('Login successfully :)', 'Success');
        //     return redirect()->intended('home');
        // } elseif (Auth::attempt(['email' => $email, 'password' => $password, 'status' => null])) {
        //     DB::table('activity_logs')->insert($activityLog);
        //     Toastr::success('Login successfully :)', 'Success');
        //     return redirect()->intended('home');
        // } else {
        //     $sendCheckError = true;
        //     Toastr::error('fail, WRONG USERNAME OR PASSWORD :)', 'Error');
        //     return redirect('login')->with($sendCheckError);
        // }
    }
}
