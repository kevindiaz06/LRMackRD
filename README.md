# Sistema de Gestión de Librería - RLMackCon

Sistema completo para la gestión de una librería, desarrollado con Laravel 12 y Tailwind CSS. Permite administrar inventario, clientes, ventas, empleados y toda la operación comercial de una librería.

## Características Principales

- **Gestión de Catálogo**: Manejo de libros, categorías y proveedores
- **Gestión de Clientes**: Registro y seguimiento de clientes
- **Control de Inventario**: Administración de stock y ubicaciones
- **Procesamiento de Ventas**: Registro de ventas con múltiples productos
- **Facturación**: Generación automática de facturas
- **Reportes y Estadísticas**: Visualización de indicadores clave
- **API REST**: Acceso a todas las funcionalidades a través de API

## Tecnologías Utilizadas

- **Backend**: PHP 8.1, Laravel 12
- **Base de Datos**: MySQL/MariaDB
- **Frontend**: Tailwind CSS, Blade
- **API**: Laravel API Resources, Sanctum para autenticación

## Requisitos

- PHP >= 8.1
- Composer
- MySQL o MariaDB
- Node.js y NPM

## Instalación

1. Clonar el repositorio:
   ```bash
   git clone [url-repositorio] rlmackcon
   cd rlmackcon
   ```

2. Instalar dependencias PHP:
   ```bash
   composer install
   ```

3. Instalar dependencias JavaScript:
   ```bash
   npm install
   ```

4. Configurar el archivo .env:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Configurar la base de datos en el archivo .env:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=libreria
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

7. Compilar activos frontend:
   ```bash
   npm run dev
   ```

8. Iniciar el servidor:
   ```bash
   php artisan serve
   ```

9. Acceder a la aplicación:
   ```
   http://localhost:8000
   ```

## Estructura de la Base de Datos

El sistema cuenta con las siguientes tablas principales:

- **categorias**: Clasificación de libros
- **proveedores**: Datos de proveedores
- **libros**: Catálogo de libros
- **clientes**: Información de clientes
- **empleados**: Registro de empleados
- **ventas**: Transacciones de venta
- **detalle_ventas**: Ítems de cada venta
- **pagos**: Pagos asociados a ventas
- **inventarios**: Control de existencias
- **facturas**: Documentos de facturación

## API REST

La aplicación expone una API RESTful completa para todas las entidades. Los endpoints siguen el formato:

- `GET /api/categorias`: Listar categorías
- `POST /api/libros`: Crear libro
- `PUT /api/clientes/{id}`: Actualizar cliente
- `DELETE /api/ventas/{id}`: Eliminar venta

## Contribuciones

Las contribuciones son bienvenidas. Para cambios importantes, por favor abra primero un issue para discutir lo que le gustaría cambiar.

## Licencia

[MIT](https://choosealicense.com/licenses/mit/)
