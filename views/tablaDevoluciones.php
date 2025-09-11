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
                <h1 class="mt-4">Lista de Devoluciones</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Registros</li>
                </ol>
                <div class="row">
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
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Productos mas devueltos
                            </div>
                            <div class="card-body"><canvas id="productosDevueltos" width="100%" height="40"></canvas></div>
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


                <a href="../report/excelDevoluciones.php" class="btn btn-success mb-3">
                    <i class="fas fa-file-excel me-2"></i> Descargar Excel Devoluciones
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
                                        <th>Codigo</th>
                                        <th>Factura N°</th>
                                        <th>Fecha</th>
                                        <th>Producto</th>
                                        <th>Cantidad Devuelta</th>
                                        <th>Motivo</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta = $conn->query('SELECT devolucion.*, detalle_factura_temp.*, producto.nombre_product
                                        FROM 
                                        devolucion
                                        LEFT JOIN 
                                            detalle_factura_temp ON devolucion.cod_detalle = detalle_factura_temp.cod_detalle
                                        LEFT JOIN
                                            producto ON detalle_factura_temp.cod_product = producto.cod_product');
                                    while ($datos = $consulta->fetch_object()) { ?>
                                        <tr>
                                            <td><?= $datos->cod_devo ?></td>
                                            <td><?= $datos->cod_fact ?></td>
                                            <td><?= $datos->fecha_devo ?></td>
                                            <td><?= $datos->nombre_product ?></td>
                                            <td style="width:fit-content;" ><?= $datos->cant_devo ?></td>
                                            <td><?= $datos->motivo_devo != "" ? $datos->motivo_devo : 'Sin Motivo' ?></td>
                                            <td>$<?= number_format($datos->total_devo, 2) ?></td>
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
<script src="../charts/devoluciones/devolucionesMes.js"></script>
<script src="../charts/devoluciones/productosDevueltos.js"></script>
<script src="../js/chat-bot.js"></script>


</body>


</html>