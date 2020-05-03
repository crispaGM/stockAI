<?php

namespace App\Http\Controllers;

use App\Enums\TipoOperacaoEnum;
use App\Models\CategoriaLancamento;
use App\Models\Lancamento;
use App\Models\SaldoContaGerencial;
use App\Services\LancamentoService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LancamentoController extends Controller
{
    private $saldoContaGerencial;
    /**
     * @var LancamentoService
     */
    private $lancamentoService;

    function __construct(SaldoContaGerencial $saldoContaGerencial, LancamentoService $lancamentoService)
    {
        $this->saldoContaGerencial = $saldoContaGerencial;
        $this->lancamentoService   = $lancamentoService;
    }

    private function rulesValidator($data, $rulesExtra = [])
    {
        $rules = array_merge([
            'tipo_operacao_id' => 'required|exists:fin_tipo_operacao,tipo_operacao_id|in:' . TipoOperacaoEnum::DESPESA . ',' . TipoOperacaoEnum::RECEITA,

        ], $rulesExtra);

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
        // TODO implementar
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $tipo_lancamento_id)
    {
        $data = array_merge($request->all(), ['tipo_operacao_id' => $tipo_lancamento_id]);

        $validator = $this->rulesValidator($data);


        if ($validator->fails()) return $this->error($validator->errors(), 422);

        try {
            CategoriaLancamento::where('categoria_lancamento_id', $data['categoria_lancamento_id'])
                ->whereIn('tipo_operacao_id', [TipoOperacaoEnum::RECEITA, TipoOperacaoEnum::DESPESA])
                ->firstOrFail();

            $lancamento = DB::transaction(function () use ($data) {

                $lancamento = $this->lancamentoService->create($data);

                return $lancamento;
            });

            return $this->success($lancamento);
        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), 404);
        } catch (ValidationException $v) {
            return $this->error($v->errors(), $v->status);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Lancamento $lancamento
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Lancamento $lancamento)
    {
        $lancamento->contaGerencialOrigem;
        $lancamento->contaGerencialDestino->ctg_nome;
        return $this->success($lancamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lancamento $lancamento
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $tipo_lancamento_id, $id)
    {
        $data = array_merge($request->all(), ['tipo_operacao_id' => $tipo_lancamento_id]);

        $validator = $this->rulesValidator($data);


        if ($validator->fails()) return $this->error($validator->errors(), 422);

        try {
            CategoriaLancamento::where('categoria_lancamento_id', $data['categoria_lancamento_id'])
                ->whereIn('tipo_operacao_id', [TipoOperacaoEnum::RECEITA, TipoOperacaoEnum::DESPESA])
                ->firstOrFail();

            $lancamento = DB::transaction(function () use ($data, $id) {

                $lancamento = $this->lancamentoService->update($data, $id);

                return $lancamento;
            });

            return $this->success($lancamento);
        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), 404);
        } catch (ValidationException $v) {
            return $this->error($v->errors(), $v->status);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Lancamento $lancamento
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Lancamento $lancamento)
    {
        try {
            DB::transaction(function () use ($lancamento) {
                $lancamento->delete();
            });

            return $this->success($lancamento, 'Registro excluido');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
