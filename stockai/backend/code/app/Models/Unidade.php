<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Unidade extends Model
{
//    use RevisionableTrait;
//    protected $revisionCreationsEnabled = true;

    protected $table = 'unidade_negocio';
    protected $primaryKey = 'id';

    protected $fillable = [
        'dominio',
        'nome',
    ];

}
