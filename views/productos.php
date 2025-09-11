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
                <h1 class="mt-4">Productos</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Productos</li>
                </ol>
                <?php
                include '../models/mensajeProducto.php';
                ?>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                Productos por Categoría
                            </div>
                            <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
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
                                Cantidad Productos vendidos
                            </div>
                            <div class="card-body"><canvas id="productosChart" width="100%" height="235"></canvas></div>
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
                <div class="container-fluid px-1 mb-5">
                    <form method="POST" action="../controller/registrarProducto.php" enctype="multipart/form-data" id="formRegistro">
                        <div class="row">
                            <!-- Lado izquierdo: Imagen -->
                            <div class="col-md-6 mb-3">
                                <div class="drop-area" id="dropArea">
                                    <div id="initialContent" class="initial-content">
                                        <p>Arrastra y suelta tu imagen aquí</p>
                                        <p style="margin-top: 10px; font-size: 14px; color: #999;">o haz clic para seleccionar</p>
                                        <p style="margin-top: 5px; font-size: 12px; color: #999;">(Formatos: JPG, PNG, JPEG)</p>
                                    </div>
                                    <div id="previewContainer" class="hidden preview-container">
                                        <img id="imagePreview" class="preview-image">
                                        <button type="button" id="removeBtn" class="remove-btn">×</button>
                                    </div>
                                    <input type="file" id="fotoproducto" class="file-input" name="fotoproducto" accept="image/jpeg, image/png, image/jpg">
                                </div>
                            </div>
                            <!-- Lado derecho: Inputs -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre" class="form-label"><b>Nombre del producto</b></label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar Nombre">
                                        <small class="text-success" id="nombreError"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="stock" class="form-label"><b>Stock</b></label>
                                        <input type="number" min="1" class="form-control" name="stock" id="stock" placeholder="Ingresar Stock">
                                        <small class="text-success" id="stockError"></small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="precio" class="form-label"><b>Precio</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" min="1" step="0.01" class="form-control" name="precio" id="precio" placeholder="0.00">
                                        </div>
                                        <small class="text-success" id="precioError"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="descuento" class="form-label"><b>Descuento</b></label>
                                        <div class="input-group">
                                            <input type="number" min="0" step="0.01" class="form-control" name="descuento" id="descuento" placeholder="0%">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <small class="text-success" id="descuentoError"></small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="categoria" class="form-label"><b>Categoría</b></label>
                                        <select name="categoria" id="categoria" class="form-select">
                                            <option value="" selected disabled>Seleccionar Categoría...</option>
                                            <?php
                                            $sql = $conn->query('SELECT * FROM categoria');
                                            while ($datos = $sql->fetch_object()) { ?>
                                                <option value="<?= $datos->cod_cate ?>"><?= $datos->descrip_cate ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="text-success" id="cateError"></small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="proveedor" class="form-label"><b>Proveedor</b></label>
                                        <select name="proveedor" id="proveedor" class="form-select">
                                            <option value="" selected disabled>Seleccionar Proveedor...</option>
                                            <?php
                                            $sql = $conn->query('SELECT * FROM proveedor');
                                            while ($datos = $sql->fetch_object()) { ?>
                                                <option value="<?= $datos->cod_prove ?>"><?= $datos->nombre_prove ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="text-success" id="proveError"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg mx-auto d-block mt-4" style="width: 60%;" name="btnguardar" value="ok">Registrar Producto</button>
                    </form>
                </div>
                <a href="../report/excelProductos.php" class="btn btn-success mb-3">
                    <i class="fas fa-file-excel me-2"></i> Descargar Excel Productos
                </a>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabla Productos
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm align-middle text-center" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th>Descuento</th>
                                        <th>Categoria</th>
                                        <th>Proveedor</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta = $conn->query('SELECT producto.*, proveedor.nombre_prove, proveedor.cod_prove, categoria.cod_cate, categoria.descrip_cate
                                        FROM 
                                        producto 
                                        LEFT JOIN 
                                            proveedor ON producto.cod_prove = proveedor.cod_prove
                                        LEFT JOIN
                                            categoria ON producto.cod_cate = categoria.cod_cate');
                                    while ($datos = $consulta->fetch_object()) { ?>
                                        <tr>
                                            <td><img width="100%" height="100%" src="<?= $datos->foto_product ?>" alt=""></td>
                                            <td><?= $datos->nombre_product ?></td>
                                            <td><?= $datos->stock_product ?></td>
                                            <td>$<?= $datos->precio_product ?></td>
                                            <td><?= $datos->descuento_product ?>%</td>
                                            <td><?= $datos->descrip_cate ?></td>
                                            <td><?= $datos->nombre_prove ?></td>
                                            <td><?= $datos->estado_product ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $datos->cod_product ?>"><i class="fa-solid fa-pen" style="font-size: 1.5em;"></i></a>
                                                <a onclick="return activaDesactivarProducto(<?= $datos->cod_product ?>)" class="btn btn-outline-success btn-sm btn-toggle-estado"><i class="fa-solid fa-power-off" style="font-size: 1.5em;"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $datos->cod_product ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $datos->cod_product ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel<?= $datos->cod_product ?>">Editar Producto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form method="POST" action="../controller/editarProducto.php" enctype="multipart/form-data">
                                                                <input type="hidden" value="<?= $datos->cod_product ?>" name="cod_product"> <!--Tienes que incorporar el ID del cliente para que al momento que envias el formulario se mande el ID al controlador-->
                                                                <input type="hidden" value="<?= $datos->foto_product ?>" name="foto_product"><!--PHP accede a los datos enviados por POST (o GET) usando el atributo name-->
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    $imagen = $datos->foto_product; // ruta como '../assets/productos/123.png'
                                                                    $imagenCargada = !empty($imagen) && file_exists($imagen);
                                                                    ?>
                                                                    <div class="drop-area <?= $imagenCargada ? 'image-loaded' : '' ?>">
                                                                        <input type="file" class="file-input" id="fotoproducto" name="fotoproducto" accept="image/*">

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
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="nombre" class="form-label"><b>Nombre del producto</b></label>
                                                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar Nombre" value="<?= $datos->nombre_product ?>" required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="stock" class="form-label"><b>Stock</b></label>
                                                                            <input type="number" min="1" class="form-control" name="stock" id="stock" placeholder="Ingresar Stock" value="<?= $datos->stock_product ?>" required>
                                                                        </div>

                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="precio" class="form-label"><b>Precio</b></label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-text">$</span>
                                                                                <input type="number" min="1" step="0.01" class="form-control" name="precio" id="precio" placeholder="0.00" value="<?= $datos->precio_product ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="descuento" class="form-label"><b>Descuento</b></label>
                                                                            <div class="input-group">
                                                                                <input type="number" min="0" class="form-control" name="descuento" id="descuento" placeholder="0.00" value="<?= $datos->descuento_product ?>" required>
                                                                                <span class="input-group-text">%</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="categoria" class="form-label"><b>Categoría</b></label>
                                                                            <select name="categoria" id="categoria" class="form-select">
                                                                                <option value="" selected disabled>Seleccionar Categoría...</option>
                                                                                <?php
                                                                                $sql = $conn->query('SELECT * FROM categoria');
                                                                                while ($categorias = $sql->fetch_object()) { ?>
                                                                                    <option value="<?= $categorias->cod_cate ?>" <?= $datos->cod_cate == $categorias->cod_cate ? "selected" : "" ?>><?= $categorias->descrip_cate ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="proveedor" class="form-label"><b>Proveedor</b></label>
                                                                            <select name="proveedor" id="proveedor" class="form-select">
                                                                                <option value="" selected disabled>Seleccionar Proveedor...</option>
                                                                                <?php
                                                                                $sql = $conn->query('SELECT * FROM proveedor');
                                                                                while ($proveedores = $sql->fetch_object()) { ?>
                                                                                    <option value="<?= $proveedores->cod_prove ?>" <?= $datos->cod_prove == $proveedores->cod_prove ? "selected" : "" ?>><?= $proveedores->nombre_prove ?></option>
                                                                                <?php } ?>
                                                                            </select>
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
<script src="../js/productos.js"></script>
<script src="../js/chat-bot.js"></script>
<script src="../charts/productos/productosPorCategoria.js"></script>
<script src="../charts/productos/productosSemana.js"></script>
<script src="../charts/productos/top5Productos.js"></script>


</body>

</html>