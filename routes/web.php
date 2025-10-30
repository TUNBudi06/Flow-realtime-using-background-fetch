<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/',[IndexController::class,'index'])->name('home');
Route::get('/login',[IndexController::class,'login'])->name('login');


Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::get('/',[IndexController::class,'adminHome'])->name('admin.home');
    // MainLine
    Route::get('/mainline', function() {
        return view('pages.mainline');
    })->name('mainline');

    // Inspection
    Route::get('/inspection', function() {
        return view('pages.inspection');
    })->name('inspection');

    // Delivery
    Route::get('/delivery', function() {
        return view('pages.delivery');
    })->name('delivery');

    // Settings
    Route::get('/settings', function() {
        return view('pages.settings');
    })->name('settings');

    // Logout
    Route::post('/logout', function() {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
