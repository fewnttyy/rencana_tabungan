<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TabunganController;

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

Route::get('/', function () {
    // Cek apakah user sudah login
    if (session()->has('id_user')) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login.form');


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TabunganController::class, 'getTabungan'])->name('dashboard');
    Route::post('/tabungan/store', [TabunganController::class, 'store'])->name('tabungan.store');
    Route::put('/update-tabungan/{id}', [TabunganController::class, 'update'])->name('tabungan.update');
    Route::post('/menabung', [TabunganController::class, 'menabung'])->name('menabung');
    Route::get('/tabungan-detail/{id_tabungan}', [TabunganController::class, 'detail'])->name('tabungan.detail');
    Route::delete('/delete-menabung/{id_menabung}', [TabunganController::class, 'deleteMenabung'])->name('menabung.delete');
    Route::delete('/delete-tabungan/{id_tabungan}', [TabunganController::class, 'deleteTabungan'])->name('tabungan.delete');
});
