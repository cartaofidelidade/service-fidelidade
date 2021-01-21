<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndividuosContatosModel;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;


class IndividuosContatosController extends Controller
{

    private $data;
    private $model;

    public function __construct(IndividuosContatosModel $individuosContatos)
    {
        $this->model = $individuosContatos;
    }

    public function index($router)
    {
        return $this->model->paginate(10);
    }

    public function buscaContatos($router)
    {

        return $this->model->find($router);
    }

    public function cadastro(Request $request)
    {
        $data = $this->model->create($request->all());

        if ($this->data->Id) {
            return response()->json(['Sucesso' => 'Contato casdastrado com sucesso', 'Id' => $this->data['estabelecimentos']->Id], 200);
        }
    }

    public function update($router, Request $request)
    {
        $contatos = $this->model->find($router)->update($request->all());

        return response()
            ->json([
                'data' => [
                    'message' => 'Curso foi atualizado com sucesso!'
                ]
            ]);
    }


    public function destroy($router)
    {
        $contatos = $this->model->find($router);

        $contatos->delete();

        return response()
            ->json([
                'data' => [
                    'message' => 'Curso foi removido com sucesso!'
                ]
            ]);
    }
}
