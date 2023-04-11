<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// 1 => 7
// Route::group(['prefix' => 'admin', 'as' => 'name.'], function() {

// });

// 8 => 10
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});
