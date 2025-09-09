<?php include 'navbar.php'; ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <?php include 'sidebar.php'; ?>

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Devoluciones</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Devoluciones</li>
                </ol>
                <?php include '../models/mensajeDevolucion.php'; ?>

                <form method="POST" action="../controller/registrarDevolucion.php" id="formDevolucion">
                    <div class="row">

                        <!-- LADO IZQUIERDO -->
                        <div class="col-md-4">

                            <!-- Buscar Factura -->
                            <div class="card shadow mb-3">
                                <div class="card-header bg-secondary text-white">Buscar Factura</div>
                                <div class="card-body">
                                    <div class="position-relative">
                                        <input type="text" id="buscarFactura" class="form-control" placeholder="Buscar por Código de Factura o Cliente" autocomplete="off">
                                        <div id="resultadosFacturas" class="position-absolute bg-white border rounded shadow-sm d-none mt-2 p-2" style="max-height:200px; overflow-y:auto; z-index:1050; min-width:100%;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Datos del Cliente -->
                            <div class="card shadow mb-3">
                                <div class="card-header bg-secondary text-white">Datos del Cliente</div>
                                <div class="card-body">
                                    <p class="mb-2"><strong>Cédula:</strong> <span id="cedulaCliente">---</span></p>
                                    <p class="mb-2"><strong>Nombre:</strong> <span id="nombreCliente">---</span></p>
                                    <p class="mb-2"><strong>Apellido:</strong> <span id="apellidoCliente">---</span></p>
                                    <p class="mb-2"><strong>Correo:</strong> <span id="correoCliente">---</span></p>
                                    <p class="mb-0"><strong>Teléfono:</strong> <span id="telefonoCliente">---</span></p>
                                </div>
                            </div>

                            <!-- Botón debajo de los datos del cliente -->
                            <button type="submit" class="btn btn-danger btn-lg w-100 shadow"
                                name="btnguardar" value="ok">
                                Registrar Devolución
                            </button>
                        </div>

                        <!-- LADO DERECHO -->
                        <div class="col-md-8">
                            <div class="card shadow">
                                <div class="card-header bg-secondary text-white">Productos de la Factura</div>
                                <div class="card-body">
                                    <div id="productosFactura">
                                        <p class="text-muted">Seleccione una factura para ver los productos...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal para motivo de devolución -->
                    <div class="modal fade" id="motivoModal" tabindex="-1" aria-labelledby="motivoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="motivoModalLabel">Motivo de Devolución</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea id="motivoTextArea" class="form-control" rows="5" placeholder="Escriba el motivo..." style="resize:none;"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="limpiarMotivo" class="btn btn-warning">Limpiar</button>
                                    <button type="button" id="guardarMotivo" class="btn btn-primary">Guardar Motivo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'scripts.php'; ?>
<script src="../js/devolucion.js"></script>
</body>

</html>