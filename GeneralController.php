<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GeneralController extends Controller
{
    public function __construct()
    {
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

    public function index()
    {
        return view('welcome');
    }

    public function votercheck()
    {
        return view('cekvoter');
    }

    public function visimisi()
    {
        if ($this->jumlahcalon == 0) {
            return redirect(route('welcome'));
        } else {
            return view('visimisi');
        }
    }

    public function hasilpemilihan()
    {
        return view('hasil');
    }
}
