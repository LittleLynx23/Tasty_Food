<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Gestión de Solicitudes de Insumos</h4>
            
            <a href="<?php echo BASE_URL; ?>Solicitud/nuevo" class="btn btn-danger">
                <i class="fas fa-plus"></i> + Nueva Solicitud
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Número</th>
                                <th>Fecha</th>
                                <th>Responsable</th>
                                <th>Área</th>
                                <th>Total ($)</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solicitudes as $solicitud) { ?>
                                <tr>
                                    <td class="fw-bold text-secondary">
                                        #<?php echo str_pad($solicitud['id_solicitud'], 4, "0", STR_PAD_LEFT); ?>
                                    </td>
                                    
                                    <td><?php echo date('d/m/Y h:i A', strtotime($solicitud['fecha_solicitud'])); ?></td>
                                    
                                    <td><?php echo $solicitud['nombre'] . ' ' . $solicitud['apellido']; ?></td>
                                    <td><span class="badge bg-secondary"><?php echo $solicitud['area']; ?></span></td>
                                    
                                    <td class="fw-bold text-success">$<?php echo number_format($solicitud['total_solicitud'], 2); ?></td>
                                    
                                    <td class="text-center">
                                        <?php 
                                            if ($solicitud['estado'] == 'Pendiente') {
                                                echo '<span class="badge bg-warning text-dark">⏳ Pendiente</span>';
                                            } elseif ($solicitud['estado'] == 'Aprobada') {
                                                echo '<span class="badge bg-success">✅ Aprobada</span>';
                                            } elseif ($solicitud['estado'] == 'Rechazada') {
                                                echo '<span class="badge bg-danger">❌ Rechazada</span>';
                                            }
                                        ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="<?php echo BASE_URL; ?>Solicitud/ver?id=<?php echo $solicitud['id_solicitud']; ?>" class="btn btn-info btn-sm text-white" title="Ver Detalles">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>

                                        <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1 && $solicitud['estado'] == 'Pendiente') { ?>
                                            
                                            <a href="<?php echo BASE_URL; ?>Solicitud/procesar?id=<?php echo $solicitud['id_solicitud']; ?>&estado=Aprobada" 
                                               class="btn btn-success btn-sm ms-1" 
                                               onclick="return confirm('¿Seguro que deseas APROBAR esta solicitud? El inventario se actualizará automáticamente.');" 
                                               title="Aprobar">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            
                                            <a href="<?php echo BASE_URL; ?>Solicitud/procesar?id=<?php echo $solicitud['id_solicitud']; ?>&estado=Rechazada" 
                                               class="btn btn-danger btn-sm ms-1" 
                                               onclick="return confirm('¿Seguro que deseas RECHAZAR esta solicitud?');" 
                                               title="Rechazar">
                                                <i class="fas fa-times"></i>
                                            </a>

                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                    <?php if (empty($solicitudes)) { ?>
                        <div class="alert alert-info text-center mt-3">
                            No hay solicitudes registradas en este momento.
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'View/Templates/footer.php'; ?>