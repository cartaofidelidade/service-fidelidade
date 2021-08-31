<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimentos;
use App\Models\TokensUsuarios;
use App\Models\Usuarios;
use App\Models\UsuariosModel;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuariosController extends Controller
{
    public function novoUsuario(array $data, int $individuos)
    {
        if (isset($data['GerarUsuario']) && $data['GerarUsuario']) {
            $validation = Validator::make($data, [
                'Senha' => 'required',
                'Login' => 'required|unique:Usuarios,Login'
            ], [
                'required' => 'O campo :attribute é obrigatório.',
                'unique' => 'Este :attribute já possui um registro.'
            ]);

            if ($validation->fails())
                return ['status' => 'erro', 'message' => $validation->errors()->first()];

            $usuarios = new Usuarios();

            $usuarios->IndividuosId = $individuos;
            $usuarios->Login = $data['Login'];
            $usuarios->Senha = Hash::make($data['Senha']);

            if ($usuarios->save()) {
                return ['status' => 'ok', 'message' => '', 'body' => ['Id' => $usuarios->Id]];
            } else {
                return ['status' => 'erro', 'message' => 'Não foi possível efetuar o cadastro do usuario.'];
            }
        }
    }

    public function checkUsuario(array $data): array
    {
        if (!isset($data['login']) or empty($data['login']))
            return ['status' => 'erro', 'message' => 'Dados obrigatórios inválidos.'];

        $usuarios = Usuarios::where(['login' => $data['login'], 'origem' => $data['origem']])->first();

        if (!$usuarios)
            return ['status' => 'erro', 'message' => 'Dados de usuário inválido.'];

        $uuid = Str::uuid()->toString();

        $token = new TokensUsuarios();
        $token->token = $uuid;
        $token->data_expiracao = date('Y-m-d H:i:s', strtotime('+30 minute'));
        $token->usuarios_id = $usuarios->id;
        $token->save();

        $individuo = [];

        if ((int)$data['origem'] === 1)
            $individuo = Estabelecimentos::find($usuarios->origem_id);

        if (!isset($individuo['nome']) or !isset($individuo['email']) or empty($individuo['email']))
            return ['status' => 'erro', 'message' => 'Ocorreu um erro inesperado. Entre em contato com o suporte.'];

        return ['status' => 'ok', 'mensagem' => 'Senha recuperada com sucesso.', 'body' => ['token' => $token['token'], 'nome' => $individuo['nome'], 'email' => $individuo['email']]];
    }
}
