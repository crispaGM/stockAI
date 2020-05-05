<?php

namespace App\Http\Controllers\Auth;

use App\Models\Permissions\Role;
use App\Models\Permissions\Token;
use App\Models\Unidade;
use App\Models\Usuario;
use App\Services\AuthenticateService;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * @var AuthenticateService
     */
    private $authenticateService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthenticateService $authenticateService)
    {

        $this->authenticateService = $authenticateService;

//        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {

            $credentials = [
                'email' => $request->login,
                'password'  => $request->password,
            ];

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $payload = Auth::getPayload($token);

            $keepLogged = isset($credentials['remember_me']) && $credentials['remember_me'];

            $expiresIn = $keepLogged ? $payload->get('exp') : (60 * 60 * 12); // 12 hours

            if (!auth::user()) {
                return $this->error(Lang::get('auth.unauthorized'), 401);
            }

            /*Token::create([
                'usuario_id'         => Auth::user()->usuario_id,
                'tok_token'          => (string)$token,
                'tok_numero_ip'      => $request->ip(),
                'tok_dispositivo'    => $request->header('User-Agent'),
                'tok_manter_logado'  => $keepLogged ? 'S' : 'N',
                'tok_data_expiracao' => date('Y-m-d H:i:s', $expiresIn),
            ]);*/


            $usuarioAutenticado = $this->authenticateService->getLoggedUser(!$keepLogged ? 0 : null);
            return $this->success($usuarioAutenticado);
        } catch (JWTException $e) {
            return $this->error('Email ou senha incorretos', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function signup(Request $request)
    {

        $user = DB::transaction(function () use ($request) {

            /*$rule = Role::create(['rol_name' => 'Atletica']);

            $rule->recursos()->create(['rec_nome' => 'cadastro_socio']);*/

            $user = Usuario::create([
                'name'             => $request->name,
                'email'             => $request->email,
                'password'             => bcrypt($request->password),
            ]);

            Unidade::create([
               'dominio'  => $request->dominio,
               'nome'  => $request->nome_estabelecimento,
            ]);

//            $role = Role::first();
//            $user = Usuario::first();


//            $user->roles()->sync($role);

            return $user;
        });


        // Get the token
        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $token     = Auth::getToken();
            $tok_token = (string)$token;
            $token_db  = Token::where('tok_token', $tok_token)->first();

            if ($token_db) {
                $token_db->tok_data_hora_saida = new DateTime();
                $token_db->save();
            }

            auth()->logout();

            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->success([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
