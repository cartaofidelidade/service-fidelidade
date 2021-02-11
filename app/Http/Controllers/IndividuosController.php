<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientesModel;


class IndividuosController extends Controller
{

    private $clientesModel;

    public function __construct(ClientesModel $clientesModel)
    {

        $this->clientesModel = $clientesModel;
    }

    public function cadastro(Request $request)
    {
        $this->clientesModel->create($request->all());
    }

    public function index()
    {
        return $this->clientesModel->paginate(10);
    }
}
