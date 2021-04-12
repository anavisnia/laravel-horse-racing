<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\BetterController;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [BetterController::class, 'index'])->name('better.index'); // force to login

Route::group(['prefix' => 'horses'], function(){
    Route::get('', [HorseController::class, 'index'])->name('horse.index');
    Route::get('create', [HorseController::class, 'create'])->name('horse.create');
    Route::post('store', [HorseController::class, 'store'])->name('horse.store');
    Route::get('edit/{horse}', [HorseController::class, 'edit'])->name('horse.edit');
    Route::post('update/{horse}', [HorseController::class, 'update'])->name('horse.update');
    Route::post('delete/{horse}', [HorseController::class, 'destroy'])->name('horse.delete');
    Route::get('show/{horse}', [HorseController::class, 'show'])->name('horse.show');
    Route::get('pdf/{horse}', [HorseController::class, 'pdf'])->name('horse.pdf');
});

Route::group(['prefix' => 'betters'], function(){
    Route::get('', [BetterController::class, 'index'])->name('better.index');
    Route::get('create', [BetterController::class, 'create'])->name('better.create');
    Route::post('store', [BetterController::class, 'store'])->name('better.store');
    Route::get('edit/{better}', [BetterController::class, 'edit'])->name('better.edit');
    Route::post('update/{better}', [BetterController::class, 'update'])->name('better.update');
    Route::post('delete/{better}', [BetterController::class, 'destroy'])->name('better.delete');
    Route::get('show/{better}', [BetterController::class, 'show'])->name('better.show');
});