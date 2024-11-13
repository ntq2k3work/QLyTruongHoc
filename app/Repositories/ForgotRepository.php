<?php

namespace App\Repositories;

use App\Models\ForgotPassword;

class ForgotRepository
{
    private $__forgot;

    public function __construct(ForgotPassword $forgot)
    {
        $this->__forgot = $forgot;
    }

    public function createForgot(array $data )
    {
        return $this->__forgot->create($data);
    }

    public function getForgotByToken($token)
    {
        return $this->__forgot->where('token', $token)->first();
    }
    public function deleteForgot($email)

    {
        return $this->__forgot->where('email', $email)->delete();
    }

}
