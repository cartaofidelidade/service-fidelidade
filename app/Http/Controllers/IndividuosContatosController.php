<?php

namespace App\Http\Controllers;

use App\Models\IndividuosContatosModel;
use Exception;
use Illuminate\Support\Facades\DB;
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

                if ($validation->fails()) {
                    DB::rollBack();
                    return response()->json(['message' => $validation->errors()->first()], 400);
                }

                try {
                    $individuosContatos = new IndividuosContatosModel();

                    $individuosContatos->Individuos = $individuos;
                    $individuosContatos->TipoContato = $value['TipoContato'];
                    $individuosContatos->Ddd = $value['Ddd'];
                    $individuosContatos->Contato = $value['Contato'];
                    $individuosContatos->Whatsapp = $value['Whatsapp'];

                    $resultado[] = $individuosContatos['Id'];
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json(['message' => $e->getMessage()], 400);
                }
            }

            return $resultado;
        }
    }
}
