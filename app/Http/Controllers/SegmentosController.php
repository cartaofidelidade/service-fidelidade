<?php

namespace App\Http\Controllers;

use App\Models\Segmentos;
use App\Models\SegmentosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SegmentosController extends Controller
{
    public function index()
    {
        $params = [];

        $params['ativo'] = 1;

        $seguimentos = Segmentos::where($params)->get();
        return response()->json($seguimentos);
    }

    public function show($id)
    {
        $seguimento = Segmentos::where(['ativo' => 1, 'id' => $id])->first();
        return response()->json($seguimento);
    }

    public function store(Request $request)
    {

        $formData = $request->only('nome');

        $validator = Validator::make(
            $formData,
            ['nome' => 'required']
        );

        if ($validator->fails())
            return response()->json(['mensagem' => $validator->errors()->first()], 400);

        $segmento = new Segmentos();
        $segmento->nome = $formData['nome'];

        if ($segmento->save())
            return response()->json($segmento);

        return response()->json(['status' => 'erro', 'mesnagem' => 'Não foi possível realizar o cadastro.'], 400);
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

        $segmento = Segmentos::where(['Id' => $id])->first();

        if (!$segmento)
            return response()->json(['status' => 'erro', 'mensagem' => 'Segmento não encontrado.'], 400);


        $segmento->Nome = $request->get('Nome');
        $segmento = $segmento->save();

        if ($segmento)
            return response()->json($segmento);

        return response()->json(['status' => 'erro', 'mesnagem' => 'Não foi possível atualizar o cadastro.'], 400);
    }

    public function delete($id)
    {
        $segmento = Segmentos::where(['Id' => $id])->first();

        if (!$segmento)
            return response()->json(['mensagem' => 'Segmento não encontrado.'], 400);

        $segmento->Ativo = 0;
        $segmento->save();

        if ($segmento)
            return response()->json($segmento);

        return response()->json(['mesnagem' => 'Não foi possível deletar o cadastro.'], 400);
    }
}
