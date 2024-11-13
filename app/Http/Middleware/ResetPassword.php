<?php

namespace App\Http\Middleware;

use App\Models\ForgotPassword;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResetPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->get('token');
        if(ForgotPassword::where('token', $token)->exists()){
            return $next($request);
        }
        return route('auth.login');
    }
}
