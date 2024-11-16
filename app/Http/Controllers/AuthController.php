<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPassRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
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

        return $this->__authService->login($user, $remember);
    }

    public function logout()
    {
        return $this->__authService->logout();
    }

    public function forgotForm()
    {
        return view('auth.forgot');
    }

    public function forgot(ForgotPassRequest $request)
    {
        $email = $request-> validated();
        $this->__authService->forgot($email);
    }

    public function resetForm(Request $token)
    {

        return view('auth.reset',$token);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $token = $request->token;
        $password = $request-> password;
        $this->__authService->resetPassword($password,$token);
    }

}
