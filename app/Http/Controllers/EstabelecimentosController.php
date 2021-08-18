<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimentos;
use App\Mail\BemVindoEstabelecimentos;

use App\Models\Usuarios;
use App\Utils\Arquivos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use  LaravelQRCode\Facades\QRCode;


class EstabelecimentosController extends Controller
{

    public function index()
    {

    }

    public function show()
    {

    }

    public function store(array $formData): array
    {
        $res = DB::transaction(function () use ($formData) {

            $validation = Validator::make(
                $formData,
                [
                    'nome_fantasia' => 'required',
                    'email' => 'required|email|unique:estabelecimentos',
                    'login' => 'required|unique:usuarios',
                    'senha' => 'required|min:6',
                ],
                [
                    'required' => 'O campo :attribute é obrigatório',
                    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
                    'unique' => 'O campo :attribute já possui um registro.',
                    'min' => 'O campo :attribute deve ser pelo menos :min caracteres.'
                ]
            );

            if ($validation->fails()) {
                DB::rollBack();
                return ['status' => 'erro', 'mensagem' => $validation->errors()->first()];
            }

            $estabelecimentos = new Estabelecimentos();

            $estabelecimentos->nome_fantasia = $formData['nome_fantasia'] ?? null;
            $estabelecimentos->email = $formData['email'];
            $estabelecimentos->segmentos_id = $formData['segmentos_id'] ?? null;

            if ($estabelecimentos->save()) {
                $usuarios = new Usuarios();

                $usuarios->login = $formData['login'];
                $usuarios->senha = Hash::make($formData['senha']);
                $usuarios->origem = 1;
                $usuarios->origem_id = $estabelecimentos->id;

                if ($usuarios->save()) {
                    DB::commit();
                    // Mail::to($formData['email'])->send(new BemVindoEstabelecimentos($estabelecimentos));
                    return ['status' => 'ok', 'mensagem' => 'Cadastro realizado com sucesso', 'body' => $estabelecimentos];
                }

                DB::rollBack();
                return ['status' => 'erro', 'mesnagem' => 'Não foi possível realizar o cadastro do usuário.'];
            }

            DB::rollBack();
            return ['status' => 'erro', 'mesnagem' => 'Não foi possível realizar o cadastro do estabelecimento.'];
        });
        return $res;
    }

    public function update(Request $request)
    {
        try {
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
                    'cidades_id' => 'required'
                ],
                [
                    'required' => 'O campo :atribute é obrigatório',
                    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.'
                ]
            );


            if ($validation->fails())
                return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);

            $logomarca = "";

            if (isset($formData['logomarca']) && !empty($formData['logomarca']))
                $logomarca = (new Arquivos())->upload($formData['logomarca'], 'estabelecimentos-logomarca/');

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
            $estabelecimentos->numero = $formData['numero'] != "" ? $formData['numero'] : null;
            $estabelecimentos->complemento = $formData['complemento'] ?? null;
            $estabelecimentos->bairro = $formData['bairro'] ?? null;
            $estabelecimentos->logomarca = $logomarca;
            $estabelecimentos->nomelogomarca = $formData['logomarca'] ?? null;
            $estabelecimentos->estados_id = $formData['estados_id'] ?? null;
            $estabelecimentos->cidades_id = $formData['cidades_id'] ?? null;
            $estabelecimentos->segmentos_id = $formData['segmentos_id'] ?? null;

            if ($estabelecimentos->save())
                return response()->json($estabelecimentos);

            return response()->json(['status' => 'erro', 'mensagem' => 'Não foi possível realizar o atualizar do estabelecimento.'], 400);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mensagem' => $th->getMessage()], 400);
        }
    }

    public function geraQrCode()
    {

        // $pastaDestino = "logo-marca/";
        // $arquivoSalvo = $pastaDestino . uniqid() . '.' . 'jpg';
        // file_put_contents($arquivoSalvo, QRCode::url('werneckbh.github.io/qr-code/')
        //     ->setSize(8)
        //     ->setMargin(2)
        //     ->svg());

        // dd('sadas');
        dd(QRCode::urlddd('werneckbh.github.io/qr-code/')
            ->setSize(8)
            ->setMargin(2)
            ->svg());


        dd(file_get_contents(QRCode::url('werneckbh.github.io/qr-code/')
            ->setSize(8)
            ->setMargin(2)
            ->svg()));


        return QRCode::text('Laravel QR Code Generator!')->png();
    }
}
