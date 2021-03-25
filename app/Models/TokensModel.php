<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokensModel extends Model
{
    protected $table = "Tokens";
    protected $primaryKey = "Id";

    protected $fillable = [
        'Token',
        'Ativo'
    ];

    protected $hidden = [];
}
