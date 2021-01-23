<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SegmentosModel extends Model
{
    const CREATED_AT = "DtCadastro";
    const UPDATED_AT = "DtAlteracao";

    protected $table = "segmentos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'Nome',
        'Ativo'
    ];

    protected $hidden = [];
}
