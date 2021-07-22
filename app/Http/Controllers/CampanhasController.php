<?php

namespace App\Http\Controllers;

use App\Models\Campanhas;
use App\Models\CampanhasModel;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CampanhasController extends Controller
{

    public function index(Request $request)
    {
        $params = [];

        $params['ativo'] = 1;

        if (isset($request->nome) && !empty($request->nome))
            $params['nome'] = $request->nome;

        if (isset($request->tipo) && !empty($request->tipo))
            $params['tipo'] = $request->tipo;

        if (isset($request->id) && !empty($request->id))
            $params['codigo'] = $request->codigo;


        $campanhas = Campanhas::where($params)->get();
        return response()->json($campanhas);
    }

    public function show($id)
    {
        $campanhas = Campanhas::find($id);

        if ($campanhas['imagem_carimbo_preenchido'])
            $campanhas['imagem_carimbo_preenchido'] = base64_encode(file_get_contents($campanhas['imagem_carimbo_preenchido']));

        if ($campanhas['imagem_carimbo_vazio'])
            $campanhas['imagem_carimbo_vazio'] = base64_encode(file_get_contents($campanhas['imagem_carimbo_vazio']));


        return response()->json($campanhas);
    }

    public function store(Request $request)
    {

        try {
            $estabelecimento = Auth::user();
            $formData = $request->all();

            $validation = Validator::make(
                $formData,
                [
                    'nome' => 'required',
                    'tipo' => 'required',
                    'data_inicio' => 'required',
                    'data_final' => 'required'
                ],
                [
                    'required' => 'O campo :atribute é obrigatório'
                ]
            );

            if ($validation->fails())
                return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);

            $campanhas = new Campanhas();

            $campanhas->estabelecimentos_id = $estabelecimento->origem_id;
            $campanhas->codigo = substr(uniqid(rand()), 0, 6);
            $campanhas->nome = $formData['nome'];
            $campanhas->tipo = $formData['tipo'];

            $campanhas->pontos = $formData['pontos'] ?? 0;
            $campanhas->quantidade_carimbos = $formData['quantidade_carimbos'];
            $campanhas->limite_carimbos_dia = $formData['limite_carimbos_dia'];
            $campanhas->data_inicio = $formData['data_inicio'];
            $campanhas->data_final = $formData['data_final'];
            $campanhas->descricao = $formData['descricao'];

            $campanhas->imagem_carimbo_preenchido = $this->uploadImagem($formData['imagem_carimbo_preenchido']) ?? null;
            $campanhas->imagem_carimbo_vazio = $this->uploadImagem($formData['imagem_carimbo_vazio']) ?? null;

            if ($campanhas->save())
                return response()->json($campanhas);
            return response()->json(['status' => 'erro', 'mesnagem' => 'Não foi possível cadastrar a campanha.'], 400);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mesnagem' => $th], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $estabelecimento = Auth::user();
            $formData = $request->all();

            $validation = Validator::make(
                $formData,
                [
                    'nome' => 'required',
                    'tipo' => 'required',
                    'data_inicio' => 'required',
                    'data_final' => 'required'
                ],
                [
                    'required' => 'O campo :atribute é obrigatório'
                ]
            );

            if ($validation->fails())
                return response()->json(['status' => 'erro', 'mensagem' => $validation->errors()->first()], 400);

            $campanhas = Campanhas::find($id);

            $campanhas->nome = $formData['nome'];
            $campanhas->tipo = $formData['tipo'];
            $campanhas->pontos = $formData['pontos'] ?? 0;
            $campanhas->quantidade_carimbos = $formData['quantidade_carimbos'];
            $campanhas->limite_carimbos_dia = $formData['limite_carimbos_dia'];
            $campanhas->data_inicio = $formData['data_inicio'];
            $campanhas->data_final = $formData['data_final'];
            $campanhas->descricao = $formData['descricao'];

            $campanhas->imagem_carimbo_preenchido = $this->uploadArquivo($formData['imagem_carimbo_preenchido']) ?? null;
            $campanhas->imagem_carimbo_vazio = $this->uploadArquivo($formData['imagem_carimbo_vazio']) ?? null;


            if ($campanhas->save())
                return response()->json($campanhas);

            return response()->json(['status' => 'erro', 'mensagem' => 'Não foi possível cadastrar a campanha.'], 400);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mensagem' => $th], 400);
        }
    }

    public function delete($id)
    {
        try {

            $campanhas = Campanhas::find($id);
            $campanhas->ativo = 0;

            if ($campanhas->save())
                return response()->json($campanhas);
        } catch (\Throwable $th) {
            return response()->json(['status', 'erro', 'mensagem' => '', $th->getMessage()], 400);
        }
    }

    public function uploadArquivo(string $arquivo)
    {
        if (strpos($arquivo, ';base64')) {

            $pastaDestino = "carimbos/";
            $imagem_parts = explode(";base64,", $arquivo);
            $imagem_type_aux = explode("image/", $imagem_parts[0]);
            $imagem_type = $imagem_type_aux[1];
            $imagem_base64 = base64_decode($imagem_parts[1]);
            $arquivoSalvo = $pastaDestino . uniqid() . '.' . $imagem_type;
            file_put_contents($arquivoSalvo, $imagem_base64);

            return $formData['logomarca'] = $arquivoSalvo;
        } else {
            return response()
                ->json(['message' => 'Erro ao salvar carimbo'], 400);
        }
    }
}
