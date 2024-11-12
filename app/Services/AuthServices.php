<?php
namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
    private $__authRepository;
    public function __construct(AuthRepository $auth)
    {
        $this->__authRepository = $auth;
    }
    public function login(array $user)
    {
        $remember = $user->remember_token ?? false;
        $auth = $this->__authRepository->getUserByEmail($user['email']);
        if($auth && Hash::check($user['password'], $auth->password)) {
            Auth::login($auth,$remember);
            session()->regenerate();
            return true;
        }
        return false;
    }
}

