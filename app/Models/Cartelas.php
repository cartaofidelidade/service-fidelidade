<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Cartelas extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "cartelas";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'campanhas_id',
        'clientes_id',
        'ativo'
    ];

    protected $hidden = [];
}
