<?php

namespace App\Http\Controllers;

use App\Enums\Payment\PaymentMethodEnum;
use App\Http\Requests\OnboardingRequest;
use App\Services\Onboarding\OnboardingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OnboardingController extends Controller
{
    public function store(OnboardingRequest $request)
    {
        try {
            (new OnboardingService())->setUserInterests($request->user(), $request->getData());
            return redirect()->route('dashboard', ['locale' => app()->getLocale()]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            \Sentry\captureException($exception);
            return back()->with('onboarding', 'something went wrong');
        }
    }

    public function show() {
        return view('organizer.onboarding', ['methods' => PaymentMethodEnum::toArray()]);
    }
}
