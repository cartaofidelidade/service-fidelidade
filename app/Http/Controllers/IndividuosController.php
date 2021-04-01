<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientesModel;
use App\Models\IndividuosModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IndividuosController extends Controller
{
    public function novoIndividuo(array $data)
    {
        $contatos = true;
        $enderecos = true;
        $usuarios = true;

        $validation = Validator::make($data, [
            'Nome' => 'required',
            'Email' => 'required|unique:Individuos,Email'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'o formato do e-mail é inválido.',
            'unique' => 'Este :attribute já possui um registro.'
        ]);

        if ($validation->fails())
            return ['status' => 'erro', 'message' => $validation->errors()->first()];

        $individuos = new IndividuosModel();

        $individuos->TipoPessoa = $data['TipoPessoa'];
        $individuos->Nome = $data['Nome'];
        $individuos->NomeFantasia = $data['NomeFantasia'];
        $individuos->Documento = apenas_numeros($data['Documento']);
        $individuos->InscricaoMunicipal = apenas_numeros($data['InscricaoMunicipal']);
        $individuos->InscricaoEstadual = apenas_numeros($data['InscricaoEstadual']);
        $individuos->Rg = apenas_numeros($data['Rg']);
        $individuos->Orgao = $data['Orgao'];
        $individuos->DataNascimento = $data['DataNascimento'];
        $individuos->Naturalidade = $data['Naturalidade'];
        $individuos->Email = $data['Email'];
        $individuos->NomeResponsavel = $data['NomeResponsavel'];
        $individuos->DocumentoResponsavel = apenas_numeros($data['DocumentoResponsavel']);

        if ($individuos->save()) {
            return $individuos->Id;
        } else {
            DB::rollBack();
            return response()->json(['message' => 'Não foi possível efetuar o cadastro do individuo.'], 400);
        }
    }
}
