<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoAssociacao extends Model
{
    protected $table = 'soc_plano_associacao';
    protected $primaryKey = 'plano_associacao_id';

    protected $fillable = ['tipo_plano_associacao_id', 'unidade_negocio_id', 'pla_valor', 'pla_descricao'];

    public function tipoPlanoAssociacao()
    {
        return $this->belongsTo('soc_tipo_plano_associacao', 'tipo_plano_associacao_id');
    }
}
