<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private $__authService;

    public function __construct(AuthServices $authServices)
    {
        $this->__authService = $authServices;
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = $request-> all();
        $remember = $user->remember_token ?? false;

        $this->__authService->login($user, $remember);
    }

    public function logout()
    {
        $this->__authService->logout();
    }

}
