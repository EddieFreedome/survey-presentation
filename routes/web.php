<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
//inutile specificarlo... va specificato il namespace alla dichiarazione della rotta del controller
// use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Clicker;
use App\Livewire\HiddenForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
// Livewire::routes();


Route::get('/', function () {
    if (Auth::check()) {
        return view('dashboard');
    } else {
        return view('welcome');
    }
});

if (Auth::user() == 'admin') {
    return view('admin');
}

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard', [HomeController::class,'index']);


// FrontController 
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', [App\Http\Controllers\FrontController::class, 'dashboard'])->name('dashboard');
    // Route::post('/nextstep', [App\Http\Controllers\FrontController::class, 'nextstep'])->name('nextstep');
    // Route::get('/start', [App\Http\Controllers\FrontController::class, 'index'])->name('start');
    Route::post('/nextstep', [HiddenForm::class, 'nextstep'])->name('nextstep');
    Route::get('/start', [HiddenForm::class, 'index'])->name('start');
    // Route::get('/clicker', [Clicker::class, 'redirectUserIfAdminsession'])->name('clicker');
});

/* crud:create add resource route */
   


require __DIR__.'/auth.php';
