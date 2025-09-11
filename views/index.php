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
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="h5 mb-2">Clientes</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users fa-2x me-3"></i>
                                    <div class="h2 fw-bold mb-0">
                                        <?php
                                        $consulta = $conn->query("SELECT COUNT(*) AS total FROM cliente where estado_client = 1");
                                        $fila = $consulta->fetch_assoc();
                                        echo $fila['total'];
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="clientes.php">Ver Detalles</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">
                                <div class="h5 mb-2">Productos</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-boxes fa-2x me-3"></i>
                                    <div class="h2 fw-bold mb-0">
                                        <?php
                                        $consulta = $conn->query("SELECT COUNT(*) AS total FROM producto where estado_product = 1");
                                        $fila = $consulta->fetch_assoc();
                                        echo $fila['total'];
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="productos.php">Ver Detalles</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                                <div class="h5 mb-2">Ventas</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-dollar-sign fa-2x me-3"></i>
                                    <div class="h2 fw-bold mb-0">
                                        <?php
                                        $consulta = $conn->query("SELECT SUM(total_detalle) AS total_ventas FROM detalle_factura_temp");
                                        $fila = $consulta->fetch_assoc();
                                        echo '$' . ($fila['total_ventas'] ?? 0);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="tablaFactura.php">Ver Detalles</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">
                                <div class="h5 mb-2">Devoluciones</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-undo-alt fa-2x me-3"></i>
                                    <div class="h2 fw-bold mb-0">
                                        <?php
                                        $consulta = $conn->query("SELECT SUM(cant_devo) AS total_devoluciones FROM devolucion");
                                        $fila = $consulta->fetch_assoc();
                                        echo $fila['total_devoluciones'] ?? 0;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="tablaDevoluciones.php">Ver Detalles</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Ventas
                            </div>
                            <div class="card-body"><canvas id="ventasChart" width="100%" height="232"></canvas></div>
                            <?php
                            // Consulta la fecha más reciente de cada tabla
                            $result = $conn->query('SELECT MAX(ultima_fecha) AS ultima_fecha
                                FROM (
                                    SELECT MAX(fecha_detalle) AS ultima_fecha FROM detalle_factura_temp
                                    UNION
                                    SELECT MAX(fecha_devo) AS ultima_fecha FROM devolucion
                                ) AS fechas');
                            $row = $result->fetch_assoc();
                            $ultima_fecha = $row['ultima_fecha']; // Devuelve la más reciente entre ambas tablas
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A", strtotime($ultima_fecha)); ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                5 productos más vendidos
                            </div>
                            <div class="card-body"><canvas id="cantidadProducto" width="100%" height="40"></canvas></div>
                            <?php
                            // Consulta la fecha más reciente de cada tabla
                            $result = $conn->query('SELECT MAX(ultima_fecha) AS ultima_fecha
                                FROM (
                                    SELECT MAX(fecha_detalle) AS ultima_fecha FROM detalle_factura_temp
                                    UNION
                                    SELECT MAX(fecha_devo) AS ultima_fecha FROM devolucion
                                ) AS fechas');
                            $row = $result->fetch_assoc();
                            $ultima_fecha = $row['ultima_fecha']; // Devuelve la más reciente entre ambas tablas
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A", strtotime($ultima_fecha)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                5 clientes con más compras
                            </div>
                            <div class="card-body">
                                <canvas id="myPieChart" width="100%" height="40"></canvas>
                            </div>
                            <?php
                            $result = $conn->query('SELECT MAX(ultima_fecha) AS ultima_fecha
                            FROM (
                                SELECT MAX(fecha_detalle) AS ultima_fecha FROM detalle_factura_temp
                                UNION
                                SELECT MAX(fecha_devo) AS ultima_fecha FROM devolucion
                            ) AS fechas');
                            $row = $result->fetch_assoc();
                            $ultima_fecha = $row['ultima_fecha'];
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A", strtotime($ultima_fecha)); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Devoluciones
                            </div>
                            <div class="card-body"><canvas id="devolucionesMes" width="100%" height="40"></canvas></div>
                            <?php
                            $result = $conn->query('SELECT MAX(fecha_devo) AS ultima_fecha FROM devolucion');
                            $row = $result->fetch_assoc();
                            $ultima_fecha = $row['ultima_fecha'];
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A", strtotime($ultima_fecha)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-map-marked-alt me-1"></i>
                                Total Ventas por Ciudad
                            </div>
                            <div class="card-body">
                                <div id="ventasMap" style="height: 400px; width: 100%;"></div>
                            </div>
                            <?php
                            // Último cliente registrado
                            $result = $conn->query("SELECT MAX(fecha_registro_client) AS ultima_fecha FROM cliente");
                            $row = $result->fetch_assoc();
                            $ultima_fecha = $row['ultima_fecha'];
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A", strtotime($ultima_fecha)); ?>
                            </div>
                        </div>
                    </div>
                </div>
<!--                 <a href="../report/excelFactura.php" class="btn btn-success mb-3">
                    <i class="fas fa-file-excel me-2"></i> Descargar Excel Facturas
                </a> -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabla Registros Factura
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-sm align-middle text-center" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>Vendedor</th>
                                        <th>Total Factura</th>
                                        <th>PDF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta = $conn->query('SELECT factura.*, cliente.nombre_client, cliente.apellido_client, vendedor.nombre_vend
                                        FROM 
                                        factura 
                                        LEFT JOIN 
                                            cliente ON factura.cod_client = cliente.cod_client
                                        LEFT JOIN
                                            vendedor ON factura.cod_vend = vendedor.cod_vend;
                                        ');
                                    while ($datos = $consulta->fetch_object()) { ?>
                                        <tr>
                                            <td><?= $datos->cod_fact ?></td>
                                            <td><?= $datos->fecha_fact ?></td>
                                            <td><?= $datos->nombre_client . ' ' . $datos->apellido_client ?></td>
                                            <td><?= $datos->nombre_vend ?></td>
                                            <td>$<?= number_format($datos->total_fact, 2) ?></td>
                                            <td class="text-center">
                                                <a href="#"
                                                    onclick="window.open('../FPDF/factura.php?id=<?= $datos->cod_fact ?>', 'Factura', 'width=900,height=600,scrollbars=yes,resizable=yes'); return false;"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-file-invoice-dollar fa-sm" style="font-size: 1.5em;"></i>
                                                </a>
                                            </td>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include 'footer.php';
        ?>
    </div>
</div>
<?php
include 'scripts.php';
?>
<script src="../js/index.js"></script>
<script src="../js/chat-bot.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../charts/dashboard/ventasSemana.js"></script>
<script src="../charts/dashboard/top5Productos.js"></script>
<script src="../charts/devoluciones/devolucionesMes.js"></script>
<script src="../charts/clientes/clientesTop5Compras.js"></script>
<script src="../charts/dashboard/ventasPorCiudad.js"></script>




</body>

</html>