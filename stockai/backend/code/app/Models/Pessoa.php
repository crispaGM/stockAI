<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * Class Pessoa
 * @package App\Models
 */
class Pessoa extends Model
{
//    use RevisionableTrait;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'ger_pessoa';
    /**
     * @var string
     */
    protected $primaryKey = 'pessoa_id';


    /**
     * @var array
     */
    protected $fillable = [
        'pes_nome',
        'pes_apelido',
        'pes_telefone',
        'pes_celular',
        'pes_email',
        'pes_cpf_cnpj',
        'tipo_pessoa_id',
        'usuario_id',
        'cargo_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'pessoa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidade()
    {
        return $this->hasOne(Unidade::class, 'unidade_negocio_id', 'pessoa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function socio()
    {
        return $this->hasOne(Socio::class, 'pessoa_id');
    }
}
