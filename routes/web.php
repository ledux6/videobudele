<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VideoRegistrationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CommandController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('song-registration/{videoId}', function($videoId) {
    return Inertia::render('SongRegistration', [ 'videoId' => $videoId ]);
})->name('songRegistration');

Route::post('song-registration', [VideoRegistrationController::class, 'register'])
    ->name('song.reg.post');

Route::get('/success/{code}', function($code) {
    return Inertia::render('Success', ['code' => $code]);
})->name('success');

Route::get('/code', function() {
    return Inertia::render('CodeInput');
});

Route::post('/code', [RegistrationController::class, 'changeRegistrationStatus'])
    ->name('change.status');
Route::get('/registrations/waiting',function() {
    return Inertia::render('RegistrationsListWaiting');
});
Route::get('/registrations/full',function() {
    return Inertia::render('RegistrationsListFull');
});

Route::get('/registrations/items', [RegistrationController::class, 'list']);
Route::get('/registrations/waiting/items', [RegistrationController::class, 'waitinglist']);
Route::post('/registration/item/close/{id}', [RegistrationController::class, 'close']);
Route::get('/registrations/admin', function() {
    return Inertia::render('Administration');
});
Route::post('/registrations/admin/clear', [RegistrationController::class, 'clear']);
Route::get('/registrations/logs/top', [VideoRegistrationController::class, 'top5Videos']);