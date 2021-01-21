<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EstabelecimentosModel extends Model
{

    private $id;

    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "estabelecimentos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IndividuosId',
        'SegmentoId',
        'Ativo',

    ];

    protected $hidden = [
        'Senha'
    ];

    public function listaEstabelecimentos()
    {

        $estabelecimentos = DB::table('estabelecimentos')
            ->join('individuos', 'clientes.individuosId', '=', 'individuos.Id')
            ->join('individuosContatos', 'individuos.id', '=', 'individuosContatos.individuosId')
            ->join('individuosEnderecos', 'individuos.id', '=', 'individuosEnderecos.individuosId')
            ->select('estabelecimentos.*','individuos.*', 'individuosContatos.*', 'individuosEnderecos.*')
            ->get();

        return $estabelecimentos;
    }
}
