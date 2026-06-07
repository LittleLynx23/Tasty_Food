<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Iniciar Sesión</title>
    <script src="https://kit.fontawesome.com/d83c3a8f8f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Public/css/login.css?v=2.0">
</head>
<body class="body-login">
    <div class="contenedor-login">
        <header class="encabezado">
            <div class="contenedor-logotipo">
                <img src="<?php echo BASE_URL; ?>Public/img/logo.png" alt="Logotipo Tasty" class="logotipo-imagen">
            </div>
            <div class="area-titulo">
                <h1>Gestión De Inventario</h1>
                <p>Barrancabermeja • Tasty Food</p>
            </div>
        </header>

        <?php if (isset($_GET['error'])): ?>
            <div style="background-color: #ffcccc; color: #a62a2a; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 15px; font-size: 14px; font-weight: bold;">
                <?php 
                    if($_GET['error'] == 'datos_incorrectos') echo "Correo, contraseña o rol inválidos.";
                    if($_GET['error'] == 'campos_vacios') echo "Por favor, llene todos los campos.";
                ?>
            </div>
        <?php endif; ?>

        <span class="etiqueta-tipo-login">Iniciar sesión como:</span>

        <button type="button" class="boton-rol activo" onclick="seleccionarRol(1, this)">
            <div class="icono-rol"><i class="fa-solid fa-user-shield"></i></div>
            <div class="nombre-rol">Administrador</div>
        </button>

        <button type="button" class="boton-rol" onclick="seleccionarRol(2, this)">
            <div class="icono-rol"><i class="fa-solid fa-user"></i></div>
            <div class="nombre-rol">Usuario Operativo</div>
        </button>

        <form action="<?php echo BASE_URL; ?>login/ingresar" method="POST">
            
            <input type="hidden" name="id_rol" id="id_rol" value="1">

            <div class="grupo-formulario">
                <label>Correo:</label>
                <input type="email" name="correo" placeholder="Ejemplo: usuario@correo.com" required>
            </div>

            <div class="grupo-formulario">
                <label>Contraseña:</label>
                <input type="password" name="contrasena" placeholder="Ejemplo: contraseña@123" required>
            </div>

            <button type="submit" class="boton-ingresar">INGRESAR</button>
        </form>
    </div>

    <script>
        function seleccionarRol(idRol, elementoBoton) {
            document.getElementById('id_rol').value = idRol;
            let botones = document.querySelectorAll('.boton-rol');
            botones.forEach(btn => btn.classList.remove('activo'));
            elementoBoton.classList.add('activo');
        }
    </script>
</body>
</html>