<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'usr_recurso';
    protected $primaryKey = 'recurso_id';

    protected $fillable = ['rec_nome', 'rol_description'];

    public function roles()
    {
        return $this->hasManyThrough(Role::class,'usr_recurso_rule', 'recurso_id', 'role_id');
    }
}
