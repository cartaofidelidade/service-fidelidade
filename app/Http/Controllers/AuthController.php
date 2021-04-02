<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function loginEstabelecimento(Request $request)
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
            return response()->json(['status' => 'erro', 'mensagem' => 'Não autorizado'], 401);


        return $this->respondWithToken($token);
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

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
