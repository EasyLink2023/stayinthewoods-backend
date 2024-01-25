<?php

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
    return redirect()->route('login');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middlware'=>'auth'], function() {
    Route::get('/event', [App\Http\Controllers\EventController::class, 'index'])->name('event.index');
    Route::post('/event', [App\Http\Controllers\EventController::class, 'create'])->name('event.create');
    Route::get('/delete-event/{id}', [App\Http\Controllers\EventController::class, 'delete'])->name('event.delete');
    Route::get('/update-status/{id}', [App\Http\Controllers\EventController::class, 'updateStatus'])->name('event.update-status');
});