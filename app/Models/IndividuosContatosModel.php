<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividuosContatosModel extends Model
{
    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "IndividuosContatos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IndividuosId',
        'TipoContato',
        'Ddd',
        'Telefone',
        'Whatsapp',
        'Ativo'
    ];

    protected $hidden = [];
}
