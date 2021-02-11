<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SegmentosModel extends Model
{
    const CREATED_AT = "DtCadastro";
    const UPDATED_AT = "DtAlteracao";

    protected $table = "Segmentos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'Nome',
        'Ativo'
    ];

    protected $hidden = [];
}
