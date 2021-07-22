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

        if (isset($request->estadoId) && !empty($request->estadoId))
            $params['estados_id'] = $request->estadoId;

        if (isset($request->id) && !empty($request->id))
            $params['id'] = $request->id;

        $cidades = Cidades::where($params)->orderBy('nome')->get();
        return response()->json($cidades);
    }
}
