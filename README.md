# API del sistema punto de ventas (Backend)

# API VERSIÓN 1.0

En esta API está programada toda la funcionalidad de la aplicación web, está API está conectada a una base de datos en PostgreSQL, sin embargo la base de datos puede cambiarse de gestor manteniendo la orden de las tablas, estructura de datos y demás funciones y vistas que se han creado para su correcto funcionamiento.

En esta API están implementadas todas las funciones y algunas más que no fueron implementadas en el frontend de la aplicación.

Es necesario estudiar detenidamente cada controlador, pues la modificación de alguna de sus funciones puede afectar el funcionamiento de la aplicación frontend.

# NOTA
Eh de señalar que para realizar pruebas con el api y mostrar correctamente las imágenes que almacenemos en la DB, es necesario añadir despues del ['SERVER_NAME']. el puerto al que el api está corriendo en el artisan por ejemplo quedaría así nuestra línea de ejecución local:

- $items[$i]['imagen'] = 'http://'.$_SERVER['SERVER_NAME'].':8000/img/categorias/'.$items[$i]['imagen'];

En producción se quita el puerto y se deja normal la url.
También es importante señalar que para conectar el frontend de la aplicación es necesario cambiar la dirección url en los archivos services del Angular, pues están configurados con un dominio local en donde fue implementado el proyecto.(También un archivo json de configuración)

Cualquier duda ponerse en contacto con el desarrollador.
