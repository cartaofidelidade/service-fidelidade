<?php

namespace App\Http\Controllers;

use App\Models\IndividuosContatosModel;
use Illuminate\Support\Facades\Validator;

class IndividuosContatosController extends Controller
{

    public function novoIndividuosContatos(array $data, int $individuos)
    {
        if (isset($data['Contatos']) && count($data['Contatos']) > 0) {
            $resultado = [];

            foreach ($data['Contatos'] as $key => $value) {
                $validation = Validator::make($value, [
                    'TipoContato' => 'required',
                    'Ddd' => 'required',
                    'Contato' => 'required',
                    'Whatsapp' => 'required'
                ], [
                    'required' => 'O campo :attribute é obrigatório.'
                ]);

                if ($validation->fails())
                    return ['status' => 'erro', 'message' => $validation->errors()->first()];

                $individuosContatos = new IndividuosContatosModel();

                $individuosContatos->Individuos = $individuos;
                $individuosContatos->TipoContato = $value['TipoContato'];
                $individuosContatos->Ddd = $value['Ddd'];
                $individuosContatos->Contato = $value['Contato'];
                $individuosContatos->Whatsapp = $value['Whatsapp'];

                if ($individuosContatos->save()) {
                    $resultado[] = $individuosContatos['Id'];
                } else {
                    return ['status' => 'erro', 'message' => 'Erro ao efetuar o cadastro do contato.'];
                }
            }

            return ['status' => 'ok', 'message' => '', 'body' => $resultado];
        }
    }
}
