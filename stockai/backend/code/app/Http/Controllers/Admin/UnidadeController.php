<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Repositorio;
use App\Http\Controllers\Controller;
use App\Models\GrupoContaGerencial;
use App\Models\Permissions\Role;
use App\Models\Permissions\RoleUsuarioUnidade;
use App\Models\Pessoa;
use App\Models\Unidade;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Exception;

class UnidadeController extends Controller
{

    private function rulesValidator($data)
    {
        $rules = array_merge([
            'pes_nome'     => 'required',
            'pes_apelido'  => 'required',
            'pes_cpf_cnpj' => 'required|unique:ger_pessoa,pes_cpf_cnpj',
            'pes_celular'  => 'required|max:20',
            'pes_email'    => 'required|email|unique:ger_pessoa,pes_email',

            'endereco.municipio_id' => 'required'
        ]);

        $messages         = [];
        $customAttributes = [];
        $validator        = Validator::make($data, $rules, $messages, $customAttributes);

        return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->query->get('limit', 15);
        return $this->success(Unidade::paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->rulesValidator($request->all());

        if ($validator->fails()) return $this->error($validator->errors(), 422);


        try {
            $unidade = DB::transaction(function () use ($request) {
                $usuario = Usuario::create([
                    'usr_login'             => $request->pes_email,
                    'usr_senha'             => bcrypt($request->pes_celular),
                    'usr_cpf'               => $request->pes_cpf_cnpj,
                    'usr_exige_troca_senha' => 'S',
                ]);

                $pessoa = Pessoa::create(array_merge($request->all(), ['usuario_id' => $usuario->usuario_id]));
                $pessoa->endereco()->create($request->endereco);
                $pessoa->unidade()->create($request->unidade);

                foreach ($request->grupo_conta_gerencial as $item) {
                    $grupoContaGerencial = GrupoContaGerencial::create(array_merge($item, ['unidade_negocio_id' => $pessoa->pessoa_id]));
                    foreach ($item['contas'] as $conta) {
                        $contaGerencial = $grupoContaGerencial->contaGerencial()->create(array_merge($conta, ['unidade_negocio_id' => $pessoa->pessoa_id]));
                        $contaGerencial->saldoContaGerencial()->create(['scg_valor_entrada' => 0, 'scg_valor_saida' => 0]);
                    }
                }


                // Permissão para o usuario na unidade de negocio
                RoleUsuarioUnidade::create([
                    'role_id'            => Repositorio::ROLE_UNIDADE,
                    'usuario_id'         => $usuario->usuario_id,
                    'unidade_negocio_id' => $pessoa->pessoa_id
                ]);

                return $pessoa;
            });

            return $this->success($unidade);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Unidade $unidade
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Unidade $unidade, $id)
    {
        return $this->success(Unidade::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unidade $unidade
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Unidade $unidade, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Unidade $unidade
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Unidade $unidade, $id)
    {
        try {


            return $this->success($unidade, 'Registro Excluido');

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
