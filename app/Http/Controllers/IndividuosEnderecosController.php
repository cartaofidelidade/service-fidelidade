<?php

namespace App\Http\Controllers;

use App\Models\IndividuosEnderecosModel;
use Illuminate\Support\Facades\Validator;

class IndividuosEnderecosController extends Controller
{

    public function novoIndividuoEnderecos(array $data, int $individuos)
    {
        if (isset($data['Enderecos']) && count($data['Enderecos']) > 0) {
            $resultado = [];

            foreach ($data['Enderecos'] as $key => $value) {
                $validation = Validator::make($value, [
                    'Cep' => 'required',
                    'Logradouro' => 'required',
                    'Numero' => 'required',
                    'Bairro' => 'required',
                    'CidadesId' => 'required',
                    'EstadosId' => 'required'
                ], [
                    'required' => 'O campo :attribute é obrigatório.'
                ]);

                if ($validation->fails())
                    return ['status' => 'erro', 'message' => $validation->errors()->first()];

                $individuosEnderecos = new IndividuosEnderecosModel();

                $individuosEnderecos->IndividuosId = $individuos;
                $individuosEnderecos->Cep = apenas_numeros($value['Cep']);
                $individuosEnderecos->Logradouro = $value['Logradouro'];
                $individuosEnderecos->Numero = $value['Numero'];
                $individuosEnderecos->Complemento = $value['Complemento'];
                $individuosEnderecos->Bairro = $value['Bairro'];
                $individuosEnderecos->CidadesId = $value['CidadesId'];
                $individuosEnderecos->EstadosId = $value['EstadosId'];

                if ($individuosEnderecos->save()) {
                    $resultado[] = $individuosEnderecos['Id'];
                } else {
                    return ['status' => 'erro', 'message' => 'Erro ao efetuar o cadastro do endereço;'];
                }
            }
            return ['status' => 'ok', 'message' => '', 'body' => $resultado];
        }
    }
}
