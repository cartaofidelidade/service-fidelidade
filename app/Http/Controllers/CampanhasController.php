<?php

namespace App\Http\Controllers;

use App\Models\Campanhas;
use App\Models\CampanhasModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CampanhasController extends Controller
{

    public function index(Response $response)
    {
        $params = [];

        $params['ativo'] = 1;

        $campanhas = Campanhas::where($params)->get();
        return response()->json($campanhas);
    }

    public function show($id)
    {
        $campanhas = Campanhas::find($id);
        return response()->json($campanhas);
    }

    public function store(Request $request)
    {
        $estabelecimento = Auth::user();
        $formData = $request->all();

        $validation = Validator::make(
            $formData,
            [
                'nome' => 'required',
                'tipo' => 'required',
                'data_inicio' => 'required',
                'data_final' => 'required'
            ],
            [
                'required' => 'O campo :atribute é obrigatório'
            ]
        );

        if ($validation->fails())
            return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);

         $campanhas = new Campanhas();

         $campanhas->estabelecimentos_id = $estabelecimento->origem_id;
         $campanhas->codigo = substr(uniqid(rand()), 0, 6);
         $campanhas->nome = $formData['nome'];
         $campanhas->tipo = $formData['tipo'];

         $campanhas->pontos = $formData['pontos']??0;
         $campanhas->quantidade_carimbos = $formData['quantidade_carimbos'];
         $campanhas->limite_carimbos_dia = $formData['limite_carimbos_dia'];
         $campanhas->data_inicio = $formData['data_inicio'];
         $campanhas->data_final = $formData['data_final'];
         $campanhas->descricao = $formData['descricao'];

         if ($campanhas->save())
            return response()->json($campanhas);
        return response()->json(['status' => 'erro', 'mesnagem' => 'Não foi possível cadastrar a campanha.'], 400);


    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
