<?php


namespace App\Services;


use App\Enums\TipoOperacaoEnum;
use App\Models\Lancamento;
use App\Models\SaldoContaGerencial;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LancamentoService
{
    private $saldoContaGerencial;

    function __construct(SaldoContaGerencial $saldoContaGerencial)
    {
        $this->saldoContaGerencial = $saldoContaGerencial;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Exception|ValidationException
     */
    public function create(array $data)
    {
        $validator = Validator::make($data, [
            'conta_gerencial_id'        => 'required|exists:fin_conta_gerencial,conta_gerencial_id',
            'categoria_lancamento_id'   => 'required|exists:fin_categoria_lancamento,categoria_lancamento_id',
            'conta_gerencial_pasivo_id' => 'nullable|exists:fin_categoria_lancamento,categoria_lancamento_id',
            'tipo_operacao_id'          => 'required|exists:fin_tipo_operacao,tipo_operacao_id',
            'unidade_negocio_id'        => 'required',
            'lan_valor'                 => 'required',
            'lan_data'                  => 'required|date_format:Y-m-d',
            'lan_descricao'             => 'required|max:40',
            'lan_efetivado'             => 'required|string|in:S,N',
        ]);

        if ($validator->fails()) throw new ValidationException($validator);

        try {
            $lancamento = DB::transaction(function () use ($data) {
                $lancamento = Lancamento::create($data);

                if ($lancamento->lan_efetivado === 'S') {

                    $this->registrarSaldoLancamento($lancamento);
                }
                return $lancamento;
            });
            return $lancamento;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $data
     * @param $id
     * @return string
     * @throws \Exception|ValidationException
     */
    public function update($data, $id)
    {
        $validator = Validator::make($data, [
            'conta_gerencial_id'      => 'required|exists:fin_conta_gerencial,conta_gerencial_id',
            'categoria_lancamento_id' => 'required|exists:fin_categoria_lancamento,categoria_lancamento_id',
            'tipo_operacao_id'        => 'required|exists:fin_tipo_operacao,tipo_operacao_id',
            'unidade_negocio_id'      => 'required',
            'lan_valor'               => 'required',
            'lan_data'                => 'required',
            'lan_descricao'           => 'required|max:40',
            'lan_efetivado'           => 'required|string|in:S,N',
        ]);

        if ($validator->fails()) throw new ValidationException($validator);

        try {
            $lancamento = Lancamento::where('lancamento_id', $id)->where('unidade_negocio_id', $data['unidade_negocio_id'])->firstOrFail();

            $lancamento = DB::transaction(function () use ($data, $lancamento) {
                /** Verificar se houve alteração nos caompos que influenciam no saldo.*/

                /**Se ainda não exitir saldo apenas criar */
                if ($lancamento->lan_efetivado === 'N' && $data['lan_efetivado'] === 'S') {
                    $lancamento->update($data);
                    $this->registrarSaldoLancamento($lancamento);
                } /** Se já estiver efetivada e remover a efetivação, deve desfazer o registro do saldo*/
                elseif ($lancamento->lan_efetivado === 'S' && $data['lan_efetivado'] === 'N') {
                    $this->reverterSaldoLancamento($lancamento);
                    $lancamento->update($data);
                } /** Se já estiver efetivada e alterar campos que influenciam no saldo, deve desfazer o registro do saldo e inserir os novos dados */
                elseif ($lancamento->lan_efetivado === 'S' && $data['lan_efetivado'] === 'S') {
                    if ($lancamento->conta_gerencial_id != $data['conta_gerencial_id'] OR
                        $lancamento->lan_data != $data['lan_data'] OR
                        $lancamento->lan_valor != $data['lan_valor']
                    ) {
                        $this->reverterSaldoLancamento($lancamento);
                        $lancamento->update($data);
                        $this->registrarSaldoLancamento($lancamento);
                    }
                } else {
                    $lancamento->update($data);
                }

                return $lancamento;
            });

            return $lancamento;

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Lancamento $lancamento
     * @return string
     */
    public function delete($unidade_negocio_id, $id)
    {
        $lancamento = Lancamento::where('lancamento_id', $id)->where('unidade_negocio_id', $unidade_negocio_id)->firstOrFail();

        DB::transaction(function () use ($lancamento) {
            $this->reverterSaldoLancamento($lancamento);
            $lancamento->delete();
        });

        return $lancamento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Lancamento $lancamento
     * @return string
     */
    public function efetivarLancamento($unidade_negocio_id, $id)
    {
        $lancamento = Lancamento::where('socio_id', $id)->where('unidade_negocio_id', $unidade_negocio_id)->firstOrFail();

        DB::transaction(function () use ($lancamento) {
            $lancamento->lan_efetivado = 'S';
            $lancamento->save();
            $this->registrarSaldoLancamento($lancamento);
        });

        return $lancamento;
    }

    private function registrarSaldoLancamento($lancamento)
    {
        DB::transaction(function () use ($lancamento) {
            if ($lancamento->tipo_operacao_id === TipoOperacaoEnum::RECEITA || $lancamento->tipo_operacao_id === TipoOperacaoEnum::TRANSFERENCIA_ENTRADA || $lancamento->tipo_operacao_id === TipoOperacaoEnum::SOCIO) {
                $valor_entrada = $lancamento->lan_valor;
                $valor_saida   = 0;
            } elseif ($lancamento->tipo_operacao_id === TipoOperacaoEnum::DESPESA || $lancamento->tipo_operacao_id === TipoOperacaoEnum::TRANSFERENCIA_SAIDA) {
                $valor_entrada = 0;
                $valor_saida   = $lancamento->lan_valor;
            }

            $saldo = [
                'conta_gerencial_id' => $lancamento->conta_gerencial_id,
                'scg_data'           => $lancamento->lan_data,
                'scg_regime_caixa'   => 'S',
                'scg_valor_entrada'  => $valor_entrada,
                'scg_valor_saida'    => $valor_saida,
            ];

            $this->saldoContaGerencial->atualizaSaldoContaGerencial($saldo);
        });

    }

    private function reverterSaldoLancamento($lancamento)
    {
        $valor_entrada = 0;
        $valor_saida   = 0;

        if ($lancamento->tipo_operacao_id === TipoOperacaoEnum::RECEITA || $lancamento->tipo_operacao_id === TipoOperacaoEnum::TRANSFERENCIA_ENTRADA || $lancamento->tipo_operacao_id === TipoOperacaoEnum::SOCIO) {
            $valor_entrada = $lancamento->lan_valor * -1;
            $valor_saida   = 0;
        } elseif ($lancamento->tipo_operacao_id === TipoOperacaoEnum::DESPESA || $lancamento->tipo_operacao_id === TipoOperacaoEnum::TRANSFERENCIA_SAIDA) {
            $valor_entrada = 0;
            $valor_saida   = $lancamento->lan_valor * -1;
        }

        $saldo = [
            'conta_gerencial_id' => $lancamento->conta_gerencial_id,
            'scg_data'           => $lancamento->lan_data,
            'scg_regime_caixa'   => 'S',
            'scg_valor_entrada'  => $valor_entrada,
            'scg_valor_saida'    => $valor_saida,
        ];

        $this->saldoContaGerencial->atualizaSaldoContaGerencial($saldo);
    }
}