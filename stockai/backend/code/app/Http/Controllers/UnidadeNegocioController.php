<?php

namespace App\Http\Controllers;

use App\Enums\Repositorio;
use App\Http\Controllers\Controller;
use App\Models\GrupoContaGerencial;
use App\Models\Permissions\Role;
use App\Models\Permissions\RoleUsuarioUnidade;
use App\Models\Pessoa;
use App\Models\Unidade;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Exception;

class UnidadeNegocioController extends Controller
{

    private function rulesValidator($data)
    {
        $id = isset($data['pessoa_id']) ? $data['pessoa_id'] : null;

        $rules = array_merge([
            'pessoa_id'    => 'required',
            'pes_nome'     => 'required',
            'pes_apelido'  => 'required',
            'pes_cpf_cnpj' => 'required|unique:ger_pessoa,pes_cpf_cnpj' . (!$id ? '' : ",$id,pessoa_id"),
            'pes_celular'  => 'required|max:20',
            'pes_email'    => 'required|string|unique:ger_pessoa,pes_email' . (!$id ? '' : ",$id,pessoa_id"),

            'endereco.municipio_id' => 'required',

            'unidade.une_cor_primaria'   => 'required',
            'unidade.une_cor_secundaria' => 'required',
            'unidade.une_cor_tercearia'  => 'required',
        ]);

        $messages         = [];
        $customAttributes = [];
        $validator        = Validator::make($data, $rules, $messages, $customAttributes);

        return $validator;
    }


    /**
     * update resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $data      = array_merge($request->all(), ['pessoa_id' => $request->unidade_negocio_id]);
        $validator = $this->rulesValidator($data);

        if ($validator->fails()) return $this->error($validator->errors(), 422);

        try {

            $unidade = DB::transaction(function () use ($request) {

                $pessoa = Pessoa::where('pessoa_id', $request->unidade_negocio_id)->firstOrFail();
                $pessoa->update($request->all());
                $pessoa->endereco()->update($request->endereco);

                $dadoUnidade = $request->only([
                    'unidade.une_cor_primaria',
                    'unidade.une_cor_secundaria',
                    'unidade.une_cor_tercearia',
                    'unidade.une_slogan',
                ]);

                $pessoa->unidade()->update($dadoUnidade['unidade']);

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
    public function show(Request $request)
    {
        try {
            $unidade_negocio = Pessoa::join('ger_unidade', 'ger_unidade.unidade_negocio_id', 'ger_pessoa.pessoa_id')
                ->where('unidade_negocio_id', $request->unidade_negocio_id)->with('unidade', 'endereco')->firstOrFail(['ger_pessoa.*']);

            return $this->success($unidade_negocio);
        } catch (ModelNotFoundException $e) {
            return $this->error('Unidade não encontrada', 404);

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
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
