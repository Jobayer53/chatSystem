<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/index', [MessageController::class, 'index'])->name('home');

Route::post('/user/register', [HomeController::class, 'user_register'])->name('user.register');
Route::post('/chat/store', [MessageController::class, 'store'])->name('chat.store');
Route::get('/get/messages/{id}', [MessageController::class, 'getMessages'])->name('getMessages');
Route::get('/get/count', [MessageController::class, 'getcount'])->name('getcount');
Route::get('/reset/count/{receiver_id}', [MessageController::class, 'resetCount'])->name('resetCount');

