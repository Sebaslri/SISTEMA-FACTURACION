<?php
if (!empty($_GET['status']) && $_GET['status'] == 'success') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Registro exitoso.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'error') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error en el registro.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php
if (!empty($_GET['status']) && $_GET['status'] == 'productOn') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Producto activado.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'productOff') { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Producto desactivado.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php
if (!empty($_GET['status']) && $_GET['status'] == 'updatedProduct') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Producto actualizado exitosamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'NoUpdatedProduct') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error al actualizar Producto.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>