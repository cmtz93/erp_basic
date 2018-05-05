<?php

namespace App\Http\Middleware;

use Closure;

class Activity
{
     protected $excepts = [
        'broadcasting/auth'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $description = null)
    {
        $exceptions = collect($this->excepts);
        if (config('logging.activity.enable') && !$exceptions->contains($request->path()) ) {
            activity($description);
        }
        return $next($request);
    }
}
