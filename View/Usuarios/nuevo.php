<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Gestión de usuarios - Nuevo usuario</h4>
            <a href="<?php echo BASE_URL; ?>Usuario/inicio" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="<?php echo BASE_URL; ?>Usuario/registrar" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Usuario" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido Usuario" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Número de documento" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Usuario" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="area" class="form-label">Área</label>
                            <select class="form-select" id="area" name="area" required>
                                <option value="" selected disabled>Seleccione el área...</option>
                                <option value="Cocina">Cocina</option>
                                <option value="Parrilla">Parrilla</option>
                                <option value="Bebidas">Bebidas</option>
                                <option value="Administración">Administración</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="id_rol" class="form-label">Rol del Sistema</label>
                            <select class="form-select" id="id_rol" name="id_rol" required>
                                <option value="" selected disabled>Seleccione un rol...</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario Operativo</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contrasena" class="form-label">Contraseña de acceso</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Mínimo 6 caracteres" required>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-danger px-5">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once 'View/Templates/footer.php'; ?>