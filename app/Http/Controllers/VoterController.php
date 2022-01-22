<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (date('Y-m-d') >= date('Y-m-d', strtotime($this->waktu['Buka'][0]))  && date('Y-m-d') <= date('Y-m-d', strtotime($this->waktu['Tutup'][0]))) {
            $datacalon = VisiMisi::get();
            return view('vote', [
                'datacalon' => $datacalon
            ]);
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
        } else {
            $notif = null;
        }
        return redirect(route('welcome'))->with($notif);
    }
    public function voting(Request $data)
    {
        // dd($data->all());
        if (Auth::user()->level == 2) {
            User::where('id', Auth::user()->id)->update([
                'status' => 1
            ]);
            Suara::where('no_urut', $data->id)->increment('vote');
            return redirect(route('vote'))->with([
                'pemberitahuan' => 'Kamu berhasil memilih! Terima kasih sudah berpartisipasi dalam Pemilihan Umum Mahasiswa STT Indonesia',
                'warna' => 'success',    
            ]);
        } else {
            return redirect(route('welcome'))->with([
                'pemberitahuan' => 'Kamu tidak memiliki hak akses ke halaman ini!',
                'warna' => 'danger',
            ]);
        }
    }
}
