<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

// 1 => 7
// Route::group(['prefix' => 'admin', 'as' => 'name.'], function() {

// });

// 8 => 10
Route::prefix('admin')->name('admin.')->middleware('auth', 'khalid')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
