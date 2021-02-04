<?php

namespace App\Http\Controllers;

use App\Models\CidadesModel;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function index()
    {
        $cidades = CidadesModel::where(['Ativo' => 1])->get();
        return response()->json($cidades, 200);
    }

    public function show(string $estadosId)
    {
        $cidades = CidadesModel::where(['EstadosId' => $estadosId])->get();
        return response()->json($cidades, 200);
    }
    public function buscaCidadesEstados($estadosId)
    {
      
        $cidades = CidadesModel::where('EstadosId','=', 13)->get();
        
        return response()->json($cidades, 200);
    }

    // estadoId
}
