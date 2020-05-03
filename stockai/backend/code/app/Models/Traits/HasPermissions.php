<?php


namespace App\Models\Traits;


use App\Exceptions\RecursoDoesNotExist;
use App\Models\Permissions\Recurso;
use App\Models\Permissions\Role;

trait HasPermissions
{

    /**
     *  Roles do usuário
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'usr_role_usuario', 'usuario_id', 'role_id');
    }

    /**
     * Recusros que o usuario possui
     *
     * @return mixed
     */
    public function recursos()
    {
        return $this->belongsToMany(Recurso::class, 'usr_recurso_usuario', 'usuario_id', 'recurso_id');
    }

    /**
     * @param $unidade_negocio_id
     * @return mixed
     */
    public function rolesUnidadeNegocio($unidade_negocio_id)
    {
        return $this->belongsToMany(Role::class, 'usr_role_usuario_unidade', 'usuario_id', 'role_id')
            ->where('unidade_negocio_id', $unidade_negocio_id);
    }


    /**
     *  Verificar se o usuário tem permissão para o determinado recurso
     *
     * @param $permissions
     * @param null $unidade_negocio_id
     * @return bool
     */
    public function hasPermissionTo($permissions, $unidade_negocio_id = null): bool
    {
        if(!$permissions) return false;

        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if ($this->hasDirectPermission($permission, $unidade_negocio_id) || $this->hasPermissionViaRole($permission, $unidade_negocio_id)) {
                    return true;
                }
            }
        } else {
            if ($this->hasDirectPermission($permissions, $unidade_negocio_id) || $this->hasPermissionViaRole($permissions, $unidade_negocio_id)) {
                return true;
            }
        }

        return false;
    }


    /**
     *  Verificar se o usuário tem permissão para o determinado recurso por meio do grupo
     *
     * @param $permission
     * @param null $unidade_negocio_id
     * @return bool
     */
    public function hasPermissionViaRole($permission, $unidade_negocio_id = null): bool
    {

        if(!$permission) return false;

        if (is_string($permission)) {
            $permission = Recurso::where('rec_nome', $permission)->first();
        }
        if (is_int($permission)) {
            $permission = Recurso::find($permission);
        }


        if (!$permission instanceof Recurso) {
            throw new RecursoDoesNotExist;
        }

        if ($unidade_negocio_id) {
            $roles = $this->rolesUnidadeNegocio($unidade_negocio_id)->get();
        } else {
            $roles = $this->roles()->get();
        }

        if (!$roles->count()) return false;


        foreach ($roles as $role) {
            if ($role->recursos->contains('recurso_id', $permission->recurso_id)) return true;
        }

        return false;
    }

    /**
     * Verificar se o usuário tem permissão para o determinado recurso
     *
     * @param string|int|Recurso $permission
     *
     * @return bool
     */
    public function hasDirectPermission($permission, $unidade_negocio_id): bool
    {
        if (is_string($permission)) {
            $permission = Recurso::where('rec_nome', $permission)->first();
        }
        if (is_int($permission)) {
            $permission = Recurso::find($permission);
        }

        if (!$permission instanceof Recurso) {
            throw new RecursoDoesNotExist;
        }


        return $this->recursos->contains('recurso_id', $permission->recurso_id);
    }

}