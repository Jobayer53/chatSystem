<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/message', [MessageController::class, 'index'])->name('message');


// Route::post('message/store',[MessageController::class, 'store'])->name('store');
// Route::get('/messages/fetch', [MessageController::class, 'fetchMessages'])->name('messages.fetch');
Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [MessageController::class, 'index'])->name('chat');
    Route::post('/messages', [MessageController::class, 'store']);
});
