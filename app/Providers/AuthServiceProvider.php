<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];


     public function createGate($permission){
        Gate::define($permission, function (User $user) use ($permission) {
            if ($permission == 'admin') return $user->users_type == 1;
            else if ($permission == 'teacher') return $user->users_type == 2;
            else if ($permission == 'student') return $user->users_type == 3;
            else if ($permission == 'parent') return $user->users_type == 4;
            return false;
        });
    }

    public function boot(): void
    {
        $this->registerPolicies();
        $this->createGate('admin');
        $this->createGate('parent');
        $this->createGate('student');
        $this->createGate('teacher');

    }
}
