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

// admin pemilih page
Route::get('/administrator/pemilih', [AdminController::class, 'pemilih'])
    ->name('pemilih');

// admin pengaturan page
Route::get('/administrator/pengaturan', [AdminController::class, 'pengaturan'])
    ->name('pengaturan');

// voter page
Route::get('/vote', [VoterController::class, 'vote'])
    ->name('vote');
