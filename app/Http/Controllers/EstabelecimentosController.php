<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimentos;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EstabelecimentosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['store']]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $formData = $request->all();

        $validation = Validator::make(
            $formData,
            [
                'nome' => 'required',
                'email' => 'required|email|unique:estabelecimentos',
                'documento' => 'required|unique:estabelecimentos',
                'login' => 'required|unique:usuarios',
                'senha' => 'required|min:6',
                'segmentos_id' => 'required',
                'estados_id' => 'required',
                'cidades_id' => 'required',
            ],
            [
                'required' => 'O campo :atribute é obrigatório',
                'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
                'unique' => 'O campo :attribute já possui um registro.',
                'min' => 'O campo :attribute deve ser pelo menos :min caracteres.'
            ]
        );

        if ($validation->fails()) {
            DB::rollBack();
            return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);
        }

        $estabelecimentos = new Estabelecimentos();

        $estabelecimentos->tipo_pessoa = $formData['tipo_pessoa'];
        $estabelecimentos->nome = $formData['nome'];
        $estabelecimentos->nome_fantasia = $formData['nome_fantasia'] ?? null;
        $estabelecimentos->documento = $formData['documento'];
        $estabelecimentos->email = $formData['email'];
        $estabelecimentos->celular = $formData['celular'] ?? null;
        $estabelecimentos->telefone = $formData['telefone'] ?? null;
        $estabelecimentos->facebook = $formData['facebook'] ?? null;
        $estabelecimentos->instagram = $formData['instagram'] ?? null;
        $estabelecimentos->site = $formData['site'] ?? null;
        $estabelecimentos->cep = $formData['cep'] ?? null;
        $estabelecimentos->logradouro = $formData['logradouro'] ?? null;
        $estabelecimentos->numero = $formData['numero'] ?? null;
        $estabelecimentos->complemento = $formData['complemento'] ?? null;
        $estabelecimentos->bairro = $formData['bairro'] ?? null;
        $estabelecimentos->logomarca = $formData['logomarca'] ?? null;
        $estabelecimentos->estados_id = $formData['estados_id'];
        $estabelecimentos->cidades_id = $formData['cidades_id'];
        $estabelecimentos->segmentos_id = $formData['segmentos_id'];

        if ($estabelecimentos->save()) {

            $usuarios = new Usuarios();

            $usuarios->login = $formData['login'];
            $usuarios->senha = Hash::make($formData['senha']);
            $usuarios->origem = 1;
            $usuarios->origem_id = $estabelecimentos->id;

            if ($usuarios->save()) {
                DB::commit();
                return response()->json($estabelecimentos);
            } else {
                DB::rollBack();
                return response()->json(['status' => 'erro', 'mesnagem' => 'Não foi possível realizar o cadastro do usuário.'], 400);
            }
        } else {
            DB::rollBack();
            return response()->json(['status' => 'erro', 'mesnagem' => 'Não foi possível realizar o cadastro do estabelecimento.'], 400);
        }
    }

    public function update(Request $request)
    {
        $estabelecimento = Auth::user();
        $formData = $request->all();

        $validation = Validator::make(
            $formData,
            [
                'nome' => 'required',
                'email' => 'required|email',
                'documento' => 'required',
                'segmentos_id' => 'required',
                'estados_id' => 'required',
                'cidades_id' => 'required',
            ],
            [
                'required' => 'O campo :atribute é obrigatório',
                'email' => 'O campo :attribute deve ser um endereço de e-mail válido.'
            ]
        );

        if ($validation->fails())
            return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);

        $estabelecimentos = Estabelecimentos::find($estabelecimento->origem_id);

        $estabelecimentos->tipo_pessoa = $formData['tipo_pessoa'];
        $estabelecimentos->nome = $formData['nome'];
        $estabelecimentos->nome_fantasia = $formData['nome_fantasia'] ?? null;
        $estabelecimentos->documento = $formData['documento'];
        $estabelecimentos->email = $formData['email'];
        $estabelecimentos->celular = $formData['celular'] ?? null;
        $estabelecimentos->telefone = $formData['telefone'] ?? null;
        $estabelecimentos->facebook = $formData['facebook'] ?? null;
        $estabelecimentos->instagram = $formData['instagram'] ?? null;
        $estabelecimentos->site = $formData['site'] ?? null;
        $estabelecimentos->cep = $formData['cep'] ?? null;
        $estabelecimentos->logradouro = $formData['logradouro'] ?? null;
        $estabelecimentos->numero = $formData['numero'] ?? null;
        $estabelecimentos->complemento = $formData['complemento'] ?? null;
        $estabelecimentos->bairro = $formData['bairro'] ?? null;
        $estabelecimentos->logomarca = $formData['logomarca'] ?? null;
        $estabelecimentos->estados_id = $formData['estados_id'];
        $estabelecimentos->cidades_id = $formData['cidades_id'];
        $estabelecimentos->segmentos_id = $formData['segmentos_id'];

        if ($estabelecimentos->save())
            return response()->json($estabelecimentos);
        return response()->json(['status' => 'erro', 'mesnagem' => 'Não foi possível realizar o atualizar do estabelecimento.'], 400);
    }
}
