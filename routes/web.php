<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

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
    return view('index');
})->name('index');

Route::get('/createUsers', [DocumentController::class, 'createUsers'])->name('users.create');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/documents', [DocumentController::class, 'list'])->name('documents');
    Route::post('/documents', [DocumentController::class, 'list'])->name('search');
});

Route::post('uploadPost', [DocumentController::class, 'uploadPost'])->name('document.upload.post');

require __DIR__ . '/auth.php';
