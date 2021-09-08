<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "clientes";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'nome',
        'email',
        'latitude',
        'longitude',
        'ativo'
    ];

    protected $hidden = [];

    public function cartelas()
    {
        return $this->hasOne(Cartelas::class,'clientes_id','id');
    }
    
}

