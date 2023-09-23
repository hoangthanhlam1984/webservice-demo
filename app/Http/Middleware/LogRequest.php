<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestLog = [
            'time'    => now()->toIso8601String(),
            'user_id' => optional($request->user())->id,
            'method'  => $request->method(),
            'url'     => $request->fullUrl(),
            'body'    => $request->all(),
            'ip'      => $request->ip(),
            'header'  => $request->header(),
        ];

        \Log::channel('request')->info("Request", $requestLog);

        return $next($request);
    }
}
