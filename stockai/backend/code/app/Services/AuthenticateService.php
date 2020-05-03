<?php


namespace App\Services;


use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthenticateService
{

    public function getLoggedUser(int $expiresIn = null)
    {
        $token = (string) auth::getToken();

        $user = Usuario::where('users.id', '=', auth::user()->id)->first();

        if (is_null($user)) {
            throw new \Exception(Lang::get('auth.forbiden'), 403);
        }
//        $user->unidades  = $user->unidades();
//        $user->modulos = $user->modulos();

        $expiresIn = !is_null($expiresIn) ? $expiresIn : auth::factory()->getTTL();

        return [
            'token'      => $token,
            'token_type' => 'Bearer',
            'user'       => $user,
            'expires_in' => $expiresIn
        ];
    }


}
