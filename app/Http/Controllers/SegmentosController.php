<?php

namespace App\Http\Controllers;

use App\Models\SegmentosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SegmentosController extends Controller
{
    public function index()
    {
        $seguimentos = SegmentosModel::where(['Ativo' => 1])->get();
        return response()->json($seguimentos);
    }

    public function show($id)
    {
        $seguimento = SegmentosModel::where(['Ativo' => 1, 'Id' => $id])->first();
        return response()->json($seguimento);
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            ['Nome' => 'required'],
            ['required' => 'O campo :attribute é obrigatório.']
        );

        if ($validator->fails())
            return response()->json(['mensagem' => $validator->errors()->first()], 400);

        $segmento = new SegmentosModel();

        $segmento->Nome = $request->get('Nome');
        $segmento = $segmento->save();

        if ($segmento)
            return response()->json($segmento);

        return response()->json(['mesnagem' => 'Não foi possível realizar o cadastro.'], 400);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            ['Nome' => 'required'],
            ['required' => 'O campo :attribute é obrigatório.']
        );

        if ($validator->fails())
            return response()->json(['mensagem' => $validator->errors()->first()], 400);

        $segmento = SegmentosModel::where(['Id' => $id])->first();

        if (!$segmento)
            return response()->json(['mensagem' => 'Segmento não encontrado.'], 400);


        $segmento->Nome = $request->get('Nome');
        $segmento = $segmento->save();

        if ($segmento)
            return response()->json($segmento);

        return response()->json(['mesnagem' => 'Não foi possível atualizar o cadastro.'], 400);
    }

    public function delete($id)
    {
        $segmento = SegmentosModel::where(['Id' => $id])->first();

        if (!$segmento)
            return response()->json(['mensagem' => 'Segmento não encontrado.'], 400);

        $segmento->Ativo = 0;
        $segmento->save();

        if ($segmento)
            return response()->json($segmento);

        return response()->json(['mesnagem' => 'Não foi possível deletar o cadastro.'], 400);
    }
}
