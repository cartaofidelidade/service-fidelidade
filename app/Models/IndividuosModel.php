<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividuosModel extends Model
{
    const CREATED_AT = "DataCadastro";
    const UPDATED_AT = "DataAlteracao";

    protected $table = "Individuos";
    protected $primaryKey = "Id";

    protected $fillable = [
        'TipoPessoa',
        'Nome',
        'NomeFantasia',
        'Documento',
        'InscricaoMunicipal',
        'InscricaoEstadual',
        'Rg',
        'Orgao',
        'DataNascimento',
        'Naturalidade',
        'Email',
        'NomeResponsavel',
        'DocumentoResponsavel',
        'Ativo'
    ];

    protected $hidden = [];


    public function contatos()
    {
        return $this->hasMany(IndividuosContatosModel::class);
    }

    public function enderecos()
    {
        return $this->hasMany(IndividuosEnderecosModel::class);
    }

    public function usuarios()
    {
        return $this->hasOne(UsuariosModel::class);
    }
}

