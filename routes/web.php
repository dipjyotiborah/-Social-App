<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

// Remove or comment out the LikeController reference
// use App\Http\Controllers\LikeController;
// Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');
Route::middleware('auth')->group(function () {
    Route::post('/exchange/offer', [ExchangeController::class, 'offerExchange'])->name('exchange.offer');
    Route::post('/exchange/respond/{exchange}', [ExchangeController::class, 'respondToExchange'])->name('exchange.respond');
});
use App\Http\Controllers\ExchangeController;

Route::post('/exchange/offer', [ExchangeController::class, 'store']);

require __DIR__.'/auth.php';
