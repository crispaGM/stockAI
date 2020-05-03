<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use SoftDeletes;

    protected $table = 'fin_lancamento';
    protected $primaryKey = 'lancamento_id';

    protected $fillable = [
        'unidade_negocio_id',
        'conta_gerencial_id',
        'categoria_lancamento_id',
        'tipo_operacao_id',
        'lan_valor',
        'lan_data',
        'lan_descricao',
        'lan_efetivado',
    ];

    public function contaGerencial()
    {
        return $this->belongsTo(ContaGerencial::class, 'conta_gerencial_id', 'conta_gerencial_id');
    }


    public function pagamentoAssociacao()
    {
        return $this->hasOne(PagamentoAssociacao::class, 'lancamento_id', 'lancamento_id');
    }

}
