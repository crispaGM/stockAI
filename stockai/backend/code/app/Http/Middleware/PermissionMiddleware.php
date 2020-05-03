<?php

namespace App\Http\Middleware;

use App\Models\Permissions\Role;
use App\Models\Unidade;
use App\Models\Usuario;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!auth()->user()) {
            return response(Lang::get('auth.unauthorized'), 401);
        }
        return $next($request);


       /* $actions     = $request->route()->getAction();
        $permissions = isset($actions['permissions']) ? $actions['permissions'] : null;

        $unidade_negocio_id = null;

        if($request->route('dominio')){
            $unidadeNegocio = Unidade::where('une_dominio', $request->route('dominio'))->first();
            $unidade_negocio_id = $unidadeNegocio ? $unidadeNegocio->unidade_negocio_id : null;

            $request->merge(['unidade_negocio_id' => $unidade_negocio_id]);

            $request->route()->forgetParameter('dominio');
        }

        if (auth()->user()->hasPermissionTo($permissions, $unidade_negocio_id) || !$permissions) {
            return $next($request);
        }

        return response(Lang::get('auth.unauthorized'), 401);*/

    }
}
