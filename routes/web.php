<?php

use App\Http\Controllers\InterestsController;
use App\Http\Controllers\Auth\OnboardingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('token', fn()=>response()->json(["token" => csrf_token()]));

Route::group(['prefix'=>'{locale}'], function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    require __DIR__.'/auth.php';

    // Route::middleware('auth')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    Route::middleware('auth')->group(function (){
        Route::get('/profile', [ProfileController::class, 'show'])->name('public.profile');
        // Events
        Route::get('events', [EventController::class, 'index'])->name('explore.events');
        Route::get('event/create', [EventController::class, 'create'])->name('event.create');
        Route::get('event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
        Route::get('event/{event}', [EventController::class, 'details'])->name('event.details');
        Route::post('event', [EventController::class, 'store'])->name('create.event');
        Route::put('event/{event}', [EventController::class, 'updateEvent'])->name('update.event');
        Route::delete('event/{event}', [EventController::class, 'destroy'])->name('delete.event');
    });

    // Route::group(['prefix' => 'kyc', 'middleware' => ['auth','attendee']], function() {
    //     Route::get('interests',[InterestsController::class, 'show'])->name('interests');
    //     Route::post('interests', [InterestsController::class, 'store'])->name('submit.interest');
    // });

    // Route::group(['prefix' => 'kyc', 'middleware' => ['auth','organizer']], function() {
    //     Route::get('onboarding',[InterestsController::class, 'show'])->name('onboarding');
    //     Route::post('onboarding', [InterestsController::class, 'store'])->name('submit.onboarding');
    // });

    // Route::middleware(['auth'])->group(function(){
    //     Route::view('test-stripe', 'onboarding');
    //     Route::get('/stripe/onboard', [OnboardingController::class, 'onboard'])->name('stripe.onboard');
    //     Route::get('/stripe/return', [OnboardingController::class, 'return'])->name('stripe.return');
    //     Route::get('/stripe/refresh', [OnboardingController::class, 'refresh'])->name('stripe.refresh');
    // });

    // Route::post('/webhook/stripe', [OnboardingController::class, 'handle']);
});