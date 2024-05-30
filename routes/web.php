<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return redirect()->route('auth.index');
//});

Route::get('/',[\App\Http\Controllers\FrontendController::class,'index']);
Route::middleware('guest')->group(function (){
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
    Route::post('/login', [AuthController::class, 'Verify'])->name('auth.verify');
});

Route::middleware(['auth:user', 'role:admin,pelanggan'])->group(function () {
    Route::get('booking/list', [BookingController::class, 'list'])->name('booking.list');
    Route::get('booking/detail/{tgl}', [BookingController::class, 'detail'])->name('booking.detail');
    Route::get('booking/batalkan/{idbs}', [BookingController::class, 'batalkan'])->name('booking.batalkan');


    Route::get('/booking/tambah', [BookingController::class, 'tambah'])->name('booking.tambah');
    Route::get('/booking/tambah/book/{tgl}', [BookingController::class, 'tambahbook'])->name('booking.tambah.book');
    Route::post('/booking/tambah/book', [BookingController::class, 'prosestambahbook'])->name('booking.prosestambah.book');

    Route::post('/booking/prosesTambah', [BookingController::class, 'prosesTambah'])->name('booking.prosesTambah');
    Route::get('/booking/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/prosesEdit', [BookingController::class, 'prosesEdit'])->name('booking.prosesEdit');
    Route::get('/booking/hapus/{id}', [BookingController::class, 'hapus'])->name('booking.hapus');

    #add
    Route::post('booking/session/generate', [BookingController::class, 'generate'])->name('booking.generate');

    Route::get('/galeri',[GaleriController::class, 'list'])->name('galeri.list');
    Route::get('/galeri/tambah',[GaleriController::class, 'tambah'])->name('galeri.tambah');
    Route::post('/galeri/prosesTambah',[GaleriController::class, 'prosesTambah'])->name('galeri.prosesTambah');
    Route::get('/galeri/edit/{id}',[GaleriController::class, 'edit'])->name('galeri.edit');
    Route::post('/galeri/prosesEdit',[GaleriController::class, 'prosesEdit'])->name('galeri.prosesEdit');
    Route::get('/galeri/hapus/{id}',[GaleriController::class, 'hapus'])->name('galeri.hapus');

    Route::get('/lapangan',[LapanganController::class, 'list'])->name('lapangan.list');
    Route::get('/lapangan/tambah',[LapanganController::class, 'tambah']) ->name('lapangan.tambah');
    Route::post('/lapangan/prosesTambah',[LapanganController::class, 'prosesTambah']) ->name('lapangan.prosesTambah');
    Route::get('/lapangan/edit{id}',[LapanganController::class, 'edit']) ->name('lapangan.edit');
    Route::post('/lapangan/prosesEdit',[LapanganController::class, 'prosesEdit']) ->name('lapangan.prosesEdit');
    Route::get('/lapangan/hapus{id}',[LapanganController::class, 'hapus']) ->name('lapangan.hapus');

});




Route::group(['middleware' => 'auth:user'], function () {
    Route::prefix('admin')->group(function (){
        Route::get('/',[DashboardController::class,'index'])->name('dashboard.index')->middleware('role.admin');
        Route::get('/api/check-availability', [BookingController::class, 'checkBookingAvailability']);
        // Route::get('/api/check-availability', [BookingController::class, 'checkAvailability']);

        Route::post('/booking/approve/{id}',[BookingController::class, 'approve'])->name('booking.approve');

        Route::get('/menu',[MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/tambah',[MenuController::class, 'tambah'])->name('menu.tambah');
        Route::post('/menu/prosesTambah',[MenuController::class, 'prosesTambah'])->name('menu.prosesTambah');
        Route::get('/menu/ubah/{id}',[MenuController::class, 'ubah'])->name('menu.ubah');
        Route::post('/menu/prosesUbah',[MenuController::class, 'prosesUbah'])->name('menu.prosesUbah');
        Route::get('/menu/hapus/{id}',[MenuController::class, 'hapus'])->name('menu.hapus');
        Route::get('/menu/order/{idMenu}/{idSwap}',[MenuController::class, 'order'])->name('menu.order');

        Route::get('/page',[PageController::class, 'index'])->name('page.index');
        Route::get('/page/tambah',[PageController::class, 'tambah'])->name('page.tambah');
        Route::post('/page/prosesTambah',[PageController::class, 'prosesTambah'])->name('page.prosesTambah');
        Route::get('/page/ubah/{id}',[PageController::class, 'ubah'])->name('page.ubah');
        Route::post('/page/prosesUbah',[PageController::class, 'prosesUbah'])->name('page.prosesUbah');
        Route::get('/page/hapus/{id}',[PageController::class, 'hapus'])->name('page.hapus');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
Route::get('/',[FrontendController::class,'index'])->name('home.index');
Route::get('layout/main',[FrontendController::class,'main']);
Route::get('/page{id}',[FrontendController::class,'detailPage'])->name('home.detailPage');
Route::get('/product',[FrontendController::class,'semuaProduct'])->name('home.product');

Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return response()->make($file, 200)->header("Content-Type", $type);
})->name('storage');