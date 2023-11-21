<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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
    return view('welcome');
});

//Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get','post'],'login', 'AdminController@login' )->name('admin.login');
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard', 'AdminController@dashboard' )->name('admin.dashboard');
        Route::match(['get', 'post'],'products/create', 'ProductController@create' )->name('admin.products.create');
        Route::post('products/store', 'ProductController@store' )->name('admin.products.store');
        Route::get('products/index', 'ProductController@index' )->name('admin.products.index');
        Route::get('products/{id}', 'ProductController@show')->name('admin.products.show');
        Route::get('products/{id}/edit', 'ProductController@edit')->name('admin.products.edit');
        Route::put('products/{id}/update', 'ProductController@update')->name('admin.products.update');
        Route::delete('products/{id}/destroy', 'ProductController@destroy')->name('admin.products.destroy');
        Route::get('sample', 'AdminController@sample' )->name('admin.sample');
        Route::get('logout', 'AdminController@logout' )->name('admin.logout');
    });
});