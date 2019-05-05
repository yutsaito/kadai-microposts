<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
/*handle() は全てのﾐﾄﾞﾙｳｪｱが持っておりﾐﾄﾞﾙｳｪｱアが設定されたﾙｰﾃｨﾝｸﾞグにｱｸｾｽされた時に毎回呼ばれﾒｿｯﾄﾞ */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) { /* if (Auth::guard($guard)->check()) でlogin中か判断 */
            return redirect('/');
        }

        return $next($request);
    }
}
