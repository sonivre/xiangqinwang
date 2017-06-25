<?php

namespace App\Http\Middleware\Intranet;

use Closure;

class UserAnalyzeTool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 得到用户真实ip地址
        $userinfo = $request->session()->get(config('custom.intranetSessionName'));
        if (! empty($userinfo) && empty($userinfo['ip'])) {
            $userinfo['ip'] = $request->ip();
            $request->session()->put(config('custom.intranetSessionName'), $userinfo);
        }
        return $next($request);
    }
}
