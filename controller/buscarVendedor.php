<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cedula'])) {
    $cedula = $conn->real_escape_string($_POST['cedula']);

    $sql = $conn->query("SELECT cod_vend, nombre_vend, telf_vend, estado_vend
                         FROM vendedor
                         WHERE cod_vend LIKE '$cedula%'
                         OR nombre_vend LIKE '%$cedula%'
                         LIMIT 10");

    if ($sql->num_rows > 0) {
        while ($data = $sql->fetch_object()) {
            if ($data->estado_vend == 0) continue; // Solo activos

            $json = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');

            echo "
            <div class='vendedor-item d-flex align-items-center p-2 mb-1 border rounded' data-vendedor='{$json}'>
                <div class='me-2 d-flex justify-content-center align-items-center' style='width:50px; height:50px; background:#e9ecef; border-radius:4px; font-weight:bold; font-size:14px;'>
                    ".substr($data->nombre_vend,0,1)."
                </div>
                <div>
                    <strong>{$data->nombre_vend}</strong><br>
                    <small class='text-muted'>Cedula: {$data->cod_vend} | Tel: {$data->telf_vend}</small>
                </div>
            </div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No se encontraron vendedores</div>";
    }
}
?>
