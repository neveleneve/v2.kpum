<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VoterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'voter']);

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
        $this->waktu = $waktu;
        $this->setting = $settings;
    }

    public function vote()
    {
        if (date('Y-m-d', strtotime($this->waktu['Buka'][0])) >= date('Y-m-d') && date('Y-m-d', strtotime($this->waktu['Tutup'][0])) <= date('Y-m-d')) {
            return view('vote');
        }
        if (date('Y-m-d') <= date('Y-m-d', strtotime($this->waktu['Buka'][0]))) {
            $notif = [
                'pemberitahuan' => 'Pemilihan belum dibuka! Harap tunggu hingga pemilihan dibuka.',
                'warna' => 'danger',
            ];
        } elseif (date('Y-m-d') >= date('Y-m-d', strtotime($this->waktu['Tutup'][0]))) {
            if ($this->setting['hasilsuara'][0] == 0) {
                $tambahan = ' Harap menunggu hasil perhitungan suara.';
            } else {
                $tambahan = null;
            }
            $notif = [
                'pemberitahuan' => 'Pemilihan sudah ditutup!' . $tambahan,
                'warna' => 'danger',
            ];
        }

        return redirect(route('welcome'))->with($notif);
    }
}
