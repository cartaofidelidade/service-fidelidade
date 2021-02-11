<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientesModel;
use App\Models\IndividuosModel;
use App\Models\IndividuosContatosModel;
use App\Models\IndividuosEnderecosModel;
use App\Models\UsuariosModel;
use Illuminate\Support\Facades\DB;




class ClientesController extends Controller
{

    private $data;
    private $clientesModel;
    private $individuosModel;
    private $individuosContatosModel;
    private $individuosEnderecosModel;
    private $usuariosModel;

    public function __construct(
        ClientesModel $clientesModel,
        IndividuosContatosModel $individuosContatosModel,
        IndividuosEnderecosModel $individuosEnderecosModel,
        IndividuosModel $individuosModel,
        UsuariosModel $UsuariosModel
    ) {
        $this->clientesModel = $clientesModel;
        $this->individuosModel = $individuosModel;
        $this->individuosEnderecosModel = $individuosEnderecosModel;
        $this->individuosContatosModel = $individuosContatosModel;
        $this->usuariosModel = $UsuariosModel;
    }

    public function index($router)
    {
        return $this->clientesModel->paginate(10);
    }

    public function listaClientes($router)
    {
        $this->data = $this->clientesModel->listaClientes($router);

        if (count($this->data) > 0) {
            return response()->json($this->data, 200);
        } else {
            return response()->json(['erro' => 'Nenhum registro encontro'], 200);
        }
    }

    public function cadastro(Request $request)
    {
        DB::beginTransaction();
        try {

            $this->data = $this->individuosModel->create($request['Individuos']);

            $contatos = $request['IndividuosContatos'];
            $contatos['IndividuosId'] = $this->data->Id;

            $this->data['individuosContatos'] = $this->individuosContatosModel->create($contatos);

            if (!$this->data['individuosContatos']->Id) {

                return response()->json('Erro ao cadastrar individuosContatos', 507);
            }

            $enderecos = $request['IndividuosEnderecos'];
            $enderecos['IndividuosId'] = $this->data->Id;

            $this->data['individuosEnderecos'] = $this->individuosEnderecosModel->create($enderecos);

            if (!$this->data['individuosEnderecos']->Id) {

                return response()->json(['Erro' => 'Não cadastrar individuosEnderecos'], 507);
            }

            $usuarios = $request['Usuario'];
            $usuarios['IndividuosId'] = $this->data->Id;

            $this->data['usuarios'] = $this->usuariosModel->create($usuarios);

            if (!$this->data['usuarios']->Id) {

                return response()->json(['erro' => 'Erro ao cadastrar Usuario'], 507);
            }

            $clientes['IndividuosId'] = $this->data->Id;
            $clientes['Ativo'] = 1;

            $this->data['usuarios'] = $this->clientesModel->create($clientes);

            if (!$this->data['usuarios']->Id) {

                return response()->json(['erro' => 'Erro ao cadastrar Cliente'], 507);
            }

            DB::commit();

            return response()->json(['Sucesso' => 'Cliente casdastrado com sucesso'], 201);
        } catch (\Throwable $e) {
            DB::rollback();

            return response()->json(['erro' => 'Erro no banco de dados' . $e], 507);
        }
    }
}
