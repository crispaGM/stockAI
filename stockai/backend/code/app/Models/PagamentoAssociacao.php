<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagamentoAssociacao extends Model
{
    use SoftDeletes;

    protected $table = 'soc_pagamento_associacao';
    protected $primaryKey = 'pagamento_associacao_id';

    protected $fillable = [
        'conta_gerencial_id',
        'socio_id',
        'lancamento_id',
        'paa_data',
        'paa_valor_pago'
    ];

    public function lancamento()
    {
        return $this->belongsTo(Lancamento::class, 'lancamento_id', 'lancamento_id');
    }
}
