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
use Doctrine\Common\Lexer\Token;

// Route::get('/', function () {
//     if (Auth::check()) {
//         return view('dashboard');
//     } else {
//         return view('welcome');
//     }
// });

// if (Auth::user() == 'admin') {
//     return view('admin');
// }

// Route::get('/sign-in', TokenLogin::class)->name('sign-in');
// Route::get('/lobby', function () {
//     return view('token-login');
// })->middleware('auth.middleware')->name('lobby');
Route::get('/sign-in', [TokenLogin::class, 'render'])->name('sign-in');

Route::group(['middleware' => AuthMiddleware::class], function () {
    Route::get('/pre-lobby', function () {
        return view('dashboard');
    })->name('pre-lobby');
});
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('admin/dashboard', [HomeController::class,'index']);


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
