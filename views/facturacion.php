<?php
include 'navbar.php';
?>


<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <?php
        include 'sidebar.php';
        ?>

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Facturación</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Facturación</li>
                </ol>
                <?php
                include '../models/mensajeFactura.php';
                ?>
                <a href="../views/Clientes.php" class="btn btn-warning mb-3">
                    <i class="fas fa-user-plus me-2"></i> Registrar Cliente
                </a>

                <form method="POST" action="../controller/registrarFactura.php" id="formFactura">
                    <div class="row mb-4">
                        <!-- Buscar Cliente -->
                        <div class="col-md-6">
                            <div class="card shadow mb-2">
                                <div class="card-header bg-secondary text-white">Buscar Cliente</div>
                                <div class="card-body">
                                    <div class="position-relative">
                                        <input type="text" id="buscarCliente" class="form-control" placeholder="Buscar Cliente por Cédula o Nombre" autocomplete="off">
                                        <!-- Contenedor flotante -->
                                        <div id="resultadosClientes"
                                            class="position-absolute bg-white border rounded shadow-sm d-none mt-2 p-2"
                                            style="max-height:200px; overflow-y:auto; z-index:1050; min-width:100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buscar Vendedor -->
                        <div class="col-md-6">
                            <div class="card shadow mb-2">
                                <div class="card-header bg-secondary text-white">Buscar Vendedor</div>
                                <div class="card-body">
                                    <div class="position-relative">
                                        <input type="text" id="buscarVendedor" class="form-control" placeholder="Buscar Vendedor por Cédula o Nombre" autocomplete="off">
                                        <!-- Contenedor flotante -->
                                        <div id="resultadosVendedores"
                                            class="position-absolute bg-white border rounded shadow-sm d-none mt-2 p-2"
                                            style="max-height:200px; overflow-y:auto; z-index:1050; min-width:100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Datos del Cliente -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-secondary text-white">Datos del Cliente</div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Cédula</label>
                                    <input type="text" class="form-control" id="cedulaCliente" name="cedulaCliente" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" readonly>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Correo</label>
                                    <input type="email" class="form-control" id="correoCliente" name="correoCliente" readonly>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Teléfono</label>
                                    <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Datos del Vendedor -->
                    <div class="card shadow mb-5">
                        <div class="card-header bg-secondary text-white">Datos del Vendedor</div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Cédula</label>
                                    <input type="text" class="form-control" id="cedulaVendedor" name="cedulaVendedor" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="nombreVendedor" name="nombreVendedor" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Teléfono</label>
                                    <input type="text" class="form-control" id="telefonoVendedor" name="telefonoVendedor" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header bg-secondary text-white">
                            Listado de Productos
                        </div>
                        <div class="card-body">
                            <!-- Fila de búsqueda y total -->
                            <div class="row g-3">
                                <div class="col-md-6 position-relative">
                                    <label for="buscarProducto" class="form-label">Buscar producto</label>
                                    <div class="position-relative">
                                        <input type="text" id="buscarProducto" class="form-control" placeholder="Buscar por nombre" autocomplete="off">
                                        <!-- Contenedor exactamente del ancho del input -->
                                        <div id="resultadosProductos"
                                            class="position-absolute bg-white border rounded shadow-sm d-none mt-2 p-2"
                                            style="max-height:200px; overflow-y:auto; z-index:1050; min-width:100%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="totalVenta" class="form-label"><b>Total Venta</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" min="1" step="0.01" class="form-control" name="totalVenta" id="totalVenta" placeholder="0.00" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila de total recibido y vuelto -->
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label for="totalRecibido" class="form-label"><b>Total Recibido</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" min="1" step="0.01" class="form-control" name="totalRecibido" id="totalRecibido" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="vuelto" class="form-label"><b>Vuelto</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" min="0" step="0.01" class="form-control" name="vuelto" id="vuelto" placeholder="0.00">
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla de productos -->
                            <div class="card-body p-0 mt-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle text-center rounded">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Stock</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Descuento (%)</th>
                                                <th>Subtotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody name="listaProductos" id="listaProductosAgregados">
                                            <!-- Aquí se agregan filas dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Resumen de Venta -->
                    <div class="card shadow mb-4 w-50 mx-auto">
                        <div class="card-header bg-warning text-white">Resumen de Venta</div>
                        <div class="card-body">
                            <p class="mb-2">Subtotal: <span id="resumenSubtotal">$0.00</span></p>
                            <p class="mb-2">IVA (15%): <span id="resumenIVA">$0.00</span></p>
                            <p class="fw-bold text-success">Total: <span id="resumenTotal">$0.00</span></p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg mx-auto d-block" style="width: 60%;" name="btnguardar" value="ok">Registrar Factura</button>
                </form>

        </main>
        <?php
        include 'footer.php';
        ?>
    </div>
</div>

<?php
include 'scripts.php';
?>
<script src="../js/facturacion.js"></script>

</body>


</html>