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
Route::get('subcategorias/{id}', 'SubcategoriasController@ListarSubcategorias');
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


/**Rutas CRUD para productos */
Route::get('productos', 'ProductosController@ListProductsGeneral');
Route::get('productos/{subcategoria}/{categoria}', 'ProductosController@ListarProductos');
Route::post('productos/nuevo', 'ProductosController@RegistrarProducto');
Route::post('producto/editar/{id}', 'ProductosController@ActualizarProducto');
Route::post('productos/eliminar/{id}', 'ProductosController@EliminarProducto');

/**Rutas CRUD para clientes */
Route::get('clientes', 'ClientesController@ListarClientes');
Route::post('clientes/nuevo','ClientesController@RegistrarCliente');
Route::post('clientes/actualizar/{id}', 'ClientesController@ActualizarCliente');
Route::post('clientes/eliminar/{id}', 'ClientesController@EliminarCliente');

/**Rutas CRUD para ordenes de compra */
Route::get('ordenescompras', 'OrdenesComprasController@ListarOrdenesCompras');
Route::post('ordenescompras/nueva', 'OrdenesComprasController@RegistrarOrdenCompra');
Route::post('ordenescompras/editar/{id}', 'OrdenesComprasController@ActualizarOrdenCompra');
Route::post('ordenescompras/eliminar/{id}', 'OrdenesComprasController@EliminarOrdenCompra');

/**Rutas CRUD para usuarios */
Route::post('usuarios/login', 'UsuariosController@ValidateUser');
Route::post('usuarios/nuevo', 'UsuariosController@RegistrarUsuario');
Route::post('usuarios/editar/{id}', 'UsuariosController@ActualizarUsuario');
Route::post('usuarios/eliminar/{id}', 'UsuariosController@EliminarUsuario');

/**Rutas CRUD para las salidas */
Route::get('salidas', 'AlmacenSalidaController@ListarSalidas');
Route::post('salida/nueva', 'AlmacenSalidaController@RegistrarSalida');
Route::post('salida/editar/{id}', 'AlmacenSalidaController@ActualizarSalida');

/**Rutas CRUD para almacen general */
Route::get('almacen', 'AlmacenGeneralController@ListarAlmacen');
Route::post('almacen/nuevo', 'AlmacenGeneralController@Store');