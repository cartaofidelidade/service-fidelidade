<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosModel extends Model
{

    private $id;

    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "usuarios";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IndividuosId',
        'Login',
        'Ativo'
    ];

    protected $hidden = [
        'Senha'
    ];

}

