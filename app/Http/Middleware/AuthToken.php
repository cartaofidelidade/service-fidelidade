<?php

namespace App\Http\Middleware;

use App\Models\TokensModel;
use Closure;

class AuthToken
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
        $headers = $request->headers;
        $auth = $headers->get('authorization');

        if (empty($auth))
            return response()->json(['mensagem' => 'Chave de acesso obrigatória.'], 401);

        $tokens = TokensModel::where('Token', $auth)->first();

        if (!$tokens)
            return response()->json(['mensagem' => 'Acesso não autorizado.'], 401);

        $request->request->set('Local', $tokens['Id']);

        $response = $next($request);
        return $response;
    }
}
