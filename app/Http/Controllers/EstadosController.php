<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function index(Request $request)
    {
        $params = [];

        if (isset($request->nome) && !empty($request->nome))
            $params['nome'] = $request->nome;

        if (isset($request->sigla) && !empty($request->sigla))
            $params['sigla'] = $request->sigla;

        if (isset($request->id) && !empty($request->id))
            $params['id'] = $request->id;

        $estados = Estados::where($params)->orderBy('nome')->get();
        return response()->json($estados);
    }
}
