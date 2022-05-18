<?php

use App\Http\Controllers\BroadCastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserBroadCastController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BroadCastController::class, 'index'])->name('main.page');
Route::get('/view/{broadCast}', [BroadCastController::class, 'show'])->name('broadcast.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/my-broadcast', [UserBroadCastController::class, 'index'])->name('user.broadcast');
    Route::get('/my-broadcast/{broadCast}', [UserBroadCastController::class, 'show'])->name('user.broadcast.show');
    Route::delete('/my-broadcast/{broadCast}', [UserBroadCastController::class, 'destroy'])->name('user.broadcast.destroy');
    Route::get('/broadcast/create', [UserBroadCastController::class, 'createForm'])->name('user.broadcast.create.form');
    Route::post('/broadcast/create', [UserBroadCastController::class, 'create'])->name('user.broadcast.create.post');

});

require __DIR__.'/auth.php';
