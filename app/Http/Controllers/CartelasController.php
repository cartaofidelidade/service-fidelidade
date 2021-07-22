<?php

namespace App\Http\Controllers;

use App\Models\Cartelas;
use Illuminate\Http\Request;

class CartelasController extends Controller
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


           
        $cidades = Cartelas::where($params)->orderBy('nome')->get();
        return response()->json($cidades);
    }

    public function store(Request $request)
    {
        $cartela = new Cartelas();

        $cartela->campanhas_id = '';
        $cartela->clientes_id = '';

    }

    public function validaCarimbos()
    {
        # code...
    }
}
