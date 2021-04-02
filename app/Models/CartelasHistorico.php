<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class CartelasHistorico extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "cartelas_historico";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'cartelas_id',
        'quantidade',
        'ativo'
    ];

    protected $hidden = [];
}
