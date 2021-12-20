<?php

namespace App\Http\Controllers;

use App\Http\Service\CampanhaService;
use App\Models\Campanhas;
use App\Models\CampanhasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CampanhasController extends Controller
{

    public function index(Request $request)
    {
        $params = [];

        $params['ativo'] = 1;
        $params['estabelecimentos_id'] =  Auth::user()->origem_id;

        if (isset($request->nome) && !empty($request->nome))
            $params['nome'] = $request->nome;

        if (isset($request->tipo) && !empty($request->tipo))
            $params['tipo'] = $request->tipo;

        if (isset($request->id) && !empty($request->id))
            $params['codigo'] = $request->codigo;

        $campanhas = Campanhas::where($params)->get();
        return response()->json($campanhas);
    }

    public function show(string $id)
    {
        $campanhas = CampanhaService::show($id);
        return response()->json($campanhas);
    }

    public function store(Request $request)
    {
        try {

            $formData = $request->all();
            $validation = Validator::make(
                $formData,
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

            $campanhas = CampanhaService::create($formData);

            return ['status' => 'ok', 'mensagem' => 'Cadastro realizado com sucesso', 'body' => $campanhas];
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mensagem' => $th->getMessage()], 400);
        }
    }

    public function update(Request $request, $id = null)
    {
        try {
            $formData = $request->all();
            $validation = Validator::make(
                $formData,
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

            $campanhas = CampanhaService::update($id, $formData);

            return ['status' => 'ok', 'mensagem' => 'Atualização realizada com sucesso', 'body' => $campanhas];
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mensagem' => $th->getMessage()], 400);
        }
    }


    public function delete(string $id)
    {
        try {
            $campanhas = CampanhaService::delete($id);
            return response()->json(['status' => 'ok', 'mensagem' => 'Cadastro removido com sucesso.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mensagem' => 'Não foi possível remover o cadastro.'], 400);
        }


    }
}
