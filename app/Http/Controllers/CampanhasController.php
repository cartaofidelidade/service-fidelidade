<?php

namespace App\Http\Controllers;

use App\Models\CampanhasModel;
use Illuminate\Http\Request;

class CampanhasController extends Controller
{

    public function index(Request $request)
    {
        $params = $request->query();

        if (!isset($params['Estabelecimento']))
            return response()->json(['mensagem' => 'Parametros obrigatórios ibválidos.'], 400);

        $campanhas = CampanhasModel::where([
            'Ativo' => 1,
            'EstabelecimentosId' => $params['Estabelecimento']
        ])
            ->get();

        return response()->json($campanhas, 200);
    }

    public function show(Request $request, $id)
    {
        $params = $request->query();

        if (!isset($params['Estabelecimento']))
            return response()->json(['mensagem' => 'Parametros obrigatórios ibválidos.'], 400);

        $campanhas = CampanhasModel::where([
            'Id' => $id,
            'EstabelecimentosId' => $params['Estabelecimento']
        ])
            ->first();

        return response()->json($campanhas, 200);
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id)
    {
    }
}
