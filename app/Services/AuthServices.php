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
    public function login(array $user,$remember)
    {
        $auth = $this->__authRepository->getUserByEmail($user['email']);

        if($auth && Hash::check($user['password'], $auth->password)) {
            Auth::login($auth,$remember);
            session()->regenerate();
            toastr()->success('Đăng nhập thành công');

            return redirect()->route('home');
        }

        toastr()->error('Tài khoản hoặc mật khẩu không chính xác');
        return redirect()->back();
    }

    public function logout()
    {
        if(Auth::check()){

            Auth::logout();
            session()->invalidate();
            session()->regenerate();

            toastr()->success('Đăng xuất thành công');
            return redirect()->route('auth.login');
        }
            toastr()->success('Đăng xuất không thành công');

    }
}

