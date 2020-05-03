<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venda extends Model
{
    use SoftDeletes;

    protected $table = 'com_venda';
    protected $primaryKey = 'venda_id';

    protected $fillable = [
        'variacao_id',
        'unidade_negocio_id',
        'conta_gerencial_id',
        'produto_id',
        'lancamento_id',
        'socio_id',
        'ven_data_venda',
        'ven_valor',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function variacao()
    {
        return $this->belongsTo(VariacaoProduto::class, 'variacao_id');
    }

    public function socio()
    {
        return $this->belongsTo(Socio::class, 'socio_id');
    }

    public function contaGerencial()
    {
        return $this->belongsTo(ContaGerencial::class, 'conta_gerencial_id');
    }
}
