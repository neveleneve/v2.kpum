<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        // user
        $admin = User::where('level', 1)->count();
        $superadmin = User::where('level', 0)->count();
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
            'admin' => $admin,
            'superadmin' => $superadmin,
            'jumlahpemilih' => $jmlpemilih,
            'jumlahcalon' => $jmlcalon,
            'jumlahsuara' => $jmlsuara,
            'setting' => $settings,
            'waktu' => $waktu,
        ]);
    }

    public function index()
    {
        return view('home');
    }
    // panitia section (only super administrator)
    public function panitia()
    {
        if (Auth::user()->level == '0') {
            $data = User::where('level', '<>', 2)->orderBy('level')->get();
            return view('administrator.panitia', [
                'panitia' => $data,
            ]);
        } else {
            return redirect(route('home'))->with([
                'pemberitahuan' => 'Kamu tidak memiliki hak akses untuk masuk ke halaman Super Administrator!',
                'warna' => 'danger'
            ]);
        }
    }
    public function addpanitia(Request $data)
    {
        $checkusername = User::where('username', $data->username)->count();
        if ($checkusername > 0) {
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Username admin telah digunakan. Gunakan username lain.',
                'warna' => 'danger',
            ]);
        } else {
            if (Auth::user()->level == 0) {
                User::insert([
                    'name' => $data->nama,
                    'username' => $data->username,
                    'password' => Hash::make($data->username),
                    'level' => $data->level,
                ]);
                return redirect(route('administrator'))->with([
                    'pemberitahuan' => 'Administrator berhasil ditambah.',
                    'warna' => 'success',
                ]);
            } else {
                return redirect(route('home'))->with([
                    'pemberitahuan' => 'Kamu tidak memiliki hak akses untuk masuk ke halaman Super Administrator!',
                    'warna' => 'danger'
                ]);
            }
        }
    }

    public function resetpanitia($id)
    {
        if (Auth::user()->level == 0) {
            $userdata = User::where('id', $id)->get();
            User::where('id', $id)->update([
                'password'=>Hash::make($userdata[0]['username'])
            ]);
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Password administrator "'.$userdata[0]['username'].'" berhasil diubah!',
                'warna' => 'success'
            ]);
        } else {
            return redirect(route('home'))->with([
                'pemberitahuan' => 'Kamu tidak memiliki hak akses untuk masuk ke halaman Super Administrator!',
                'warna' => 'danger'
            ]);
        }
    }

    public function viewpanitia($id)
    {
        if (Auth::user()->level == 0) {
            $userdata = User::where('id', $id)->get();
            User::where('id', $id)->update([
                'password'=>Hash::make($userdata[0]['username'])
            ]);
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Password administrator "'.$userdata[0]['username'].'" berhasil diubah!',
                'warna' => 'success'
            ]);
        } else {
            return redirect(route('home'))->with([
                'pemberitahuan' => 'Kamu tidak memiliki hak akses untuk masuk ke halaman Super Administrator!',
                'warna' => 'danger'
            ]);
        }
    }
    public function activatepanitia($id)
    {
        if (Auth::user()->level == 0) {
            $userdata = User::where('id', $id)->get();
            User::where('id', $id)->update([
                'password'=>Hash::make($userdata[0]['username'])
            ]);
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Password administrator "'.$userdata[0]['username'].'" berhasil diubah!',
                'warna' => 'success'
            ]);
        } else {
            return redirect(route('home'))->with([
                'pemberitahuan' => 'Kamu tidak memiliki hak akses untuk masuk ke halaman Super Administrator!',
                'warna' => 'danger'
            ]);
        }
    }
    public function deactivatepanitia($id)
    {
        if (Auth::user()->level == 0) {
            $userdata = User::where('id', $id)->get();
            User::where('id', $id)->update([
                'password'=>Hash::make($userdata[0]['username'])
            ]);
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Password administrator "'.$userdata[0]['username'].'" berhasil diubah!',
                'warna' => 'success'
            ]);
        } else {
            return redirect(route('home'))->with([
                'pemberitahuan' => 'Kamu tidak memiliki hak akses untuk masuk ke halaman Super Administrator!',
                'warna' => 'danger'
            ]);
        }
    }


    // calon section
    public function calon()
    {
        $data = VisiMisi::get();
        return view('administrator.calon', [
            'calon' => $data,
        ]);
    }

    public function pemilih()
    {
        $data = User::where('level', 2)->get();
        return view('administrator.pemilih', [
            'pemilih' => $data,
        ]);
    }

    public function pengaturan()
    {
        return view('administrator.pengaturan');
    }
}
