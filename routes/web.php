<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [GeneralController::class, 'index'])
    ->name('welcome');

Route::get('/visi-misi', [GeneralController::class, 'visimisi'])
    ->name('visimisi');

Route::get('/cek-voter', [GeneralController::class, 'votercheck'])
    ->name('cekvoter');

Route::post('/cek-voter', [GeneralController::class, 'voterchecking'])
    ->name('cekingvoter');

Route::get('/hasil-pemilihan', [GeneralController::class, 'hasilpemilihan'])
    ->name('hasil');

Auth::routes([
    'register' => false,
    'reset' => false,
]);

// admin home page
Route::get('/administrator', [AdminController::class, 'index'])
    ->name('home');

// admin panitia page
Route::get('/administrator/panitia', [AdminController::class, 'panitia'])
    ->name('administrator');

Route::post('/administrator/panitia', [AdminController::class, 'addpanitia'])
    ->name('addadministrator');

Route::post('/administrator/panitia/update', [AdminController::class, 'updatepanitia'])
    ->name('updateadministrator');

Route::get('/administrator/panitia/reset/{id}', [AdminController::class, 'resetpanitia'])
    ->name('resetadministrator');

Route::get('/administrator/panitia/view/{id}', [AdminController::class, 'viewpanitia'])
    ->name('viewadministrator');

Route::get('/administrator/panitia/activate/{id}', [AdminController::class, 'activatepanitia'])
    ->name('activateadministrator');

Route::get('/administrator/panitia/deactive/{id}', [AdminController::class, 'deactivatepanitia'])
    ->name('deactivateadministrator');

// admin calon page
Route::get('/administrator/calon', [AdminController::class, 'calon'])
    ->name('calon');

Route::post('/administrator/calon', [AdminController::class, 'addcalon'])
    ->name('addcalon');

Route::post('/administrator/calon/update', [AdminController::class, 'updatecalon'])
    ->name('updatecalon');

Route::get('/administrator/calon/view/{id}', [AdminController::class, 'viewcalon'])
    ->name('viewcalon');

// admin pemilih page
Route::get('/administrator/pemilih', [AdminController::class, 'pemilih'])
    ->name('pemilih');

Route::get('/administrator/pemilih/view/{id}', [AdminController::class, 'viewpemilih'])
    ->name('viewpemilih');

Route::post('/administrator/pemilih/update', [AdminController::class, 'updatepemilih'])
    ->name('updatepemilih');

Route::get('/administrator/pemilih/hapus/{id}', [AdminController::class, 'hapuspemilih'])
    ->name('hapuspemilih');

Route::get('/administrator/pemilih/hapus', [AdminController::class, 'hapuspemilihall'])
    ->name('hapuspemilihall');

Route::post('/administrator/pemilih', [AdminController::class, 'addpemilih'])
    ->name('addpemilih');
    
Route::post('/administrator/pemilih/banyak', [AdminController::class, 'addpemilihbanyak'])
    ->name('addpemilihbanyak');

Route::get('/administrator/pemilih/download', [AdminController::class, 'downloadpemilih'])
    ->name('downloadpemilih');

// admin pengaturan page
Route::get('/administrator/pengaturan', [AdminController::class, 'pengaturan'])
    ->name('pengaturan');
Route::post('/administrator/pengaturan/update', [AdminController::class, 'updatepengaturan'])
    ->name('updatepengaturan');
Route::post('/administrator/pengaturan/hapusgambar', [AdminController::class, 'hapusgambar'])
    ->name('hapusgambar');
Route::post('/administrator/pengaturan/addgambar', [AdminController::class, 'tambahgambar'])
    ->name('tambahgambar');
Route::post('/administrator/pengaturan/waktu', [AdminController::class, 'waktu'])
    ->name('updatewaktu');
Route::post('/administrator/pengaturan/updatedata', [AdminController::class, 'updatedata'])
    ->name('updatedata');

// voter page
Route::get('/vote', [VoterController::class, 'vote'])
    ->name('vote');
