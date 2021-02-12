<?php

namespace App\Http\Middleware;

use App\Models\EstabelecimentosModel;
use Closure;

class AuthEstablishments
{

    private $token = "0B39719B-66E0-4A43-9B2B-9C3E8DDFA517";

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $headers = $request->headers;
        $auth = $headers->get('authorization');

        if (empty($auth))
            return response()->json(['mensagem' => 'Chave de acesso obrigatória.'], 401);

        $auth = base64_decode($auth);
        $usuarios = json_decode($auth, true);

        $estabelecimentos = EstabelecimentosModel::where(['IndividuosId' => $usuarios['IndividuosId']])->first();

        if (!$estabelecimentos)
        return response()->json(['mensagem' => 'Acesso não autorizado.'], 401);

        $request->request->set('Estabelecimento', $estabelecimentos['Id']);

        $response = $next($request);

        return $response;
    }
}
