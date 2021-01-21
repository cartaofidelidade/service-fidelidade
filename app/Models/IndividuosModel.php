<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividuosModel extends Model
{
    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "individuos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'Nome',
        'Email',
        'Ddd',
        'Telefone',
        'Whatsapp',
        'DataNascimento',
        'Cep',
        'Logradouro',
        'Numero',
        'Complemento',
        'Bairro',
        'IdCidades',
        'IdEstados',
        'Senha',
        'Ativo',
        'Documento'
    ];

    protected $hidden = [
        'Senha'
    ];
}

