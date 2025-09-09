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
if (!empty($_GET['status']) && $_GET['status'] == 'ProveOn') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Proveedor activado.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'ProveOff') { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Proveedor desactivado.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php
if (!empty($_GET['status']) && $_GET['status'] == 'updatedProve') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Proveedor actualizado exitosamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'NoUpdatedProve') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error al actualizar Proveedor.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>