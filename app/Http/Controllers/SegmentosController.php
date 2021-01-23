<?php

namespace App\Http\Controllers;

use App\Models\SegmentosModel;
use Illuminate\Http\Request;

class SegmentosController extends Controller
{
    public function index()
    {
        $estados = SegmentosModel::where(['Ativo' => 1])->get();
        return response()->json($estados, 200);
    }

    public function show()
    {
        $estados = SegmentosModel::where(['Ativo' => 1])->get();
        return response()->json($estados, 200);
    }
}
