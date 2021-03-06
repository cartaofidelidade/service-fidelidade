<?php

namespace App\Http\Controllers;

use App\Mail\register;
use App\Models\EstabelecimentosModel;
use App\Models\IndividuosModel;
use App\Models\UsuariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContaEstabelecimentosController extends Controller
{

    private $token = "0B39719B-66E0-4A43-9B2B-9C3E8DDFA517";

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['Email' => 'required', 'Senha' => 'required'],
            ['required' => 'O campo :attribute é obrigatório.']
        );

        if ($validator->fails())
            return response()->json(['mensagem' => $validator->errors()->first()], 400);

        $usuarios = UsuariosModel::where(['Login' => $request->get('Email')])->first();

        if (!$usuarios || !Hash::check($request->get('Senha'), $usuarios->Senha))
            return response()->json(['mensagem' => 'Os dados de Login e ou Senha estão incorretos.'], 400);

        return response()->json(['Autorization' => base64_encode(json_encode($usuarios))], 200);
    }

    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'TipoPessoa' => 'required',
                'Nome' => 'required',
                'Segmento' => 'required',
                'Email' => 'required|unique:Individuos,Email',
                'Senha' => 'required'
            ],
            [
                'required' => 'O campo :attribute é obrigatório.',
                'unique' => 'O :attribute ja possui um registrado.'
            ]
        );

        if ($validator->fails())
            return response()->json(['mensagem' => $validator->errors()->first()], 400);

        DB::beginTransaction();

        $individuos = new IndividuosModel();

        $individuos->TipoPessoa = $request->get('TipoPessoa');
        $individuos->Nome = $request->get('Nome');
        $individuos->NomeFantasia = $request->get('Nome');
        $individuos->Email = $request->get('Email');

        if (!$individuos->save()) {
            DB::rollBack();
            return response()->json(['mensagem' => 'Erro ao efetuar o cadastro do indivíduo.'], 400);
        }

        $usuarios = new UsuariosModel();

        $usuarios->IndividuosId = $individuos['Id'];
        $usuarios->Login = $request->get('Email');
        $usuarios->Senha = Hash::make($request->get('Senha'));

        if (!$usuarios->save()) {
            DB::rollBack();
            return response()->json(['mensagem' => 'Erro ao efetuar o cadastro do usuário.'], 400);
        }

        $estabelecimento = new EstabelecimentosModel();

        $estabelecimento->IndividuosId = $individuos['Id'];
        $estabelecimento->SegmentoId = $request->get('Segmento');

        if (!$estabelecimento->save()) {
            DB::rollBack();
            return response()->json(['mensagem' => 'Erro ao efetuar o cadastro do usuário.'], 400);
        }

        $dadosEmail = [
            'Nome' => $individuos['Nome'],
            'Email' => $individuos['Email'],
            'Codigo' => '123456',
        ];

        Mail::send(new register($dadosEmail));

        DB::commit();
        return response()->json(['Id' => $estabelecimento['Id']], 200);
    }

    public function checkRegister(Request $request)
    {
    }

    public function forgot(Request $request)
    {
    }
}
