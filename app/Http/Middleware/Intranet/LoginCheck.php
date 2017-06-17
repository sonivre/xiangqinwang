<?php

namespace App\Http\Middleware\Intranet;

use Closure;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 验证是否已经登录, 否则跳转到登录界面
        if (! $request->session()->exists('intranet')) {
            return redirect('intranet/login');
        }
        return $next($request);
    }
}