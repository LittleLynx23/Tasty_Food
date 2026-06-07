<?php require_once 'View/Templates/header.php'; ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <h4>Nueva Solicitud de Insumos</h4>
        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body bg-light">
                <div class="row align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Seleccione el Insumo</label>
                        <select class="form-select" id="select_insumo">
                            <option value="" disabled selected>Elija un insumo...</option>
                            <?php foreach ($insumos as $insumo) { ?>
                                <option value="<?php echo $insumo->getIdInsumo(); ?>" 
                                        data-precio="<?php echo $insumo->getPrecioBase(); ?>"
                                        data-nombre="<?php echo $insumo->getNombre(); ?>">
                                    <?php echo $insumo->getNombre() . " (" . $insumo->getUnidadMedida() . ")"; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cantidad a Solicitar</label>
                        <input type="number" class="form-control" id="input_cantidad" min="1" placeholder="Ej: 5">
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="button" class="btn btn-secondary w-100" onclick="agregarAlCarrito()">
                            <i class="fas fa-plus"></i> Agregar Insumo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="<?php echo BASE_URL; ?>Solicitud/registrar" method="POST" id="formSolicitud">
                    
                    <input type="hidden" name="detalles_ocultos" id="detalles_ocultos">

                    <div class="table-responsive mb-3">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unit.</th>
                                    <th>Subtotal</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_carrito">
                                </tbody>
                        </table>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Observaciones (Opcional)</label>
                            <textarea name="observacion" class="form-control" rows="2" placeholder="Motivo de la solicitud urgente..."></textarea>
                        </div>
                        <div class="col-md-4 text-end">
                            <h4 class="mt-4">Total: $<span id="total_vista">0.00</span></h4>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="<?php echo BASE_URL; ?>Solicitud/inicio" class="btn btn-outline-danger">Cancelar</a>
                        <button type="button" class="btn btn-danger px-5" onclick="enviarSolicitud()">Generar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
   
    let carrito = [];

    function agregarAlCarrito() {
        let select = document.getElementById('select_insumo');
        let cantidad = document.getElementById('input_cantidad').value;

        if (select.value === "" || cantidad <= 0 || cantidad === "") {
            alert("Por favor seleccione un insumo y una cantidad válida.");
            return;
        }

      
        let id_insumo = select.value;
        let nombre = select.options[select.selectedIndex].getAttribute('data-nombre');
        let precio = parseFloat(select.options[select.selectedIndex].getAttribute('data-precio'));
        let subtotal = precio * cantidad;

        carrito.push({
            id_insumo: id_insumo,
            nombre: nombre,
            cantidad: parseInt(cantidad),
            precio: precio,
            subtotal: subtotal
        });


        select.value = "";
        document.getElementById('input_cantidad').value = "";

        dibujarTabla();
    }

    function dibujarTabla() {
        let tbody = document.getElementById('cuerpo_carrito');
        let totalVista = document.getElementById('total_vista');
        tbody.innerHTML = '';
        let totalGeneral = 0;

        carrito.forEach((item, index) => {
            totalGeneral += item.subtotal;
            tbody.innerHTML += `
                <tr>
                    <td>${item.nombre}</td>
                    <td>${item.cantidad}</td>
                    <td>$${item.precio.toFixed(2)}</td>
                    <td>$${item.subtotal.toFixed(2)}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminarItem(${index})">X</button>
                    </td>
                </tr>
            `;
        });

        totalVista.innerText = totalGeneral.toFixed(2);
    }

    function eliminarItem(index) {
        carrito.splice(index, 1);
        dibujarTabla();
    }

    function enviarSolicitud() {
        if(carrito.length === 0) {
            alert("Debe agregar al menos un insumo a la solicitud.");
            return;
        }
       
        document.getElementById('detalles_ocultos').value = JSON.stringify(carrito);
      
        document.getElementById('formSolicitud').submit();
    }
</script>

<?php require_once 'View/Templates/footer.php'; ?>