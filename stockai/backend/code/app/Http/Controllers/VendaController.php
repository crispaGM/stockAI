<?php

namespace App\Http\Controllers;

use App\Enums\TipoOperacaoEnum;
use App\Models\CategoriaLancamento;
use App\Models\PagamentoAssociacao;
use App\Models\Pessoa;
use App\Models\Produto;
use App\Models\Socio;
use App\Models\VariacaoProduto;
use App\Models\Venda;
use App\Services\LancamentoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Exception;
use Illuminate\Validation\ValidationException;

class VendaController extends Controller
{
    /**
     * @var LancamentoService
     */
    private $lancamentoService;

    function __construct(LancamentoService $lancamentoService)
    {
        $this->lancamentoService = $lancamentoService;
    }

    private function rulesValidator($data, $rulesExtra = [])
    {
        $rules = array_merge([
            'conta_gerencial_id' => 'required|exists:fin_conta_gerencial,conta_gerencial_id',
            'variacao_id'        => 'required',
            'produto_id'         => 'required',
            'ven_data_venda'     => 'required|date_format:Y-m-d\TH:i',
            'ven_valor'          => 'required',
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
        $planosAssocicao = DB::select("SELECT 
                ven.venda_id,
                ven.ven_data_venda,
                ven.ven_valor,
                pro.pro_nome,
                var.var_nome
            FROM com_venda ven
            JOIN com_produto pro ON pro.produto_id = ven.produto_id
            JOIN com_variacao var ON var.variacao_id = ven.variacao_id
            WHERE ven.unidade_negocio_id = :unidade_negocio_id", [
            'unidade_negocio_id' => $request->unidade_negocio_id,
        ]);

        return $this->success($planosAssocicao);
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
            $venda = DB::transaction(function () use ($request) {
                $produto             = Produto::where('produto_id', $request->produto_id)->where('unidade_negocio_id', $request->unidade_negocio_id)->firstOrFail();
                $categoriaLancamento = CategoriaLancamento::where('tipo_operacao_id', TipoOperacaoEnum::RECEITA)->first();

                $lancamento = [
                    'conta_gerencial_id'      => $request->conta_gerencial_id,
                    'unidade_negocio_id'      => $request->unidade_negocio_id,
                    'categoria_lancamento_id' => $categoriaLancamento->categoria_lancamento_id,
                    'tipo_operacao_id'        => TipoOperacaoEnum::RECEITA,
                    'lan_valor'               => $request->ven_valor,
                    'lan_data'                => date('Y-m-d', strtotime($request->ven_data_venda)),
                    'lan_descricao'           => "Venda " . $produto->pro_nome,
                    'lan_efetivado'           =>  'S',
                ];

                $lancamento = $this->lancamentoService->create($lancamento);

                $venda = Venda::create(array_merge($request->all(), ['lancamento_id' => $lancamento->lancamento_id]));

                return $venda;
            });

            return $this->success($venda);
        } catch (ValidationException $v) {
            return $this->error($v->errors(), $v->status);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = $this->rulesValidator($request->all());

        if ($validator->fails()) return $this->error($validator->errors(), 422);


        try {
            $venda = VEnda::where('unidade_negocio_id', $request->unidade_negocio_id)->where('venda_id', $id)->firstOrFail();

            $pagamentoAssociacao = DB::transaction(function () use ($request, $venda) {
                $categoriaLancamento = CategoriaLancamento::where('tipo_operacao_id', TipoOperacaoEnum::RECEITA)->first();
                $produto             = Produto::where('produto_id', $request->produto_id)->where('unidade_negocio_id', $request->unidade_negocio_id)->firstOrFail();

                $lancamento = [
                    'conta_gerencial_id'      => $request->conta_gerencial_id,
                    'unidade_negocio_id'      => $request->unidade_negocio_id,
                    'categoria_lancamento_id' => $categoriaLancamento->categoria_lancamento_id,
                    'tipo_operacao_id'        => TipoOperacaoEnum::RECEITA,
                    'lan_valor'               => $request->ven_valor,
                    'lan_data'                => date('Y-m-d', strtotime($request->ven_data_venda)),
                    'lan_descricao'           => "Venda " . $produto->pro_nome,
                    'lan_efetivado'           => 'S',
                ];

                $this->lancamentoService->update($lancamento, $venda->lancamento_id);

                $venda->update(array_merge($request->all(), ['lancamento_id' => $venda->lancamento_id]));

                return $venda;
            });

            return $this->success($pagamentoAssociacao);
        } catch (ModelNotFoundException $e) {
            return $this->error('Venda não encontrada', 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {

            $venda = DB::selectOne("SELECT
                ven.venda_id,
                ven.ven_data_venda,
                ven.ven_valor,
                pro.pro_nome,
                var.var_nome,
                ven.socio_id,
                pes.pes_apelido AS socio,
                ctg.conta_gerencial_id,
                ctg.ctg_nome AS conta_gerencial
            FROM com_venda ven
            JOIN com_produto pro ON pro.produto_id = ven.produto_id
            JOIN com_variacao var ON var.variacao_id = ven.variacao_id
            JOIN fin_conta_gerencial ctg ON ctg.conta_gerencial_id = ven.conta_gerencial_id
            LEFT JOIN ger_socio soc ON soc.socio_id = ven.socio_id
            LEFT JOIN ger_pessoa pes ON pes.pessoa_id = soc.pessoa_id
            WHERE ven.deleted_at IS NULL
              AND ven.unidade_negocio_id = :unidade_negocio_id
              AND ven.venda_id = :venda_id
            ORDER BY ven.ven_data_venda, pro.pro_nome, ctg.ctg_nome", [
                'unidade_negocio_id' => $request->unidade_negocio_id,
                'venda_id'           => $id
            ]);
            if (!$venda) throw new ModelNotFoundException;


            return $this->success($venda);
        } catch (ModelNotFoundException $e) {
            return $this->error('Venda não encontrada', 404);

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        try {
            $venda = Venda::where('unidade_negocio_id', $request->unidade_negocio_id)->where('venda_id', $id)->firstOrFail();

            DB::transaction(function () use ($request, $venda) {
                $this->lancamentoService->delete($request->unidade_negocio_id, $venda->lancamento_id);
                $venda->delete();
            });
            return $this->success($venda, 'Registro Excluido');
        } catch (ModelNotFoundException $e) {
            return $this->error('Venda não encontrada', 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
