<?php

    namespace App\Http\Controllers;

    use App\Models\EstadosModel;
    use Illuminate\Http\Request;

    class EstadosController extends Controller
    {
        public function index()
        {
            $estados = EstadosModel::where(['Ativo' => 1])->get();
            return response()->json($estados, 200);
        }

        public function show()
        {
            $estados = EstadosModel::where(['Ativo' => 1])->get();
            return response()->json($estados, 200);
        }
    }
