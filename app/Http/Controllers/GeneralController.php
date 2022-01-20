<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        $carousel = File::allFiles(public_path('images/carousel'));
        $carouselcount = 0;
        $carouselfilename = [];
        foreach ($carousel as $path) {
            $file = pathinfo($path);
            $carouselfilename[$carouselcount] = $file['basename'];
            $carouselcount++;
        }

        $carapilih = File::allFiles(public_path('images/carapilih'));
        $carapilihcount = 0;
        $carapilihfilename = [];
        foreach ($carapilih as $path) {
            $file = pathinfo($path);
            $carapilihfilename[$carapilihcount] = $file['basename'];
            $carapilihcount++;
        }
        return view('welcome', [
            'jumlahcarousel' => $carouselcount,
            'filecarousel' => $carouselfilename,
            'jumlahcarapilih' => $carapilihcount,
            'filecarapilih' => $carapilihfilename,
        ]);
    }

    public function votercheck()
    {
        return view('cekvoter');
    }

    public function voterchecking(Request $data)
    {
        $userdata = User::where('username', $data->pencarian)->orWhere('name',  $data->pencarian)->get();
        // dd($data->all());
        return redirect(route('cekvoter'))->with([
            'datamhs' => $userdata,
            'pencarian' => $data->pencarian,
        ]);
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
