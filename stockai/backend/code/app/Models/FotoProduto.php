<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoProduto extends Model
{
    protected $table = 'com_foto_produto';
    protected $primaryKey = 'foto_produto_id';
    public $timestamps = false;

    protected $fillable = ['fop_link_imagem', 'produto_id'];
}
