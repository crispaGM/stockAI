<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'com_produto';
    protected $primaryKey = 'produto_id';

    protected $fillable = [
        'unidade_negocio_id',
        'categoria_id',
        'pro_nome',
        'pro_valor_custo',
        'pro_valor',
        'pro_valor_socio',
        'pro_descricao',
        'pro_imagem',
        'pro_cadastro_ativo',
    ];


    public function fotosProduto()
    {
        return $this->hasMany(FotoProduto::class, 'produto_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
