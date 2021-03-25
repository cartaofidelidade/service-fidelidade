<?php

namespace App\Http\Controllers;

use App\Models\EstabelecimentosModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EstabelecimentosController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        $validation = Validator::make(
            $request->all(),
            ['SegmentosId' => 'required',],
            ['required' => 'O campo :attribute é obrigatório.']
        );

        if ($validation->fails()) {
            DB::rollBack();
            return response()->json(['message' => $validation->errors()->first()], 400);
        }

        try {
            $individuos = (new IndividuosController())->novoIndividuo($request->all());

            $estabelecimentos = new EstabelecimentosModel();

            $estabelecimentos->IndividuosId = $individuos;
            $estabelecimentos->SegmentosId = $request->SegmentosId;

            $estabelecimentos->save();

            DB::commit();
            return response()->json(['message' => 'Cadastro realizado com sucesso.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Não foi possível efetuar o cadastro do estabelecimento.'], 400);
        }
    }
}
