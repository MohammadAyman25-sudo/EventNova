<?php

namespace App\Services\Interest;

use App\DTOs\InterestsDTO;
use App\Models\User;

class InterestService
{
    public function setUserInterests(User $user, InterestsDTO $interestsDTO)
    {
        $user->interests()->sync($interestsDTO->interests);
        if ($interestsDTO->notification_preferences) {
            $user->notification_channels = $interestsDTO->notification_preferences;
            $user->save();
        }
    }
}