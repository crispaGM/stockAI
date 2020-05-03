<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
        protected $table = 'usr_token';
    protected $primaryKey = 'token_id';

    protected $fillable = [
        'tok_token',
        'usuario_id',
        'tok_numero_ip',
        'tok_dispositivo',
        'tok_manter_logado',
        'tok_data_expiracao',
        'tok_logado',
        'tok_data_hora_saida',
    ];


}
