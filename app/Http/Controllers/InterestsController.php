<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterestsRequest;
use App\Services\Interest\InterestService;
use Illuminate\Support\Facades\Log;

class InterestsController extends Controller
{
    public function store(InterestsRequest $request)
    {
        try {
            // dd($request->getData());
            (new InterestService())->setUserInterests($request->user(), $request->getData());
            return redirect()->route('dashboard');
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return back()->with('interests', 'something went wrong');
        }
    }

    public function show() {
        return view('interests', [
            'categories' => Category::all(),
        ]);
    }
}
