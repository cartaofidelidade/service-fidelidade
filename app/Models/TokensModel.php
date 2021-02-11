<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokensModel extends Model
{
    const CREATED_AT = "DtCadastro";
    const UPDATED_AT = "DtAlteracao";

    protected $table = "Tokens";
    protected $primaryKey = "Id";

    protected $fillable = ['Token'];

    protected $hidden = [];
}
