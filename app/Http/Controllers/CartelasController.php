<?php

namespace App\Http\Controllers;

use App\Models\Cartelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campanhas;


class CartelasController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['store']]);
    }

    public function index(Request $request)
    {
        $params = [];


        if (isset($request->estadoId) && !empty($request->campanhas_id))
            $params['campanhas_id'] = $request->estadoId;

        if (isset($request->estadoId) && !empty($request->clientes_id))
            $params['clientes_id'] = $request->clientes_id;

        if (isset($request->id) && !empty($request->id))
            $params['id'] = $request->id;



        $cartelas = Cartelas::where($params)->get();
        return response()->json($cartelas);
    }

    public function store(Request $request)
    {

        try {

            $cliente = Auth::user();
            $formData = $request->all();

            $cartelas = new Cartelas();

            $cartelas->campanhas_id = $formData['campanhas_id'];
            $cartelas->clientes_id = $formData['clientes_id'];

            if ($this->validaCarimbos($formData['campanhas_id']))
                return response()->json(['status' => 'erro', 'mensagem' => 'Limite diario atingido.'], 400);


            if ($cartelas->save())
                return response()->json($cartelas);

            return response()->json(['status' => 'erro', 'mensagem' => 'Não adicionar carimbo.'], 400);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'erro', 'mensagem' => $th->getMessage()], 400);
        }
    }

    public function listClient()
    {
        
    }


    public function validaCarimbos($id)
    {

        $campanhas = Campanhas::find($id);
        $cliente = Auth::user();

        $cartelas = Cartelas::where('clientes_id', '<=', '07527786-8dea-46b3-8490-27b5171f94c8')
            ->where('campanhas_id', '<=', $id)
            ->whereDate('created_at', date('Y-m-d'))
            // ->whereDate('data_cadastro', date('Y-m-d'))
            ->get();

        if ($campanhas->limite_carimbos_dia < $cartelas->count())
            return true;

        return false;
    }
}
