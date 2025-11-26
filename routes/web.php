<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RecapController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\HomeController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/allcake', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('allcake');

Route::get('/custom', function () {
    return view('user.Custom');
})->middleware(['auth', 'verified'])->name('custom');


Route::get('/Contact', function () {
    return view('user.kontak');
})->middleware(['auth', 'verified'])->name('Contact');

Route::get('/order/{id}', [App\Http\Controllers\User\OrderController::class, 'show'])->name('order.show');

Route::post('/list-pesanan', [OrderController::class, 'store'])->name('orders.store');
Route::middleware(['auth'])->group(function () {
    Route::get('/list-pesanan', [OrderController::class, 'userOrders'])
        ->name('user.list-pesanan');

    Route::post('/list-pesanan/cancel/{id}', [OrderController::class, 'cancelOrder'])
        ->name('user.list-pesanan.cancel');
});

Route::get('/pesanan/{id}', [App\Http\Controllers\User\OrderController::class, 'pesanan'])->name('user.pesanan');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/orders/{id}/update', [OrderController::class, 'updateStatus'])->name('orders.update');

        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

        Route::resource('/products', ProductController::class);
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
        

        Route::get('/slots/{date?}', [SlotController::class, 'index'])->name('slots.index');
        Route::post('/slots/update', [SlotController::class, 'update'])->name('slots.update');

        Route::get('/recap', [RecapController::class, 'index'])->name('recap.index');
});

require __DIR__.'/auth.php';