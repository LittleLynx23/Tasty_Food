<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Gestión de Insumos</h4>
            
            <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1) { ?>
                <a href="<?php echo BASE_URL; ?>Insumo/nuevo" class="btn btn-danger">
                    <i class="fas fa-plus"></i> + Nuevo Insumo
                </a>
            <?php } ?>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="filtroNombre" class="form-label fw-bold">Buscar por Nombre</label>
                        <input type="text" class="form-control" placeholder="Ej: Tomate..." id="filtroNombre">
                    </div>
                    <div class="col-md-6">
                        <label for="filtroCategoria" class="form-label fw-bold">Filtrar por Categoría</label>
                        <input type="text" class="form-control" placeholder="Ej: Vegetales..." id="filtroCategoria">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre Insumo</th>
                                <th>Categoría</th>
                                <th>Cantidad Actual</th>
                                <th>Stock Mínimo</th>
                                <th>Estado</th>
                                
                                <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1) { ?>
                                    <th class="text-center">Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($insumos as $insumo) { 
                                $cantidad = $insumo->getCantidadActual();
                                $minimo = $insumo->getStockMinimo();
                                $unidad = $insumo->getUnidadMedida(); 
                            ?>
                                <tr>
                                    <td><?php echo $insumo->getNombre(); ?></td>
                                    <td><?php echo $insumo->getNombreCategoria(); ?></td>
                                    <td class="fw-bold"><?php echo $cantidad . " " . $unidad; ?></td>
                                    <td><?php echo $minimo . " " . $unidad; ?></td>
                                    <td>
                                        <?php 
                                            if ($cantidad == 0) {
                                                echo '<span class="badge bg-danger">Agotado</span>';
                                            } elseif ($cantidad <= $minimo) {
                                                echo '<span class="badge bg-warning text-dark">Bajo</span>';
                                            } else {
                                                echo '<span class="badge bg-success">OK</span>';
                                            }
                                        ?>
                                    </td>
                                    
                                    <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1) { ?>
                                        <td class="text-center">
                                            <a href="<?php echo BASE_URL; ?>Insumo/editar?id=<?php echo $insumo->getIdInsumo(); ?>" class="btn btn-warning btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>Insumo/eliminar?id=<?php echo $insumo->getIdInsumo(); ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('¿Estás seguro de que deseas eliminar este insumo?');">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </td>
                                    <?php } ?>
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
        let fCategoria = document.getElementById('filtroCategoria').value.toLowerCase();
        let filas = document.querySelectorAll('tbody tr');

        filas.forEach(function(fila) {
            let nombre = fila.cells[0].textContent.toLowerCase();
            let categoria = fila.cells[1].textContent.toLowerCase();

            let cumpleNombre = nombre.includes(fNombre);
            let cumpleCategoria = categoria.includes(fCategoria);

            if (cumpleNombre && cumpleCategoria) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }

    document.getElementById('filtroNombre').addEventListener('keyup', aplicarFiltros);
    document.getElementById('filtroCategoria').addEventListener('keyup', aplicarFiltros);
</script>

<?php require_once 'View/Templates/footer.php'; ?>