# Inventario

## ¿Qué hace el proyecto?

Es una aplicación web para registrar y consultar productos de un inventario. Permite:

- Registrar el nombre de un producto y su cantidad.
- Guardar los productos en una base de datos.
- Consultar una tabla con el ID, nombre, cantidad, estado y fecha de registro.
- Mostrar el estado «Disponible» cuando la cantidad es mayor que cero y «Sin existencia» cuando es cero o menor.
- Mostrar el total de productos registrados y mensajes de confirmación o de campos inválidos.

La versión actual permite registrar y consultar productos; no incluye funciones para editarlos o eliminarlos.

## ¿Qué tecnologías usa?

- **PHP:** procesa el formulario y consulta o guarda los productos mediante PDO.
- **HTML:** define la estructura de la página y el formulario.
- **CSS:** proporciona los estilos de la interfaz.
- **MySQL/MariaDB:** almacena la información. El archivo SQL incluido fue exportado desde MariaDB.
- **Laragon:** es el entorno de desarrollo local utilizado para ejecutar PHP, el servidor web y el servidor de base de datos.
- **HeidiSQL:** es la herramienta utilizada para administrar la base de datos e importar el archivo SQL. No es el servidor de base de datos.

## ¿Qué se necesita instalar?

Para ejecutarlo localmente se necesita:

1. **Laragon**, con un servidor web, PHP y MySQL o MariaDB disponibles.
2. La extensión **PDO MySQL** habilitada en PHP, necesaria para la conexión.
3. Un **navegador web** para abrir la aplicación.
4. **HeidiSQL**, si se desea administrar e importar la base de datos con esta herramienta. Si ya está disponible en el entorno, no es necesario instalarlo nuevamente.

El proyecto no requiere instalar paquetes con Composer ni npm.

También necesita la base de datos `inventario` y su tabla `productos`. Se incluye el archivo `base_datos.sql` para prepararla. **Si ya importaste esta base de datos y la tabla existe, puedes omitir la importación.** Los productos de ejemplo no son obligatorios para que funcione la aplicación.

## ¿Cómo se instala y configura el proyecto?

### 1. Colocar el proyecto en Laragon

Copia la carpeta `inventario` en la carpeta de proyectos de Laragon. Si utilizas la ubicación habitual, la ruta será:

```text
C:\laragon\www\inventario
```

Si Laragon está instalado en otra ubicación o utiliza otra raíz de documentos, coloca el proyecto en su carpeta correspondiente.

### 2. Iniciar los servicios

Abre Laragon e inicia el servidor web y el servidor MySQL o MariaDB. Ambos deben estar activos para utilizar la aplicación.

### 3. Preparar la base de datos en HeidiSQL

Si ya importaste la base de datos, comprueba que exista `inventario` y que contenga la tabla `productos`; después continúa con el paso 4.

Para una instalación nueva:

1. Abre HeidiSQL y conéctate al servidor MySQL/MariaDB de Laragon usando el usuario, contraseña y puerto de tu instalación.
2. Crea una base de datos llamada `inventario`. Puedes ejecutar esta instrucción en una pestaña de consulta:

   ```sql
   CREATE DATABASE IF NOT EXISTS inventario
   CHARACTER SET utf8mb4
   COLLATE utf8mb4_unicode_ci;
   ```

3. Selecciona la base de datos `inventario` como base activa.
4. Abre el archivo `base_datos.sql` del proyecto en HeidiSQL y ejecuta su contenido sobre esa base de datos.
5. Comprueba que se haya creado la tabla `productos`. El archivo incluye tres productos de ejemplo: Refresco, galletas y cereal.

**Atención:** el archivo SQL contiene `DROP TABLE IF EXISTS productos`; volver a importarlo elimina la tabla existente y la reemplaza con los datos del archivo. Además, no contiene la instrucción para crear o seleccionar la base de datos, por eso se prepara y selecciona antes de importarlo.

### 4. Configurar la conexión

Abre `config/conexion.php`. El proyecto incluye estos valores:

```php
$servidor = 'localhost';
$baseDatos = 'inventario';
$usuario = 'root';
$contrasena = '';
```

Ajusta el servidor, el usuario y la contraseña para que coincidan con tu instalación de MySQL/MariaDB. La contraseña vacía solo funciona si tu usuario está configurado así.

Si el servidor usa un puerto distinto al predeterminado, añade el puerto a la cadena de conexión PDO. Por ejemplo, para el puerto 3307:

```php
"mysql:host=$servidor;port=3307;dbname=$baseDatos;charset=utf8mb4"
```

### 5. Abrir la aplicación

Con el proyecto dentro de la carpeta `www` y los servicios activos, abre:

```text
http://localhost/inventario/
```

Si configuraste otro puerto para el servidor web, inclúyelo en la dirección.

La aplicación debe abrirse mediante el servidor de Laragon; abrir `index.php` directamente desde el explorador de archivos no ejecuta PHP.

### 6. Comprobar el funcionamiento

1. Escribe el nombre de un producto y una cantidad entera, por ejemplo `Lápiz` y `10`.
2. Presiona **Registrar producto**.
3. Comprueba que aparezca el mensaje de registro correcto y que el producto se muestre en la tabla.
4. Opcionalmente, consulta la tabla `productos` en HeidiSQL para verificar que el registro se guardó.

## Archivos principales

| Archivo | Función |
| --- | --- |
| `index.php` | Muestra el formulario y consulta los productos registrados. |
| `guardar.php` | Valida los datos recibidos y guarda el producto. |
| `config/conexion.php` | Configura la conexión a la base de datos mediante PDO. |
| `css/estilos.css` | Define la apariencia de la aplicación. |
| `base_datos.sql` | Contiene la estructura de la tabla y los datos de ejemplo. |

## Problemas comunes

- **No se conecta a la base de datos:** comprueba que MySQL/MariaDB esté activo y revisa los datos de `config/conexion.php`.
- **La base de datos o la tabla no existen:** crea `inventario` e importa el SQL sobre esa base de datos.
- **Aparece `could not find driver`:** habilita la extensión PDO MySQL en la configuración de PHP que utiliza Laragon y reinicia el servicio web.
- **La página no abre:** revisa que el servidor web esté activo, que la carpeta esté dentro de la raíz de documentos de Laragon y que la dirección y el puerto sean correctos.
