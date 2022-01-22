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
    protected function credentials(Request $request)
    {
        // dd($request->all());
        $data = User::where('username', $request->username)->get();
        if (count($data) > 0) {
            if ($data[0]['level'] == 1) {
                return [
                    'username' => $request->{$this->username()},
                    'password' => $request->password,
                    'status' => 0
                ];
            } elseif ($data[0]['level'] == 0 || $data[0]['level'] == 2) {
                return [
                    'username' => $request->{$this->username()},
                    'password' => $request->password,
                ];
            }
        } else {
            return [
                'username' => $request->{$this->username()},
                'password' => $request->password,
                'status' => 0
            ];
        }
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
