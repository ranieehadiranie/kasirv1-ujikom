<?php

use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetugasRequestController;
use App\Http\Controllers\ManagementPetugas;



Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerStore'])->name('register.store');
Route::post('/login', [UserController::class, 'loginCheck'])->name('login.check');
Route::resource('users', UserController::class);
// dasboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::post('produk/cetak/label', [ProdukController::class, 'cetakLabel'])->name('produk.cetakLabel');
    Route::PUT('produk/edit/{id}/tambahStok', [ProdukController::class, 'tambahStok'])->name('produk.tambahStok');
    Route::get('produk/logproduk', [ProdukController::class, 'logproduk'])->name('produk.logproduk');
    Route::resource('produk', ProdukController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::get('penjualan/bayarCash/{id}', [PenjualanController::class, 'bayarCash'])->name('penjualan.bayarCash');
    Route::post('penjualan/bayarCash', [PenjualanController::class, 'bayarCashStore'])->name('penjualan.bayarCashStore');
    Route::get('penjualan/nota/{id}', [PenjualanController::class, 'nota'])->name('penjualan.nota');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/petugas-requests', [PetugasRequestController::class, 'index'])->name('petugas-requests.index');
    Route::get('/petugas-requests/{id}/edit', [PetugasRequestController::class, 'edit'])->name('petugas-requests.edit');
    Route::get('/petugas-request/datatables', [PetugasRequestController::class, 'datatable'])->name('petugas-requests.datatable');
    Route::get('/petugas-requests/create', [PetugasRequestController::class, 'create'])->name('petugas-requests.create');
    Route::post('/petugas-requests', [PetugasRequestController::class, 'store'])->name('petugas-requests.store');
    Route::put('/petugas-requests/{id}', [PetugasRequestController::class, 'update'])->name('petugas-requests.update');
Route::delete('/petugas-requests/{id}', [PetugasRequestController::class, 'destroy'])->name('petugas-requests.destroy');
Route::get('/petugas-request/datatables', [PetugasRequestController::class, 'datatable'])->name('petugas-requests.datatable');
    Route::get('/dashboard', [PenjualanController::class, 'dashboard'])->name('dashboard');
  
});
