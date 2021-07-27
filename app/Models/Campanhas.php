<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Campanhas extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "campanhas";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'estabelecimentos_id',
        'codigo',
        'nome',
        'tipo',
        'pontos',
        'quantidade_carimbos',
        'limite_carimbos_dia',
        'data_inicio',
        'data_final',
        'descricao',
        'imagem_carimbo_preenchido',
        'imagem_carimbo_vazio',
        'ativo'
    ];

    protected $hidden = [];
}
