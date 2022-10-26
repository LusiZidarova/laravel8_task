<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamController;

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

/* Route::get('/', function () {
    return view('layout');
}); */
/* Route::get('/', function () {
    return view('stream.create');
}); */
//Route::get('/', [\App\Http\Controllers\StreamController::class, 'index']);

Route::get('/', function () {
    return view('stream.index');
});
Route::get('/stream/create', [\App\Http\Controllers\StreamController::class, 'create']);
Route::post('stream/store', [\App\Http\Controllers\StreamController::class,  'store'])->name('store');

Route::get('/stream/getAll', [\App\Http\Controllers\StreamController::class, 'getAll'])->name('stream.getAll');
/* Route::get('stream/edit/{$id}',  [StreamController::class, 'edit']);
Route::delete('stream/delete/{$id}', [StreamController::class, 'destroy'])->name('stream.delete'); */
Route::get('/stream/delete/{id}',  [\App\Http\Controllers\StreamController::class,  'destroy'])->name('stream.delete');

/* Route::get('/stream/edit/{id}',  [StreamController::class, 'edit'])->name('stream.edit');
Route::post('/stream/{id}/update',  [StreamController::class, 'update']); */
Route::get('/stream/edit/{id}',  [StreamController::class, 'edit'])->name('stream.edit');
Route::post('/stream/update/{id}',  [StreamController::class, 'update'])->name('stream.update');
