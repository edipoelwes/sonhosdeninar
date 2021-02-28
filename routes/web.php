<?php

use App\Http\Controllers\{UserController};
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

Route::get('/', 'App\Http\Controllers\AuthController@loginForm')->name('login');
Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login.do');

Route::middleware('auth')->group(function () {
   Route::get('home', 'App\Http\Controllers\HomeController@home')->name('home');
   Route::get('companies', 'App\Http\Controllers\CompanyController@companies')->name('companies');
   Route::resources([
      'users' => UserController::class,
   ]);
   Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
});
