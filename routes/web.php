<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MainMenuController@mainPage');
Route::get('portfolio', 'MainMenuController@mainPage');
Route::get('contacts', 'MainMenuController@mainPage');
Route::get('/page/{id}', 'MainMenuController@onePage');

Route::resource('admin/portfolio', PortfolioController::class);
Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});
