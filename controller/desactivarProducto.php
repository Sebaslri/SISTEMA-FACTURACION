<?php
if (!empty($_POST['toggle_producto'])) {
    $producto_id = $_POST['toggle_producto'];

    $consulta_estado = $conn->query("SELECT estado_product FROM producto WHERE cod_product = '$producto_id'");
    $producto = $consulta_estado->fetch_object();

    if ($producto) {
        $nuevo_estado = ($producto->estado_product == 1) ? 0 : 1;

        if ($conn->query("UPDATE producto SET estado_product = '$nuevo_estado' WHERE cod_product = '$producto_id'")) {
            // Enviar respuesta con el nuevo estado (ON u OFF)
            echo "1-" . ($nuevo_estado == 1 ? "ON" : "OFF");
        } else {
            echo "0";
        }
        exit;
    }
}
?>