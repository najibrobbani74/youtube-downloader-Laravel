<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

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
})->name('home');
Route::get('/my-documentation', function () {
    return view('documentation');
});
Route::get('/video', [VideoController::class,'searchVideo'])->name('searchVideo');
Route::get('/video/download/{id}', [VideoController::class,'videoDownloadDetail'])->name('videoDownloadDetail');
Route::get('/video/{id}', [VideoController::class,'videoDetail'])->name('videoDetail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/history', [HistoryController::class,'historyPage'])->middleware(['auth', 'verified'])->name('history');
Route::post('/storeHistory', [HistoryController::class,'storeHistory'])->middleware(['auth', 'verified'])->name('storeHistory');
Route::delete('/deleteHistory/{id}', [HistoryController::class,'deleteHistory'])->middleware(['auth', 'verified'])->name('deleteHistory');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
