<?php

namespace App\Http\Middleware;

use App\Models\Tokens;
use Closure;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('authorization');

        if (!$token)
            return response('Unauthorized.', 401);

        $token = Tokens::where(['token' => $token, 'ativo' => 1])->first();

        if (!$token)
            return response('Unauthorized.', 401);

        $request->origem = $token->origem;

        $response = $next($request);
        return $response;
    }
}
