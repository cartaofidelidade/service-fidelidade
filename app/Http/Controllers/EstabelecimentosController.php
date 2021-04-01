<?php

namespace App\Http\Controllers;

use App\Models\EstabelecimentosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EstabelecimentosController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        $formData = $request->all();

        dd($formData);

        $validation = Validator::make(
            $formData,
            ['SegmentosId' => 'required',],
            ['required' => 'O campo :attribute é obrigatório.']
        );

        if ($validation->fails()) {
            DB::rollBack();
            return response()->json(['mensagem' => $validation->errors()->first()], 400);
        }

        $individuos = (new IndividuosController())->novoIndividuo($formData);

        $estabelecimentos = new EstabelecimentosModel();

        $estabelecimentos->IndividuosId = $individuos;
        $estabelecimentos->SegmentosId = $request->SegmentosId;

        $estabelecimentos->save();

        if ($estabelecimentos->save()) {
            DB::commit();
            return response()->json(['mensagem' => 'Cadastro realizado com sucesso.']);
        } else {
            DB::rollBack();
            return response()->json(['mensagem' => 'Não foi possível efetuar o cadastro do estabelecimento.'], 400);
        }
    }
}
