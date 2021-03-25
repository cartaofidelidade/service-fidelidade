<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividuosEnderecosModel extends Model
{
    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "IndividuosEnderecos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IndividuosId',
        'EstadosId',
        'CidadesId',
        'Cep',
        'Logradouro',
        'Numero',
        'Complamento',
        'Bairro',
        'Ativo'
    ];

    protected $hidden = [];
}
