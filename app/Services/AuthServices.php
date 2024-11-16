<?php
namespace App\Services;

use App\Mail\ForgotMail;
use App\Models\ForgotPassword;
use App\Repositories\AuthRepository;
use App\Repositories\ForgotRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AuthServices
{
    private $__authRepository;
    private $__forgotRepository;

    public function __construct(AuthRepository $auth,ForgotRepository $forgot)
    {
        $this->__authRepository = $auth;
        $this->__forgotRepository = $forgot;
    }
    public function login(array $user,$remember)
    {
        $auth = $this->__authRepository->getUserByEmail($user['email']);

        if($auth && Hash::check($user['password'], $auth->password)) {
            Auth::login($auth,$remember);
            session()->regenerate();
            toastr()->success('Đăng nhập thành công');

            return redirect()->route('admin.dashboard');
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

    public function forgot($email)
    {
        $user = $this->__authRepository->getUserByEmail($email);
        $token = Str::random(64);

        $data = [
            'email' => $user->email,
            'token' => $token,
            'created_at' => now(),
        ];

        if($user){
            $check = $this->__forgotRepository->createForgot($data);
            if($check){
                $send = Mail::to($user->email)->send(new ForgotMail($user,$token));
                if($send){
                    toastr()->success('Vui lòng kiểm tra hộp thư đến để đặt lại mật khẩu');
                    return redirect()->route('auth.login');
                }
            }
        }
    }

    public function resetPassword($token, $password)
    {
        $email = $this->__forgotRepository->getForgotByToken($token);
        $reseted = $this->__authRepository->update($email, $password);
        if($reseted){
            $this->__forgotRepository->deleteForgot($email);
            toastr()->success('Đặt lại mật khẩu thành công');
        }else{
            toastr()->error('Đặt lại mật khẩu không thành công');
        }
        return redirect()->route('auth.login');
    }
}

