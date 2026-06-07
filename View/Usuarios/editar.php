<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Gestión de usuarios - Editar usuario</h4>
            <a href="<?php echo BASE_URL; ?>Usuario/inicio" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="<?php echo BASE_URL; ?>Usuario/actualizar" method="POST">
                    
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario->getIdUsuario(); ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->getNombre(); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $usuario->getApellido(); ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $usuario->getCedula(); ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario->getCorreo(); ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="area" class="form-label">Área</label>
                            <select class="form-select" id="area" name="area" required>
                                <option value="Cocina" <?php echo ($usuario->getArea() == 'Cocina') ? 'selected' : ''; ?>>Cocina</option>
                                <option value="Parrilla" <?php echo ($usuario->getArea() == 'Parrilla') ? 'selected' : ''; ?>>Parrilla</option>
                                <option value="Bebidas" <?php echo ($usuario->getArea() == 'Bebidas') ? 'selected' : ''; ?>>Bebidas</option>
                                <option value="Administración" <?php echo ($usuario->getArea() == 'Administración') ? 'selected' : ''; ?>>Administración</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="id_rol" class="form-label">Rol del Sistema</label>
                            <select class="form-select" id="id_rol" name="id_rol" required>
                                <option value="1" <?php echo ($usuario->getIdRol() == 1) ? 'selected' : ''; ?>>Administrador</option>
                                <option value="2" <?php echo ($usuario->getIdRol() == 2) ? 'selected' : ''; ?>>Usuario Operativo</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contrasena" class="form-label">Cambiar Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Dejar en blanco para no cambiar">
                            <small class="text-muted">Si no deseas cambiarla, deja este campo vacío.</small>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-warning px-5"><i class="fas fa-save"></i> Actualizar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once 'View/Templates/footer.php'; ?>