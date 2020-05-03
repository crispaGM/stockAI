<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Unidade extends Model
{
    use RevisionableTrait;
    protected $revisionCreationsEnabled = true;

    protected $table = 'ger_unidade';
    protected $primaryKey = 'unidade_negocio_id';
    public $timestamps = false;

    protected $fillable = [
        'unidade_negocio_id',
        'une_dominio',
        'une_cor_primaria',
        'une_cor_secundaria',
        'une_cor_tercearia',
        'une_slogan'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'unidade_negocio_id');
    }
}
