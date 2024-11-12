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
        $status = $this->__authService->login($user);
        if($status){
            toastr()->success('Đăng nhập thành công');
            return redirect()->route('home');
        }else{
            toastr()->error('Tài khoản hoặc mật khẩu không chính xác');
            return redirect()->back();
        }
    }

}
