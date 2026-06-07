<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h4>Gestión de Insumos - Nuevo Insumo</h4>
            <a href="<?php echo BASE_URL; ?>Insumo/inicio" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="<?php echo BASE_URL; ?>Insumo/registrar" method="POST">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre del Insumo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Tomate Chonto" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select class="form-select" id="id_categoria" name="id_categoria" required>
                                <option value="" selected disabled>Elija la categoría...</option>
                                <option value="1">Proteínas / Carnes</option>
                                <option value="2">Lácteos</option>
                                <option value="3">Vegetales</option>
                                <option value="4">Panadería</option>
                                <option value="5">Bebidas</option>
                                <option value="6">Empaques</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2" placeholder="Breve descripción del insumo..." required></textarea>
                        </div>
                    </div>

                   <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                            <select class="form-select" id="unidad_medida" name="unidad_medida" required>
                                <option value="" selected disabled>Elija...</option>
                                <option value="Kg">Kg</option>
                                <option value="Lb">Lb</option>
                                <option value="Litro">Litro</option>
                                <option value="Unidad">Unidad</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cantidad_actual" class="form-label">Cantidad Inicial</label>
                            <input type="number" class="form-control" id="cantidad_actual" name="cantidad_actual" placeholder="Ej: 50" min="0" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                            <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" placeholder="Ej: 10" min="0" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="precio_base" class="form-label">Precio Base</label>
                            <input type="number" step="0.01" class="form-control" id="precio_base" name="precio_base" placeholder="Ej: 5000" min="0" required>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-danger px-5">Guardar Insumo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once 'View/Templates/footer.php'; ?>