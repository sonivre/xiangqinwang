<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/17
 * Time: 20:55
 */

namespace App\Http\Middleware\Frontend;

use Closure;
use App\Http\Controllers\Intranet\SystemController;
use Illuminate\Support\Facades\Session;
use MemberAuthService;

class MemberLoginCheck
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
        if (! MemberAuthService::checkUserLogin()) {
            return redirect('/');
        }

        return $next($request);
    }
}