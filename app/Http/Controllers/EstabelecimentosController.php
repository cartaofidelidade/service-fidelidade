<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientesModel;
use App\Models\IndividuosModel;
use App\Models\IndividuosContatosModel;
use App\Models\IndividuosEnderecosModel;

use App\Models\EstabelecimentosModel;
use PhpParser\Node\Stmt\TryCatch;

class EstabelecimentosController extends Controller
{

    private $data;
    private $clientesModel;
    private $individuosModel;
    private $individuosContatosModel;
    private $individuosEnderecosModel;
    private $estabelecimentosModel;

    public function __construct(
        EstabelecimentosModel $estabelecimentosModel,
        IndividuosContatosModel $individuosContatosModel,
        IndividuosEnderecosModel $individuosEnderecosModel,
        IndividuosModel $individuosModel

    ) {
        $this->estabelecimentosModel = $estabelecimentosModel;
        $this->individuosModel = $individuosModel;
        $this->individuosEnderecosModel = $individuosEnderecosModel;
        $this->individuosContatosModel = $individuosContatosModel;
    }

    public function index($router)
    {
        return $this->estabelecimentosModel->paginate(10);
    }

    public function listaEstabelecimentos($router)
    {
        return $this->estabelecimentosModel->listaEstabelecimentos();

        if (count($this->data) > 0) {
            return response()->json($this->data, 200);
        } else {
            return response()->json(['erro' => 'Nenhum registro encontro'], 200);
        }
    }

    public function cadastro(Request $request)
    {

        $this->data = $this->individuosModel->create($request['Individuos']);

        $contatos = $request['IndividuosContatos'];
        $contatos['IndividuosId'] = $this->data->Id;

        $this->data['individuosContatos'] = $this->individuosContatosModel->create($contatos);


        if (!$this->data['individuosContatos']->Id) {

            return response()->json('Erro ao cadastrar individuosContatos', 200);
        }

        $enderecos = $request['IndividuosEnderecos'];
        $enderecos['IndividuosId'] = $this->data->Id;

        $this->data['individuosEnderecos'] = $this->individuosEnderecosModel->create($enderecos);

        if (!$this->data['individuosEnderecos']->Id) {

            return response()->json('Erro', 'Não cadastrar individuosEnderecos 200');
        }


        $estabelecimentos = $request['Estabelecimentos'];
        $estabelecimentos['IndividuosId'] = $this->data->Id;


        $this->data['estabelecimentos'] = $this->estabelecimentosModel->create($estabelecimentos);

        if (!$this->data['estabelecimentos']->Id) {

            return response()->json(['erro' => 'Erro ao cadastrar estabelecimento'], 200);
        }

        return response()->json(['Sucesso' => 'Estabelecimentos casdastrado com sucesso', 'Id' => $this->data['estabelecimentos']->Id], 200);
    }
}
