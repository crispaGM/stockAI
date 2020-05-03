<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaLancamento extends Model
{
    use SoftDeletes;

    protected $table = 'fin_categoria_lancamento';
    protected $primaryKey = 'categoria_lancamento_id';

    protected $fillable = [
        'tipo_operacao_id',
        'cal_nome',
        'cal_icon',
        'cal_cor',
    ];
}
