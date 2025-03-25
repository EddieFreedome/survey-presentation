<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
//inutile specificarlo... va specificato il namespace alla dichiarazione della rotta del controller
// use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Clicker;
use App\Livewire\HiddenForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
// Livewire::routes();

use App\Livewire\TokenLogin;
use App\Http\Controllers\PreLobbyController;

Route::get('/login', [PreLobbyController::class, 'loginView'])->name('login');
Route::post('/register', [PreLobbyController::class, 'register'])->name('register');
Route::get('/pre-lobby', [PreLobbyController::class, 'show'])->name('pre-lobby');
// Route::group(['middleware' => AuthMiddleware::class], function () {
// Route::middleware('auth')->group(function () {

    Route::get('/start', [App\Http\Controllers\FrontController::class, 'start'])->name('start');
    Route::post('/nextstep', [App\Http\Controllers\FrontController::class, 'nextstep'])->name('nextstep');
    Route::get('/clicker', [Clicker::class, 'redirectUserIfAdminsession'])->name('clicker');

// });

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('admin/dashboard', [HomeController::class,'index']);


// FrontController 
// Route::middleware(['auth.middleware'])->group(function () {
//     // Route::get('/dashboard', [App\Http\Controllers\FrontController::class, 'dashboard'])->name('dashboard');
//     // Route::post('/nextstep', [App\Http\Controllers\FrontController::class, 'nextstep'])->name('nextstep');
//     // Route::get('/start', [App\Http\Controllers\FrontController::class, 'index'])->name('start');
//     Route::post('/nextstep', [HiddenForm::class, 'nextstep'])->name('nextstep');
//     Route::get('/start', [HiddenForm::class, 'index'])->name('start');
//     // Route::get('/clicker', [Clicker::class, 'redirectUserIfAdminsession'])->name('clicker');
// });

/* crud:create add resource route */
   


// require __DIR__.'/auth.php';
