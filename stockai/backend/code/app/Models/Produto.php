<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'unidade_negocio_id',
        'categoria_id',
        'nome',
        'valor_custo',
        'valor_venda',
        'qtd_estoque',
        'data_validade',
    ];


    /*public function fotosProduto()
    {
        return $this->hasMany(FotoProduto::class, 'produto_id');
    }*/

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
