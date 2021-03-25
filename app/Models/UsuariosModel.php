<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosModel extends Model
{
    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "Usuarios";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IndividuosId',
        'Login',
        'Senha',
        'Ativo'
    ];

    protected $hidden = [
        'Senha'
    ];
}
