<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Gestión de Usuarios</h4>
            <a href="<?php echo BASE_URL; ?>Usuario/nuevo" class="btn btn-danger">
                <i class="fas fa-plus"></i> + Nuevo usuario
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="filtroNombre" class="form-label fw-bold">Nombre o Apellido</label>
                        <input type="text" class="form-control" placeholder="Ej: Andrés..." id="filtroNombre">
                    </div>
                    <div class="col-md-4">
                        <label for="filtroCedula" class="form-label fw-bold">Cédula</label>
                        <input type="text" class="form-control" placeholder="Ej: 123456..." id="filtroCedula">
                    </div>
                    <div class="col-md-4">
                        <label for="filtroArea" class="form-label fw-bold">Área de Trabajo</label>
                        <select class="form-select" id="filtroArea">
                            <option value="">Todas las áreas</option>
                            <option value="Cocina">Cocina</option>
                            <option value="Parrilla">Parrilla</option>
                            <option value="Bebidas">Bebidas</option>
                            <option value="Administración">Administración</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Correo</th>
                                <th>Área</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) { ?>
                                <tr>
                                    <td><?php echo $usuario->getNombre(); ?></td>
                                    <td><?php echo $usuario->getApellido(); ?></td>
                                    <td><?php echo $usuario->getCedula(); ?></td>
                                    <td><?php echo $usuario->getCorreo(); ?></td>
                                    <td>
                                        <span class="badge bg-primary"><?php echo $usuario->getArea(); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo BASE_URL; ?>Usuario/editar?id=<?php echo $usuario->getIdUsuario(); ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        
                                        <a href="<?php echo BASE_URL; ?>Usuario/eliminar?id=<?php echo $usuario->getIdUsuario(); ?>" 
                                           class="btn btn-danger btn-sm" 
                                           title="Eliminar" 
                                           onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
 
    function aplicarFiltros() {
       
        let fNombre = document.getElementById('filtroNombre').value.toLowerCase();
        let fCedula = document.getElementById('filtroCedula').value.toLowerCase();
        let fArea = document.getElementById('filtroArea').value.toLowerCase();

      
        let filas = document.querySelectorAll('tbody tr');

       
        filas.forEach(function(fila) {
       
            let nombre = fila.cells[0].textContent.toLowerCase();
            let apellido = fila.cells[1].textContent.toLowerCase();
            let cedula = fila.cells[2].textContent.toLowerCase();
            let area = fila.cells[4].textContent.toLowerCase();

      
            let cumpleNombre = nombre.includes(fNombre) || apellido.includes(fNombre);
            let cumpleCedula = cedula.includes(fCedula);
            let cumpleArea = (fArea === "") || (area.includes(fArea));

            if (cumpleNombre && cumpleCedula && cumpleArea) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }


    document.getElementById('filtroNombre').addEventListener('keyup', aplicarFiltros);
    document.getElementById('filtroCedula').addEventListener('keyup', aplicarFiltros);
    document.getElementById('filtroArea').addEventListener('change', aplicarFiltros);
</script>

<?php require_once 'View/Templates/footer.php'; ?>