<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "tokens";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'token',
        'origem',
        'ativo'
    ];

    protected $hidden = [];
}
