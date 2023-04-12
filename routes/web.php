<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

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

Route::get('/', function () {
    return view('welcome');
})->name('front.index');

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_admin'
])->group(function () {
    //manggil controller yang dibuat seperti biasa
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    //manggil controller yang dibuatnya pake --resource (langsung di buat crudnya)
    Route::resource('brands', AdminBrandController::class);
    Route::resource('types', AdminTypeController::class);
    Route::resource('items', AdminItemController::class);
    // Route::resource('bookings', AdminBookingController::class);
});
