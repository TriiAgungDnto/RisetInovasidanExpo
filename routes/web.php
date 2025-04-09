<?php

use App\Http\Controllers\PageController;
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

Auth::routes([
    'register' => false
]);

Route::group(
    [
    'middleware' => 'pagespeed',],
    function () {
        Route::get('/', [PageController::class, 'index'])->name('home');
        Route::get('/book', [PageController::class, 'book'])->name('book');
        Route::get('/haki', [PageController::class, 'haki'])->name('haki');
        Route::get('/innovation', [PageController::class, 'innovation'])->name('innovation');
        Route::get('/journal', [PageController::class, 'journal'])->name('journal');
        Route::get('/conference', [PageController::class, 'conference'])->name('conference');
        Route::get('/grant', [PageController::class, 'grant'])->name('grant');
    }
);
