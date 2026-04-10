<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Onboarding\Providers\CardProvider\Providers\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function onboard()
    {
        $user = Auth::user();

        if (!$user->stripe_id){
            $account = $this->stripe->createConnectedAccount();
            $user->update([
                'stripe_id' => $account->id,
            ]);
        }

        $link = $this->stripe->createOnboardingLink($user->stripe_id);

        return redirect($link->url);
    }

    public function return()
    {
        return redirect()->route('dashboard')
                ->with('success', 'Onboarding submitted. We will verify your account shortly.');
    }

    public function refresh()
    {
        return  redirect()->route('stripe.dashboard');
    }
}
