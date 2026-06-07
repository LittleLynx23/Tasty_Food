<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Detalle de Solicitud #<?php echo $solicitud['id_solicitud']; ?></h4>
            <a href="<?php echo BASE_URL; ?>Solicitud/inicio" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Solicitante:</strong> <?php echo $solicitud['nombre'] . ' ' . $solicitud['apellido']; ?></p>
                        <p><strong>Área:</strong> <?php echo $solicitud['area']; ?></p>
                        <p><strong>Fecha:</strong> <?php echo $solicitud['fecha_solicitud']; ?></p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p><strong>Estado:</strong> 
                            <span class="badge <?php echo ($solicitud['estado'] == 'Pendiente') ? 'bg-warning text-dark' : (($solicitud['estado'] == 'Aprobada') ? 'bg-success' : 'bg-danger'); ?>">
                                <?php echo $solicitud['estado']; ?>
                            </span>
                        </p>
                        <p><strong>Total Estimado:</strong> $<?php echo number_format($solicitud['total_solicitud'], 2); ?></p>
                    </div>
                </div>
                <?php if (!empty($solicitud['observacion'])) { ?>
                    <div class="alert alert-info">
                        <strong>Observación:</strong> <?php echo $solicitud['observacion']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Insumos Solicitados</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Insumo</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detalles as $item) { ?>
                                <tr>
                                    <td><?php echo $item['nombre_insumo']; ?></td>
                                    <td><?php echo $item['unidad_medida']; ?></td>
                                    <td><?php echo $item['cantidad_solicitada']; ?></td>
                                    <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th>$<?php echo number_format($solicitud['total_solicitud'], 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <?php 
         
                if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1 && $solicitud['estado'] == 'Pendiente') { 
                ?>
                    <div class="text-end mt-4">
                        <a href="<?php echo BASE_URL; ?>Solicitud/procesar?id=<?php echo $solicitud['id_solicitud']; ?>&estado=Rechazada" class="btn btn-danger me-2" onclick="return confirm('¿Seguro que deseas RECHAZAR esta solicitud?');">
                            <i class="fas fa-times"></i> Rechazar
                        </a>
                        <a href="<?php echo BASE_URL; ?>Solicitud/procesar?id=<?php echo $solicitud['id_solicitud']; ?>&estado=Aprobada" class="btn btn-success" onclick="return confirm('¿Seguro que deseas APROBAR esta solicitud? El inventario se actualizará automáticamente.');">
                            <i class="fas fa-check"></i> Aprobar
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php require_once 'View/Templates/footer.php'; ?>