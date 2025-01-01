<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VideoRegistrationController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('song-registration/{videoId}', function($videoId) {
    return Inertia::render('SongRegistration', [ 'videoId' => $videoId ]);
})->name('songRegistration');

Route::post('song-registration', [VideoRegistrationController::class, 'register'])->name('song.reg.post');

Route::get('/success/{code}', function($code) {
    return Inertia::render('Success', ['code' => $code]);
})->name('success');

Route::get('/code', function() {
    return Inertia::render('CodeInput');
});

Route::post('/code', [RegistrationController::class, 'changeRegistrationStatus'])->name('change.status');

require __DIR__.'/auth.php';
