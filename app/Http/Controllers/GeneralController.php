<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use App\Models\Waktu;
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
        // 
        $time = Waktu::all();
        foreach ($time as $key) {
            $waktu[$key['nama']] = [
                $key['tanggal'],
            ];
        }
        View::share([
            'jumlahpemilih' => $jmlpemilih,
            'jumlahcalon' => $jmlcalon,
            'jumlahsuara' => $jmlsuara,
            'setting' => $settings,
            'waktu' => $waktu,
        ]);
        $this->jumlahcalon = $jmlcalon;
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

        $datacalon = VisiMisi::orderBy('no_urut')->get();

        $datasuaramasuk = Suara::sum('vote');

        dd($carapilih);
        return view('welcome', [
            'jumlahcarousel' => $carouselcount,
            'filecarousel' => $carouselfilename,
            'jumlahcarapilih' => $carapilihcount,
            'filecarapilih' => $carapilihfilename,
            'datacalon' => $datacalon,
            'datasuaramasuk' => $datasuaramasuk,
        ]);
    }

    public function suarapersonal($nourut)
    {
        $data = Suara::where('no_urut', $nourut)->get();
        return $data[0]['vote'];
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
            $datavisimisi = VisiMisi::orderBy('no_urut')->get();
            return view('visimisi', [
                'datavisimisi' => $datavisimisi
            ]);
        }
    }

    public function hasilpemilihan()
    {
        return view('hasil');
    }
}
