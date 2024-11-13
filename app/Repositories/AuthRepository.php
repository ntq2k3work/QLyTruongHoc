<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    private $__auth;
    public function __construct(User $auth)
    {
        $this->__auth = $auth;
    }

    public function getUserByEmail($email)
    {
        return $this->__auth->where('email', $email)->first();
    }

    public function update($email, $password)
    {
        return $this->__auth->where('email', $email)->update(['password' => $password]);
    }
}
