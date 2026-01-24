<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRoleRequest;
use App\Services\Auth\UserRoleService;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function create(UserRoleRequest $request)
    {
        try {
            (new UserRoleService())->assignUserRole($request->getData());
            return redirect()->route('dashboard');
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return back()->withErrors([
                'error' => $th->getMessage(),
            ]);
        }
    }   
}
