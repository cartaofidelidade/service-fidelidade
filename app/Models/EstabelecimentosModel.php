<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EstabelecimentosModel extends Model
{

    private $id;

    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "Estabelecimentos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'IndividuosId',
        'SegmentoId',
        'Ativo'
    ];

    protected $hidden = [];

    
    public function individuo()
    {
        return $this->belongsTo(IndividuosModel::class, 'IndividuosId')
            ->with(['usuarios', 'enderecos', 'contatos']);
    }

}
