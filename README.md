# Tasty Food - Sistema de Inventario

Este es un proyecto web que se hizo en PHP usando arquitectura MVC y MySQL. Sirve para llevar el control del inventario, los insumos y los usuarios de un negocio de comida rápida (Tasty Food).

## Tecnologías
* PHP puro (Modelo-Vista-Controlador)
* MySQL para la base de datos
* HTML, CSS normal y algo de JavaScript
* Boxicons para los iconos

## Cómo probarlo en tu PC

Si quieres descargar el proyecto y correrlo en tu computadora, sigue estos pasos:

1. **Servidor local:** Necesitas tener instalado XAMPP o WAMP Server.
2. **Ubicación:** Clona o descarga esta carpeta y ponla en `htdocs` (si usas XAMPP) o en la carpeta `www` (si usas WAMP).

### Base de datos
1. Abre tu phpMyAdmin (`http://localhost/phpmyadmin/`).
2. Crea una base de datos nueva que se llame `tasty_food_db`.
3. Selecciona la base de datos y dale a la pestaña "Importar". Sube el archivo `script_tastyfood.sql` que dejé dentro de la carpeta `BD` del proyecto.

### Configuración
Para que conecte bien con tu servidor local, abre el archivo `Config/config.php` en tu editor de código y revisa que los datos de conexión estén así:

```php
<?php
define("BASE_URL", "http://localhost/Tasty_Food/"); // Cambia esto si tu carpeta se llama distinto
define('DB_SERVIDOR', 'localhost');
define('DB_USER', 'root');
define('DB_CLAVE', '');
define('DB_NOMBRE', 'tasty_food_db');
?>
```

## Usuarios de prueba
Cuando ya tengas todo corriendo, entra a la página desde tu navegador (por ejemplo: `http://localhost/Tasty_Food/`). 

Puedes iniciar sesión con este usuario administrador que ya viene creado por defecto en el archivo SQL para probar el sistema:

* **Correo:** admin@tastyfood.com
* **Contraseña:** admin123
