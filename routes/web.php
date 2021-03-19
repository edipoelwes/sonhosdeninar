<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
   UserController,ClientController, ProductController,
   RoleController, PermissionController, PurchaseController};

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

   Route::get('users/edit', 'App\Http\Controllers\UserController@edit')->name('users.edit');
   Route::resource('users', UserController::class)->except(['create', 'show', 'edit', 'update']);

   Route::get('clients/edit', 'App\Http\Controllers\ClientController@edit')->name('clients.edit');
   Route::resource('clients', ClientController::class)->except(['create', 'show', 'edit', 'update']);

   Route::get('product', 'App\Http\Controllers\ProductController@product')->name('products.product');
   Route::get('product/{category}', 'App\Http\Controllers\ProductController@index')->name('products.index');
   Route::get('products/edit', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
   Route::resource('products', ProductController::class)->except(['index', 'create', 'show', 'edit', 'update']);

   Route::resources([
      'purchases' => PurchaseController::class
   ]);

   /**Rota de permissoes de acesso */
   Route::get('roles/{role}/permissions', 'App\Http\Controllers\RoleController@permissions')->name('roles.permission');
   Route::put('roles/{role}/permissions/sync', 'App\Http\Controllers\RoleController@permissionsSync')->name('roles.permissionSync');

   Route::get('users/{user}/roles', 'App\Http\Controllers\UserController@roles')->name('users.roles');
   Route::put('users/{user}/roles/sync', 'App\Http\Controllers\UserController@rolesSync')->name('users.rolesSync');

   Route::get('roles/edit', 'App\Http\Controllers\RoleController@edit')->name('roles.edit');
   Route::resource('roles', RoleController::class)->except(['create', 'show', 'edit', 'update']);

   Route::get('permissions/edit', 'App\Http\Controllers\PermissionController@edit')->name('permissions.edit');
   Route::resource('permissions', PermissionController::class)->except(['create', 'show', 'edit', 'update']);

   Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

   Route::middleware(['permission:Super Usuario'])->group(function () {
      Route::view('regular', 'paper-dashboard.tables.regular')->name('regular');
      Route::view('extended', 'paper-dashboard.tables.extended')->name('extended');
   });

   Route::view('icons', 'paper-dashboard.components.icons')->name('icons')->middleware(['permission:Super Usuario']);
   Route::view('users-profile', 'paper-dashboard.pages.user')->name('profile')->middleware(['permission:Super Usuario']);
});
