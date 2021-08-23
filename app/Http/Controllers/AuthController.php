<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Estabelecimentos;
use App\Models\Usuarios;
use App\Mail\Forgot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function auth(Request $request)
    {
        $data = $request->only('login', 'senha');

        $validation = Validator::make(
            $data,
            [
                'login' => 'required',
                'senha' => 'required'
            ],
            [
                'required' => 'O campo :attribute é obrigatório',
            ]
        );

        if ($validation->fails())
            return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);

        $token = Auth::attempt(['login' => $data['login'], 'password' => $data['senha']]);

        if (!$token)
            return response()->json(['status' => 'erro', 'mensagem' => 'Os dados de Login e ou Senha estão inválidos.'], 400);

        $origem = Auth::user()->origem;

        $usuario = [];

        if ((int)$origem === 1) {
            $usuario = Estabelecimentos::find(Auth::user()->origem_id);
        } else if ((int)$origem === 2) {
            $usuario = Clientes::find(Auth::user()->origem_id);
        }

        return response()->json(['status' => 'ok', 'token' => $token, 'nome' => $usuario['nome'] ?? $usuario['nome_fantasia'], 'id' => $usuario['id']]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => 'ok', 'mensagem' => 'Logout realizado com sucesso.']);
    }

    public function username()
    {
        return 'login';
    }

    public function register(Request $request)
    {
       
        $register = [];

        if ((int)$request->origem === 1)
            $register = (new EstabelecimentosController())->store($request->all());

        if ((int)$request->origem === 2)
            $register = (new ClientesController())->store($request->all());

        return response()->json($register, ($register['status'] === 'erro' ? 400 : 200));
    }

    public function forgot(Request $request)
    {
        $forgot = [];

        if (!isset($request->login) or empty($request->login))
            return ['status' => 'erro', 'message' => 'Dados obrigatórios inválidos.'];

        if ((int)$request->origem === 1)
            $forgot = (new UsuariosController())->checkUsuario(['login' => $request->login, 'origem' => $request->origem]);

        if ($forgot['status'] === 'erro')
            return response()->json($forgot, 400);

        Mail::to($forgot['body']['email'])->send(new Forgot($forgot['body']));

        unset($forgot['body']);

        return response()->json($forgot, ($forgot['status'] === 'erro' ? 400 : 200));
    }

    public function checkTokenForgot(Request $request)
    {
    }

    public function changePassword(Request $request)
    {
        $formData = $request->all();

        $usuario = Usuarios::where('tokenAlteracaoSenha', '=', $formData['token'])->get();

        if (!isset($usuario[0]->id))
            return response()->json(['status' => 'erro', 'mensagem' => 'Usuario não localizado.'], 400);


        $usuarios = Usuarios::find($usuario[0]->id);
        $usuarios->senha = Hash::make($formData['senha']);
        $usuarios->tokenAlteracaoSenha = null;

        if ($usuarios->save()) {
            return response()->json($usuarios);
        }
    }
}
