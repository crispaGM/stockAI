<?php

namespace App\Http\Controllers;

use App\Enums\Repositorio;
use App\Libraries\ImageUtils;
use App\Models\FotoProduto;
use App\Models\Produto;
use App\Models\VariacaoProduto;
use http\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    private function rulesValidator($data, $rulesExtra = [])
    {
        $rules = array_merge([
            'categoria_id'               => 'required|exists:categorias,id',
            'unidade_negocio_id'         => 'required',
            'nome'                        => 'required',
            'qtd_estoque'                => 'required',
            'data_validade'                        => 'required|date',
            'valor_custo'                 => 'required',
            'valor_venda'                       => 'required',
//            'fotos_produto.*.fop_link_imagem' => 'required_without:fotos_produto.*.imagem',
//            'fotos_produto.*.imagem'          => 'required_without:fotos_produto.*.fop_link_imagem',
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
        $limit = $request->query->get('limit', 15);
        return $this->success(Produto::with('categoria:id,name')->paginate($limit, ['id', 'categoria_id', 'nome', 'valor_custo', 'valor_venda', 'qtd_estoque']));
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

        $produto = DB::transaction(function () use ($request) {
            $produto = Produto::create($request->all());

            /** Fotos do Produto*/
            /*foreach ($request->fotos_produto as $foto) {

                if (!empty($foto['imagem'])) {
                    $imagem = $foto['imagem'];
                    unset($foto['imagem']);

                    $foto['fop_link_imagem'] = $produto->produto_id; // setar um valor para poder cadastrar
                    $fotoProduto             = $produto->fotosProduto()->create($foto);


                    $fileName      = Repositorio::IMAGEM_PRODUTO . $fotoProduto->foto_produto_id;
                    $repositoryDir = Repositorio::IMAGEM_PRODUTO . DIRECTORY_SEPARATOR . $request->unidade_negocio_id;

                    $fotoProduto->fop_link_imagem = ImageUtils::saveImage($imagem, $repositoryDir, $fileName, $fotoProduto->fop_link_imagem);
                    $fotoProduto->save();
                }
            }*/

            return $produto;
        });
        try {

            return $this->success($produto);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500, $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $produto = Produto::where('produto_id', $id)->where('unidade_negocio_id', $request->unidade_negocio_id)->firstOrFail();
            $produto->categoria;
            $produto->fotosProduto;
            return $this->success($produto);
        } catch (ModelNotFoundException $e) {
            return $this->error('Produto não encontrado', 404);

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = $this->rulesValidator($request->all());

        if ($validator->fails()) return $this->error($validator->errors(), 422);
        try {

            $produto = Produto::where('unidade_negocio_id', $request->unidade_negocio_id)->where('produto_id', $id)->firstOrFail();

            DB::transaction(function () use ($request, $produto) {
                $produto->update($request->all());

                /** Fotos do Produto*/
                foreach ($request->fotos_produto as $foto) {

                    if (isset($foto['foto_produto_id']) && $foto['foto_produto_id'] && (isset($foto['excluido']) && $foto['excluido'])) {
                        $fotoProduto = FotoProduto::find($foto['foto_produto_id']);
                        ImageUtils::deleteImage($fotoProduto->fop_link_image);
                        $fotoProduto->delete();
                    } else if (!empty($foto['imagem'])) {
                        $imagem = $foto['imagem'];
                        unset($foto['imagem']);

                        if (isset($foto['foto_produto_id']) && $foto['foto_produto_id'] && !isset($foto['excluido'])) {
                            $fotoProduto = FotoProduto::find($foto['foto_produto_id']);
                        } else {
                            $foto['fop_link_imagem'] = $produto->produto_id; // setar um valor para poder cadastrar
                            $fotoProduto             = $produto->fotosProduto()->create($foto);
                        }

                        $fileName                     = Repositorio::IMAGEM_PRODUTO . $fotoProduto->foto_produto_id;
                        $repositoryDir                = Repositorio::IMAGEM_PRODUTO . DIRECTORY_SEPARATOR . $request->unidade_negocio_id;
                        $fotoProduto->fop_link_imagem = ImageUtils::saveImage($imagem, $repositoryDir, $fileName, $fotoProduto->fop_link_imagem);
                        $fotoProduto->save();
                    }
                }
            });

            return $this->success($produto);

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        try{
            $produto = Produto::where('produto_id', $id)->where('unidade_negocio_id', $request->unidade_negocio_id)->firstOrFail();

            DB::transaction(function () use( $produto){
                foreach ($produto->fotosProduto as $foto){
                    ImageUtils::deleteImage($foto->fop_link_imagem);
                    $foto->delete();
                }

                $produto->delete();
            });

            return $this->success($produto, 'Registro Excluido');
        }catch (ModelNotFoundException $e) {
            return $this->error('Produto não encontrado', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
