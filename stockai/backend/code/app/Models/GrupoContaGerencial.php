<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoContaGerencial extends Model
{
    protected $table = 'fin_grupo_conta_gerencial';
    protected $primaryKey = 'grupo_conta_gerencial_id';

    protected $fillable = ['gcg_nome', 'unidade_negocio_id', 'tipo_grupo_conta_id'];

    public function contaGerencial()
    {
        return $this->hasMany(ContaGerencial::class, 'grupo_conta_gerencial_id');
    }
}
