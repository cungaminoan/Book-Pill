<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        return $this->userService->index($request);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }

    public function resetPassword(Request $request)
    {
        return $this->userService->resetPassword($request);
    }

    public function resetPasswordRequest(Request $request)
    {
        return $this->userService->resetPasswordRequest($request);
    }

    public function verifyEmail(Request $request)
    {
        return $this->userService->verifyEmail($request);
    }

    public function resetPasswordIndex(Request $request)
    {
        return $this->userService->resetPasswordIndex($request);
    }

    public function changeUser(Request $request)
    {
        return $this->userService->changeUser($request);
    }

    public function register(Request $request)
    {
        return $this->userService->register($request);
    }

    public function registerUser(Request $request)
    {
        return $this->userService->registerUser($request);
    }
}
