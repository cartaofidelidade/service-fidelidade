<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientesModel extends Model
{

    private $id;

    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "Clientes";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IndividuosId',
        'Ativo',

    ];

    protected $hidden = [
        'Senha'
    ];

    public function listaClientesEstabelecimentos($id = "")
    {

        $clientes = DB::table('clientes')
            ->join('individuos', 'clientes.individuosId', '=', 'individuos.Id')
            ->leftJoin('individuosContatos', 'individuos.id', '=', 'individuosContatos.individuosId')
            ->leftJoin('individuosEnderecos', 'individuos.id', '=', 'individuosEnderecos.individuosId')
            ->select(
                'clientes.Id as ClientesId',
                'clientes.IndividuosId as ClientesIndividuosId',
                'individuos.*',
                'individuosContatos.*',
                'individuosContatos.Id as individuosContatosId',
                'individuosEnderecos.Id as individuosEnderecosId',
                'individuosEnderecos.*'
            )
            ->get();

        return $clientes;
    }
    public function listaClientes($id)
    {

        $clientes = DB::table('clientes')
            ->join('individuos', 'clientes.individuosId', '=', 'individuos.Id')
            ->leftJoin('individuosContatos', 'individuos.id', '=', 'individuosContatos.individuosId')
            ->leftJoin('individuosEnderecos', 'individuos.id', '=', 'individuosEnderecos.individuosId')
            ->select(
                'clientes.Id as ClientesId',
                'clientes.IndividuosId as ClientesIndividuosId',
                'individuos.*',
                'individuosContatos.*',
                'individuosContatos.Id as individuosContatosId',
                'individuosEnderecos.Id as individuosEnderecosId',
                'individuosEnderecos.*'
            );
            
            $clientes->addwhere('clientes.Id', '=', 1)->get();

            dd($clientes);

        return $clientes;
    }
}
