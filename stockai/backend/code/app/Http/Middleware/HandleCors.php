<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

class HandleCors
{
    /**
     * Setup Cross Origin Resource Sharing
     *
     * @param Request $request - HttpRequest
     * @param Closure $next - Callable (next action)
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin'  => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Api-Key, X-Requested-With, Accept, Origin, Application'
        ];

        if ($request->getMethod() == 'OPTIONS') {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);

        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
