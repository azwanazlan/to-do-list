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

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/add', [ContentController::class, 'addContent'])->name('add');

Route::get('delete/{id}', [ContentController::class, 'deleteContent'])->name('delete');

Route::get('edit/{id}', [ContentController::class, 'editContent'])->name('edit');
Route::post('update/{id}', [ContentController::class, 'updateContent'])->name('update');



