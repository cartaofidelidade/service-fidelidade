<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampanhasModel extends Model
{
    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "Campanhas";
    protected $primaryKey = "Id";

    protected $fillable = [
        'EstabelecimentosId',
        'Codigo',
        'Nome',
        'Tipo',
        'FormaPontuacao',
        'ValorNotaFiscal',
        'Pontos',
        'QuantidadeCarimbos',
        'LimitarCarimbosDia',
        'DataInicial',
        'DataFInal',
        'Descricao',
        'Ativo'
    ];

    protected $hidden = [];
}
