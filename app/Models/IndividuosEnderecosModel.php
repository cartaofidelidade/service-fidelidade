<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividuosEnderecosModel extends Model
{
    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "individuosEnderecos";
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
        'Padrao',
        'Ativo'
    ];

    protected $hidden = [
        'Senha'
    ];
}

