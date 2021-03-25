<?php

namespace App\Http\Controllers;

use App\Models\UsuariosModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

            if ($validation->fails()) {
                DB::rollBack();
                return response()->json(['message' => $validation->errors()->first()], 400);
            }

            $usuarios = new UsuariosModel();

            $usuarios->IndividuosId = $individuos;
            $usuarios->Login = $data['Login'];
            $usuarios->Senha = Hash::make($data['Senha']);

            if ($usuarios->save()) {
                return $usuarios['Id'];
            } else {
                DB::rollBack();
                return response()->json(['message' => 'Não foi possível efetuar o cadastro do usuario.']);
            }
        }
    }
}
