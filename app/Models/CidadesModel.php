<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CidadesModel extends Model
{
    const CREATED_AT = "DtCadastro";
    const UPDATED_AT = "DtAlteracao";

    protected $table = "cidades";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IdEstados',
        'Nome',
        'Ativo'
    ];

    protected $hidden = [];
}
