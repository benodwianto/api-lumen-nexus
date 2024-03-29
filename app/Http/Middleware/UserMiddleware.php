<?php

namespace App\Http\Middleware;

use App\Models\User;

use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { {
            if ($request->user()->status <> '1') {
                return redirect('login');
            }
            return $next($request);
        }
    }
}
