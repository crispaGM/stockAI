<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Endereco extends Model
{
    use RevisionableTrait;

    protected $table = 'ger_endereco';
    protected $primaryKey = 'endereco_id';

    protected $fillable = [
        'pessoa_id',
        'municipio_id',
        'end_telefone',
        'end_logradouro',
        'end_numero',
        'end_complemento',
        'end_bairro',
        'end_cep',
        'end_latitude',
        'end_longitude',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
