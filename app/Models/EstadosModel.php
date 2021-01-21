<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadosModel extends Model
{
    const CREATED_AT = "DtCadastro";
    const UPDATED_AT = "DtAlteracao";

    protected $table = "estados";
    protected $primaryKey = "Id";

    protected $fillable = [
        'Nome',
        'Sigla',
        'Ativo'

    ];

    protected $hidden = [];
}
