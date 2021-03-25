<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndividuosEnderecosModel;
use Exception;
use Illuminate\Support\Facades\DB;
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

                if ($validation->fails()) {
                    DB::rollBack();
                    return response()->json(['message' => $validation->errors()->first()], 400);
                }

                try {
                    $individuosEnderecos = new IndividuosEnderecosModel();

                    $individuosEnderecos->IndividuosId = $individuos;
                    $individuosEnderecos->Cep = apenas_numeros($value['Cep']);
                    $individuosEnderecos->Logradouro = $value['Logradouro'];
                    $individuosEnderecos->Numero = $value['Numero'];
                    $individuosEnderecos->Complemento = $value['Complemento'];
                    $individuosEnderecos->Bairro = $value['Bairro'];
                    $individuosEnderecos->CidadesId = $value['CidadesId'];
                    $individuosEnderecos->EstadosId = $value['EstadosId'];

                    $resultado[] = $individuosEnderecos['Id'];
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json(['message' => $e->getMessage()], 400);
                }
            }

            return $resultado;
        }
    }
}
