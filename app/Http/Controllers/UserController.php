<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function user()
    {
        try {
            $user = $this->userService->getUser();
            return response()->json(['user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'categories' => 'array|nullable',
                'authors' => 'array|nullable',
                'sources' => 'array|nullable',
            ]);

            $userId = Auth::id();

            $update = $this->userService->updateUser($userId, $validated);

            return response()->json(['message' => 'Preferences updated successfully.', 'data' => $update]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
     }

}
