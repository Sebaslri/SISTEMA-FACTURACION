<?php
if (!empty($_POST['toggle_cliente'])) {
    $cliente_id = $_POST['toggle_cliente'];

    $consulta_estado = $conn->query("SELECT estado_client FROM cliente WHERE cod_client = '$cliente_id'");
    $cliente = $consulta_estado->fetch_object();

    if ($cliente) {
        $nuevo_estado = ($cliente->estado_client == 1) ? 0 : 1;

        if ($conn->query("UPDATE cliente SET estado_client = '$nuevo_estado' WHERE cod_client = '$cliente_id'")) {
            // Enviar respuesta con el nuevo estado (ON u OFF)
            echo "1-" . ($nuevo_estado == 1 ? "ON" : "OFF");
        } else {
            echo "0";
        }
        exit;
    }
}
?>