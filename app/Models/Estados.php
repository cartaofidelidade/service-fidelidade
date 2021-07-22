<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "estados";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'nome',
        'sigla'
    ];

    protected $hidden = [];

    public function cidades()
    {
        return $this->hasMany(Cidades::class, 'estados_id', 'id');
    }
}
