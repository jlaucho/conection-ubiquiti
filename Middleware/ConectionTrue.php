<?php

namespace jlaucho\conection_ubiquiti\Middleware;

use Closure;

class ConectionTrue
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
        $conection = false;
        if (!$conection) {
            return redirect('home');
        }
        return $next($request);
    }
}
