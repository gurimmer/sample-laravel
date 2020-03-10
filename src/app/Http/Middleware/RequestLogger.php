<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    const ENABLE_ENVIRONMENT = [
        'local',
        'development',
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('app.debug') && in_array(App::environment(), self::ENABLE_ENVIRONMENT, true)) {
            $this->writeLog($request);
        }
        return $next($request);
    }

    /**
     * @param Request $request
     * @return void
     */
    private function writeLog(Request $request): void
    {
        Log::debug($request->method(), ['url' => $request->fullUrl(), 'request' => $request->all()]);
    }
}
