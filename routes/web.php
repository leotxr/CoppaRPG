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

//ROTAS DO PERSONAGEM
Route::resource('chars', CharController::class);
Route::get('destroy', 'App\Http\Controllers\CharController@destroy')->name('destroy');

//ROTAS TESTE
Route::get('teste', 'App\Http\Controllers\ExpertiseController@teste');
Route::get('equips', 'App\Http\Controllers\ExpertiseController@show')->name('equips');
Route::get('add_exp', 'App\Http\Controllers\ExpertiseController@insert')->name('add_exp');
Route::get('delete_char', 'App\Http\Controllers\CharController@destroy')->name('delete_char');

//ROTAS RELACIONADAS AS INSERCOES DE ARMAS AO PERSONAGEM COM USO DE AJAX
Route::get('delete_myweapon', 'App\Http\Controllers\WeaponController@delmyweapon')->name('delete_myweapon');
Route::get('load_myweapon', 'App\Http\Controllers\WeaponController@infomyweapon')->name('load_myweapon');
Route::get('add_weapon', 'App\Http\Controllers\WeaponController@addweapon')->name('add_weapon');
Route::get('load_weapons', 'App\Http\Controllers\WeaponController@infoweapon')->name('load_weapons');

//ROTAS RELACIONADAS AS INSERCOES DE TALENTOS AO PERSONAGEM COM USO DE AJAX
Route::get('delete_mytalent', 'App\Http\Controllers\TalentController@delmytalent')->name('delete_mytalent');
Route::get('load_mytalent', 'App\Http\Controllers\TalentController@infomytalent')->name('load_mytalent');
Route::get('add_talent', 'App\Http\Controllers\TalentController@addtalent')->name('add_talent');
Route::get('load_talents', 'App\Http\Controllers\TalentController@infotalent')->name('load_talents');

//ROTAS RELACIONADAS AS INSERCOES DE MAGIAS AO PERSONAGEM COM USO DE AJAX
Route::get('delete_mymagic', 'App\Http\Controllers\MagicController@delmymagic')->name('delete_mymagic');
Route::get('load_mymagic', 'App\Http\Controllers\MagicController@infomymagic')->name('load_mymagic');
Route::get('add_magic', 'App\Http\Controllers\MagicController@addmagic')->name('add_magic');
Route::get('load_magics', 'App\Http\Controllers\MagicController@infomagic')->name('load_magics');

//ROTAS RELACIONADAS AS INSERCOES DE PERICIAS AO PERSONAGEM COM USO DE AJAX
Route::get('show_expertises_table', 'App\Http\Controllers\ExpertiseController@infoexpertisestable')->name('show_expertises_table');
Route::get('show_my_expertises', 'App\Http\Controllers\ExpertiseController@infomyexpertises')->name('show_my_expertises');
Route::get('update_exp', 'App\Http\Controllers\ExpertiseController@update_exp')->name('update_exp');

//ROTAS DE CARREGAMENTO DE INFORMACOES DE OBJETOS
Route::get('load_armors', 'App\Http\Controllers\ArmorController@infoarmor')->name('load_armors');
Route::get('load_shields', 'App\Http\Controllers\ShieldController@infoshield')->name('load_shields');





