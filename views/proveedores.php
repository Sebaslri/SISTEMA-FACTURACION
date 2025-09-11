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
                <h1 class="mt-4">Proveedores</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Proveedores</li>
                </ol>
                <?php
                include '../models/mensajeProveedores.php';
                ?>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Proveedores Activos
                            </div>
                            <div class="card-body"><canvas id="proveedoresEstado" width="100%" height="40"></canvas></div>
                            <?php
                            // Zona horaria de Ecuador
                            date_default_timezone_set('America/Guayaquil');
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                Proveedores por tipo de contribuyente
                            </div>
                            <div class="card-body"><canvas id="clasificacionProve" width="100%" height="40"></canvas></div>
                            <?php
                            // Zona horaria de Ecuador
                            date_default_timezone_set('America/Guayaquil');
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A"); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid px-1 mb-5">
                    <form method="POST" action="../controller/registrarProveedor.php" enctype="multipart/form-data" id="formRegistro">
                        <div class="row">
                            <!-- Lado izquierdo: Imagen -->
                            <div class="col-md-6 mb-3">
                                <div class="drop-area" id="dropArea">
                                    <div id="initialContent" class="initial-content">
                                        <p>Arrastra y suelta tu logo aquí</p>
                                        <p style="margin-top: 10px; font-size: 14px; color: #999;">o haz clic para seleccionar</p>
                                        <p style="margin-top: 5px; font-size: 12px; color: #999;">(Formatos: JPG, PNG, JPEG)</p>
                                    </div>
                                    <div id="previewContainer" class="hidden preview-container">
                                        <img id="imagePreview" class="preview-image">
                                        <button type="button" id="removeBtn" class="remove-btn">×</button>
                                    </div>
                                    <input type="file" id="fotoprove" class="file-input" name="fotoprove" accept="image/jpeg, image/png, image/jpg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tipo-persona" class="form-label"><b>Tipo de Contribuyente</b></label>
                                        <select name="tipo-persona" id="tipo-persona" class="form-select">
                                            <option value="" selected>Seleccionar tipo...</option>
                                            <?php
                                            $sql = $conn->query('SELECT * FROM tipo_cliente');
                                            while ($datos = $sql->fetch_object()) { ?>
                                                <option value="<?= $datos->cod_tipo_client ?>"><?= $datos->descrip_tipo_client ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="text-success" id="tipoPersoError"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="RUC" class="form-label"><b>RUC</b></label>
                                        <input type="text" class="form-control" name="RUC" id="RUC" value="" placeholder="Ingresar RUC" maxlength="13">
                                        <small class="text-success" id="rucError"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre" class="form-label"><b>Razón social</b></label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="" placeholder="Ingresar Nombre">
                                        <small class="text-success" id="nombreError"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="telf" class="form-label"><b>Teléfono</b></label>
                                        <input type="text" class="form-control" name="telf" id="telf" value="" placeholder="Ingresar Teléfono" maxlength="10">
                                        <small class="text-success" id="telfError"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="correo" class="form-label"><b>Correo</b></label>
                                        <input type="text" class="form-control" name="correo" id="correo" value="" placeholder="example@hotmail.com">
                                        <small class="text-success" id="correoError"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="direccion" class="form-label"><b>Dirección</b></label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="" placeholder="Ej: PRADERA 1 MZ. D117 V. 12">
                                        <small class="text-success" id="direcError"></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg mx-auto d-block mt-4" style="width: 60%;" name="btnguardar" value="ok">Registrar Proveedor</button>
                    </form>
                </div>
                <a href="../report/excelProveedores.php" class="btn btn-success mb-3">
                    <i class="fas fa-file-excel me-2"></i> Descargar Excel Proveedores
                </a>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabla Proveedores
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm align-middle text-center" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>RUC</th>
                                        <th>Tipo Contribuyente</th>
                                        <th>Razón Social</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta = $conn->query('SELECT proveedor.*, tipo_cliente.descrip_tipo_client
                                        FROM 
                                        proveedor 
                                        LEFT JOIN 
                                        tipo_cliente ON proveedor.cod_tipo_client = tipo_cliente.cod_tipo_client');
                                    while ($datos = $consulta->fetch_object()) { ?>
                                        <tr>
                                            <td><img width="80" height="80" src="<?= $datos->logo_prove ?>" alt=""></td>
                                            <td><?= $datos->cod_prove ?></td>
                                            <td><?= $datos->descrip_tipo_client ?></td>
                                            <td><?= $datos->nombre_prove ?></td>
                                            <td><?= $datos->telf_prove ?></td>
                                            <td><?= $datos->correo_prove ?></td>
                                            <td><?= $datos->direccion_prove ?></td>
                                            <td><?= $datos->estado_prove ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $datos->cod_prove ?>"><i class="fa-solid fa-pen" style="font-size: 1.5em;"></i></a>
                                                <a onclick="return activaDesactivarProveedor('<?= $datos->cod_prove ?>')" class="btn btn-outline-success btn-sm btn-toggle-estado"><i class="fa-solid fa-power-off" style="font-size: 1.5em;"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $datos->cod_prove ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $datos->cod_prove ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel<?= $datos->cod_prove ?>">Editar Proveedor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form method="POST" action="../controller/editarProveedor.php" enctype="multipart/form-data">
                                                                <input type="hidden" value="<?= $datos->cod_prove ?>" name="cod_prove"> <!--Tienes que incorporar el ID del cliente para que al momento que envias el formulario se mande el ID al controlador-->
                                                                <input type="hidden" value="<?= $datos->logo_prove ?>" name="logo_prove"><!--PHP accede a los datos enviados por POST (o GET) usando el atributo name-->
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    $imagen = $datos->logo_prove; // ruta como '../assets/Proveedores/123.png'
                                                                    $imagenCargada = !empty($imagen) && file_exists($imagen);
                                                                    ?>
                                                                    <div class="drop-area <?= $imagenCargada ? 'image-loaded' : '' ?>">
                                                                        <input type="file" class="file-input" id="logoprove" name="logoprove" accept="image/*">

                                                                        <div id="initialContent" class="initial-content <?= $imagenCargada ? 'hidden' : '' ?>">
                                                                            <p>Arrastra y suelta tu imagen aquí</p>
                                                                            <p style="margin-top: 10px; font-size: 14px; color: #999;">o haz clic para seleccionar</p>
                                                                            <p style="margin-top: 5px; font-size: 12px; color: #999;">(Formatos: JPG, PNG, JPEG)</p>
                                                                        </div>
                                                                        <div class="preview-container <?= $imagenCargada ? '' : 'hidden' ?>">
                                                                            <img src="<?= $imagen ?>" class="preview-image" />
                                                                            <button type="button" class="remove-btn">×</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="mb-3">
                                                                            <label for="nombre" class="form-label"><b>Razón social</b></label>
                                                                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $datos->nombre_prove ?>" placeholder="Ingresar Nombre" required>
                                                                            <small class="text-success" id="nombreError"></small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="mb-3">
                                                                            <label for="telf" class="form-label"><b>Teléfono</b></label>
                                                                            <input type="text" class="form-control" name="telf" id="telf" value="<?= $datos->telf_prove ?>" placeholder="Ingresar Teléfono" maxlength="10" required>
                                                                            <small class="text-success" id="telfError"></small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="mb-3">
                                                                            <label for="correo" class="form-label"><b>Correo</b></label>
                                                                            <input type="text" class="form-control" name="correo" id="correo" value="<?= $datos->correo_prove ?>" placeholder="example@hotmail.com" required>
                                                                            <small class="text-success" id="correoError"></small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="mb-3">
                                                                            <label for="direccion" class="form-label"><b>Dirección</b></label>
                                                                            <input type="text" class="form-control" name="direccion" id="direccion" value="<?= $datos->direccion_prove ?>" placeholder="Ej: PRADERA 1 MZ. D117 V. 12" required>
                                                                            <small class="text-success" id="direcError"></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                                </div>
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
<script src="../js/proveedores.js"></script>
<script src="../js/chat-bot.js"></script>
<script src="../charts/proveedores/proveedoresEstado.js"></script>
<script src="../charts/proveedores/clasificacionProve.js"></script>



</body>

</html>