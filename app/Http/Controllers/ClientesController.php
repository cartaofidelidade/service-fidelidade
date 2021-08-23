<?php

namespace App\Http\Controllers;

use App\Mail\BemVindoClientes;
use App\Models\Clientes;
use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ClientesController extends Controller
{

    public function index($router)
    {
    }

    public function show($router)
    {
    }

    public function store(array $formData)
    {


        $response = DB::transaction(function () use ($formData) {
            $validation = Validator::make(
                $formData,
                [
                    'nome' => 'required',
                    'email' => 'required|email|unique:clientes',
                ],
                [
                    'required' => 'O campo :atribute é obrigatório',
                    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
                    'unique' => 'O campo :attribute já possui um registro.'
                ]
            );


            if ($validation->fails()) {
                DB::rollBack();
                return  ['status' => 'erro', 'mensagem' => $validation->errors()->first()];
            }

            $clientes = new Clientes();

            $clientes->nome = $formData['nome'];
            $clientes->email = $formData['email'];
            $clientes->latitude = $formData['latitude'] ?? null;
            $clientes->longitude = $formData['longitude'] ?? null;

            if ($clientes->save()) {
                $usuarios = new Usuarios();

                $usuarios->login = $formData['login'];
                $usuarios->senha = Hash::make($formData['senha']);
                $usuarios->origem = 2;
                $usuarios->origem_id = $clientes->id;

                if ($usuarios->save()) {
                    DB::commit();
                    // Mail::to($formData['email'])->send(new BemVindoClientes($clientes));

                    return ['status' => 'ok', 'mensagem' => 'Cadastro realizado com sucesso', 'body' => $clientes];
                } else {
                    DB::rollBack();
                    return ['status' => 'erro', 'mensagem' => 'Não foi possível realizar o cadastro do usuário.'];
                }
            } else {
                DB::rollBack();
                return ['status' => 'erro', 'mensagem' => 'Não foi possível realizar o cadastro do cliente.'];
            }
        });

        return $response;
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $formData = $request->all();
            $validation = Validator::make(
                $formData,
                [
                    'nome' => 'required',
                    'email' => 'required|email',
                ],
                [
                    'required' => 'O campo :atribute é obrigatório',
                    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.'
                ]
            );

            if ($validation->fails()) {
                DB::rollBack();
                return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);
            }

            $clientes = Clientes::find($id);

            $clientes->nome = $formData['nome'];
            $clientes->email = $formData['email'];
            $clientes->latitude = $formData['latitude'] ?? null;
            $clientes->longitude = $formData['longitude'] ?? null;

            if ($clientes->save()) {
                DB::commit();
                return response()->json(['status' => 'ok', 'mensagem' => 'Cadastro atualizado com sucesso.', 'body' => $clientes]);
            }

            DB::rollBack();
            return response()->json(['status' => 'erro', 'mensagem' => 'Não foi possível realizar o cadastro do cliente.'], 400);
        } catch (\Exception $th) {
            return response()->json(['status' => 'erro', 'mensagem' => 'Houve um erro inesperado, entre em contato com a equipe de suporte.'], 400);
        }
    }
}
