<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/',[IndexController::class,'index'])->name('home');
Route::get('/login',[IndexController::class,'login'])->name('login');
