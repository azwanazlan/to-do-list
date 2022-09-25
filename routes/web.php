<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/','home')->name('/');
    Route::get('/home','index')->name('home');
});

Route::controller(ContentController::class)->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::post('/add', 'addContent')->name('add');
        Route::get('delete/{id}', 'deleteContent')->name('delete');
        Route::get('edit/{id}', 'editContent')->name('edit');
        Route::post('update/{id}', 'updateContent')->name('update');
    });
});
