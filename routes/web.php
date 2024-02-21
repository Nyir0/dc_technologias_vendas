<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->post('/sell', [SellerController::class, 'Sell']);

Route::middleware('auth')->post('/edit', [SellerController::class, 'Edit']);

Route::middleware('auth')->get('/history', [SellerController::class, 'history'])->name('history');

Route::middleware('auth')->post('/sell-close', [SellerController::class, 'SellClose']);

Route::middleware('auth')->get('/edit-history/{id}', [SellerController::class, 'editHistory']);

require __DIR__.'/auth.php';
