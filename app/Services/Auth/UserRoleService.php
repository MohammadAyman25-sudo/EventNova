<?php

namespace App\Services\Auth;

use App\DTOs\Auth\Register\RegisterationRequestDTO;
use App\DTOs\UserRoleDTO;
use App\Repositories\SocialAccount\SocialAccountRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\Registered;
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
        $userRecord->email_verified_at = $user->email_verified_at ?? now();
        $userRecord->save();
        try {
            $userRecord->addMediaFromUrl($user['avatar'])
                   ->preservingOriginal()
                   ->withResponsiveImages()
                   ->toMediaCollection('avatar');
        } catch (\Exception $th) {
            Log::error('Failed to import avatar:'.$th->getMessage());
        }

        (new SocialAccountRepository())->create($userRecord, $provider, $user);

        event(new Registered($userRecord));

        Auth::login($userRecord);
    }
}