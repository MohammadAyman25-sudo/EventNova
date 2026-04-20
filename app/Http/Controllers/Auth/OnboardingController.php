<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Onboarding\Providers\CardProvider\Providers\StripeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        return redirect()->route('dashboard', ['locale' => app()->getLocale()])
                ->with('success', 'Onboarding submitted. We will verify your account shortly.');
    }

    public function refresh()
    {
        return  redirect()->route('dashboard',['locale' => app()->getLocale()]);
    }

    public function handle(Request $request)
    {
        Log::info('Request:', $request->toArray());
        return $request;
    }
}
