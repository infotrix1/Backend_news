<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Exception;


class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser(): User
    {
        return auth()->user();
    }

    public function updateUser($id, $data)
    {
        try {
            return $this->userRepository->update($id, $data);
        } catch (Exception $e) {
            throw new Exception("Failed to update preferences: " . $e->getMessage());
        }
    }

}

