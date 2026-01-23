<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Registeration\RegisterRequest;
use App\Models\User;
use App\Services\Auth\RegisterationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        try {
            (new RegisterationService())->register($request->getData());
            return redirect(route('verify-email', absolute: false));
        } catch (\Throwable $th) {
            Log::error('Registration Error: ' . $th->getMessage());
            return redirect()->back()->withInput()->withErrors(['registration_error' => 'An error occurred during registration. Please try again.']);
        }
    }
}
