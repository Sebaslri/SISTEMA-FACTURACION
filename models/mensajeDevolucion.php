<?php
if (!empty($_GET['status']) && $_GET['status'] == 'success') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Devolución registrada.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'error') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error en la devolución.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>