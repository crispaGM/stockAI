<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**  ROTAS PARA ACESSO DA UNIDADE*/
Route::group(['middleware' => ['auth:api', 'hasPermission'], 'prefix' => '{dominio}'], function () {

    // Comercial
    Route::get('categoria', ['uses' => 'CategoriaController@index', 'permissions' => 'cadastro_categoria']);
    Route::get('categoria/{id}', ['uses' => 'CategoriaController@show', 'permissions' => 'cadastro_categoria']);
    Route::post('categoria', ['uses' => 'CategoriaController@store', 'permissions' => 'cadastro_categoria']);
    Route::put('categoria/{id}', ['uses' => 'CategoriaController@update', 'permissions' => 'cadastro_categoria']);
    Route::delete('categoria/{id}', ['uses' => 'CategoriaController@destroy', 'permissions' => 'cadastro_categoria']);

    Route::get('produto', ['uses' => 'ProdutoController@index', 'permissions' => 'cadastro_produto']);
    Route::get('produto/{id}', ['uses' => 'ProdutoController@show', 'permissions' => 'cadastro_produto']);
    Route::post('produto', ['uses' => 'ProdutoController@store', 'permissions' => 'cadastro_produto']);
    Route::put('produto/{id}', ['uses' => 'ProdutoController@update', 'permissions' => 'cadastro_produto']);
    Route::delete('produto/{id}', ['uses' => 'ProdutoController@destroy', 'permissions' => 'cadastro_produto']);

    Route::get('venda', ['uses' => 'VendaController@index', 'permissions' => 'cadastro_venda']);
    Route::get('venda/{id}', ['uses' => 'VendaController@show', 'permissions' => 'cadastro_venda']);
    Route::post('venda', ['uses' => 'VendaController@store', 'permissions' => 'cadastro_venda']);
    Route::put('venda/{id}', ['uses' => 'VendaController@update', 'permissions' => 'cadastro_venda']);
    Route::delete('venda/{id}', ['uses' => 'VendaController@destroy', 'permissions' => 'cadastro_venda']);

});

Route::group(['middleware' => 'api', 'prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('menu', function (){ return '';});
        Route::get('user', 'AuthController@user');
        Route::get('user', 'AuthController@user');
        Route::get('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });
});
