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
                <h1 class="mt-4">Vendedores</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Vendedores</li>
                </ol>
                <?php
                include '../models/mensajeVendedor.php';
                ?>
                <div class="row">
                    <div class="col-xl-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Vendedores activos
                            </div>
                            <div class="card-body"><canvas id="vendedoresEstado" width="100%" height="50"></canvas></div>
                            <?php
                            // Zona horaria de Ecuador
                            date_default_timezone_set('America/Guayaquil');
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Vendedores con más ventas ultimos 6 meses
                            </div>
                            <div class="card-body"><canvas id="vendedoresMes" width="100%" height="35"></canvas></div>
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
                </div>

                <div class="container-fluid px-1 mb-5">
                    <form method="POST" action="../controller/registrarVendedor.php" enctype="multipart/form-data" id="formRegistro">

                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cedula" class="form-label"><b>Cédula</b></label>
                                <input type="text" class="form-control" name="cedula" id="cedula" value="" placeholder="Ingresar Cédula" maxlength="10">
                                <small class="text-success" id="cedulaError"></small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="nombre" class="form-label"><b>Nombre</b></label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="" placeholder="Ingresar Nombre">
                                <small class="text-success" id="nombreError"></small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="apellido" class="form-label"><b>Apellido</b></label>
                                <input type="text" class="form-control" name="apellido" id="apellido" value="" placeholder="Ingresar Apellido">
                                <small class="text-success" id="apellidoError"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="telf" class="form-label"><b>Teléfono</b></label>
                                <input type="text" class="form-control" name="telf" id="telf" value="" placeholder="Ingresar Teléfono" maxlength="10">
                                <small class="text-success" id="telfError"></small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="correo" class="form-label"><b>Correo</b></label>
                                <input type="text" class="form-control" name="correo" id="correo" value="" placeholder="example@hotmail.com">
                                <small class="text-success" id="correoError"></small>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="direccion" class="form-label"><b>Direccion</b></label>
                                <input type="text" class="form-control" name="direccion" id="direccion" value="" placeholder="Ej: PRADERA 1 MZ. D117 V. 12">
                                <small class="text-success" id="direcError"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="provincia" class="form-label"><b>Provincia</b></label>
                                <select name="provincia" id="provincia" class="form-select">
                                    <option value="" selected disabled>Seleccionar Provincia...</option>
                                    <?php
                                    $sql = $conn->query('SELECT * FROM provincia');
                                    while ($datos = $sql->fetch_object()) { ?>
                                        <option value="<?= $datos->cod_prov ?>"><?= $datos->descrip_prov ?></option>
                                    <?php } ?>
                                </select>
                                <small class="text-success" id="provError"></small>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="canton" class="form-label"><b>Cantón</b></label>
                                <select name="canton" id="canton" class="form-select">
                                    <option value="" selected disabled>Seleccionar Cantón...</option>
                                </select>
                                <small class="text-success" id="cantonError"></small>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-lg mx-auto d-block" style="width: 60%;" name="btnguardar" value="ok">Registrar Vendedor</button>
                    </form>
                </div>
                <a href="../report/excelVendedores.php" class="btn btn-success mb-3">
                    <i class="fas fa-file-excel me-2"></i> Descargar Excel
                </a>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabla Vendedores
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-sm align-middle text-center" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                        <th>Cantón</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta = $conn->query('SELECT vendedor.*, canton.* FROM vendedor 
                                            LEFT JOIN 
                                            canton ON vendedor.cod_canton = canton.cod_canton ');
                                    while ($datos = $consulta->fetch_object()) { ?>
                                        <tr>
                                            <td><?= $datos->cod_vend ?></td>
                                            <td><?= $datos->nombre_vend ?></td>
                                            <td><?= $datos->apellido_vend ?></td>
                                            <td><?= $datos->telf_vend ?></td>
                                            <td><?= $datos->correo_vend ?></td>
                                            <td><?= $datos->direccion_vend ?></td>
                                            <td><?= $datos->descrip_canton ?></td>
                                            <td><?= $datos->estado_vend ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $datos->cod_vend ?>"><i class="fa-solid fa-user-pen" style="font-size: 1.5em;"></i></a>
                                                <a onclick="return activaDesactivarVendedor('<?= $datos->cod_vend ?>')" class="btn btn-outline-success btn-sm btn-toggle-estado"><i class="fa-solid fa-power-off" style="font-size: 1.5em;"></i></a>                                            </td>
                                            </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $datos->cod_vend ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $datos->cod_vend ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel<?= $datos->cod_vend ?>">Editar Vendedor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="../controller/editarVendedor.php" enctype="multipart/form-data">
                                                            <input type="hidden" value="<?= $datos->cod_vend ?>" id="cod_vende" name="cod_vend"> <!--Tienes que incorporar el ID del vende para que al momento que envias el formulario se mande el ID al controlador-->
                                                            <div class="row">
                                                                <div class="col-md-3 mb-3">
                                                                    <label for="nombre" class="form-label"><b>Nombre</b></label>
                                                                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $datos->nombre_vend ?>" placeholder="Ingresar Nombre" required>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <label for="apellido" class="form-label"><b>Apellido</b></label>
                                                                    <input type="text" class="form-control" name="apellido" id="apellido" value="<?= $datos->apellido_vend ?>" placeholder="Ingresar Apellido" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="telf" class="form-label"><b>Teléfono</b></label>
                                                                    <input type="text" class="form-control" name="telf" id="telf" value="<?= $datos->telf_vend ?>" placeholder="Ingresar Teléfono" maxlength="10" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="correo" class="form-label"><b>Correo</b></label>
                                                                    <input type="text" class="form-control" name="correo" id="correo" value="<?= $datos->correo_vend ?>" placeholder="example@hotmail.com" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="direccion" class="form-label"><b>Direccion</b></label>
                                                                    <input type="text" class="form-control" name="direccion" id="direccion" value="<?= $datos->direccion_vend ?>" placeholder="Ej: PRADERA 1 MZ. D117 V. 12" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="provinciaedit" class="form-label"><b>Provincia</b></label>
                                                                    <select name="provinciaedit" id="provinciaedit" class="form-select provincia-select" required>
                                                                        <option value="" disabled>Seleccionar Provincia...</option>
                                                                        <?php
                                                                        $sql = $conn->query('SELECT * FROM provincia');
                                                                        while ($datosprov = $sql->fetch_object()) { ?>
                                                                            <option value="<?= $datosprov->cod_prov ?>" <?= $datos->cod_prov == $datosprov->cod_prov ? "selected" : "" ?>><?= $datosprov->descrip_prov ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="cantonedit" class="form-label"><b>Cantón</b></label>
                                                                    <select name="cantonedit" id="cantonedit" class="form-select canton-select" required>
                                                                        <option value="" selected disabled>Seleccionar Cantón...</option>
                                                                        <?php
                                                                        $sql = $conn->query("SELECT * FROM canton WHERE cod_prov = $datos->cod_prov");
                                                                        while ($datoscanton = $sql->fetch_object()) { ?>
                                                                            <option value="<?= $datoscanton->cod_canton ?>" <?= $datos->cod_canton == $datoscanton->cod_canton ? "selected" : "" ?>><?= $datoscanton->descrip_canton ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
<script src="../js/Vendedores.js"></script>
<script src="../charts/vendedores/vendedoresPorMes.js" ></script>
<script src="../charts/vendedores/vendedoresEstado.js" ></script>

</body>


</html>