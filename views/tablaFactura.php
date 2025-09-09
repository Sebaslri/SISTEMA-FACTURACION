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
                <h1 class="mt-4">Lista de Facturas</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Registros</li>
                </ol>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Ventas
                            </div>
                            <div class="card-body"><canvas id="ventasChart" width="100%" height="300"></canvas></div>
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
                                <i class="fas fa-chart-bar me-1"></i>
                                Facturas generadas
                            </div>
                            <div class="card-body"><canvas id="facturasMes" width="100%" height="52"></canvas></div>
                            <?php
                            // Consulta la fecha más reciente de cada tabla
                            $result = $conn->query('SELECT MAX(fecha_fact) AS ultima_fecha FROM factura');
                            $row = $result->fetch_assoc();
                            $ultima_fecha = $row['ultima_fecha']; // Devuelve la más reciente entre ambas tablas
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A", strtotime($ultima_fecha)); ?>
                            </div>
                        </div>
                    </div>
                </div>


                <a href="../report/excelFactura.php" class="btn btn-success mb-3">
                    <i class="fas fa-file-excel me-2"></i> Descargar Excel Facturas
                </a>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabla Registros
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
<script>
    /*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
  
});
</script>

<script src="../charts/facturas/facturasMes.js"></script>
<script src="../charts/dashboard/ventasSemana.js"></script>


</body>


</html>