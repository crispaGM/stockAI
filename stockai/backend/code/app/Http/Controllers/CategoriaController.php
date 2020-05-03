<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\VariacaoProduto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Exception;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->query->get('limit', 15);
        return $this->success(Categoria::paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                     => 'required',
        ]);

        if ($validator->fails()) return $this->error($validator->errors(), 422);


        try {
            $categoria = DB::transaction(function () use ($request) {
                $categoria = Categoria::create($request->all());
                return $categoria;
            });

            return $this->success($categoria);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Categoria $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $dominio, $id)
    {
        $categoria = Categoria::where('id', $id)->firstOrFail();

        return $this->success($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Categoria $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $dominio, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) return $this->error($validator->errors(), 422);

        try {
            $categoria = DB::transaction(function () use ($request, $id) {
                $categoria = Categoria::where('id', $id)->firstOrFail();
                $categoria->fill($request->all());
                $categoria->save();

                return $categoria;
            });

            return $this->success($categoria);

        } catch (ModelNotFoundException $e) {
            return $this->error('Categoria não encontrada', 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Categoria $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $dominio, $id)
    {
        try {
            $categoria = Categoria::where('id', $id)->firstOrFail();

            $categoria = DB::transaction(function () use ($categoria, $id) {
                $categoria->delete();
                return $categoria;
            });

            return $this->success($categoria, 'Registro Excluido');

        } catch (ModelNotFoundException $e) {
            return $this->error('Categoria não encontrada', 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
