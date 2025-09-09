<?php
if (!empty($_POST['toggle_vendedor'])) {
    $vendedor_id = $_POST['toggle_vendedor'];

    $consulta_estado = $conn->query("SELECT estado_vend FROM vendedor WHERE cod_vend = '$vendedor_id'");
    $vendedor = $consulta_estado->fetch_object();

    if ($vendedor) {
        $nuevo_estado = ($vendedor->estado_vend == 1) ? 0 : 1;

        if ($conn->query("UPDATE vendedor SET estado_vend = '$nuevo_estado' WHERE cod_vend = '$vendedor_id'")) {
            // Enviar respuesta con el nuevo estado (ON u OFF)
            echo "1-" . ($nuevo_estado == 1 ? "ON" : "OFF");
        } else {
            echo "0";
        }
        exit;
    }
}
?>