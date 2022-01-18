<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function username()
    {
        return 'username';
    }
    
    public function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $jmlpemilih = User::where('level', 2)->count();
        $jmlcalon = VisiMisi::count();
        $jmlsuara = Suara::sum('vote');
        // setting
        $setting = Setting::all();
        foreach ($setting as $key) {
            $settings[$key['nama']] = [
                $key['status'],
            ];
        }

        View::share([
            'jumlahpemilih' => $jmlpemilih,
            'jumlahcalon' => $jmlcalon,
            'jumlahsuara' => $jmlsuara,
            'setting' => $settings,
        ]);
        $this->jumlahcalon = $jmlcalon;
        $this->setting = $settings;
    }
}
