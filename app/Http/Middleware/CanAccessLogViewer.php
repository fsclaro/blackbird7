<?php

namespace App\Http\Middleware;

use Closure;

class CanAccessLogViewer
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
        abort_unless(\Gate::allows('log_viewer_access'), 403);

        return $next($request);
    }
}