<?php

namespace App\Repositories;
use Exception;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function update(int $id, array $data): bool
    {
        $user = User::find($id);
        if (!$user) {
            throw new Exception("User not found.");
        }
        $user->preferences = $data;
        return $user->save();
    }
}


