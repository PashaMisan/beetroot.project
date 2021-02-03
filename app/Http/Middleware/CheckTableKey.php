<?php

namespace App\Http\Middleware;

use App\Admin_panel_models\Order;
use Closure;
use Illuminate\Http\Request;

class CheckTableKey
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Order::hasKey()) {
            return redirect('menu');
        }

        return $next($request);
    }
}
