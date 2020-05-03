<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class RoleUsuarioUnidade extends Model
{
    protected $table = 'usr_role_usuario_unidade';
    protected $primaryKey = 'role_usuario_unidade_id';
    public $incrementing = false;

    protected $fillable = ['role_id', 'usuario_id', 'unidade_negocio_id'];
}
