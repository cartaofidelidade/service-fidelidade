<?php

namespace App\Http\Controllers;

use App\Models\CidadesModel;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function index()
    {
        $cidades = CidadesModel::where(['Ativo' => 1])->get();
        return response()->json($cidades, 200);
    }

    public function show()
    {
        $cidades = CidadesModel::where(['Ativo' => 1])->get();
        return response()->json($cidades, 200);
    }
}
