<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwxtController;
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

//listen the whenever a query is made
/*
DB::listen(function($query){
    dump($query->sql);
});
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/twxts', [TwxtController::class, 'index'])->name('twxts.index');
Route::post('/twxts', [TwxtController::class, 'store'])->name('twxts.store');
Route::get('/twxts/{id}/edit', [TwxtController::class, 'edit'])->name('twxts.edit');
Route::put('/twxts/{id}',[ TwxtController::class, 'update'])->name('twxts.update');
Route::delete('/twxts/{id}',[ TwxtController::class, 'destroy'])->name('twxts.destroy');



//--- BREEZE AUTH

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
