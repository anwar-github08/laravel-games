<?php

use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DigiflazzController;
use App\Http\Controllers\TransaksiController;
use App\Http\Livewire\ShowProduk;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [DigiflazzController::class, 'getKategori']);
Route::post('/produk', [ShowProduk::class, 'mount']);

// Admin
Route::get('/kategori', [AdminController::class, 'kategoriAdd']);


// // topup / transaksi
// Route::post('/topup', [DigiflazzController::class, 'topUp']);
// Route::get('/topup', [DigiflazzController::class, 'pulsa']);


// // request transaksi
// Route::post('/transaksi', [TransaksiController::class, 'store']);

// // menampilkan data transaksi
// Route::get('/transaksi/{reference}', [TransaksiController::class, 'show'])->name('transaksi.show');


// // admin
// Route::get('/admin', [AdminController::class, 'index']);

// cekTransaksi
Route::get('/cekTransaksi', function () {
   return view('admin.cekTransaksi', ['title' => 'Cek Transaksi']);
});
Route::post('/cekTransaksi', [AdminController::class, 'show']);

// // riwayat transaksi
// Route::get('/riwayatTransaksi', [AdminController::class, 'riwayatTransaksi'])->middleware('auth');

// // callback
// Route::post('/callback', [CallbackController::class, 'handle']);

// // register
// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);

// // login
// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'auth']);

// // logout
// Route::post('/logout', [LoginController::class, 'logout']);



// // endpoint test
// Route::get('/cekSaldo', [DigiflazzController::class, 'cekSaldo']);
// Route::get('/daftarHarga', [DigiflazzController::class, 'daftarHarga']);
