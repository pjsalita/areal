<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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
    return view('index');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/feed', [FeedController::class, 'index'])->name('feed');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{user}', [ProfileController::class, 'get'])->name('profile.view');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
});

require __DIR__.'/auth.php';
