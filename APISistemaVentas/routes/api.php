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

/**Rutas CRUD para las categorias */
Route::get('categorias', 'CategoriasController@ListarCategorias');
Route::post('categorias/nueva', 'CategoriasController@RegistrarCategoria');
Route::post('categorias/editar/{id}', 'CategoriasController@ActualizarCategoria');
Route::delete('categorias/eliminar/{id}', 'CategoriasController@EliminarCategoria');


/**Rutas CRUD para subcategorias */
Route::get('subcategorias', 'SubcategoriasController@Subcategorias');
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
Route::get('productos/filtro/{id}', 'ProductosController@ListarProductos');
Route::post('productos/nuevo', 'ProductosController@RegistrarProducto');
Route::post('producto/editar/{id}', 'ProductosController@ActualizarProducto');
Route::delete('productos/eliminar/{id}', 'ProductosController@EliminarProducto');
Route::get('productos/total', 'ProductosController@TotalProductosRegistrados');
Route::post('productos/add', 'ProductosController@ProductosDetalles');

/**Rutas CRUD para clientes */
Route::get('clientes', 'ClientesController@ListarClientes');
Route::post('clientes/nuevo','ClientesController@RegistrarCliente');
Route::post('clientes/actualizar/{id}', 'ClientesController@ActualizarCliente');
Route::delete('clientes/eliminar/{id}', 'ClientesController@EliminarCliente');
Route::get('clientes/total', 'ClientesController@TotalClientes');
Route::post('cliente/detalle', 'ClientesController@ClienteDetalle');

/**Rutas CRUD para ordenes de compra */
Route::get('ordenescompras', 'OrdenesComprasController@ListarOrdenesCompras');
Route::post('ordenescompras/nueva', 'OrdenesComprasController@RegistrarOrdenCompra');
Route::post('ordenescompras/editar/{id}', 'OrdenesComprasController@ActualizarOrdenCompra');
Route::delete('ordenescompras/eliminar/{id}', 'OrdenesComprasController@EliminarOrdenCompra');
Route::get('ordenescompras/total', 'OrdenesComprasController@TotalOrdenesCompras');

/**Rutas CRUD para usuarios */
Route::post('registrar', 'Auth\RegisterController@create');
Route::post('login','Auth\LoginController@login');
Route::post('leerToken', 'Auth\LoginController@LeerToken');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('usuarios', 'Auth\LoginController@ListaUsuarios');

/**Rutas CRUD para las salidas */
Route::get('salidas', 'AlmacenSalidaController@ListarSalidas');
Route::post('salida/nueva', 'AlmacenSalidaController@RegistrarSalida');
Route::post('salida/editar/{id}', 'AlmacenSalidaController@ActualizarSalida');

/**Rutas CRUD para almacen general */
Route::get('almacen', 'AlmacenGeneralController@ListarAlmacen');
Route::get('almacen/fecha', 'AlmacenGeneralController@ListarAlmacenFecha');
Route::post('almacen/detalles/compras', 'AlmacenGeneralController@ListarDetallesCompras');
Route::post('almacen/nuevo', 'AlmacenGeneralController@Store');

/**Rutas CRUD para las remisiones */
Route::get('remisiones', 'RemisionesController@ListarRemisiones');
Route::post('remisiones/nueva', 'RemisionesController@RegistrarRemision');
Route::post('remisiones/editar', 'RemisionesController@ActualizarRemision');
Route::delete('remisiones/eliminar/{id}', 'RemisionesController@EliminarRemision');
Route::post('remisiones/actualizar', 'RemisionesController@ActualizarRemision');
Route::get('remisionesp', 'RemisionesController@RemisionPrueba');

/**Rutas CRUD para los detalles de la remision */
Route::post('detallesremision', 'DetallesRemisionController@ListarRemision');
Route::post('detallesremision/nuevo', 'DetallesRemisionController@RegistrarDetalleRemision');
Route::delete('detallesremision/eliminar/{id}', 'DetallesRemisionController@EliminarDetalleRemision');


Route::get('stock', 'StockController@Stock');

Route::post('productos/prueba', 'DetallesRemisionController@PruebaProd');