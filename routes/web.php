<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExpertiseController;

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

Route::resource('teste', ExpertiseController::class);
Route::get('edit', 'App\Http\Controllers\ExpertiseController@edit')->name('edit');
Route::get('add_exp', 'App\Http\Controllers\ExpertiseController@insert')->name('add_exp');
Route::get('delete_char', 'App\Http\Controllers\CharController@destroy')->name('delete_char');
Route::get('delete_myweapon', 'App\Http\Controllers\CharController@delmyweapon')->name('delete_myweapon');
Route::get('load_myweapon', 'App\Http\Controllers\CharController@infomyweapon')->name('load_myweapon');
Route::get('add_weapon', 'App\Http\Controllers\CharController@addweapon')->name('add_weapon');
Route::get('load_weapons', 'App\Http\Controllers\CharController@infoweapon')->name('load_weapons');
Route::get('load_armors', 'App\Http\Controllers\CharController@infoarmor')->name('load_armors');
Route::get('load_shields', 'App\Http\Controllers\CharController@infoshield')->name('load_shields');





