<?php

use App\Http\Controllers\InterestsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function (){
    Route::get('/profile', [ProfileController::class, 'show'])->name('public.profile');
});

Route::group(['prefix' => 'kyc', 'middleware' => ['auth','attendee']], function() {
    Route::get('interests',[InterestsController::class, 'show'])->name('interests');
    Route::post('interests', [InterestsController::class, 'store'])->name('submit.interest');
});

// Route::view('web/test-mail', 'emails.verify-email', [
//     'user' => UserDTO::from([
//         'full_name' => 'Test User',
//         'email' => 'mohammad@m-ayman.com',
//     ]),
//     'verificationUrl' => env('APP_URL').'/verify-email/10/'.Str::random(32),
// ]);

// Route::get('/test-mail', function () {
//     Mail::to('mohammad@m-ayman.com')->send(new VerifyEmail(UserDTO::from([
//         'full_name' => 'Test User',
//         'email' => 'mohammad@m-ayman.com',
//     ])));
//     return 'Email Sent';
// });

require __DIR__.'/auth.php';
