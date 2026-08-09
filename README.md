# Real English CR

Sitio web de la academia de ingles Real English CR. Es la parte del front-end del proyecto del curso SC-504 Lenguajes de Bases de Datos. Esta organizado con el patron MVC (Modelo - Vista - Controlador), igual que como lo vimos en SC-502.

## De que se trata

Real English CR es una academia (ficticia) de ingles con cinco sedes en Costa Rica: San Jose, Heredia, Cartago, Alajuela y Liberia. Aca esta la parte web, o sea las paginas que ve el usuario. El modelo se conecta a la base de datos en Oracle usando PHP con la extension OCI8.

## Estructura (MVC)

- `index.php` - punto de entrada, redirige a la vista principal.
- `view/` - las vistas (lo que se muestra).
  - `LayoutExterno.php` - el encabezado, menu y pie de pagina que se repiten (funciones ImportCSS, PintarHeader, PintarFooter, ImportJS).
  - `vInicio/` - las 18 paginas como vistas .php (Principal, AcercaDe, Cursos, Precios, IniciarSesion, RegistrarUsuarios, Contacto, etc.).
  - `vAdmin/` - el modulo de mantenimientos, el CRUD de las 15 tablas.
- `control/` - los controladores.
  - `InicioController.php` - maneja los formularios (login, registro, contacto).
  - `AdminController.php` - maneja el modulo de mantenimientos.
- `model/` - el modelo. Aca esta la conexion a Oracle (Conexion.php), el catalogo de las 15 entidades (Entidades.php), el CRUD que llama a los paquetes (CrudModel.php) y la autenticacion (Autenticacion.php).
- `assets/` - css, js, imagenes y fuentes.

## Como correrlo

1. Tener XAMPP instalado.
2. Copiar la carpeta `RealEnglishCR` dentro de `C:\xampp\htdocs`.
3. Abrir el panel de XAMPP y prender Apache.
4. En el navegador entrar a: `http://localhost:81/RealEnglishCR/`
   (el index.php redirige solo a la pagina principal)

## Tecnologias

- HTML5, CSS3 y JavaScript
- Bootstrap y jQuery
- PHP con patron MVC
- Oracle + OCI8

## Estado del proyecto

- [x] Paginas en español con estructura MVC
- [x] Precios en colones y metodos de pago locales (SINPE Movil)
- [x] Controlador de formularios (login, registro, contacto)
- [x] Conexion del modelo a Oracle con PHP / OCI8
- [x] Validaciones e ingreso real de datos
- [x] Modulo de mantenimientos con el CRUD de las 15 tablas
- [x] Login con contrasena cifrada para administradores y estudiantes

## Grupo F

- Granados Gonzalez Luis Andres
- Perez Calderon David
- Rodriguez Arroyo Michelle Andrea
- Valverde Arroyo Maria Catalina

Universidad Fidelitas - SC-504 Lenguajes de Bases de Datos
