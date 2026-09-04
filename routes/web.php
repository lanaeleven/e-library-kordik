<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/', [BookController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/books/borrow/{book}', [BookController::class, 'borrow'])->name('book.borrow');
    Route::get('/books/{book}', [BookController::class, 'detail'])->name('book.detail');
    Route::get('/books/{book}/read', [BookController::class, 'show'])->name('book.read');
    Route::get('/books/{book}/page/{pageNumber}', [BookController::class, 'servePage'])->name('book.page');
});
