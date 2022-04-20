<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\WeaponController;

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


Route::GET('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('chars', CharController::class);

//Route::get('teste', [CharController::class, 'insert']);
Route::get('teste', 'App\Http\Controllers\WeaponController@index')->name('teste');
Route::get('load_weapons', 'App\Http\Controllers\WeaponController@loadWeapons')->name('load_weapons');





