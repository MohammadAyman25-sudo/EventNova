<?php

namespace App\Repositories\User;

use App\DTOs\Auth\Register\RegisterationRequestDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    private function initialQuery():User|Builder
    {
        return (new User())->newModelQuery();
    }

    public function create(RegisterationRequestDTO $registerationRequestDTO):User
    {
        $user = new User();
        $user->first_name = $registerationRequestDTO->first_name;
        $user->last_name = $registerationRequestDTO->last_name;
        $user->email = $registerationRequestDTO->email;
        $user->password = $registerationRequestDTO->password;
        $user->save();
        return $user;
    }

    public function getUserById(string $id):User
    {
        return $this->initialQuery()->where('id', $id)->first();
    }
}