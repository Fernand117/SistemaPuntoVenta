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

/**Rutas CRUD para las categorias */
Route::get('categorias', 'CategoriasController@ListarCategorias');
Route::post('categorias/nueva', 'CategoriasController@RegistrarCategoria');
Route::post('categorias/editar/{id}', 'CategoriasController@ActualizarCategoria');
Route::post('categorias/eliminar/{id}', 'CategoriasController@EliminarCategoria');


/**Rutas CRUD para subcategorias */
Route::get('subcategorias', 'SubcategoriasController@ListarSubcategorias');
Route::post('subcategorias/nueva', 'SubcategoriasController@RegistrarSubcategoria');
Route::post('subcategorias/editar/{id}', 'SubcategoriasController@ActualizarSubcategorias');
Route::delete('subcategorias/eliminar/{id}', 'SubcategoriasController@EliminarSubcategoria');

/**Rutas CRUD para marcas */
Route::get('marcas', 'MarcasController@ListarMarcas');
Route::post('marcas/nueva', 'MarcasController@RegistrarMarca');
Route::post('marcas/editar/{id}', 'MarcasController@ActualizarMarca');
Route::delete('marcas/eliminar/{id}', 'MarcasController@EliminarMarca');

/**Rutas CRUD para provedores */
Route::get('provedores', 'ProvedoresController@ListarProvedores');
Route::post('provedores/nuevo', 'ProvedoresController@RegistrarProvedor');
Route::post('provedores/editar/{id}', 'ProvedoresController@ActualizarProvedor');
Route::delete('provedores/eliminar/{id}', 'ProvedoresController@EliminarProvedor');

/**Rutas CRUD para Precios */
Route::get('precios', 'PreciosController@ListarPrecios');
Route::post('precios/nuevo', 'PreciosController@RegistrarPrecio');
Route::post('precios/editar/{id}', 'PreciosController@ActualizarPrecio');
Route::delete('precios/eliminar/{id}', 'PreciosController@EliminarPrecio');

/**Rutas CRUD para Estados de ordenes */
Route::get('estados', 'EstadoOrdenController@ListarEstados');
Route::post('estados/nuevo', 'EstadoOrdenController@RegistrarEstadoOrden');
Route::post('estados/editar/{id}', 'EstadoOrdenController@ActualizarEstadoOrden');
Route::delete('estados/eliminar/{id}', 'EstadoOrdenController@EliminarEstadoOrden');