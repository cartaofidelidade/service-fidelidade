<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    use Uuid;

    const CREATED_AT = "data_cadastro";
    const UPDATED_AT = "data_alteracao";

    protected $table = "cidades";

    protected $keyType = "string";

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $fillable = [
        'estados_id',
        'nome'
    ];

    protected $hidden = [];

    public function estado(){
        return $this->belongsTo(Estados::class, 'estados_id');
    }
}
