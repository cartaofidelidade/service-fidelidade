<?php

namespace App\Http\Controllers;

use App\Models\Cidades;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function index(Request $request)
    {
        $params = [];

        if (isset($request->nome) && !empty($request->nome))
            $params['nome'] = $request->nome;

        if (isset($request->estado) && !empty($request->estado))
            $params['estados_id'] = $request->estado;

        if (isset($request->id) && !empty($request->id))
            $params['id'] = $request->id;

        $cidades = Cidades::where($params)->get();
        return response()->json($cidades);
    }
}
