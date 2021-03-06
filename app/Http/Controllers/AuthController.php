<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function authEstabelecimento(Request $request)
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

        $estabelecimento = Estabelecimentos::find(Auth::user()->origem_id);
        return $this->respondWithToken($token, $estabelecimento->nome, $estabelecimento->id);
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

    protected function respondWithToken($token, $usuario, $id)
    {
        return response()->json([
            'status' => 'ok',
            'token' => $token,
            'usuario' => $usuario,
            'id' => $id
        ]);
    }
}
