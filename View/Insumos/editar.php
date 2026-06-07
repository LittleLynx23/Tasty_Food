<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Gestión de Insumos - Editar Insumo</h4>
            <a href="<?php echo BASE_URL; ?>Insumo/inicio" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="<?php echo BASE_URL; ?>Insumo/actualizar" method="POST">
                    
                    <input type="hidden" name="id_insumo" value="<?php echo $insumo->getIdInsumo(); ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre del Insumo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $insumo->getNombre(); ?>" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select class="form-select" id="id_categoria" name="id_categoria" required>
                                <option value="1" <?php echo ($insumo->getIdCategoria() == 1) ? 'selected' : ''; ?>>Proteínas / Carnes</option>
                                <option value="2" <?php echo ($insumo->getIdCategoria() == 2) ? 'selected' : ''; ?>>Lácteos</option>
                                <option value="3" <?php echo ($insumo->getIdCategoria() == 3) ? 'selected' : ''; ?>>Vegetales</option>
                                <option value="4" <?php echo ($insumo->getIdCategoria() == 4) ? 'selected' : ''; ?>>Panadería</option>
                                <option value="5" <?php echo ($insumo->getIdCategoria() == 5) ? 'selected' : ''; ?>>Bebidas</option>
                                <option value="6" <?php echo ($insumo->getIdCategoria() == 6) ? 'selected' : ''; ?>>Empaques</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required><?php echo $insumo->getDescripcion(); ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                            <select class="form-select" id="unidad_medida" name="unidad_medida" required>
                                <option value="Kg" <?php echo ($insumo->getUnidadMedida() == 'Kg') ? 'selected' : ''; ?>>Kg</option>
                                <option value="Lb" <?php echo ($insumo->getUnidadMedida() == 'Lb') ? 'selected' : ''; ?>>Lb</option>
                                <option value="Litro" <?php echo ($insumo->getUnidadMedida() == 'Litro') ? 'selected' : ''; ?>>Litro</option>
                                <option value="Unidad" <?php echo ($insumo->getUnidadMedida() == 'Unidad') ? 'selected' : ''; ?>>Unidad</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cantidad_actual" class="form-label">Cantidad Actual</label>
                            <input type="number" class="form-control" id="cantidad_actual" name="cantidad_actual" value="<?php echo $insumo->getCantidadActual(); ?>" min="0" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                            <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" value="<?php echo $insumo->getStockMinimo(); ?>" min="0" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="precio_base" class="form-label">Precio Base</label>
                            <input type="number" step="0.01" class="form-control" id="precio_base" name="precio_base" value="<?php echo $insumo->getPrecioBase(); ?>" min="0" required>
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