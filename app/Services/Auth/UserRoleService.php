<?php

namespace App\Services\Auth;

use App\DTOs\Auth\Register\RegisterationRequestDTO;
use App\DTOs\UserRoleDTO;
use App\Repositories\SocialAccount\SocialAccountRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserRoleService
{
    public function assignUserRole(UserRoleDTO $userRoleDTO)
    {
        $user = (array)(session()->get('pending_social_user'));
        $provider = session()->get('provider');
        list($first_name, $last_name) = explode(' ', $user['name']);
        $userRecord = (new UserRepository())->create(RegisterationRequestDTO::from([...$user, 'first_name'=>$first_name, 'last_name'=>$last_name, 'role' => $userRoleDTO->role]));
        $userRecord->markEmailAsVerified();
        try {
            $userRecord->addMediaFromUrl($user['avatar'])
                   ->toMediaCollection('avatar');
        } catch (\Exception $th) {
            Log::error('Failed to import avatar:'.$th->getMessage());
        }

        (new SocialAccountRepository())->create($userRecord, $provider, $user);

        session()->forget(['pending_social_user', 'provider']);

        Auth::login($userRecord, true);

        return $userRecord;
    }
}