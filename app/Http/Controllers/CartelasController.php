<?php

namespace App\Http\Controllers;

use App\Models\Cartelas;
use Illuminate\Http\Request;

class CartelasController extends Controller
{
    public function index(Request $request)
    {
        $params = [];

        if (isset($request->nome) && !empty($request->nome))
            $params['nome'] = $request->nome;

        if (isset($request->estadoId) && !empty($request->estadoId))
            $params['estados_id'] = $request->estadoId;

        if (isset($request->id) && !empty($request->id))
            $params['id'] = $request->id;


           
        $cidades = Cartelas::where($params)->orderBy('nome')->get();
        return response()->json($cidades);
    }

    public function store(Request $request)
    {
        
        try {

            $cliente = Auth::user();
            $formData = $request->all();

            // $validation = Validator::make(
            //     $formData,
            //     [
            //         'nome' => 'required',
            //         'tipo' => 'required',
            //         'data_inicio' => 'required',
            //         'data_final' => 'required'
            //     ],
            //     [
            //         'required' => 'O campo :atribute é obrigatório'
            //     ]
            // );



            // if ($validation->fails())
            //     return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);

            $cartelas = new Cartelas();

            $cartelas->campanhas_id = $cliente->clientes_id;
            $cartelas->clientes_id = $formData['campanhas_id'];





            if ($cartelas->save())
                return response()->json($cartelas);
            return response()->json(['status' => 'erro', 'mesnagem' => 'Não adicionar carimbo.'], 400);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mesnagem' => $th->getMessage()], 400);
        }

    }

    public function validaCarimbos()
    {
        # code...
    }
}
