<?php

namespace App\Services\Auth;

use App\DTOs\Auth\Password\ResetPasswordRequestDTO;

class PasswordService
{
    public function resetPassword(ResetPasswordRequestDTO $resetPasswordRequestDTO)
    {
        return Password::reset(
                    $resetPasswordRequestDTO,
                    function (User $user) use ($resetPasswordRequestDTO) {
                        $user->forceFill([
                            'password' => Hash::make($resetPasswordRequestDTO->password),
                            'remember_token' => Str::random(60),
                        ])->save();

                        event(new PasswordReset($user));
                    }
                );
    }
}