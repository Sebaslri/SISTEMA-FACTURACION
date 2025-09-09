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
if (!empty($_GET['status']) && $_GET['status'] == 'VendorOn') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Vendedor activado.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'VendorOff') { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Vendedor desactivado.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php
if (!empty($_GET['status']) && $_GET['status'] == 'updatedVendor') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Vendedor actualizado exitosamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'NoUpdatedVendor') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error al actualizar Vendedor.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

