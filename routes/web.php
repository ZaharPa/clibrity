<?php

use App\Http\Controllers\AddedByUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('', fn() => to_route('book.index'));

Route::resource('book', BookController::class)
    ->only(['index', 'show']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('register', RegistrationController::class)
    ->only(['create', 'store']);

Route::get('/email/verify', function() {
    return inertia('Registration/VerifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('book.index')
        ->with('success', 'Email was verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    if (!$request->user()->hasVerifiedEmail()) {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->intended('/book')->with('success', 'Verification link sent!');
    }

    return redirect()->intended('/book')->with('success', 'You already have verified email');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::resource('added-book', AddedByUserController::class)
    ->middleware(['auth', 'verified'])->except('show');
