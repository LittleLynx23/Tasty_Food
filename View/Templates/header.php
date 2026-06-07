<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Public/css/estilos.css">
</head>
<body>

    <header class="topbar">
            
            <button class="btn-menu-movil" id="btnMenu">
                <i class='bx bx-menu'></i>
            </button>

            <div class="topbar-left">
                <div class="logo-texto">TASTY<span style="color:#a62a2a">FOOD</span></div>
                    <div class="user-info">
                        <strong><?php echo isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Invitado'; ?></strong><br>
                            
                        <?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario no identificado'; ?><br>
                            
                        ID: <?php echo isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : '---'; ?>
                    </div>
            </div>

            <div class="topbar-right">
                <h2>Gestión De Inventario - Tasty Food</h2>
            </div>
        </header>

    <div class="wrapper">
        
        <aside class="sidebar">
                    <div class="nav-links">
                        
                        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador'): ?>
                            <a href="<?php echo BASE_URL; ?>" class="btn-rojo"><i class='bx bx-home'></i> INICIO</a>
                            <a href="<?php echo BASE_URL; ?>usuario/inicio" class="btn-rojo"><i class='bx bx-user'></i> USUARIOS</a>
                            <a href="<?php echo BASE_URL; ?>insumo/inicio" class="btn-rojo"><i class='bx bx-box'></i> INSUMOS</a>
                            <a href="<?php echo BASE_URL; ?>solicitud/inicio" class="btn-rojo"><i class='bx bx-edit'></i> SOLICITUDES</a>
                        
                        <?php else: ?>
                            <a href="<?php echo BASE_URL; ?>" class="btn-rojo"><i class='bx bx-home'></i> INICIO</a>
                            <a href="<?php echo BASE_URL; ?>insumo/inicio" class="btn-rojo"><i class='bx bx-box'></i> INSUMOS</a>
                            <a href="<?php echo BASE_URL; ?>solicitud/inicio" class="btn-rojo"><i class='bx bx-edit'></i> SOLICITUDES</a>
                        <?php endif; ?>

                    </div>
                    
                    <div class="nav-links mt-auto">
                        <a href="<?php echo BASE_URL; ?>login/salir" class="btn-rojo"><i class='bx bx-log-out'></i> SALIR</a>
                    </div>
        </aside>

        <main class="main-content">
            <div class="contenido-real">