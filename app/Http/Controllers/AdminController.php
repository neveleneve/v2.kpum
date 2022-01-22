<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Setting;
use App\Models\Suara;
use App\Models\User;
use App\Models\VisiMisi;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

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
    // usefull function 
    public function randomstringlah()
    {
        $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        return $randomString;
    }
    public function hitungfile($publicpath)
    {
        $m_all_imgs = File::files(public_path($publicpath));
        $filecount = 0;
        if ($m_all_imgs !== false) {
            $filecount = count($m_all_imgs);
        }
        return $filecount;
    }
    public function csvtoarray($filename = '', $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = null;
        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
    // index page administrator
    public function index()
    {
        return view('home');
    }
    // panitia section (only super administrator)
    public function panitia()
    {
        if (Auth::user()->level == '0') {
            if (isset($_GET['search'])) {
                $data = User::where('level', '<>', 2)->where('username', 'LIKE', '%' . $_GET['search'] . '%')->orderBy('level')->get();
            } else {
                $data = User::where('level', '<>', 2)->orderBy('level')->get();
            }
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
                    'status' => '0',
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
                'password' => Hash::make($userdata[0]['username'])
            ]);
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Password administrator "' . $userdata[0]['username'] . '" berhasil diubah!',
                'warna' => 'success'
            ]);
        } else {
            return redirect(route('home'))->with([
                'pemberitahuan' => 'Kamu tidak memiliki hak akses untuk masuk ke halaman Super Administrator!',
                'warna' => 'danger'
            ]);
        }
    }
    public function updatepanitia(Request $data)
    {
        if ($data->username == $data->usernamelama) {
            User::where('id', $data->id)->update([
                'name' => $data->name,
                'status' => $data->status,
            ]);
        } else {
            $checkdata = User::where('username', $data->username)->count();
            if ($checkdata > 0) {
                return redirect(route('viewadministrator', ['id' => $data->id]))->with([
                    'pemberitahuan' => 'Username telah digunakan. Gunakan username lain.',
                    'warna' => 'danger',
                ]);
            } else {
                User::where('id', $data->id)->update([
                    'name' => $data->name,
                    'username' => $data->username,
                    'status' => $data->status,
                ]);
            }
        }
        return redirect(route('viewadministrator', ['id' => $data->id]))->with([
            'pemberitahuan' => 'Berhasil memperbarui data administrator!',
            'warna' => 'success'
        ]);
    }
    public function viewpanitia($id)
    {
        if (Auth::user()->level == 0) {
            $data = User::where('id', $id)->get();
            return view('administrator.panitiaview', [
                'data' => $data
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
                'status' => '0'
            ]);
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Administrator "' . $userdata[0]['username'] . '" berhasil diaktifkan!',
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
                'status' => '1'
            ]);
            return redirect(route('administrator'))->with([
                'pemberitahuan' => 'Administrator "' . $userdata[0]['username'] . '" berhasil dinon-aktifkan!',
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
    public function addcalon(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'gambar' => 'mimes:jpeg,jpg,png'
        ]);
        VisiMisi::insert([
            'no_urut' => $request->no_urut,
            'ketua' => $request->ketua,
            'nimketua' => $request->nimketua,
            'jurusanketua' => $request->jurusanketua,
            'angkatanketua' => $request->angkatanketua,
            'wakil' => $request->wakil,
            'nimwakil' => $request->nimwakil,
            'jurusanwakil' => $request->jurusanwakil,
            'angkatanwakil' => $request->angkatanwakil,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Suara::insert([
            'no_urut' => $request->no_urut,
            'vote' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $file = $request->file('gambar' . $request->type);
        $namafile =  $request->no_urut . '.jpg';
        $destination = public_path('images/paslon');
        $file->move($destination, $namafile);
        return redirect(route('calon'))->with([
            'pemberitahuan' => 'Data calon pemilihan berhasil ditambahkan!',
            'warna' => 'success',
        ]);
    }
    public function viewcalon($id)
    {
        $data = VisiMisi::where('id', $id)->get();
        return view('administrator.calonview', [
            'data' => $data,
        ]);
    }
    public function updatecalon(Request $request)
    {
        // dd($request->all());
        VisiMisi::where('id', $request->id)->update([
            'ketua' => $request->ketua,
            'nimketua' => $request->nimketua,
            'jurusanketua' => $request->jurusanketua,
            'angkatanketua' => $request->angkatanketua,
            'wakil' => $request->wakil,
            'nimwakil' => $request->nimwakil,
            'jurusanwakil' => $request->jurusanwakil,
            'angkatanwakil' => $request->angkatanwakil,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);
        if ($request->gambar != null) {
            $file = $request->file('gambar' . $request->type);
            $namafile =  $request->no_urut . '.jpg';
            $destination = public_path('images/paslon');
            $file->move($destination, $namafile);
        }
        return redirect(route('viewcalon', ['id' => $request->id]))->with([
            'pemberitahuan' => 'Data calon pemilihan berhasil diperbarui!',
            'warna' => 'success',
        ]);
    }

    // pemilih section
    public function pemilih()
    {
        if (isset($_GET['search'])) {
            $data = User::where('level', 2)->where('username', 'LIKE', '%' . $_GET['search'] . '%')->orderBy('username')->paginate(10);
        } else {
            $data = User::where('level', 2)->orderBy('username')->paginate(10);
        }
        return view('administrator.pemilih', [
            'pemilih' => $data,
        ]);
    }
    public function updatepemilih(Request $data)
    {
        User::where('id', $data->id)->update([
            'name' => $data->name
        ]);
        return redirect(route('viewpemilih', ['id' => $data->id]))->with([
            'pemberitahuan' => 'Berhasil memperbarui data pemilih!',
            'warna' => 'success'
        ]);
    }
    public function viewpemilih($id)
    {
        $data = User::where('id', $id)->get();
        return view('administrator.pemilihview', [
            'data' => $data
        ]);
    }
    public function hapuspemilih($id)
    {
        User::where('id', $id)->delete();
        return redirect(route('pemilih'))->with([
            'pemberitahuan' => 'Berhasil menghapus data pemilih!',
            'warna' => 'success'
        ]);
    }
    public function hapuspemilihall()
    {
        if (Auth::user()->level == 0) {
            User::where('level', 2)->delete();
            return redirect(route('pengaturan'))->with([
                'pemberitahuan' => 'Berhasil menghapus semua data pemilih!',
                'warna' => 'success'
            ]);
        } else {
            return redirect(route('welcome'))->with([
                'pemberitahuan' => 'Anda tidak memiliki akses untuk halaman ini!',
                'warna' => 'danger'
            ]);
        }
    }
    public function addpemilih(Request $data)
    {
        // dd($data->all());
        $checkdata = User::where('username', $data->nim)->count();
        $pass = $this->randomstringlah();
        if ($checkdata > 0) {
            return redirect(route('pemilih'))->with([
                'pemberitahuan' => 'Data pemilih gagal ditambah karena sudah tersedia',
                'warna' => 'danger'
            ]);
        } else {
            User::insert([
                'name' => $data->nama,
                'username' => $data->nim,
                'password' => Hash::make($pass),
                'token' => $pass,
                'level' => '2',
                'status' => '0',
                'vote_time' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect(route('pemilih'))->with([
                'pemberitahuan' => 'Data pemilih berhasil ditambah!',
                'warna' => 'success'
            ]);
        }
    }
    public function addpemilihbanyak(Request $data)
    {
        $data->validate([
            'file' => 'mimes:csv,txt'
        ]);

        $namafile = 'DataMahasiswa.csv';
        $file = $data->file('file');
        $destination = public_path('csv');
        $file->move($destination, $namafile);
        $datacsv = $this->csvtoarray(public_path('csv/DataMahasiswa.csv'));
        $datax = $datacsv;
        // echo $datacsv[1]['username'];
        $jmldatanotinput = 0;
        $jmldatadiinput = 0;
        for ($i = 0; $i < count($datacsv); $i++) {
            $cekdata = User::where('username', $datacsv[$i]['username'])->count();
            if ($cekdata > 0) {
                $jmldatanotinput += 1;
            } else {
                $jmldatadiinput += 1;
                $pass = $this->randomstringlah();
                User::insert([
                    'name' =>  $datacsv[$i]['name'],
                    'username' => $datacsv[$i]['username'],
                    'password' => Hash::make($pass),
                    'token' => $pass,
                    'level' => '2',
                    'status' => '0',
                    'vote_time' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        File::delete('csv/DataMahasiswa.csv');
        return redirect(route('pemilih'))->with([
            'pemberitahuan' => count($datacsv) . ' data pemilih ditemukan! ' . $jmldatadiinput . ' data berhasil diinput, ' . $jmldatanotinput . ' data gagal ditambah',
            'warna' => 'success'
        ]);
    }

    // setting section
    public function namabulan($numb)
    {
        switch ($numb) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;
            default:
                break;
        }
    }
    public function pengaturan()
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
        // dd($carouselfilename);
        return view('administrator.pengaturan', [
            'jumlahcarousel' => $carouselcount,
            'filecarousel' => $carouselfilename,
            'jumlahcarapilih' => $carapilihcount,
            'filecarapilih' => $carapilihfilename,
        ]);
    }
    public function updatepengaturan(Request $data)
    {
        // ajax function
        $nama = $data->id;
        $value = $data->value;
        if ($value == 'true') {
            $status = 1;
            Setting::where('nama', $nama)->update([
                'status' => $status
            ]);
        } else {
            $status = 0;
            Setting::where('nama', $nama)->update([
                'status' => $status
            ]);
        }

        return [$status];
    }
    public function waktu(Request $data)
    {
        // dd($data->all());
        echo $tanggal = str_replace('T', ' ', $data->tanggal);
        Waktu::where('nama', $data->type)->update([
            'tanggal' => date('Y-m-d H:i:s', strtotime($tanggal))
        ]);
        if ($data->type == 'Buka') {
            $status = "pembukaan";
        } else {
            $status = "penutupan";
        }
        return redirect(route('pengaturan'))->with([
            'pemberitahuan' => 'Berhasil memperbarui waktu ' . $status . ' pemilihan',
            'warna' => 'success'
        ]);
    }
    public function hapusgambar(Request $data)
    {
        $carousel = File::allFiles(public_path('images/' . $data->type));
        $file = pathinfo($carousel[$data->target]);
        File::delete(public_path('images/' . $data->type . '/' . $file['basename']));
        return redirect(route('pengaturan'))->with([
            'pemberitahuan' => 'Berhasil menghapus foto pada folder ' . $data->type,
            'warna' => 'success'
        ]);
    }
    public function tambahgambar(Request $data)
    {
        $file = $data->file('gambar' . $data->type);
        $namafile = $file->getClientOriginalName();
        $destination = public_path('images/' . $data->type);
        $file->move($destination, $namafile);
        return redirect(route('pengaturan'))->with([
            'pemberitahuan' => 'Berhasil menambah foto pada folder ' . $data->type,
            'warna' => 'success'
        ]);
    }
    public function downloadpemilih()
    {
        return Excel::download(new UsersExport, 'pemilih.xlsx');
    }
    public function updatedata(Request $data)
    {
        if ($data->password == null) {
            User::where('id', $data->id)->update([
                'name' => $data->name,
                'username' => $data->username,
            ]);
        } else {
            User::where('id', $data->id)->update([
                'name' => $data->name,
                'username' => $data->username,
                'password' => Hash::make($data->username),
            ]);
        }
        return redirect(route('pengaturan'))->with([
            'pemberitahuan' => 'Data profil admin berhasil diperbarui!',
            'warna' => 'success',
        ]);
    }
    public function resetapp(Request $data)
    {
        $datauser = User::where('id', Auth::user()->id)->get();
        if (Hash::check($data->password, $datauser[0]['password'])) {
            User::truncate();
            VisiMisi::truncate();
            Suara::truncate();
            User::insert([
                [
                    'name' => 'master administrator',
                    'username' => 'akimilakuo',
                    'password' => Hash::make('akimilakuo'),
                    'token' => null,
                    'level' => '0',
                    'status' => '0',
                    'vote_time' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            return redirect(route('pengaturan'))->with([
                'pemberitahuan',
                'warna',
            ]);
        } else {

            return redirect(route('pengaturan'))->with([
                'pemberitahuan',
                'warna',
            ]);
        }
    }
}
