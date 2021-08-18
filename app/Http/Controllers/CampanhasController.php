<?php

namespace App\Http\Controllers;

use App\Models\Campanhas;
use App\Models\CampanhasModel;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CampanhasController extends Controller
{

    public function index(Request $request)
    {
        $params = [];

        $params['ativo'] = 1;

        if (isset($request->nome) && !empty($request->nome))
            $params['nome'] = $request->nome;

        if (isset($request->tipo) && !empty($request->tipo))
            $params['tipo'] = $request->tipo;

        if (isset($request->id) && !empty($request->id))
            $params['codigo'] = $request->codigo;


        $campanhas = Campanhas::where($params)->get();
        return response()->json($campanhas);
    }

    public function show($id)
    {
        $campanhas = Campanhas::find($id);

        if ($campanhas['imagem_carimbo_preenchido'])
            $campanhas['imagem_carimbo_preenchido'] = base64_encode(file_get_contents($campanhas['imagem_carimbo_preenchido']));

        if ($campanhas['imagem_carimbo_vazio'])
            $campanhas['imagem_carimbo_vazio'] = base64_encode(file_get_contents($campanhas['imagem_carimbo_vazio']));


        return response()->json($campanhas);
    }

    public function store(Request $request)
    {
        $formData = $request->all();

        $res = DB::transaction(function () use ($formData) {
            $validation = Validator::make($formData,
                [
                    'nome' => 'required',
                    'tipo' => 'required',
                    'data_inicio' => 'required',
                    'data_final' => 'required'
                ],
                ['required' => 'O campo :atribute é obrigatório']
            );

            if ($validation->fails())
                return ['status' => 'erro', 'mensagem' => $validation->errors()->first()];

            $campanhas = new Campanhas();

            $campanhas->estabelecimentos_id = Auth::user()->origem_id;
            $campanhas->codigo = substr(uniqid(rand()), 0, 6);
            $campanhas->nome = $formData['nome'];
            $campanhas->tipo = $formData['tipo'];
            $campanhas->pontos = $formData['pontos'] ?? 0;
            $campanhas->quantidade_carimbos = $formData['quantidade_carimbos'];
            $campanhas->limite_carimbos_dia = $formData['limite_carimbos_dia'];
            $campanhas->data_inicio = $formData['data_inicio'];
            $campanhas->data_final = $formData['data_final'];
            $campanhas->descricao = $formData['descricao'];

            if ($campanhas->save())
                return ['status' => 'ok', 'mensagem' => 'Cadastro realizado com sucesso', 'body' => $campanhas];
            return ['status' => 'erro', 'mensagem' => 'Não foi possível cadastrar a campanha.'];
        });

        return response()->json($res, ($res['status'] === 'erro' ? 400 : 200));
    }

    public function update(Request $request, $id)
    {
        $formData = $request->all();

        $res = DB::transaction(function () use ($formData, $id) {
            $validation = Validator::make($formData,
                [
                    'nome' => 'required',
                    'tipo' => 'required',
                    'data_inicio' => 'required',
                    'data_final' => 'required'
                ],
                ['required' => 'O campo :atribute é obrigatório']
            );

            if ($validation->fails())
                return ['status' => 'erro', 'mensagem' => $validation->errors()->first()];

            $campanhas = Campanhas::find($id);

            $campanhas->nome = $formData['nome'];
            $campanhas->tipo = $formData['tipo'];
            $campanhas->pontos = $formData['pontos'] ?? 0;
            $campanhas->quantidade_carimbos = $formData['quantidade_carimbos'];
            $campanhas->limite_carimbos_dia = $formData['limite_carimbos_dia'];
            $campanhas->data_inicio = $formData['data_inicio'];
            $campanhas->data_final = $formData['data_final'];
            $campanhas->descricao = $formData['descricao'];

            if ($campanhas->save())
                return ['status' => 'ok', 'mensagem' => 'Cadastro realizado com sucesso.'];
            return ['status' => 'erro', 'mensagem' => 'Não foi possível cadastrar a campanha.'];
        });

        return response()->json($res, ($res['status'] === 'erro' ? 400 : 200));
    }

    public function delete($id)
    {
        if (empty($id))
            return response()->json(['status' => 'erro', 'mensagem' => 'Dados obrigatórios inválidos.'], 400);

        $campanhas = Campanhas::find($id);
        $campanhas->ativo = 0;

        if ($campanhas->save())
            return response()->json(['status' => 'ok', 'mensagem' => 'Cadastro removido com sucesso.']);
        return response()->json(['status' => 'erro', 'mensagem' => 'Não foi possível remover o cadastro.'], 400);
    }
}
