<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\GoogleAccountController;

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

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/appointment/{appointment}', [AppointmentController::class, 'show'])->name('appointment.show');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::put('/appointment/{appointment}', [AppointmentController::class, 'update'])->name('appointment.update');

    Route::get('/google/auth', [GoogleAccountController::class, 'store'])->name('google.store');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/achievement', [ProfileController::class, 'achievement'])->name('profile.achievement');

    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::post('/like', [LikeController::class, 'like'])->name('like');
    Route::delete('/like', [LikeController::class, 'unlike'])->name('like');
});

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/design/{post}', [PostController::class, 'design'])->name('design.show');

require __DIR__.'/auth.php';
