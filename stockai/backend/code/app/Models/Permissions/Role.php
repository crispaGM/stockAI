<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'usr_role';
    protected $primaryKey = 'role_id';
    public $incrementing = false;

    protected $fillable = ['rol_name', 'rol_description'];

    public function recursos()
    {
        return $this->belongsToMany(Recurso::class,'usr_recurso_role',  'role_id', 'recurso_id');
    }
}
