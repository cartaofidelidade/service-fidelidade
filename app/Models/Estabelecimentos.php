<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Estabelecimentos extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "estabelecimentos";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'tipo_pessoa',
        'nome',
        'nome_fantasia',
        'documento',
        'email',
        'celular',
        'telefone',
        'facebook',
        'instagram',
        'site',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'arquivologomarca',
        'nomelogomarca',
        'estados_id',
        'cidades_id',
        'segmentos_id',
        'ativo'
    ];

    protected $hidden = [];
}
